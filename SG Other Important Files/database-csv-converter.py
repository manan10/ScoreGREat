import mysql.connector
import csv

mydb = mysql.connector.connect(
  host="test.c1ruqdbfywti.ap-south-1.rds.amazonaws.com",
  user="admin",
  passwd="admin1234",
  database="scoregreat"
)

cursor = mydb.cursor()

cursor.execute("select * from public_discussion_data;")
with open("public_discussion_data.csv", "w", newline='') as csv_file:            
    csv_writer = csv.writer(csv_file)
    csv_writer.writerow([i[0] for i in cursor.description]) #write headers
    csv_writer.writerows(cursor) 

