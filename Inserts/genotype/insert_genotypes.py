import csv

"""
# CRIANDO RELAÇÃO ID_INDIVIDUAL X STUDBOOK
with open('../historic/BLT_historic.csv', newline='\n') as csvfile:
	read_BLT_historic = csv.DictReader(csvfile, delimiter=',')
	id_individual = 3 # Representa o id dos indivíduos no Banco de dados. Os primeiros individuos são: Wild(1) e Unkown(2)

	with open("identification.csv", 'w') as file:
		cabecalho = "id_individual,identification\n"
		file.write(cabecalho)

		for row in read_BLT_historic:
			# As linhas que possuem sexo do indivíduo são também as primeiras linhas de com cada numero de studbook.
			if row['Sex'] !="NA":
				linha = f"{id_individual},{row['Stud']}\n"
				file.write(linha)
				id_individual+=1
"""


# Lendo Locus (Header) do arquivo CSV
with open('genotype/Genotipos_cativeiro.csv', newline='\n') as csvfile:
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

				sql = f"INSERT INTO `genotype` (`id_individual`, `id_locus`, `alelo`, `excluded`, `excluded_date`) VALUES ('{id_individual}', '{id_locus}', '{alelo}', NULL, NULL);\n"		
				file.write(sql)

		


"""
BIBLIOGRAFIA:
	- https://www.geeksforgeeks.org/working-csv-files-python/
"""
