import csv

# Merge de Num_Studbook e id_individual
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


with open('Genotipos_cativeiro.csv', 'r') as file:
	read_genotipos = file.readlines()


lista_id = []
with open('identification.csv', newline='\n') as identification:
	read_identification = csv.DictReader(identification, delimiter=',')

	for identification in read_identification: 
		for row in read_genotipos:
			studbook = row.split(",")[0]

			if studbook == identification['identification']:
				lista_id.append(identification['id_individual'])

print(lista_id)



