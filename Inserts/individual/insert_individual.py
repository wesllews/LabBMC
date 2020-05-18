import csv


#Abrindo Dados
with open('../Dados/BLT.csv', newline='\n') as csvfile:
	read_BLT = csv.DictReader(csvfile, delimiter=',')

	#Escrevendo inserts
	with open("../SQL/1.individual.sql", 'w') as file:
		for row in read_BLT:

			category = 1
			name = f"\'{row['Name']}\'" if row['Name']!="" else "NULL"

			if row['Stud'] != "NA":

					sql= f"INSERT INTO `individual` (`identification`, `id_category`, `sex`, `name`) VALUES ('{row['Stud']}', '{category}', '{row['Sex']}', {name});\n"
					file.write(sql)
#	BIBLIOGRAFIA
#	https://pynative.com/python-mysql-select-query-to-fetch-data/
	