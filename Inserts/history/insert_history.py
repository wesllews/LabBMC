#Variaveis globais
linha_BLT = []
lista_event =["Zero","Birth", "Capture", "Transfer", "Release", "Death"]


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

	for i in range(len(linha_BLT)):
		if linha_BLT[i][9]!="5" and linha_BLT[i][9].rfind("[")==-1:
			file.write("INSERT INTO `history` (`id`, `id_individual`, `id_events`, `id_institute`, `observation`, `excluded`, `excluded_date`) VALUES (NULL,'"+linha_BLT[i][0]+"', '"+linha_BLT[i][9]+"', '"+linha_BLT[i][5]+"',NULL, 'n', NULL);\n")
		elif linha_BLT[i][9]=="5":
			file.write("INSERT INTO `history` (`id`, `id_individual`, `id_events`, `id_institute`, `observation`, `excluded`, `excluded_date`) VALUES (NULL,'"+linha_BLT[i][0]+"', '"+linha_BLT[i][9]+"', '"+linha_BLT[i][5]+"','"+linha_BLT[i+1][9]+"', 'n', NULL);\n")

