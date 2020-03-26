import csv

# Lendo Arquivo para criar o SQL
with open('historic/BLT_historic.csv', newline='\n') as csvfile:
	read_BLT_historic = csv.DictReader(csvfile, delimiter=',')
	
	#stud= "1"
	#id_individual = 3

	with open("todos_inserts.sql", 'a') as file:


		#Select de relacionamentos
		Select = "SELECT identification,sex, sire, dam FROM individual INNER JOIN kinship ON individual.identification = kinship.id_individual WHERE sire = 1 or dam = 2;\n\n"
		file.write(Select)


		for row in read_BLT_historic:
			"""
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
				"""
			Sire = row['Sire']
			"""
			#DAM
			if row['Dam'] == "WILD":
				Dam = 1
			elif row['Dam'] == "UNKNOWN":
				Dam = 2
			elif row['Dam'] != "NA":
				Dam = int(row['Dam'])+2
			else:
				"""
			Dam = row['Dam']
			id_individual = row['Stud']

			# Usando 'f-string' para criar linha SQL
			sql = f"INSERT INTO `kinship` (`id_individual`, `sire`, `dam`, `excluded`, `excluded_date`) VALUES ('{id_individual}', '{Sire}', '{Dam}', NULL, NULL);\n"
			
			#Consistência de dados - removendo a linha sem histórico
			if Sire !="NA" and Dam !="NA":
				file.write(sql)
