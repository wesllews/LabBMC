import csv


#Abrindo Dados
with open('../Dados/BLT.csv', newline='\n') as csvfile:
	read_BLT = csv.DictReader(csvfile, delimiter=',')

	#Abrindo dois arquivos
	with open("../SQL/1.individual.sql", 'w') as file, open('../Dados/individual.csv', 'w') as individual:
		id=0
		header= "id,identification,id_category,sex,name\n"
		individual.write(header)

		for row in read_BLT:
			category = 1
			name = f"\'{row['Name']}\'" if row['Name']!="" else "NULL"

			if row['Stud'] != "NA":
				
				#Escrevendo inserts
				sql= f"INSERT INTO `individual` (`id`, `identification`, `id_category`, `sex`, `name`) VALUES (NULL, '{row['Stud']}', '{category}', '{row['Sex']}', {name});\n"
				file.write(sql)

				#Escrevendo tabela de individuos
				id+=1
				csv= f"{id},{row['Stud']},{category},{row['Sex']},{row['Name']}\n"
				individual.write(csv)