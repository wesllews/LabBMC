import csv

#Inserindo status - Arquivo SQL
with open('status/status.csv', newline='\n') as csvfile:
	reader = csv.DictReader(csvfile, delimiter=',')
	

	with  open("../SQL/7.status.sql", 'w') as file:

		for row in reader: 
			sql = f"INSERT INTO `status` (`id_individual`, `id_institute`, `id_fragment`, `alive`) VALUES ((SELECT id FROM individual WHERE identification='{row['ID']}'), (SELECT id FROM institute WHERE abbreviation='{row['Location']}'), NULL, '{row['Alive']}');\n"
			file.write(sql)

# WILD STATUS
with open('wild/wild.csv', newline='\n') as csvfile:
	read_wild = csv.DictReader(csvfile, delimiter=',')

	with open("../SQL/7.status.sql", 'a') as file:
		file.write("\n-- ************************************** `Wild Status`\n")
		for row in read_wild:
			sql = f"INSERT INTO `status` (`id_individual`, `id_institute`, `id_fragment`, `alive`) VALUES ((SELECT id FROM individual WHERE identification='{row['Identification']}'), NULL, (SELECT id FROM fragment WHERE fragment='{row['Fragment']}'), NULL);\n"
			file.write(sql)