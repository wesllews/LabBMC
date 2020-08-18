import csv

#Abrindo Dados
with open('wild/wild.csv', newline='\n') as csvfile:
	read_wild = csv.DictReader(csvfile, delimiter=',')

	#Abrindo dois arquivos
	with open("../SQL/5.wild.sql", 'w') as file, open('../Dados/individual.csv', 'a') as individual:

		for row in read_wild:
			
			identification = row['Identification']
			category = 2
			sex = row['Sex']
			name = f"\'{row['Name']}\'" if row['Name']!="" else "NULL"

			#Escrevendo inserts
			sql= f"INSERT INTO `individual` (`id`, `identification`, `id_category`, `sex`, `name`) VALUES (NULL,'{identification}', '{category}', '{row['Sex']}', {name});\n"			
			file.write(sql)

			#Escrevendo tabela de individuos
			csv= f",{identification},{category},{row['Sex']},{row['Name']}\n"
			individual.write(csv)