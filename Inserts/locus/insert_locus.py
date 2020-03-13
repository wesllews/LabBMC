import csv

#Inserindo Locus - Arquivo SQL
with open('locus.csv', newline='\n') as csvfile:
	reader = csv.DictReader(csvfile, delimiter=',')
	

	with open("insert_locus.sql", 'w') as file:

		for row in reader:
			sql = f"INSERT INTO `locus` (`id`, `locus`, `excluded`, `excluded_date`) VALUES (NULL, '{row['Locus']}', NULL, NULL);\n"
			file.write(sql)
