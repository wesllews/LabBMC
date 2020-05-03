import csv

#Abrindo Dados
with open('wild/wild.csv', newline='\n') as csvfile:
	read_wild = csv.DictReader(csvfile, delimiter=',')

	#Escrevendo inserts
	with open("../SQL/7.wild.sql", 'w') as file:
	#with open("wild/insert_wild.sql", 'w') as file:

		for row in read_wild:
			
			identification = row['Identification']
			category = 2
			sex = row['Sex']
			name = f"\'{row['Name']}\'" if row['Name']!="" else "NULL"

			sql= f"INSERT INTO `individual` (`identification`, `id_category`, `sex`, `name`) VALUES ('{identification}', '{category}', '{row['Sex']}', {name});\n"			
			file.write(sql)