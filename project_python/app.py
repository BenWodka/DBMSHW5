# from flask import Flask, Blueprint, render_template, request, redirect, url_for, flash
# from flask_sqlalchemy import SQLAlchemy
import subprocess
import python_db
import json

mysql_username = 'bmw032'  # please change to your username
mysql_password = 'ieroo6Ro'  # please change to your MySQL password

app = Flask(__name__)
app.secret_key = "secretkey" #necessary for flash message

#prefixes url to ensure correct redirection
mod = Blueprint('project', __name__, url_prefix='/~bmw032/project_python')

@mod.before_app_first_request
def initialize():
     subprocess.run(['./filldata.sh'], check=True)

@mod.route('/')
def home():
    return render_template("home.php")

@mod.route('/addgame', methods=['POST', 'GET'])
def addGame():
    if request.method == 'POST':
        team1 = request.form["team1"]
        team2 = request.form["team2"]
        score1 = request.form["score1"]
        score2 = request.form["score2"]
        date = request.form["date"]

        team1ID = getTeamID(team1)
        team2ID = getTeamID(team2)
        
        if not team1ID or not team2ID:
             flash("One or more teams not found. Check your spelling and try again")
             return redirect(url_for("project.addGame"))

        nextID = nextID("Game")
        values = (nextID, team1ID,team2ID,score1,score2,date)

        openDB()
        python_db.insert("Game", values)
        closeDB()

        flash('Game added successfully!', 'success')
        return redirect(url_for("project.addGame"))
    else:
        return render_template("addgame.php")
    
def openDB():
    python_db.open_database('localhost', mysql_username, mysql_password, mysql_username)

def closeDB():
     python_db.close_db()

def getTeamID(teamName):
     openDB()
     teamNameLike = "%" + teamName + "%"
     sql = "SELECT TeamID FROM Team WHERE Location LIKE %s OR Nickname LIKE %s"
     teamID = python_db.executeSelect(sql, (teamNameLike, teamNameLike))
     closeDB()
     return teamID

app.register_blueprint(mod)

if __name__ == "__main__":
    app.run(debug=True)