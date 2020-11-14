import csv

# FRAGMENT
with open('wild_location/fragment.csv', newline='\n') as csvfile:
	read_fragment = csv.DictReader(csvfile, delimiter=',')

	with open("../SQL/6.fragment.sql", 'w') as file:
		for row in read_fragment:
			sql= f"INSERT INTO `fragment` (`id`, `fragment`, `abbreviation`, `country`, `state`, `city`) VALUES (NULL, '{row['fragment']}', NULL, '{row['country']}', '{row['state']}', NULL);\n"
			file.write(sql)

# GROUP
with open('wild_location/group.csv', newline='\n') as csvfile:
	read_group = csv.DictReader(csvfile, delimiter=',')

	with open("../SQL/11.group.sql", 'w') as file:
		for row in read_group:

			longitude = f"\'{row['Longitude']}\'" if row['Longitude']!="" else "NULL"
			latitude = f"\'{row['Latitude']}\'" if row['Latitude']!="" else "NULL"

			sql= f"INSERT INTO `group` (`id`, `id_fragment`, `group`, `longitude`, `latitude`) VALUES (NULL, (SELECT id FROM fragment WHERE fragment='{row['Fragment']}'), '{row['Group']}', {longitude}, {latitude});\n"
			file.write(sql)

#IND_GROUP
with open('wild/wild.csv', newline='\n') as csvfile:
	read_wild = csv.DictReader(csvfile, delimiter=',')

	#Abrindo dois arquivos
	with open("../SQL/12.ind_group.sql", 'w') as file, open('../Dados/individual.csv', 'a') as individual:

		for row in read_wild:
			longitude = f"\'{row['Longitude']}\'" if row['Longitude']!="" else "NULL"
			latitude = f"\'{row['Latitude']}\'" if row['Latitude']!="" else "NULL"

			sql = f"INSERT INTO `ind_group` (`id_individual`, `id_group`, `longitude_ind`, `latitude_ind`) VALUES ( (SELECT id FROM individual WHERE identification='{row['Identification']}'), (SELECT `group`.id FROM `group` INNER JOIN fragment ON `group`.id_fragment=fragment.id WHERE fragment='{row['Fragment']}' and `group`='{row['Group']}' ), {longitude}, {latitude});\n"
			file.write(sql)