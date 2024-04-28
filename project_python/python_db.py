import mysql.connector
from tabulate import tabulate
from datetime import datetime


def open_database(hostname, user_name, mysql_pw, database_name):
    global conn
    conn = mysql.connector.connect(host=hostname,
                                   user=user_name,
                                   password=mysql_pw,
                                   database=database_name
                                   )
    global cursor
    cursor = conn.cursor()


def printFormat(result):
    header = []
    for cd in cursor.description:  # get headers
        header.append(cd[0])
    print('')
    print('Query Result:')
    print('')
    return(tabulate(result, headers=header))  # print results in table format

# select and display query



def executeSelect(query, params=None):
    if params is None:
        cursor.execute(query)
    else:
        cursor.execute(query, params)
    res = cursor.fetchall()
    return res


def insert(table, values):
    values_str = ', '.join(["'" + str(val) + "'" for val in values])    
    print(f"\nvalues_str: {values_str}\n")
    query = "INSERT into " + table + " values (" + values_str + ")" + ';'
    cursor.execute(query)
    conn.commit()

def insertGame(table, values):
    print(f"\nDATE(insertGame):\n{values[5]}") #debug
    date_obj = datetime.strptime(values[5], '%Y-%m-%d')  # Convert the date string to a datetime object
    date_str = date_obj.strftime('%Y-%m-%d')
    values[5] = date_str
    print(f"\nDATE(before values_str):\n{values[5]}") #debug
    values_str = ', '.join(map(str, values))
    print(f"\nDATE(after values_str):\n{values[5]}") #debug

    query = "INSERT INTO {} VALUES (%s, %s, %s, %s, %s, %s)"
    cursor.execute("INSERT INTO {} VALUES (%s, %s, %s, %s, %s, %s)".format(table), values)
    conn.commit()


def nextId(table):
    query = "SELECT IFNULL(MAX(GameID), 0) AS max_id FROM " + table 
    cursor.execute(query)
    result = cursor.fetchall()[0][0]
    return 1 if result is None else int(result) + 1

def nextIdPlayer(table):
    query = "SELECT IFNULL(MAX(playerID), 0) AS max_id FROM " + table 
    cursor.execute(query)
    result = cursor.fetchall()[0][0]
    return 1 if result is None else int(result) + 1


def executeUpdate(query):  # use this function for delete and update
    cursor.execute(query)
    conn.commit()


def close_db():  # use this function to close db
    cursor.close()
    conn.close()


###   TEST #####
# mysql_username = 'replaceIt' # please change to your MySQL username
# mysql_password ='replaceIt'  # please change to your MySQL password
# open_database('localhost',mysql_username,mysql_password,mysql_username) # open database   
# executeSelect('SELECT * FROM ITEM'); # This is just a sample test, replace with your query
# insert('ITEM',"'jbg',22,23.5,1 ")# This is just a sample test, replace with your query
# executeSelect('SELECT * FROM ITEM where supplier_id = 22;')# checking if the value is updated
# executeUpdate('delete from ITEM where supplier_id = 22;')# testing delete
# executeSelect('SELECT * FROM ITEM where supplier_id = 22;')# checking if the id = 22 does not exist
# # executeUpdate("Update SUPPLIER set supplier_id = 20 where address ='Yemen';")# testing update
# # executeSelect("SELECT * FROM SUPPLIER where address = 'Yemen';")# checking the updated value
# close_db()# close database
