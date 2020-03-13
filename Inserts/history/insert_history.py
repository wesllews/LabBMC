#Variaveis globais
linha_BLT = []
linha_BLT_history = []
linha_institute =[]
lista_event =["id Zero criado apenas para nivelamento","Birth", "Capture", "Transfer", "Loan to", "Release", "Death"]


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


#Variaveis auxiliares
aux_institute_id ="a"
aux_institute_abbreviation ="a"


# inserindo coluna com os id's dos institutos no studbook
linha_BLT[0].insert(5,"id_institute") 

for i in range(len(linha_BLT)): #Contém os id's dos individuos em cada linha da coluna 0 do studybook
	for j in range(len(linha_institute)):

		if linha_BLT[i][5]==linha_institute[j][2]: #Se a abreviação do studynook for igual a abreviação do conjunto de institutos
			linha_BLT[i].insert(5,linha_institute[j][0]) #acrescenta uma coluna no studybook com o id do instituto

			#Guardando o ultimo id e abreviacao utilizado para eventos que não são anotados o local de ocorrência, por exemplo 'death'
			aux_institute_id = linha_institute[j][0]
			aux_institute_abbreviation = linha_institute[j][2]

		elif linha_BLT[i][5]=="NA": #Se no evento registrado no studybook não diz qual o instituto ocorreu, então foi no local anterior,por isso utiliza-se as variaveis auxiliares.
			linha_BLT[i].insert(5,aux_institute_id)
			linha_BLT[i][6]= aux_institute_abbreviation


#inserindo coluna com os id's dos eventos no studbook
linha_BLT[0].insert(9,"Event ID") 

for i in range(len(linha_BLT)):
	
	for j in range(len(lista_event)):
		if linha_BLT[i][9]==lista_event[j]:
			linha_BLT[i].insert(9,str(j))


# Write Arquivo para trabalhar com o historico
with open("../../Dados/BLT_history.csv", 'w') as file:

	for i in range(len(linha_BLT)):

		for j in range(len(linha_BLT[i])):
			valor = linha_BLT[i][j].split("\n")
			file.write(valor[0])
			file.write(",")
		file.write("\n")


#Abrindo studybook editado e colocando os resultados em matriz.
with open('../../Dados/BLT_history.csv', 'r') as dados:
    read_BLT_history= dados.readlines()

for i in range(len(read_BLT_history)):
	linha = str(read_BLT_history[i])
	linha= linha.split(",")
	linha_BLT_history.append(linha)


# Arquivo SQL com os inserts
with open("insert_historic.sql", 'w') as file:

	Death = str(lista_event.index('Death'))
	for i in range(len(linha_BLT_history)):
		if linha_BLT_history[i][9]!=Death and linha_BLT_history[i][9].rfind("[")==-1:
			file.write("INSERT INTO `history` (`id`, `id_individual`, `id_events`, `id_institute`, `observation`, `excluded`, `excluded_date`) VALUES (NULL,'"+linha_BLT_history[i][0]+"', '"+linha_BLT_history[i][9]+"', '"+linha_BLT_history[i][5]+"',NULL, 'n', NULL);\n")
		elif linha_BLT_history[i][9]==Death:
			file.write("INSERT INTO `history` (`id`, `id_individual`, `id_events`, `id_institute`, `observation`, `excluded`, `excluded_date`) VALUES (NULL,'"+linha_BLT_history[i][0]+"', '"+linha_BLT_history[i][9]+"', '"+linha_BLT_history[i][5]+"','"+linha_BLT_history[i+1][9]+"', 'n', NULL);\n")

