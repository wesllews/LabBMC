import csv

#Inserindo status - Arquivo SQL
with open('status/status.csv', newline='\n') as csvfile:
	reader = csv.DictReader(csvfile, delimiter=',')
	

	with  open("../SQL/6.status.sql", 'w') as file:

		for row in reader: 
			sql = f"INSERT INTO `status` (`id_individual`, `id_institute`, `alive`) VALUES ('{row['ID']}', (SELECT id FROM institute WHERE abbreviation='{row['Location']}'), '{row['Alive']}');\n"
			file.write(sql)
