<!DOCTYPE html>


<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="img/iconesub/sb.ico">

	<title>Softbio - Home</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link rel="icon" href="img/logos/sb.ico">

	
  	<script src="bootstrap/jquery.js"></script>

    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  	$("#navbar").load("navbar.php?p=index");
    });
    </script> 

</head>
	<div id="navbar">
	</div>
<body>	

    <!-- Carousel
    ================================================== -->
<div class=" contentpagina">
    <section class="section-white">
  <div class="container">

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		<li data-target="#carousel-example-generic" data-slide-to="3"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item active">
          <img src="./img/bee.jpg" alt="...">
          <div class="carousel-caption">
            <p class="legenda-slide"><b>Bem-vindo ao Softbio</b></p>
    		<!--<p>Acesse os diversos conteúdos disponibilizados no nosso site!</p>
    		<p><a class="btn btn-lg btn-success" href="#" role="button">Saiba mais</a></p>-->	
          </div>
        </div>
        <div class="item"> 
          <img src="./img/cnidario.jpg" alt="...">
          <div class="carousel-caption">
            <p class="legenda-slide"><b>Aprendizado diferenciado</b></p>
    			<!--<p>a Softbio possui todos os conteúdos necessários para a sua aprendizagem!</p>-->
          </div>
        </div>
        <div class="item">
          <img src="./img/dna.jpg" alt="...">
          <div class="carousel-caption">
            <p class="legenda-slide"><b>Da origem da vida até hoje...</b></p>
    		<!--<p>Com os melhores conteúdos e questões!</p>-->
          </div>
        </div>
		<div class="item">
          <img src="./img/passaro.jpg" alt="...">
          <div class="carousel-caption">
            <p class="legenda-slide"><b>O que você está esperando?</b></p>
    		<!--<p>Comece já a estudar Biologia!</p>-->
    		<!--<p><a class="btn btn-lg btn-success" href="#" role="button">Vamos lá!</a></p>-->
          </div>
        </div>
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div>

  </div>
</section>	
		<br>
    <div class="container-fluid">
		<div class="row">
    		<div class="col-xs-6 col-sm-3">
    			<a class="thumbnail link-preto" href="paggeralcont.php">
    				<img src="img/estudo2.jpg" class="img-responsive img-rounded" alt="teste" width="330">
    				<div class="textodiv">
    					<p align="center">Estudo  de forma dinâmica e simples</p>
    				</div>
    			</a>
    		</div>        
    		<div class="col-xs-6 col-sm-3">
    			<a class="thumbnail link-preto" href="cadastrar.php">
    				<img src="img/estudo.jpg" class="img-responsive img-rounded" alt="teste" width="330">
    				<div class="textodiv">
    					<p align="center">Vem estudar com o sistema Softbio!</p>
    				</div> 
    			</a>
    		</div>
			<div class="clearfix visible-xs"></div>
			<div class="col-xs-6 col-sm-3">
				<a class="thumbnail link-preto" href="sobre.html">
					<img src="img/aquario.jpg" class="img-responsive img-rounded" alt="teste" width="330">
					<div class="textodiv">
						<p align="center">"Biologia nem sempre é complicada. Ela pode ser divertida, curiosa e até fascinante." - Maura Watan</p>
					</div> 
				</a>
			</div>        
			<div class="col-xs-6 col-sm-3">
				<a class="thumbnail link-preto" href="login.php">
					<img src="img/borboleta.jpg" class="img-responsive img-rounded" alt="teste" width="330">
					<div class="textodiv">
						<p align="center">Mude o seu futuro, comece agora!</p>
					</div>
				</a>
			</div>    
    	</div>
	</div>
</div>
	<footer id="footer" class="footer">
	</footer>
 </body>
  
</html>
