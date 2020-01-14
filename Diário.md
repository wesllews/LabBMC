# Para Fazer Hoje(10/01):
- Escrever script SQL de insert dos specific_id de cada indivíduo.
	
	- No script de inserir_specific_id.py ajustar os dados contidos em BLT.csv para cada linha da coluna "stud",coluna 0, possuir o id referente ao individuo a que se refere. Atualmente a primeira linha possui o id e as linhas subsequentes ficam em branco até uma nova "seção" de dados de outro individuo. 


# Feito
- Retornei a tabela de specific_id_individual pro 'BancoCompleto.sql' e apaguei a de "captive_location"

- Criado um script "BancoObjetivo.sql" para fragmentar o banco de dados a partir dos dados que eu estou trabalhando no momento de forma objetiva, para facilitar o desenvolvimento.

- Dentro do script 'insert_specific_id.py' foi feita uma adpatação do studobook(BLT.csv) que permita identificação dos institutos e invididuos envolvidos nos eventos do historico do animal.


# Póximas Etapas

- Ainda é necessário ver qual a melhor forma de lidar com locais que não possuem um id_specific para os idnividuos. Faz-se necessário a troca da primary Key da tabela, justamente por que atualmente a PK é o id especifico.

- Fiz a troca no arquivo BLT.csv do 'location' SCARLOS para SAO CARLOS. Precisa ser verificado se de fato correspondem ao mesmo local. (stud  nº 91 e outros 5)

- Adicionar a tabela de institutos a opção "wild" para os casos de reintrodução.  (stud  nº 141, 260, 293)
 
- Começar a inserir o histórico dos individuos. Tabela 'history'.



---------------------------------------------------------------------------------------------------------------------------

# Para Fazer Hoje(13/01):

"Ainda é necessário ver qual a melhor forma de lidar com locais que não possuem um id_specific para os idnividuos. Faz-se necessário a troca da primary Key da tabela, justamente por que atualmente a PK é o id especifico.""
	- Pensando nessa necessidade eu vou adaptar o banco e as inserções para que os id específicos sejam adicionados nas obersações dos históricos, uma vez que não é um item indispensável para os relacionamentos, mas que precisa ser mantido.

"Fiz a troca no arquivo BLT.csv do 'location' SCARLOS para SAO CARLOS. Precisa ser verificado se de fato correspondem ao mesmo local. (stud  nº 91 e outros 5)"
 	- Alguns dados não estão corretamente colocados no BLT.csv, então vou utilizar os erros de inserção do 'insert_specific_id.sql' para ver quais linhas os dados não foram corretamente arrumados.


# Feito:

- Adicionado na tabela de institutos a opção "wild" para os casos de reintrodução.  (stud  nº 141, 260, 293)

- Os dados com conflitos de nomes foram arrumados no arquivo BLT.csv. Exemplo "SCARLOS" ou Erros na numeração dos indivíduos.


- Foram arrumados erros nas numerações do studbook original, entre no individuo 360 e 433, neles a numeração foi pulada 2 unidades em cada, ocasionando desníveis de numeração (Num Indivíduos X Numero de Registros).

- Fiz o BLT_Histórico com os id's dos eventos por linha para facilitar a inserção dos históricos.
 

---------------------------------------------------------------------------------------------------------------------------


# Para Fazer Hoje(14/01)

- Juntar os scripts de 'insert_specific_id' e 'insert_historico'.

- Arrumar erros na inserção inicial dos historicos (script insert SQL feito hoje). Exemplo: ind. 395.

- Inserir o histórico dos individuos. Tabela 'history'.


# Feito:

- Juntado os scripts de 'insert_specific_id' e 'insert_historico', pois as manipulações para edição do studbook (BLT.csv) ficaram fragmentadas em dois scripts distintos. Isso foi utilizado para criar o BLT_history.csv

- Arrumado o erro na inserção do indíduo 395, que era causado por não haver um evento inserido de 'Loan to'.


# Próximas Etapas

- Inserir os id's específicos nas observações de cada evento do histórico.

- Vai ser necessário fazer inserção de individuos "wild" e "unknow" para as relações de parentescos posteriores parentescos.















