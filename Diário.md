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

