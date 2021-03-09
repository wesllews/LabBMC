import csv

# Lendo Locus (Header) do arquivo CSV
with open('haplotype/haplotypes.csv', newline='\n') as csvfile:
	read_genotipos = csv.reader(csvfile, delimiter=',')

	# Salvando o nome dos locus.
	locus = next(read_genotipos,None)

	with  open("../SQL/14.haplotypes.sql", 'w') as file:
		for row in read_genotipos:
			id_individual = row[0]

			# Removendo coluna 0, StudBook da lista de locus
			for i in range (1,len(locus)): 

				id_locus = locus[i]
				alelo = row[i]

				if alelo !="0":
					sql = f"INSERT INTO `haplotype` (`id`,`id_individual`, `id_mitochondrial_locus`, `haplotype`, `restricted`) VALUES (NULL, (SELECT id FROM individual WHERE name LIKE '%{id_individual}'), (SELECT id FROM mitochondrial_locus WHERE mitochondrial_locus='{id_locus}'), '{alelo}', 0) ;\n"		
					file.write(sql)

		


"""
BIBLIOGRAFIA:
	- https://www.geeksforgeeks.org/working-csv-files-python/
"""
