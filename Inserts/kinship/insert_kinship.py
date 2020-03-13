import csv

# Lendo Arquivo para criar o SQL
with open('../historic/BLT_historic.csv', newline='\n') as csvfile:
	read_BLT_historic = csv.DictReader(csvfile, delimiter=',')
	
	stud= "1"
	id_individual = 3

	with open("insert_kinship.sql", 'w') as file:

		#Select de relacionamentos
		Select = "SELECT id, studbook, sex FROM individual INNER JOIN kinship ON individual.id = kinship.id_individual WHERE sire = 3 and dam = 4;\n\n"
		file.write(Select)


		for row in read_BLT_historic:

			if stud != row['Stud']:
				stud = row['Stud']
				id_individual+=1

			# SIRE
			if row['Sire'] == "WILD":
				Sire = 1
			elif row['Sire'] == "UNKNOWN":
				Sire = 2
			elif row['Sire'] != "NA":
				Sire = int(row['Sire'])+2
			else:
				Sire = row['Sire']

			#DAM
			if row['Dam'] == "WILD":
				Dam = 1
			elif row['Dam'] == "UNKNOWN":
				Dam = 2
			elif row['Dam'] != "NA":
				Dam = int(row['Dam'])+2
			else:
				Dam = row['Dam']

			# Usando 'f-string' para criar linha SQL
			sql = f"INSERT INTO `kinship` (`id_individual`, `sire`, `dam`, `excluded`, `excluded_date`) VALUES ('{id_individual}', '{Sire}', '{Dam}', NULL, NULL);\n"
			
			#Consistência de dados - removendo a linha sem histórico
			if Sire !="NA" and Dam !="NA":
				file.write(sql)
