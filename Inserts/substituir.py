import csv

with open('status.csv', 'r') as tabela:
	read_tabela = tabela.read()

	with open('substituir.csv', newline='\n') as csvSubs:
		read_substituir = csv.DictReader(csvSubs, delimiter=',')

		for row in read_substituir:
			read_tabela = read_tabela.replace(row['antes'], row['depois'])

	with open('status.csv', 'w') as file:
		file.write(read_tabela)

	