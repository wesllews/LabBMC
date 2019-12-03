<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>LabBMC</title>

  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <!-- Bibliotecas precisam ser chamadas primeiro-->
  <script type="text/javascript" src="js/jquery.js"></script>
  <!-- Scripts comuns de JS-->
  <script type="text/javascript" src="js/bootstrap.js"></script>
</head>

<body>

<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
  <!-- Inicia a linha da navbar-->
  <div class="container">
    <a class="navbar-brand " href="#">LabBMC</a>
    <!-- Um objeto fixo do nav, pode ser em letra ou até mesmo um logotipo -->


    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#pages" > 
      <!-- O toggler é o botão "oculto" que aparece como indice do menu, para determinados tamanhos de tela, no item data-target é colocado o ID da lista de botões contidos no nav-->
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="pages" >
      <!-- O id desse item que permite ele ser referenciado pelo -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Data View</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Related Archives</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
      </ul>
      </div>

      <div class="collapse navbar-collapse" id="pages">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Request access</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-success" href="login.php">Login</a>
          </li>
        </ul>
      </div>
      
    </div>
  </div>  
 </nav>
<br><br><br><br>
<div class="container">
  <h2>Leontopithecus chrysopygus</h2>
  <p>
  O mico-leão-preto (nome científico: Leontopithecus chrysopygus) é um Macaco do Novo Mundo, da família Cebidae e subfamília Callitrichinae. É uma das duas espécies de mico-leão que ocorre no estado de São Paulo, e historicamente ocorreu em quase toda a extensão entre o rio Paranapanema e o rio Tietê, em áreas de floresta estacional semidecidual. Atualmente, encontra-se apenas em nove localidades do estado de São Paulo, sendo o Parque Estadual Morro do Diabo a única em que é possível ter uma população viável a longo prazo. Já foi considerado uma subespécie do mico-leão-dourado, mas hoje é considerado espécie plena.
  </p>
</div>
  <div class="container">
    <h2>Conexão</h2>
  <a class="btn btn-info" href="conection.php">Script de Conexão</a>
  </div>
  <br><br>
  <div class="container">
    <h2>Manejo BD</h2>
  <a class="btn btn-info" href="/phpmyadmin/index.php?lang=pt_BR">PHP Admin</a>
  </div>
</body>

</html>