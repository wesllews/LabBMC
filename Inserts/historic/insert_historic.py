import csv
#Variaveis globais
linha_BLT = []
read_BLT_historic = []
linha_institute =[]
lista_event =["id Zero criado apenas para nivelamento","Birth", "Capture", "Transfer", "Loan to", "Release", "Death"]


#Adicionando os id_institute em uma matriz a partir do arquivo institute.csv
with open('../institute/institute.csv', 'r') as institute:
    read_institute = institute.readlines()

for i in range(len(read_institute)):
	linha = str(read_institute[i])
	linha= linha.split(",")
	linha_institute.append(linha) 

# Substituindo os NA da coluna 0, pelos respectivos ids do individuo
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
aux_id_institute ="a"
aux_institute_abbreviation ="a"


# inserindo coluna com os id's dos institutos no studbook
linha_BLT[0].insert(5,"id_institute") 

for i in range(len(linha_BLT)): #Contém os id's dos individuos em cada linha da coluna 0 do studbook
	for j in range(len(linha_institute)):

		if linha_BLT[i][5]==linha_institute[j][2]: #Se a abreviação do studynook for igual a abreviação do conjunto de institutos
			linha_BLT[i].insert(5,linha_institute[j][0]) #acrescenta uma coluna no studbook com o id do instituto

			#Guardando o ultimo id e abreviacao utilizado para eventos que não são anotados o local de ocorrência, por exemplo 'death'
			aux_id_institute = linha_institute[j][0]
			aux_institute_abbreviation = linha_institute[j][2]

		elif linha_BLT[i][5]=="NA": #Se no evento registrado no studbook não diz qual o instituto ocorreu, então foi no local anterior,por isso utiliza-se as variaveis auxiliares.
			linha_BLT[i].insert(5,aux_id_institute)
			linha_BLT[i][6]= aux_institute_abbreviation


#inserindo coluna com os id's dos eventos no studbook
linha_BLT[0].insert(9,"Event_id") 

for i in range(len(linha_BLT)):
	
	for j in range(len(lista_event)):
		if linha_BLT[i][9]==lista_event[j]:
			linha_BLT[i].insert(9,str(j))


#inserindo coluna de observações dos eventos "Death by unkown"
for i in range(len(linha_BLT)):

	if linha_BLT[i][9].rfind("[")!=-1: #se na coluna 9 não tiver "[death..."
		linha_BLT[i-1].insert(11,str(linha_BLT[i][9])) #Usando linha_BLT[i-1] eu transporto a observação uma linha acima, aonde o evento de Death aconteceu 
		linha_BLT[i][9] ="NA" #apagando a observação da coluna de eventos
	else:
		linha_BLT[i].insert(11,"NA")

linha_BLT[0].insert(11,"Observation") #linha de titulo na coluna 11, mas o insert é colocado pra 10

# Write Arquivo para trabalhar com o historico
with open("BLT_historic.csv", 'w') as file:

	for i in range(len(linha_BLT)):

		for j in range(len(linha_BLT[i])):
			valor = linha_BLT[i][j].strip("\n") #remove os \n de cada item da matrix (Gambiarra)
			file.write(str(valor) +",")
		file.write("\n") # quebra linha depois que cada dado é impresso em formato csv



# Lendo Arquivo para criar o SQL
with open('BLT_historic.csv', newline='\n') as csvfile:
	read_BLT_historic = csv.DictReader(csvfile, delimiter=',')
	stud= "1"
	id_individual = 1

	with open("insert_historic.sql", 'w') as file:
		for row in read_BLT_historic:


			if stud != row['Stud']:
				stud = row['Stud']
				id_individual+=1




			id = None
			id_event = row['Event_id']
			id_institute = row['id_institute']
			Local_id = row['Local_id'] if row['Local_id']!="NA" else None
			date = row['Date'] if row['Date']!="NA" else None
			observation = row['Observation'] if row['Observation']!="NA" else None

			# Usando 'f-string' para criar linha SQL
			sql = f"INSERT INTO `historic` (`id`, `id_individual`, `id_event`, `id_institute`, `local_id`, `date`, `observation`, `excluded`, `excluded_date`) VALUES (NULL, '{id_individual}', '{id_event}', '{id_institute}', '{Local_id}', '{date}', '{observation}', NULL, NULL);\n"
			
			#Consistência de dados - removendo a linha sem histórico
			if id_event !="NA":
				file.write(sql)