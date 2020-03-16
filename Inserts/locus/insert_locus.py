import csv

#Inserindo Locus - Arquivo SQL
with open('locus/locus.csv', newline='\n') as csvfile:
	reader = csv.DictReader(csvfile, delimiter=',')
	

	with  open("todos_inserts.sql", 'a') as file:

		for row in reader:
			sql = f"INSERT INTO `locus` (`locus`, `excluded`, `excluded_date`) VALUES ('{row['Locus']}', NULL, NULL);\n"
			file.write(sql)
