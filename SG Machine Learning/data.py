import mysql.connector
import pandas

mydb = mysql.connector.connect(
  host="test.c1ruqdbfywti.ap-south-1.rds.amazonaws.com",
  user="admin",
  passwd="admin1234",
  database="scoregreat"
)

cursor = mydb.cursor()

# Assinging both CSV files to respective file objects

math_file = 'math_diff.csv'
verbal_file = 'verbal_diff.csv'


# Reading the files into respective Dataframes

math = pandas.read_csv(math_file)
verbal = pandas.read_csv(verbal_file)

print(math.head())
print(verbal.head())

"""for index, row in math.iterrows():
	sql = 'update ques_math set difficulty = %s where id = %s'     
	cursor.execute(sql, (row['difficulty'], row['queid']))
mydb.commit()

for index, row in verbal.iterrows():
	sql = 'update ques_verbal set difficulty = %s where id = %s'
	cursor.execute(sql, (row['difficulty'], row['queid']))
mydb.commit()"""
