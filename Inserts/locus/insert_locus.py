import csv

#Inserindo Locus - Arquivo SQL
with open('locus/locus.csv', newline='\n') as csvfile:
	reader = csv.DictReader(csvfile, delimiter=',')
	

	with  open("../SQL/9.locus.sql", 'w') as file:

		for row in reader: 
			sql = f"INSERT INTO `locus` (`id`,`locus`, `type`, `motif`, `reference`, `forward`, `reverse`) VALUES (NULL, '{row['locus']}','{row['type']}','{row['motif']}','{row['reference']}', '{row['forward']}','{row['reverse']}');\n"
			file.write(sql)
