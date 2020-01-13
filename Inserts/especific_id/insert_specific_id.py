
# Criando um arquivo com todos os "NA" da coluna 0, substituido pelos id do individuo.
# Acrescentar os id_institutes aos nomes dos institutes.

#Variaveis globais
linha_BLT = []
linha_institute =[]


#Adicionando os id_institute em uma matriz a partir do arquivo institute.csv
with open('../institute/institute.csv', 'r') as institute:
    read_institute = institute.readlines()

for i in range(len(read_institute)):
	linha = str(read_institute[i])
	linha= linha.split(",")
	linha_institute.append(linha)


#Abrindo studybook e colocando os resultados em matriz, substituindo os NA da coluna 0, pelos respectivos ids de individuo
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


# Arquivo SQL com os inserts
with open("insert_specific_id.sql", 'w') as file:

	for i in range(1,len(linha_BLT)):
		file.write("INSERT INTO `specific_id_individual` (`id`, `id_individual`, `id_institute`, `excluded`, `excluded_date`) VALUES ('"+linha_BLT[i][8]+"', '"+linha_BLT[i][0]+"', '"+linha_BLT[i][5]+"', NULL, NULL);\n")




