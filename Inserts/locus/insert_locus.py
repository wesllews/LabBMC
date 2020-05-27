import csv

#Inserindo Locus - Arquivo SQL
with open('locus/locus.csv', newline='\n') as csvfile:
	reader = csv.DictReader(csvfile, delimiter=',')
	

	with  open("../SQL/9.locus.sql", 'w') as file:

		for row in reader: 
			sql = f"INSERT INTO `locus` (`locus`, `type`, `reference`, `forward`, `reverse`) VALUES ('{row['locus']}','{row['type']}', '{row['reference']}', '{row['forward']}','{row['reverse']}');\n"
			file.write(sql)
