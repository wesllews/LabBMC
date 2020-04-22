import csv

#Abrindo Dados
with open('wild/wild.csv', newline='\n') as csvfile:
	read_wild = csv.DictReader(csvfile, delimiter=',')

	#Escrevendo inserts
	with open("todos_inserts.sql", 'a') as file:
	#with open("wild_location/insert_wild_location.sql", 'w') as file:

		for row in read_wild:
			
			identification = row['Identification']
			Fragment= row['Fragment']
			Pop = row['Pop']
			Group = row['Group'] if row['Group']!="" else None 
			Longitude = row['Longitude'] if row['Longitude']!="" else None
			Latitude = row['Latitude'] if row['Latitude']!="" else None

			sql= f"INSERT INTO `wild_location` (`id_individual`, `fragment`, `pop`, `group`, `longitude`, `latitude`, `excluded`, `excluded_date`) VALUES ('{identification}', '{Fragment}', '{Pop}', '{Group}', '{Longitude}', '{Latitude}', NULL, NULL);\n"
			file.write(sql)