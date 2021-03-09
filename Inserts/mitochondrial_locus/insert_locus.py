import csv

#Inserindo Locus - Arquivo SQL
with open('mitochondrial_locus/locus.csv', newline='\n') as csvfile:
	reader = csv.DictReader(csvfile, delimiter=',')
	

	with  open("../SQL/13.mitochondrial_locus.sql", 'w') as file:

		for row in reader: 
			sql = f"INSERT INTO `mitochondrial_locus` (`id`,`mitochondrial_locus`) VALUES (NULL, '{row['locus']}');\n"
			file.write(sql)
