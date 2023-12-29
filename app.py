import mysql.connector
from flask import Flask
from flask import jsonify

app = Flask(__name__)

mydb = mysql.connector.connect(
  host="192.168.209.128",
  user="admin",
  password="123456",
  database="snorby"
)

mycursor = mydb.cursor()



# for x in myresult:
#   print(x)

@app.route("/events")
def summary():
    mycursor.execute("SELECT timestamp, INET_NTOA(ip_src), INET_NTOA(ip_dst), sig_priority, sig_name FROM events_with_join")
    myresult = mycursor.fetchall()
    return jsonify(myresult)

@app.route("/graph")
def graph():
    query="SELECT sig_name, count(*) as total_event from events_with_join where sig_name like '%POLICY%' or sig_name like '%Echo%' or sig_name like '%Windows%' group by sig_name;"
    mycursor.execute(query)
    myresult = mycursor.fetchall()
    return jsonify(myresult)

if __name__ == '__main__':
   app.run(host='192.168.209.1')

   