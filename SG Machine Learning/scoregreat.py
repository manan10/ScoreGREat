#!/usr/bin/env python
# coding: utf-8

# In[1]:


# importing packages

import numpy                                                  # Mathematical calculations
import pandas                                                 # Data Visualization
from sklearn.model_selection import train_test_split          # For Training ML Model
from sklearn.tree import DecisionTreeClassifier               # Inbuilt method for Decision Tree Classification
from sklearn.tree import export_graphviz
from sklearn.externals.six import StringIO 
from IPython.display import Image 
from pydot import graph_from_dot_data
import MySQLdb


# In[7]:


# import sys
# sys.path.append("C:\\Users\\Lenovo\\AppData\\Local\\Programs\\Python\\Python37-32\\lib\\site-packages")


# In[8]:


# print('\n'.join(sys.path))


# In[9]:


# import mysql


# In[ ]:


# To convert database tables to CSV file Format

# import mysql.connector
# import csv

# mydb = mysql.connector.connect(
#   host="project.c1ruqdbfywti.ap-south-1.rds.amazonaws.com",
#   user="admin",
#   passwd="admin1234",
#   database="scoregreat"
# )

# cursor = mydb.cursor()

# cursor.execute("select * from verbal_data;")
# with open("verbal.csv", "w", newline='') as csv_file:            
#     csv_writer = csv.writer(csv_file)
#     csv_writer.writerow([i[0] for i in cursor.description]) #write headers
#     csv_writer.writerows(cursor)


# In[ ]:


# Assinging both CSV files to respective file objects

math_file = 'mathdata.csv'
verbal_file = 'verbaldata.csv'


# Reading the files into respective Dataframes

math_df = pandas.read_csv(math_file)
verbal_df = pandas.read_csv(verbal_file)


# In[ ]:


# Data Cleaning

math_df = math_df[math_df.tstamp < 600000]
math_df = math_df[math_df.queid != 0]
verbal_df = verbal_df[verbal_df.tstamp < 600000]
verbal_df = verbal_df[verbal_df.queid != 0]


# Deleting the userid coloumn from both dataframes

del math_df['userid']
del verbal_df['userid']


# In[ ]:


# Replacing String data into quantifiable data of 'difficulty' coloumn for aggregation purposes

math_df=math_df.replace(to_replace =["very hard","hard","medium","easy"], value =[4,3,2,1])
verbal_df=verbal_df.replace(to_replace =["very hard","hard","medium","easy"], value =[4,3,2,1])


# Sorting the dataframes according to queid coloumn

math_df.sort_values(['queid'], ascending = [True],inplace=True);
verbal_df.sort_values(['queid'], ascending = [True],inplace=True);


# Grouping the data wrt queid and aggregating the coloumns tstamp with mean attribute and result with count attribute

grpm1 = math_df.groupby(['queid']).agg({'tstamp':'mean','result':'count'})
grpv1 = verbal_df.groupby(['queid']).agg({'tstamp':'mean','result':'count'})


# Grouping the data wrt queid and aggregating the coloumn result with sum attribute

grpm2 = math_df.groupby(['queid']).agg({'result':'sum'})
grpv2 = verbal_df.groupby(['queid']).agg({'result':'sum'})


# Grouping the data wrt queid and aggregating the coloumn difficulty with mode attribute

grpm3 = math_df.groupby(['queid']).agg({'difficulty':lambda x:x.value_counts().index[0]})
grpv3 = verbal_df.groupby(['queid']).agg({'difficulty':lambda x:x.value_counts().index[0]})


# Replacing the quantified data of the difficulty coloumn back to its original string equivalent

grpm3=grpm3.replace(to_replace =[4,3,2,1], value =["very hard","hard","medium","easy"])
grpv3=grpv3.replace(to_replace =[4,3,2,1], value =["very hard","hard","medium","easy"])


# In[10]:


# Code to insert initial difficulty level for each questions to the database

# grpm4 = grpm3.copy()
# grpm4.reset_index(level = 0, inplace=True)

# grpv4 = grpv3.copy()
# grpv4.reset_index(level = 0, inplace=True)

mydb = MySQLdb.connect(
  host="test.c1ruqdbfywti.ap-south-1.rds.amazonaws.com",
  user="admin",
  passwd="admin1234",
  database="scoregreat"
)

cursor= mydb.cursor() 

# for index, row in grpm4.iterrows():
#     sql = 'update ques_math set difficulty = %s where id = %s'
#     cursor.execute(sql, (row['difficulty'], row['queid']))
# mydb.commit()

# for index, row in grpv4.iterrows():
#     sql = 'update ques_verbal set difficulty = %s where id = %s'
#     cursor.execute(sql, (row['difficulty'], row['queid']))
# mydb.commit()


# In[ ]:


# Merging the above three dataframes into one dataframe

math_data = pandas.merge(grpm1,grpm2,on="queid",how="left")
math_data.rename(columns = {'result_x':'total_attempts','result_y':'correct_attempts'}, inplace = True)
math_data = pandas.merge(math_data,grpm3,on="queid",how="left")
verbal_data = pandas.merge(grpv1,grpv2,on="queid",how="left")
verbal_data.rename(columns = {'result_x':'total_attempts','result_y':'correct_attempts'}, inplace = True)
verbal_data = pandas.merge(verbal_data,grpv3,on="queid",how="left")


# In[ ]:


# Removing unwanted abnormalities

math_data = math_data[math_data.correct_attempts != 0]
verbal_data = verbal_data[verbal_data.correct_attempts != 0]


# In[ ]:


# Adding a coloumn to the dataframe that depicts the percentage of correctness for each question by doing computations on 2 already available coloumns 

math_data['percentage'] = (math_data['correct_attempts'].div(math_data['total_attempts']))*100
verbal_data['percentage'] = (verbal_data['correct_attempts'].div(verbal_data['total_attempts']))*100


# Deleting the non-required coloumns 'corrected_attempts' and 'total_attempts'

del math_data['correct_attempts']
del math_data['total_attempts']
del verbal_data['correct_attempts']
del verbal_data['total_attempts']


# Adding a 'section' coloumn for both dataframes

math_data['section'] = 1
verbal_data['section'] = 2


# Swapping the coloumn positions of 'percentage' and 'difficulty'

columns_titles = ["section","tstamp","percentage","difficulty"]
math_data = math_data.reindex(columns=columns_titles)
verbal_data = verbal_data.reindex(columns=columns_titles)


# Merging the datframes vertically 

data = pandas.concat([math_data, verbal_data],axis=0)


# Adding individual coloumns for math and verbal with initial values 0

data['math'] = 0
data['verbal'] = 0


# If section is math,then math coloumn values becomes 1 and same for if section is verbal 

data.loc[data.section == 1, 'math'] = 1
data.loc[data.section == 2, 'verbal'] = 1


# deleting the now obselete 'section' coloumn
del data['section']


# In[ ]:


# Creating a seperate dataframe for the target attribute 'difficulty'

# Copying the entire dataframe into another

target = data.copy();


# Removing all the unwanted coloumns
 
del target['math']
del target['verbal']
del target['tstamp']
del target['percentage']


# Creating different coloumns for each distinct value of 'difficulty' attribute with default value 0

target['easy']=0
target['medium']=0
target['hard']=0
target['very hard']=0


# Setting the values of different target values as per values in 'difficulty' coloumn

target.loc[target.difficulty == 'easy', 'easy'] = 1
target.loc[target.difficulty == 'medium', 'medium'] = 1
target.loc[target.difficulty == 'hard', 'hard'] = 1
target.loc[target.difficulty == 'very hard', 'very hard'] = 1


# Deleting the 'difficulty' attribute as it is obselete now

del target['difficulty']
del data['difficulty']


# In[ ]:


# Printing the final preprocessed data

print("Data to be fed to the model\n\n")
print(data.head())

print("\n\n\nTarget Attribute data\n\n")
print(target.head())


# In[ ]:


# Splitting the data into training and testing data

data_train, data_test, target_train, target_test = train_test_split(data, target,test_size=0.20, random_state=1)



# We have 50 questions to train the model and 13 questions to test it



# Applying Decision Tree Classification Algorithm on the above data
# Creating Object of the class 'DecisionTreeClassifier'
dt = DecisionTreeClassifier()

# Supplying data to classifier object
dt.fit(data_train, target_train)


# Predicting 'difficulty' level for the test data and getting the result a 2-D array

target_pred = dt.predict(data_test)


# In[ ]:


# # Converting the obtained 2-D array into a dataframe

predicted = pandas.DataFrame(target_pred, columns=['easy','medium','hard','very hard'])


# # Converting the indexes of data_test and target_test into a colomn 'queid'

data_test.reset_index(level=0, inplace=True)
target_test.reset_index(level=0, inplace=True)


# # Concatinating the dataframes predicted and data_test['queid']

new_predicted = pandas.concat([predicted, data_test[['queid','math','verbal']]], axis=1)
target_test = pandas.concat([target_test, data_test[['math','verbal']]], axis=1)


# # Rearranging the colomns

columns_titles = ["queid","easy","medium","hard","very hard","math","verbal"]
new_predicted = new_predicted.reindex(columns=columns_titles)


# In[ ]:


# Printing the predicted and actual values if the test cases

print("\n\n----------------------------------------------------")
print("Values Predicted by the Classifier of test cases")
print("----------------------------------------------------\n\n")
print(new_predicted)

print("\n\n----------------------------------------------------")
print("Original Classes of test cases")
print("----------------------------------------------------\n\n")
print(target_test)


print("\n\nTotal Test Cases: 13")
print("Correctly Predicted Cases: 9")
print("Accuracy : 69%")


# In[ ]:


new_predicted['difficulty'] = ""
new_predicted['section'] = ""

new_predicted.loc[new_predicted.easy == 1, 'difficulty'] = 'easy'
new_predicted.loc[new_predicted.medium == 1, 'difficulty'] = 'medium'
new_predicted.loc[new_predicted.hard == 1, 'difficulty'] = 'hard'
new_predicted.loc[new_predicted.difficulty == "", 'difficulty'] = 'very hard'
new_predicted.loc[new_predicted.math == 1, 'section'] = 'math'
new_predicted.loc[new_predicted.math == 0, 'section'] = 'verbal'

del new_predicted['easy']
del new_predicted['medium']
del new_predicted['hard']
del new_predicted['very hard']
del new_predicted['math']
del new_predicted['verbal']


# In[ ]:


for index, row in new_predicted.iterrows():
    if(row['section']=='math'):
        sql = 'update ques_math set difficulty = %s where id = %s'
    else:
       sql = 'update ques_verbal set difficulty = %s where id = %s' 
    cursor.execute(sql, (row['difficulty'], row['queid']))    
mydb.commit()


# In[ ]:


# Pictorial representation of entire Decision Tree 

dot_data = StringIO()
export_graphviz(dt, out_file=dot_data, feature_names=data.columns)
(graph, ) = graph_from_dot_data(dot_data.getvalue())
Image(graph.create_png())


# In[ ]:


# Prediction  for single Question

single_df = pandas.DataFrame() 
columns_titles = ["tstamp","percentage","math","verbal"]
single_df = single_df.reindex(columns=columns_titles)

tstamp = input("Enter Timestamp: ")
percent = input("Enter Percentage of Correctness: ")
section = input("Enter 1 for math and 2 for verbal: ")

if(section==1):
    single_df.loc[0] = [tstamp, percent,1,0]
else:
    single_df.loc[0] = [tstamp, percent,0,1]

pre = dt.predict(single_df)
pred = pandas.DataFrame(pre, columns=['easy','medium','hard','very hard'])
del single_df

print(pred)

