import csv


#Abrindo Dados
with open('../Dados/BLT.csv', newline='\n') as csvfile:
	read_BLT = csv.DictReader(csvfile, delimiter=',')

	#Escrevendo inserts
	with open("todos_inserts.sql", 'w') as file:
		for row in read_BLT:

			category = 1
			name = row['Name'] if row['Name']!="" else None

			if row['Stud'] != "NA":

					sql= f"INSERT INTO `individual` (`identification`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES ('{row['Stud']}', '{category}', '{row['Sex']}', '{name}', NULL, NULL);\n"
					file.write(sql)

		UPDATE = f"\nUPDATE individual SET name = NULL WHERE name ='None';\n"
		file.write(UPDATE)
#	BIBLIOGRAFIA
#	https://pynative.com/python-mysql-select-query-to-fetch-data/
	