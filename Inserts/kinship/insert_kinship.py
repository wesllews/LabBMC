import csv

# Lendo Arquivo para criar o SQL
with open('historic/BLT_historic.csv', newline='\n') as csvfile:
	read_BLT_historic = csv.DictReader(csvfile, delimiter=',')

	with open("../SQL/4.kinship.sql", 'w') as file:


		for row in read_BLT_historic:
			
			Sire = row['Sire']
			Dam = row['Dam']
			id_individual = row['Stud']

			# Usando 'f-string' para criar linha SQL
			sql = f"INSERT INTO `kinship` (`id_individual`, `sire`, `dam`) VALUES ('{id_individual}', '{Sire}', '{Dam}');\n"
			
			#Consistência de dados - removendo a linha sem histórico
			if Sire !="NA" and Dam !="NA":
				file.write(sql)
