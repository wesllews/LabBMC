import csv

#Abrindo Dados
with open('wild/wild.csv', newline='\n') as csvfile:
	read_wild = csv.DictReader(csvfile, delimiter=',')

	#Escrevendo inserts
	with open("todos_inserts.sql", 'w') as file:
	#with open("wild/insert_wild.sql", 'w') as file:

		for row in read_wild:
			
			identification = row['Identification']
			category = 2
			sex = row['Sex']
			name = row['Name'] if row['Name']!="" else None

			sql= f"INSERT INTO `individual` (`identification`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES ('{identification}', '{category}', '{row['Sex']}', '{name}', NULL, NULL);\n"
			file.write(sql)