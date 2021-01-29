import csv

# Lendo Locus (Header) do arquivo CSV
with open('genotype/genotipos.csv', newline='\n') as csvfile:
	read_genotipos = csv.reader(csvfile, delimiter=',')

	# Salvando o nome dos locus.
	locus = next(read_genotipos,None)

	with  open("../SQL/10.genotypes.sql", 'w') as file:
		for row in read_genotipos:
			id_individual = row[0]

			# Removendo coluna 0, StudBook da lista de locus
			for i in range (1,len(locus)): 

				id_locus = locus[i]
				alelo = row[i]

				if alelo !="0":
					sql = f"INSERT INTO `genotype` (`id`,`id_individual`, `id_locus`, `allele`, `restricted`) VALUES (NULL, (SELECT id FROM individual WHERE identification='{id_individual}'), (SELECT id FROM locus WHERE locus='{id_locus}'), '{alelo}', 0) ;\n"		
					file.write(sql)

		


"""
BIBLIOGRAFIA:
	- https://www.geeksforgeeks.org/working-csv-files-python/
"""
