import subprocess

mysql_username = 'bmw032'  # please change to your username
mysql_password = 'ieroo6Ro'  # please change to your MySQL password

def initialize():
     subprocess.run(['./filldata.sh'], check=True)