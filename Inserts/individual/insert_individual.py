#Abrindo identification
with open('../../Dados/BLT.csv', 'r') as dados:
    read = dados.readlines()

# Criando um arquivo com todos os inserts
with open('insert_individual.sql', 'w') as file:
	for i in range(len(read)):
		linha = str(read[i])
		linha2= linha.split(",")


		if(linha2[0] != "NA"): #"NA" sao as celulas vazias da coluna de id na tabela do studybook

			if(linha2[9]=="\n"):
				sql= "INSERT INTO `individual` (`id`, `identification`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '"+linha2[0]+"', '1', '"+linha2[1]+"', NULL, 'n', NULL);"
			else:
				sql= "INSERT INTO `individual` (`id`, `identification`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'"+linha2[0]+"' , '1', '"+linha2[1]+"', '"+linha2[9][:-1]+"', 'n', NULL);"
			file.write(sql+"\n")	

#	BIBLIOGRAFIA
#	https://pynative.com/python-mysql-select-query-to-fetch-data/
	