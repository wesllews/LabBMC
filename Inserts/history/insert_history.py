#Variaveis globais
linha_BLT = []
linha_institute =[]
lista_event =["Zero","Birth", "Capture", "Transfer", "Loan to", "Release", "Death"]


#Adicionando os id_institute em uma matriz a partir do arquivo institute.csv
with open('../institute/institute.csv', 'r') as institute:
    read_institute = institute.readlines()

for i in range(len(read_institute)):
	linha = str(read_institute[i])
	linha= linha.split(",")
	linha_institute.append(linha)

# Substituindo os NA da coluna 0, pelos respectivos ids de individuo
with open('../../Dados/BLT.csv', 'r') as dados:
    read_BLT = dados.readlines()

for i in range(len(read_BLT)):
	linha = str(read_BLT[i])
	linha= linha.split(",")

	#Substituindo "NA" por id's enquanto salva em uma matriz
	if linha[0] != "NA":
		aux_id = linha[0]
	else:
		linha[0]=aux_id
	linha_BLT.append(linha)

#inserindo coluna 'id_institute' no studbook
linha_BLT[0].insert(5,"id_institute") 

# Fazendo um 'merge' entre o nome e o id dos intitutes(location)
aux_institute_id ="a"
aux_institute_abbreviation ="a"

for i in range(len(linha_BLT)):
	for j in range(len(linha_institute)):

		if linha_BLT[i][5]==linha_institute[j][2]:
			linha_BLT[i].insert(5,linha_institute[j][0])
			#Guardando o ultimo id e abreviacao utilizado no mesmo animal
			aux_institute_id = linha_institute[j][0]
			aux_institute_abbreviation = linha_institute[j][2]

		elif linha_BLT[i][5]=="NA":
			linha_BLT[i].insert(5,aux_institute_id)
			linha_BLT[i][6]= aux_institute_abbreviation


# Arquivo criado para trabalhar com o historico
with open("../../Dados/BLT_history.csv", 'w') as file:

	for i in range(len(linha_BLT)):

		for j in range(len(linha_BLT[i])):
			valor = linha_BLT[i][j].split("\n")
			file.write(valor[0])
			file.write(",")
		file.write("\n")


#Abrindo studybook editado e colocando os resultados em matriz.
with open('../../Dados/BLT_history.csv', 'r') as dados:
    read_BLT = dados.readlines()

for i in range(len(read_BLT)):
	linha = str(read_BLT[i])
	linha= linha.split(",")
	linha_BLT.append(linha)

#inserindo coluna com os id's dos eventos no studbook
linha_BLT[0].insert(9,"Event ID") 

for i in range(len(linha_BLT)):
	for j in range(len(lista_event)):

		if linha_BLT[i][9]==lista_event[j]:
			linha_BLT[i].insert(9,str(j))

# Arquivo criado para trabalhar com o historico
with open("../../Dados/BLT_history.csv", 'w') as file:

	for i in range(len(linha_BLT)):

		for j in range(len(linha_BLT[i])):
			valor = linha_BLT[i][j].split("\n")
			file.write(valor[0])
			file.write(",")
		file.write("\n")


# Arquivo SQL com os inserts
with open("insert_historic.sql", 'w') as file:

	Death = str(lista_event.index('Death'))
	for i in range(len(linha_BLT)):
		if linha_BLT[i][9]!=Death and linha_BLT[i][9].rfind("[")==-1:
			file.write("INSERT INTO `history` (`id`, `id_individual`, `id_events`, `id_institute`, `observation`, `excluded`, `excluded_date`) VALUES (NULL,'"+linha_BLT[i][0]+"', '"+linha_BLT[i][9]+"', '"+linha_BLT[i][5]+"',NULL, 'n', NULL);\n")
		elif linha_BLT[i][9]==Death:
			file.write("INSERT INTO `history` (`id`, `id_individual`, `id_events`, `id_institute`, `observation`, `excluded`, `excluded_date`) VALUES (NULL,'"+linha_BLT[i][0]+"', '"+linha_BLT[i][9]+"', '"+linha_BLT[i][5]+"','"+linha_BLT[i+1][9]+"', 'n', NULL);\n")

