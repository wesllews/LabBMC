import csv

# Lendo Locus (Header) do arquivo CSV
with open('genotype/genotipos.csv', newline='\n') as csvfile:
	read_genotipos = csv.reader(csvfile, delimiter=',')

	# Salvando o nome dos locus.
	locus = next(read_genotipos,None)

	with  open("todos_inserts.sql", 'a') as file:
		for row in read_genotipos:
			id_individual = row[0]

			# Removendo coluna 0, StudBook da lista de locus
			for i in range (1,len(locus)): 

				id_locus = locus[i]
				alelo = row[i]

				if alelo !="0":
					sql = f"INSERT INTO `genotype` (`id_individual`, `id_locus`, `alelo`, `excluded`, `excluded_date`) VALUES ('{id_individual}', '{id_locus}', '{alelo}', NULL, NULL);\n"		
					file.write(sql)

		


"""
BIBLIOGRAFIA:
	- https://www.geeksforgeeks.org/working-csv-files-python/
"""
