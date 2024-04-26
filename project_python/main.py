import subprocess
import os
import sys
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
    # values[1] = "'" + values[1] + "'"  # Remove leading and trailing single quotes
    # values[2] = "'" + values[2] + "'"

    #convert team name into team ID
    openDB()
    gameID = python_db.nextId('Game')
    closeDB()

    values[0] = gameID

    print(f"\nvalues[1] == {values[1]}\n")

    team1 = str(values[1])
    print(f"\nteam1: (before getTeamID) {team1}\n")
    team1ID = getTeamID(team1)
    print(f"\nteam1: (before getTeamID) {team1}\n")

    values[1] = team1ID

    team2 = str(values[2])
    team2ID = getTeamID(team2)
    values[2] = team2ID

    # Convert the values list to a string format for SQL query
    # values_str = ', '.join(map(str, values))

    #query = "INSERT INTO Game VALUES (%s, %s, %s, %s, %s, %s)"
    
    #print(f"\nDATE(addGame):\n{values[5]}") #debug
    openDB()
    python_db.insertGame('Game', values)
    closeDB()



def main(operation, values):
    # running = True
    # while(running):
    #     menu()
    #     operation = input("\nEnter the number of the menu operation you'd like to perform\n")
    if operation == "addgame":
        addgame(values)
    elif operation == "addplayer":
        # Handle add player operation
        pass
        # case 3:
        #     print()
        # case 4:
        #     print()
        # case 5:
        #     print()
        # case 6:
        #     print()
        # case 7:
        #     print()
        # case 8:
        #     running = False
        #     print()
if __name__ == "__main__":
    if len(sys.argv) < 3:
        print("Not enough cmd arguments")
        sys.exit(1)

    operation = sys.argv[1]  # The operation to perform
    values = sys.argv[2:]    # Additional values passed in
    #initialize()
    main(operation, values)