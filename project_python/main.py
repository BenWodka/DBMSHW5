import subprocess
import os
import sys
import json
import python_db

# Enable error reporting by printing to stderr
sys.stderr.write("This is a debug message.\n")

mysql_username = 'bmw032'  # please change to your username
mysql_password = 'ieroo6Ro'  # please change to your MySQL password


def menu():
    print("\nWelcome to the NFL database. Select one of the following options:\n")
    print("1) Add a game to the game table\n")
    print("2) Add a player to the player table\n")
    print("3) View all players on a team\n")
    print("4) View all the a players in a given position on any team, e.g., all the quarterbacks\n")
    print("5) View all teams arranged by conference\n")
    print("6) View all games played by a given team\n")
    print("7) View all results on a given date\n")
    print("8) Quit\n")

# def initialize():
#     subprocess.run(['~/public_html/project_python/filldata.sh'], check=True)

def openDB():
    python_db.open_database('localhost', mysql_username, mysql_password, mysql_username)

def closeDB():
     python_db.close_db()

def getTeamID(teamName):
     openDB()
     #teamName1 = "%"
     sql = "SELECT TeamID FROM Team WHERE Location LIKE %s;"
     teamID = python_db.executeSelect(sql, (teamName,))
     closeDB()
     #necessary to prevent them coming back as empty lists
     if teamID:
        return teamID[0][0]  # Return the first TeamID if it exists
     else:
        return None  # Return None if no TeamID is found

def addgame(values):
    #convert team name into team ID
    openDB()
    gameID = python_db.nextId('Game')
    closeDB()

    values[0] = gameID
    team1 = str(values[1])
    team1ID = getTeamID(team1)
    values[1] = team1ID

    team2 = str(values[2])
    team2ID = getTeamID(team2)
    values[2] = team2ID

    openDB()
    python_db.insertGame('Game', values)
    closeDB()

def addplayer(values):
    openDB()
    playerID = python_db.nextIdPlayer('Player')
    closeDB()

    values[0] = playerID

    team = str(values[1])
    teamID = getTeamID(team)
    values[1] = teamID

    openDB()
    python_db.insert('Player', values)
    closeDB()

def viewplayers(values):
    # print(f"\nview players values: {values}\n")

    team = values[0].split()[0]
    #print(f"\nview players team: {team}\n")
    teamID = getTeamID(team)
    #print(f"\nview players ID: {teamID}\n")
    sql = "SELECT position, name \
            FROM Player \
            WHERE TeamID = %s"
    openDB()
    players = python_db.executeSelect(sql, (teamID,))
    closeDB()

    playersjson = json.dumps(players)
    print(playersjson)
    return playersjson

def viewposition(values):
    # print(f"\nview players values: {values}\n")

    team = values[0].split()[0]
    position = values[1]
    #print(f"\nview players team: {team}\n")
    teamID = getTeamID(team)
    #print(f"\nposition: {position}\n")
    sql = "SELECT position, name \
            FROM Player \
            WHERE TeamID = %s AND position = %s"
    openDB()
    players = python_db.executeSelect(sql, (teamID, position))
    closeDB()

    playersjson = json.dumps(players)
    print(playersjson)
    return playersjson

def standings():
    # sql = " SELECT Conference, Location, Nickname, COUNT(g1.TeamID1) AS TotalWins \
    #         FROM Team t \
    #         LEFT JOIN Game g1 ON t.TeamID = g1.TeamID1 AND g1.Score1 > g1.Score2 \
    #         GROUP BY t.Conference, t.Location, t.Nickname \
    #         ORDER BY t.Conference, TotalWins DESC"
    sql = """
            SELECT 
            t.Conference,
            t.Location,
            t.Nickname,
            CAST(SUM(CASE WHEN (g.TeamID1 = t.TeamID AND g.Score1 > g.Score2) OR (g.TeamID2 = t.TeamID AND g.Score2 > g.Score1) THEN 1 ELSE 0 END) AS SIGNED) AS Wins,
            CAST(SUM(CASE WHEN (g.TeamID1 = t.TeamID AND g.Score1 < g.Score2) OR (g.TeamID2 = t.TeamID AND g.Score2 < g.Score1) THEN 1 ELSE 0 END) AS SIGNED) AS Losses
            FROM Team t
            LEFT JOIN Game g ON t.TeamID = g.TeamID1 OR t.TeamID = g.TeamID2
            GROUP BY t.Conference, t.Location, t.Nickname
            ORDER BY t.Conference, Wins DESC, Losses
        """
    openDB()
    result = python_db.executeSelect(sql)
    closeDB()
    standings = [
            {
                "Conference": row[0],
                "Location": row[1],
                "Nickname": row[2],
                "Wins": int(row[3]),
                "Losses": int(row[4])
            } for row in result
        ]
    print(json.dumps(standings))
    return json.dumps(standings)

def gamesbyteam(team_name):
    sql = "SELECT t1.Location AS HomeLocation, t1.Nickname AS HomeNickname, t2.Location AS AwayLocation, t2.Nickname AS AwayNickname, g.date, g.Score1, g.Score2, \
            CASE WHEN g.Score1 > g.Score2 THEN 'Won' ELSE 'Lost' END AS Result \
            FROM Game g \
            JOIN Team t1 ON g.TeamID1 = t1.TeamID \
            JOIN Team t2 ON g.TeamID2 = t2.TeamID \
            WHERE t1.Location = %s OR t2.Location = %s \
            ORDER BY g.date DESC"
    openDB()
    games = python_db.executeSelect(sql, (team_name, team_name))
    closeDB()
    return json.dumps(games)

def resultsbydate(game_date):
    sql = "SELECT t1.Location AS Team1Location, t1.Nickname AS Team1Nickname, t2.Location AS Team2Location, t2.Nickname AS Team2Nickname, g.Score1, g.Score2, \
            CASE WHEN g.Score1 > g.Score2 THEN t1.Location ELSE t2.Location END AS Winner \
            FROM Game g \
            JOIN Team t1 ON g.TeamID1 = t1.TeamID \
            JOIN Team t2 ON g.TeamID2 = t2.TeamID \
            WHERE g.date = %s"
    openDB()
    results = python_db.executeSelect(sql, (game_date,))
    closeDB()
    return json.dumps(results)
    
def main(operation, values):
    if operation == "addgame":
        addgame(values)
    elif operation == "addplayer":
        addplayer(values)
    elif operation == "viewplayers":
        #print("Debug: Starting viewplayers with values:", values)
        viewplayers(values)
    elif operation == "viewposition":
        #print("Debug: Starting viewposition with values:", values)
        viewposition(values)
    elif operation == "viewstandings":
        standings()
    elif operation == "gamesbyteam":
        gamesbyteam(values)
    elif operation == "resultsbydate":
        resultsbydate(values)

if __name__ == "__main__":
    if len(sys.argv) < 2:
        print("Not enough arguments")
        sys.exit(1)

    operation = sys.argv[1]  # The operation to perform
    values = sys.argv[2:]    # Additional values passed in
    #initialize()
    main(operation, values)