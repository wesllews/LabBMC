#Abrindo studbook
with open('../../Dados/BLT.csv', 'r') as dados:
    read = dados.readlines()

# Criando um arquivo com todos os inserts
with open('insert_individual.sql', 'w') as file:
	for i in range(len(read)):
		linha = str(read[i])
		linha2= linha.split(",")


		if(linha2[0] != "NA"): #"NA" sao as celulas vazias da coluna de id na tabela do studybook

			if(linha2[9]=="\n"):
				sql= "INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '"+linha2[0]+"', '1', '"+linha2[1]+"', NULL, 'n', NULL);"
			else:
				sql= "INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'"+linha2[0]+"' , '1', '"+linha2[1]+"', '"+linha2[9][:-1]+"', 'n', NULL);"
			file.write(sql+"\n")	


#Tabela pra merge nome instituto = id instituto
# Anotacao Dia 10/01: Nao lembro o porque comecei fazer esse merge 
with open('individual_merge.csv', 'w') as file2:
	for i in range(len(read)):
		linha = str(read[i])
		linha2= linha.split(",")
		if(linha2[0] != "NA"):
			file2.write(linha2[0]+","+linha2[5]+"\n")




#	BIBLIOGRAFIA
#	https://pynative.com/python-mysql-select-query-to-fetch-data/
	