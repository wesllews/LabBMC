with open('institute/institute.csv', 'r') as file:
    read = file.readlines()


with open('../SQL/2.institute.sql', 'w') as file:

	for i in range(1,len(read)):

		linha = str(read[i])
		linha2= linha.split(",")

		if linha2[4]=="NA" : 
			linha2[4]="Not specified"

		if linha2[5]=="NA" : 
			linha2[5]="NULL"
			sql = "INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`) VALUES (NULL,'{}','{}','{}','{}',{}, 'n');".format(linha2[1],linha2[2],linha2[3],linha2[4],linha2[5])
		else:
			sql = "INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`) VALUES (NULL,'{}','{}','{}','{}','{}', 'n');".format(linha2[1],linha2[2],linha2[3],linha2[4],linha2[5])

		file.write(sql+"\n")

	
		

