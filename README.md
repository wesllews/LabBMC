# Feito (23/08)
1. Fazer o filtro por POPULATION
2. Botão modal para "population"

## Próximas Etapas
Igualar funções da página de captivity com a página de genótipos
    - Colocar informações de population no modal
    - Status de alive precisa ser recebido como CASE WHEN
Fazer página de Life history > Wild
Inserir campos de informações de fragmentos e grupos na página Individual.php
Modal do botão de download que defina Baixar todos os dados ou apenas a pagina atual.
Genetics: aparecer os genotipos só do individuos
Home para "BLT Projects" contendo link para o wix do genoma e o bltdatabase
Impedir SQL Injection
Página de Login
Página de pesquisa
___ 

# Para fazer (17/08)
1. Diminuir recursão dos dados
2. Botão modal para "population"

# Feito
1. Diminuir recursão dos dados
2. Botão modal para "population"

## Próximas Etapas
Igualar funções da página de captivity com a página de genótipos
	- Fazer o filtro por por POPULATION
Fazer página de Life history > Wild
Inserir campos de informações de fragmentos e grupos na página Individual.php
Modal do botão de download que defina Baixar todos os dados ou apenas a pagina atual.
Genetics: aparecer os genotipos só do individuos
Home para "BLT Projects" contendo link para o wix do genoma e o bltdatabase
Impedir SQL Injection
Página de Login
Página de pesquisa
___ 

# Para fazer (16/08)
1. Diminuir recursão dos dados
2. Botão modal para "population"

# Feito
1. Filtro de informações com botão modal
2. Status de alive dividido em 3: True/}False/Unknown
3. Cabeçalho menor
4. Adicionado clausule de "WHERE 1=1" na query principal
5. Botão de páginação está duplicando as restrições do filtro e travando a página (Forms tem que ser antes do 'SQL Filter')

## Próximas Etapas
Igualar funções da página de captivity com a página de genótipos
	- Fazer o filtro por por POPULATION
Fazer página de Life history > Wild
Inserir campos de informações de fragmentos e grupos na página Individual.php
Modal do botão de download que defina Baixar todos os dados ou apenas a pagina atual.
Genetics: aparecer os genotipos só do individuos
Home para "BLT Projects" contendo link para o wix do genoma e o bltdatabase
Impedir SQL Injection
Página de Login
Página de pesquisa
___ 

# Para fazer (13/08)
1. Fazer Select de "CASE category=1 THEN id_institute ..."

# Feito
1. Fazer Select de "CASE category=1 THEN id_institute ..."

## Próximas Etapas
Fazer página de genótipos
Fazer página de Life history > Wild
Inserir campos de informações de fragmentos e grupos na página Individual.php
Modal do botão de download que defina Baixar todos os dados ou apenas a pagina atual.
Genetics: aparecer os genotipos só do individuos
Home para "BLT Projects" contendo link para o wix do genoma e o bltdatabase
Impedir SQL Injection
Página de Login
Página de pesquisa
___ 

# Para fazer (01/07)
1. Inserir grupos de indivíduos de vida livre. 
2. Ajustar nome dos locus em Genotypes and Alleles.

# Feito
1. Inserir grupos de indivíduos de vida livre.

## Próximas Etapas
 Modal do botão de download que defina Baixar todos os dados ou apenas a pagina atual.
Inserir Grupo dos indivíduos
Inserir campos de informações de fragmentos e grupos na página Individual.php
Fazer página de genótipos
Impedir SQL Injection
Página de Login
Fazer página de Life history > Wild
Página de pesquisa

___


# Para fazer (11/06)
1. Página de download de dados e formatação em formato excel ou csv.

## Novas ferramentas:

- Eu vou tentar usar o [PhpSpreadsheet](https://phpspreadsheet.readthedocs.io/en/latest/) mas para isso é necessário fazer instalação do [composer](https://getcomposer.org/doc/00-intro.md), eu vou optar por fazer uso de da forma local dele, baixando no pc.

- Foi necessário fazer instalação de alguns programas de requisit do phpSpreadSheet que não havia no meu computador:
    ```
    sudo apt install php-xml
    sudo apt-get install php7.2-mbstring
    sudo apt-get install php7.2-zip
    ```
- Aproveitei e instalei uma ferramenta chamada phpinsights que ajuda a analisar a qualidade do código desenvolvido baseado nesse conteúdo (Como está a saúdo do seu código)[https://imasters.com.br/back-end/como-esta-a-saude-do-seu-codigo].

- (PHP Copy/Paste Detector (PHPCPD))[https://imasters.com.br/back-end/detectando-codigo-duplicado-em-php-com-php-copy-paste-detector-phpcpd]
    

## Próximas Etapas
Inserir Grupo dos indivíduos
Fazer página de Wild Indivíduos

___

# Para fazer (08/06)
1. O botão de paginação não envia as colunas que eu decidi ocultar
2. Mudar a cor do checkbox dos filtros 
3. Aplicar "Grid-container" na página de individuo, para mostras os locus de forma mais concentrada do que uma tabela longa

## Feito
1. O botão de paginação não envia as colunas que eu decidi ocultar
2. Mudar a cor do checkbox dos filtros
3. Aplicar "Grid-container" na página de individuo, para mostras os locus de forma mais concentrada do que uma tabela longa

## Próximas Etapas
Inserir Grupo dos indivíduos
Fazer página de Wild Indivíduos

___


# Para fazer (30/04)
1. Fazer botão que abra todas as janelas de histórico
2. Reunião com a Patrícia e Paola

## Feito
1. Fazer botão que abra todas as janelas de histórico
2. Reunião com a Patrícia e Paola
    -Novas Demandas: Filro de indivíduos Vivos e por institute, não precisa ter datas.
    
## Próximas Etapas
- Fazer filtro de alive e death.
- Fazer filtro de institute.
- Fazer botões que encaminhem para as paginas de dados genéticos
- Fazer script de iterações que consiga filtrar individuos por instituto, sendo o ultimo instituto que ele esteve.
- Fazer filtros de nascido e mortos combinados em PHP

---------------------------------------------------------------------------------------------------------------------------

# Para fazer (29/04)
1. Fazer Filtro de items por página funcionar
2. Fazer script de paginação
3. Fazer script de Sort e ORDER BY funcionar junto com os botões

## Feito
1. Fazer Filtro de items por página funcionar
2. Fazer script de paginação
3. Fazer script de Sort e ORDER BY funcionar junto com os botões

## Próximas Etapas
- Fazer botões que encaminhem para as paginas de dados genéticos
- Fazer script de iterações que consiga filtrar individuos por instituto, sendo o ultimo instituto que ele esteve.
- Fazer um filtro de "Transferido para:"
- Fazer filtros de nascido e mortos combinados em PHP

---------------------------------------------------------------------------------------------------------------------------
# Para fazer (28/04)
1. Fazer botões que encaminhem para as paginas de dados genéticos ou histórico do indivíduo.
2. Selecionar os dados que a pessoa quer ver do studbook (checkbox)


## Feito
1. Feito botão que mostra o histórico dos indivíduos
    - Tendo todas as informações, numero de eventos no histórico, e botão collapse
2. Selecionar os dados que a pessoa quer ver do studbook (checkbox)

## Próximas Etapas
- Fazer botões que encaminhem para as paginas de dados genéticos
- Fazer script de iterações que consiga filtrar individuos por instituto, sendo o ultimo instituto que ele esteve.
-  Fazer um filtro de "Transferido para:"
- Fazer filtros de nascido e mortos combinados em PHP

---------------------------------------------------------------------------------------------------------------------------

# Para fazer (26/04)
1. Colocar as setas de ORDER BY e SORT apenas em alguns botões do header da tabela
2. Fazer botões que encaminhem para as paginas de dados genéticos ou histórico do indivíduo.

## Feito
1. Colocar as setas de ORDER BY e SORT apenas em alguns botões do header da tabela
2. Modificando o arquivo 'httpd-xampp.conf' e usando um programa chamado **ngrok** consegui disponibilizar o acesso a base de dados para outros computadores que não os meu. 

## Próximas Etapas
- Selecionar os dados que a pessoa quer ver do studbook (checkbox)
- Fazer botão que mostre um modal ou popup  com os historicos do individuo
- Fazer script de iterações que consiga filtrar individuos por instituto, sendo o ultimo instituto que ele esteve.
-  Fazer um filtro de "Transferido para:"
- Fazer filtros de nascido e mortos combinados em PHP

**Como ativar forma remota do BD:**
``` bash
# Iniciar o Xampp
sudo /opt/lampp/lampp restart

# Iniciar o ngrok
./ngrok http 80
```

---------------------------------------------------------------------------------------------------------------------------

# Contexto (25/04)
- Após reunião com a patrícia dia 21/04, foram decidos alguns pontos de mudanças do banco de dados. 1) a página de studbook passaria a ter todos os dados dos individuos de cativeiro e com links para as páginas 'genetics' onde seriam colocados os os dados de genotipos e os de sequencias mitocondriais.


## Para fazer
1. Refazer os scripts de apresentação de dados (table)
2. Selecionar os dados que a pessoa quer ver do studbook (checkbox)
3. Colocar o order apenas em alguns botões do header da tabela
4. Fazer botões que encaminhem para as paginas de dados genéticos ou histórico do indivíduo.
5. Fazer botão que mostre um modal com os historicos do individuo
6. Fazer filtros de nascido e mortos combinados.
7. Fazer script de iterações que consiga filtrar individuos por instituto, sendo o ultimo instituto que ele esteve. 


## Feito
1. Refazer os scripts de apresentação de dados (table). 
    - Refiz alguns pedaços do cabeçalho para que os nomes das colunas possam ser independentes do botão que envia o "Sort" dos dados.
    - Coloquei o botão de filtro, o quadrado do form e a tabela em containers diferentes pra facilitar "modularização"

6. Fazer filtros de nascido e mortos combinados.
    - Consegui fazer um jeito de filtrar periodos de BIRTH e DEATH ao mesmo tempo com SQL, mas ainda precisa elaborar os 'Gets'


## Próximas Etapas

1. Selecionar os dados que a pessoa quer ver do studbook (checkbox)
2. Colocar o ORDER BY apenas em alguns botões do header da tabela
3. Fazer botões que encaminhem para as paginas de dados genéticos ou histórico do indivíduo.
4. Fazer botão que mostre um modal ou popup  com os historicos do individuo
5. Fazer script de iterações que consiga filtrar individuos por instituto, sendo o ultimo instituto que ele esteve.
6. Fazer um filtro de "Transferido para:"

---------------------------------------------------------------------------------------------------------------------------

# Para fazer (14/04) -part2
- Colocar os itens em uma div lateral e com efeito colapse.
- Fazer o Reset dos filtros.

## Feito
- Colocar os itens em uma div lateral e com efeito colapse.
- Fazer o Reset dos filtros.
- Os filtros foram arrumdos e questão de design e também as opções de filtros: por instituto, sexo, locus e etc. Para ambas as páginas: Genotypes/Studbook.

## Próximas Etapas
- Fazer validação dos inputs recebidos nos filtros, exemplo: data, items per page, etc.
- Fazer página About.
- Aprender Class.
---------------------------------------------------------------------------------------------------------------------------

# Para fazer (13/04)
- Filter by institute e Sex.


## Feito
- Filter by institute e Sex.


## Próximas Etapas
- Colocar os itens em uma div lateral e com efeito colapse.
- Fazer o Reset dos filtros.
- Fazer validação dos inputs recebidos nos filtros, exemplo: data, items per page, etc.
- Fazer página About.
- Aprender Class.
---------------------------------------------------------------------------------------------------------------------------

# Para fazer (12/04)
- Tentar manter os links dos parametros nas páginas, para isso vou transformar tudo em forms com vários submits 

## Feito
- Por enquanto foi criada mais uma função, chamada "forms", que cria input-hidden que armazena o valor dos filtros utilizados e todos os valores recebidos na função "get_all". Ela utiliza o nome das keys do array dessa função pra criar os inputs conforme seu valor. Os links utilizados na paginação e funções de tabelas foram substituidos por button-type-submit que tem evento 'onclick' que muda o valor dos input-hidden e envia o formulário.

- A partir de agora, todos os filtros que são adicionais ao SQL principal da página serão concatenados a SQL principal, ainda nas suas páginas, por exemplo filtro de data na página de studbook. Enquanto os filtros finais como ORDER BY e LIMIT serão adicionados nas funções das classes, por exemplo na função table e table_body.

- Poder criar a página de genotypes, em que os locus estejam em colunas e os alelos em linhas.


## Próximas Etapas
- Fazer validação dos inputs recebidos nos filtros, exemplo: data, items per page, etc.
- Filter by institute, Sex, etc usando o array de header pra tudo.
- Fazer página About.
- Aprender Class.
---------------------------------------------------------------------------------------------------------------------------

# Para fazer (10/04)
- Recriar em 'db.class.php' uma função que imprime só o cabeçalho das tabelas e outra para imprimir só o corpo, para poder criar a página de genotypes, em que os locus estejam em colunas e os alelos em linhas.


## Próximas Etapas
- Rentar manter os links dos parametros nas páginas.
- Incorporar os demais filtros do sql nas páginas e não dentro das funções de tabela.
- Fazer validação dos inputs recebidos nos filtros, exemplo: data, items per page, etc.
- Filter by institute, Sex, etc usando o array de header pra tudo.
- Fazer página About.

---------------------------------------------------------------------------------------------------------------------------
# Para fazer (09/04)
- Recriar em 'db.class.php' uma função que imprime só o cabeçalho das tabelas e outra para imprimir só o corpo, para poder criar a página de genotypes, em que os locus estejam em colunas e os alelos em linhas.
- Fazer página About.

## Feito
- Criada uma função get_all() que faz todos os gets da página studbook.php e retorna um array.

## Próximas Etapas
- Fazer os links de limit, page voltarem para as páginas principas e não nas funções para tentar mante-los nos links dos parametros.
- Fazer validação dos inputs recebidos nos filtros, exemplo: data, items per page, etc.
- Filter by institute, Sex, etc usando o array de header pra tudo.

---------------------------------------------------------------------------------------------------------------------------

# Para fazer (08/04)
- Filtro de datas(between) utilizando bootstrap datapicker.

## Feito
- Filtro de datas(between) utilizando bootstrap datapicker.

## Próximas Etapas
- Recriar em 'db.class.php' uma função que imprime só o cabeçalho das tabelas e outra para imprimir só o corpo, para poder criar a página de genotypes, em que os locus estejam em colunas e os alelos em linhas.
- Fazer os links de limit, page voltarem para as páginas principas e não nas funções para tentar mante-los nos links dos parametros.
- Fazer validação dos inputs recebidos nos filtros, exemplo: data, items per page, etc.
- Filter by institute, Sex, etc usando o array de header pra tudo.
- Fazer página About.
---------------------------------------------------------------------------------------------------------------------------

# Para fazer (07/04)
- Correção das versões dos códigos entre o gitHub e os códigos e dados do meu computador.

## Feito 
- Parte 1 do curso de GitHub e versionamento pelo udemy(Comandos: commit, add, push, diff, chave SSH).
- Correção das versões.

## Próximas Etapas
- Filtro de datas(between)
- Filter by institute, Sex, etc usando o array de header pra tudo.
- Fazer página About.
---------------------------------------------------------------------------------------------------------------------------
# Para fazer (06/04)
Página de study book:
- Filtro de datas(between)
- Filtro de linhas por página(limit)
- Filter by institute, Sex, etc usando o array de header pra tudo.

## Feito 
- Filtro de linhas por página(limit)

## Próximas Etapas
- Filtro de datas(between)
- Filter by institute, Sex, etc usando o array de header pra tudo.
- Fazer página About.
---------------------------------------------------------------------------------------------------------------------------

## Feito (27/03)
- Header - Concluído
- Design da Home - Concluído
- Footer - Concluído

## Próximas Etapas
- Fazer uma página simples pra Stud Book, contendo resultados em forma de lista.
- Fazer página About.
---------------------------------------------------------------------------------------------------------------------------

# Para Fazer (24/03)
- Estudar componentes Bootstrap
- Lendo um artigo na página BootstrapBay: [Learn Bootstrap 4 in 14 Days](https://bootstrapbay.com/blog/day-1-bootstrap-4-cdn-and-starter-template/)

## Feito
- Li sobre os seguintes temas: Typography, Images, Buttons, Navbar.
- Construindo o arquivo Header.php do site, contendo a Navbar do site.
- Foi incorporado ao scripts repositórios de Fonts (google fonts) e escolhida de início uma font-family
- Incoporado repositório de Icons(Fonts Awesome) via link-CSS.
---------------------------------------------------------------------------------------------------------------------------

# Para Fazer (23/03)
- Estudar programação WEB
- Curso no udemy: "Introdução JavaScript e Jquery - Diego Mariano"
- Lendo um artigo na página BootstrapBay: [Learn Bootstrap 4 in 14 Days](https://bootstrapbay.com/blog/day-1-bootstrap-4-cdn-and-starter-template/)

## Feito
- Curso no udemy: "Introdução à criação de sites dinâmicos com php - Diego Mariano"
- Utilizei um modelo pronto da web pra projetar como gostaria que a home do Banco de dados ficasse pasta: 'Exemplo-lawncare'
- Li sobre os seguintes temas: Starrter Template, Grid System, Flex.
---------------------------------------------------------------------------------------------------------------------------

# Para Fazer (22/03)
- Estudar programação WEB e começar fazer pagina de vizualização de studbook.
- Curso no udemy: "Introdução à criação de sites dinâmicos com php - Diego Mariano"

## Feito
- Curso no udemy: "Introdução à criação de sites dinâmicos com php - Diego Mariano"
---------------------------------------------------------------------------------------------

# Para Fazer (20/03)
- Alteração do banco de dados para inserir localização dos individuos de vida livre.
- Inserir genotipos dos individuos vida livre.
- Inserir indivíduos de vida livre.

## Feito
- Inserir indivíduos de vida livre.
- Alteração do banco de dados para inserir localização dos individuos de vida livre.
- Inserir genotipos dos individuos vida livre.

## Próximas Etapas
**- Estudar programação WEB e começar fazer pagina de vizualização de studbook.**
**- Talvez para a inserção das sequências Dloop eu vou precisar alterar a tabela genotype, para o alelo ser um campo TEXT ou criar uma nova tabela só pra sequencias longas que possam querer ser inseridas.**

---------------------------------------------------------------------------------------------------------------------------
# Para Fazer (17-19/03)
- Reunir as informações doa individuos de vida livre:
        - Localização
        - Identification
        - Name
        - Fragmento, Grupo e População.

## Feito

(17/03)
- Fora decidido por mim e comunicado a elas que os individuos de vida livre serão inseridos utilizando o codido do banco de amostras do laboratório (MAM_XXX) no campo individual.identification e os códigos utilizados pelos zoologicos ou biologos que concederam a amostra serão anotados no campo individual.name

(19/03)
- Reunir as informações doa individuos de vida livre. Foi colocado em uma tabela no meu drive chamada Genótipos - BD que possui tres folhas: Wild informações de individuo, Wild Genotipos e Cativeiro Genotipos.

## Próximas Etapas
- Colocar as tabelas de genótipos wild e captive juntas e os dados de forma consistentes para tentar inserir todos individuos juntos.

- Inserir Genótipos dos individuos de vida livre.

- Fazer as devidas alterações no banco de dados para que todas essas informações sejam devidamente inseridas e da forma menos trabalhosa.

---------------------------------------------------------------------------------------------------------------------------
# Para Fazer Hoje(16/03)
- Ver como inserir alelos distintos do mesmo loci. Exemplo: duas colunas Lchu1.

- Inserir Genótipos dos individuos de cativeiro.

- Testar um novo modelo de banco com os ids das tabelas sendo nominal e não id numérico + nominal, reduzindo o número de recursões da página web e criação de arquivos.
     - alterar os inserts com base no novo modelo de teste

## Feito
- Testar um novo modelo de banco com id's nominais. Relação de tabelas alteradas:
    - historic.id_individual(varchar)
    - individual.id (excluído)
    - individual.indentification (varchar e pk nominal)
    - kinship id_individual, sire e dam (varchar)
    - genotype.id (excluído)
    - locus.id (exluído), locus(pk nominal)

- Ver como inserir alelos distintos do mesmo loci. Exemplo: duas colunas Lchu1.

- Inserir Genótipos dos individuos de cativeiro.
        - Alterar os inserts com base no novo modelo de teste

## Próximas Etapas
- Colocar as tabelas de genótipos wild e captive juntas e os dados de forma consistentes para futura inserção.

- Definir quanto aos números de identificação utilizados nos individuos de vide livre e cativeiro, uma vez que cada um possui um código de identificação e resgitro diferente. (número do studbook X [Nº no banco de amostra, numero dado por quem envio a amostra, número do animal])

- Conversar com Patty e Paola sobre que número utilizar para wild individuos.

- Inserir Genótipos dos individuos de vida livre.
---------------------------------------------------------------------------------------------------------------------------

# Para Fazer Hoje(13/03) - Part2
- Inserir lista de locus.

- Definir quanto aos números de identificação utilizados nos individuos de vide livre e cativeiro, uma vez que cada um possui um código de identificação e resgitro diferente. (número do studbook X [Nº no banco de amostra, numero dado por quem envio a amostra, número do animal])

- Colocar as tabelas de genótipos wild e captivejuntas e os dados de forma consistentes para futura inserção.

- Conversar co m Patty e Paola de que número utilizar para wild individuos.


## Feito
- O recém campo 'studbook' inserido no banco de dados foi modificado para 'identification'

- Criado um arquivo de Locus(locus X id) com base na tabela de excel de "Genótipos-Mico-Leão-Preto" enviado pela Nathalia no meu email, dia 9/março.

- Feito um arquivo contendo o id_individuo(BD) e o numStudbook(BLT_csv) juntos.

## Próximas Etapas
- Inserir Genótipos dos individuos de cativeiro e individuos de vida livre.
- Colocar as tabelas de genótipos wild e captivejuntas e os dados de forma consistentes para futura inserção.
- Conversar co m Patty e Paola de que número utilizar para wild individuos.
- Definir quanto aos números de identificação utilizados nos individuos de vide livre e cativeiro, uma vez que cada um possui um código de identificação e resgitro diferente. (número do studbook X [Nº no banco de amostra, numero dado por quem envio a amostra, número do animal])
- Ver como inserir alelos distintos do mesmo loci. Exemplo: duas colunas Lchu1.
----

# Para Fazer Hoje(13/03) - Part1
- Inserir Paternidade dos individuos na tabela kinship.
- Adicionar individuos Wild e Unknown por conta do parentesco.

## Feito

- Adicionado individuo Wild(1) e Unknown(2) e registrados no bancoObjetivo e o BancoCompleto
- Adicionado Kinship ao BancoObjetivo.sql
- Parentescos (kinship) inseridos.

## Próximas Etapas
- Inserir Genótipos

---------------------------------------------------------------------------------------------------------------------------
# Para Fazer Hoje(12/03) - Part 1
- O insert de datas e id_especificos precisam ser validados pq nem sempre eles vão existir. Para isso utilizar 'if inline' para trocar 'NA' por valor NULL.

- Fazer insert do histórico dos indivíduos

- Remover linhas vazias do BLT_historic.csv, pois nelas tinham as observações de morte e não mais validas.

- Continuar o script inserte_historic.py a partir da linha 102 e trabalhar com as conversão das variáveis pra texto, criando a variavel dos inserts sql.

## Feito:
- Confirmar se as alterações feitas no SQL do banco de dados estão iguais as feitas no design do banco, en geral foram nas seguintes propriedades:
    - utilizar individual.Studbook como pk ou não e as possíveis recursões necessárias na pagina web.
    - Historic.id_individual(cadastro de histórico dependente do cadastro de indivíduo)
    - Relação das PK entre  tabelas individual e geotypes

- O insert de datas e id_especificos precisam ser validados pq nem sempre eles vão existir. Para isso utilizar 'if inline' para trocar 'NA' por valor NULL.

- Fazer insert do histórico dos indivíduos

- Remover linhas vazias do BLT_historic.csv, pois nelas tinham as observações de morte e não mais validas.

- Continuar o script inserte_historic.py a partir da linha 102 e trabalhar com as conversão das variáveis pra texto, criando a variavel dos inserts sql.

## Próximas Etapas

- Inserir Paternidade dos individuos, tabela kinship.


---------------------------------------------------------------------------------------------------------------------------
# Para Fazer Hoje(11/03)

- Refazer os inserts das tabelas devido a modificação dos bancos
    - Os SQL's do Banco -- OK
    - Institutes -- OK
    - Individual -- OK

- O insert de datas e id_especificos precisam ser validados pq nem sempre eles vão existir. Para isso utilizar 'if inline' para trocar 'NA' por valor NULL.

- Entender porquê e como funciona o código:  `linha_BLT[i][9].rfind("[")!=-1`

## Feito:
-  Separar as observações de morte dos invidivíduos da coluna 'Event_id'.

- O Código em insert_historic.py utilizará a biblioteca CSV para tornar mais fácil o uso de arquivo CSV.

- ID integer da tabela individual foi substituído pelo id_studbook

## Próximas Etapas
- O insert de datas e id_especificos precisam ser validados pq nem sempre eles vão existir. Para isso utilizar 'if inline' para trocar 'NA' por valor NULL.

- Fazer insert do histórico dos indivíduos

- Remover linhas vazias do BLT_historic.csv, pois nelas tinham as observações de morte e não mais validas.

- Continuar o script inserte_historic.py a partir da linha 102 e trabalhar com as conversão das variáveis pra texto, criando a variavel dos inserts sql.

- Confirmar se as alterações feitas no SQL do banco de dados estão iguais as feitas no design do banco, en geral foram nas seguintes propriedades:
    - Individual.Studbook como pk ou não e as possíveis recursões necessárias caso isso não seja utilizado.
    - Historic.id_individual(cadastro de histórico dependente do cadastro de indivíduo)
    - Relação das PK entre  tabelas individual e geotypes

---------------------------------------------------------------------------------------------------------------------------
# Para Fazer Hoje(10/03)

- Adicionar parametros que estão no studbook_2017 ao banco de dados que anteriormente não haviam (Falar com Paola e Patty sobre isso).

- Adicionar individuos do studbook_2017 só havia utilizado a edição 2014.



## Feito:
- Não foram adicionados parametros do studbook_2017 ao banco de dados pois a estrutura do arquivo passada pelo dominic era input de um programa e não um novo dataset (Falei com Paola sobre isso).

- Modificado o banco de dados para que o sexo do indivíduo seja texto, em caso de unknown 'varchar(15)'

- Adicionado individuos do studbook_2017 ao arquivo BLT.csv (studbook edição 2014)

- Modificar o banco de dados para que a tabela de individuos possua Id do banco de dados numérico e id studbook 'VarChar', pois alguns id's do studbook sõa agora codigos.

## Próximas Etapas

PENDÊNCIA DO HISTÓRICO
-  Separar as observações de morte dos invidivíduos da coluna 'Event ID'.

- O insert de datas e id_especificos precisam ser validados pq nem sempre eles vão existir. Para isso utilizar 'if inline' para trocar 'NA' por valor NULL.

- Entender porque e como funciona o código:  `linha_BLT[i][9].rfind("[")!=-1`


## OBSERVAÇÃO:
``` bash
#Comando para selecionar colunas
grep "MOVE" Studbook_2017.CSV | cut -d';' -f1,5-7 | tail -n20 >dados.csv
```

---------------------------------------------------------------------------------------------------------------------------
# Para Fazer Hoje(09/03)

- Desfazer algumas alterações feitas no studbook original.

## Feito:
- Os numeros de studbook de cada individuo não podem ser alterados independente se não seguirem a ordem numérica, desta forma as alterações dos id's feitas entre no individuo 360 e 433 no dia 13/01 foram desfeitas.

- Utilizado o comando `grep -v "MOVE" Studbook\ 2017.CSV > Teste.csv` para selecionar só as linhas de históricos do studbook.

## Próximas Etapas

MODIFICAR O BANCO DE DADOS PELAS SEGUINTES NECESSIDADES:
- Adicionar individuos do studbook_2017 só havia utilizado a edição 2014.
- Modificar o banco de dados para que a tabela de individuos possua Id do banco de dados numérico e id studbook 'VarChar', pois alguns id's do studbook sõa agora codigos.

- Adicionar parametros que estão no studbook_2017 ao banco de dados que anteriormente não haviam (Falar com Paola e Patty sobre isso).

PENDÊNCIA DO HISTÓRICO
-  Separar as observações de morte dos invidivíduos da coluna 'Event ID'.

- O insert de datas e id_especificos precisam ser validados pq nem sempre eles vão existir. Para isso utilizar 'if inline' para trocar 'NA' por valor NULL.

- Entender porque e como funciona o código:  `linha_BLT[i][9].rfind("[")!=-1`

---------------------------------------------------------------------------------------------------------------------------
# Para Fazer Hoje(05/03)

- Padronizar as datas do studbook para formato de data aaaa-mm-dd
- Tentar por meio do arquivo antigo do BLT.csv fazer recuperação das datas por completo, devido corrompimento dos dados

- Vai ser necessário fazer inserção de individuos "wild" e "unknow" para as relações de parentescos posteriores parentescos.


## Feito:
- Padronizar as datas do studbook para formato de data aaaa-mm-dd
- Tentar por meio do arquivo antigo do BLT.csv fazer recuperação das datas por completo, devido corrompimento dos dados
- Na coluna 'localID' do studbook foram substituídos 'NONE' e '????' por 'NA'. Uma insconsistência foi encontrada no ind.421 pois foi anotado '000', pouco indicativo de ser um id valido.

- inserindo coluna de observações dos eventos "Death by unkown"

## Próximas Etapas

- Separar as observações de morte dos invidivíduos da coluna 'Event ID'.

- O insert de datas e id_especificos precisam ser validados pq nem sempre eles vão existir. Para isso utilizar 'if inline' para trocar 'NA' por valor NULL.

- Entender porque e como funciona o código:  `linha_BLT[i][9].rfind("[")!=-1`


---------------------------------------------------------------------------------------------------------------------------
# Para Fazer Hoje(04/03)

- Padronizar as datas do studbook para formato de data.
- Acrescentar as datas dos eventos e id_específico dos individuos no SQL de historico.
- Vai ser necessário fazer inserção de individuos "wild" e "unknow" para as relações de parentescos posteriores parentescos.


## Feito:

- Arrumado arquvivo '/Dados/BLT_history.csv' pois todos os dados estavam duplicados.
- Acrescentar as datas dos eventos e id_específico dos individuos no SQL de historico.


## Próximas Etapas

- Padronizar as datas do studbook para formato de data aaaa-mm-dd

- Vai ser necessário fazer inserção de individuos "wild" e "unknow" para as relações de parentescos posteriores parentescos.

- Tentar por meio do arquivo antigo do BLT.csv fazer recuperação das datas com o ano por completo


## OBSERVAÇÃO:
``` bash
#Comandos de manejo de data
cat BLT.csv | cut -d, -f7 > Datas_BLT.txt

```

---------------------------------------------------------------------------------------------------------------------------
# Para Fazer Hoje(14/01)

- Juntar os scripts de 'insert_specific_id' e 'insert_historico'.

- Arrumar erros na inserção inicial dos historicos (script insert SQL feito hoje). Exemplo: ind. 395.

- Inserir o histórico dos individuos. Tabela 'history'.


## Feito:

- Juntado os scripts de 'insert_specific_id' e 'insert_historico', pois as manipulações para edição do studbook (BLT.csv) ficaram fragmentadas em dois scripts distintos. Isso foi utilizado para criar o BLT_history.csv

- Arrumado o erro na inserção do indíduo 395, que era causado por não haver um evento inserido de 'Loan to'.


## Próximas Etapas

- Inserir os id's específicos nas observações de cada evento do histórico.

- Vai ser necessário fazer inserção de individuos "wild" e "unknow" para as relações de parentescos posteriores parentescos.


---------------------------------------------------------------------------------------------------------------------------
# Para Fazer Hoje(13/01):

"Ainda é necessário ver qual a melhor forma de lidar com locais que não possuem um id_specific para os idnividuos. Faz-se necessário a troca da primary Key da tabela, justamente por que atualmente a PK é o id especifico.""
    - Pensando nessa necessidade eu vou adaptar o banco e as inserções para que os id específicos sejam adicionados nas obersações dos históricos, uma vez que não é um item indispensável para os relacionamentos, mas que precisa ser mantido.

"Fiz a troca no arquivo BLT.csv do 'location' SCARLOS para SAO CARLOS. Precisa ser verificado se de fato correspondem ao mesmo local. (stud  nº 91 e outros 5)"
    - Alguns dados não estão corretamente colocados no BLT.csv, então vou utilizar os erros de inserção do 'insert_specific_id.sql' para ver quais linhas os dados não foram corretamente arrumados.


## Feito:

- Adicionado na tabela de institutos a opção "wild" para os casos de reintrodução.  (stud  nº 141, 260, 293)

- Os dados com conflitos de nomes foram arrumados no arquivo BLT.csv. Exemplo "SCARLOS" ou Erros na numeração dos indivíduos.


- Foram arrumados erros nas numerações do studbook original, entre no individuo 360 e 433, neles a numeração foi pulada 2 unidades em cada, ocasionando desníveis de numeração (Num Indivíduos X Numero de Registros).

- Fiz o BLT_Histórico com os id's dos eventos por linha para facilitar a inserção dos históricos.
 
---------------------------------------------------------------------------------------------------------------------------
# Para Fazer Hoje(10/01):
- Escrever script SQL de insert dos specific_id de cada indivíduo.
    
    - No script de inserir_specific_id.py ajustar os dados contidos em BLT.csv para cada linha da coluna "stud",coluna 0, possuir o id referente ao individuo a que se refere. Atualmente a primeira linha possui o id e as linhas subsequentes ficam em branco até uma nova "seção" de dados de outro individuo. 


## Feito
- Retornei a tabela de specific_id_individual pro 'BancoCompleto.sql' e apaguei a de "captive_location"

- Criado um script "BancoObjetivo.sql" para fragmentar o banco de dados a partir dos dados que eu estou trabalhando no momento de forma objetiva, para facilitar o desenvolvimento.

- Dentro do script 'insert_specific_id.py' foi feita uma adpatação do studobook(BLT.csv) que permita identificação dos institutos e invididuos envolvidos nos eventos do historico do animal.


# Póximas Etapas

- Ainda é necessário ver qual a melhor forma de lidar com locais que não possuem um id_specific para os idnividuos. Faz-se necessário a troca da primary Key da tabela, justamente por que atualmente a PK é o id especifico.

- Fiz a troca no arquivo BLT.csv do 'location' SCARLOS para SAO CARLOS. Precisa ser verificado se de fato correspondem ao mesmo local. (stud  nº 91 e outros 5)

- Adicionar a tabela de institutos a opção "wild" para os casos de reintrodução.  (stud  nº 141, 260, 293)
 
- Começar a inserir o histórico dos individuos. Tabela 'history'.

