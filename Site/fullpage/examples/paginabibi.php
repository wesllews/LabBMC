<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Responsive Height - fullPage.js</title>
	<meta name="author" content="Alvaro Trigo Lopez" />
	<meta name="description" content="fullPage full-screen navigation and sections control menu." />
	<meta name="keywords"  content="fullpage,jquery,demo,screen,fullscreen,navigation,control arrows, dots" />
	<meta name="Resource-type" content="Document" />


	<link rel="stylesheet" type="text/css" href="../jquery.fullPage.css" />
	<link rel="stylesheet" type="text/css" href="examples.css" />
	<style>

	/* Style for our header texts
	* --------------------------------------- */
	h1{
		font-size: 5em;
		font-family: arial,helvetica;
		color: #fff;
		margin:0;
	}
	.intro p{
		color: #fff;
	}

	/* Centered texts in each section
	* --------------------------------------- */
	.section{
		text-align:center;
	}

	/* Bottom menu
	* --------------------------------------- */
	#infoMenu li a {
		color: #fff;
	}
	</style>

	<!--[if IE]>
		<script type="text/javascript">
			 var console = { log: function() {} };
		</script>
	<![endif]-->

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>

	<script type="text/javascript" src="../vendors/scrolloverflow.js"></script>

	<script type="text/javascript" src="../jquery.fullPage.js"></script>
	<script type="text/javascript" src="examples.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#fullpage').fullpage({
				anchors: ['firstPage', 'secondPage', '3rdPage'],
				sectionsColor: ['#C63D0F', '#1BBC9B', '#7E8F7C'],
				responsiveHeight: 600,
				afterResponsive: function(isResponsive){
				
				}
			});
		});
	</script>

</head>
<body>


<div id="fullpage">
	<div class="section " id="section0">
		<div class="intro">
			<h1>Responsive</h1>
			<p>This example will turn to normal scroll when the window size gets smaller than 600px height</p>
		</div>
	</div>
	<div class="section" id="section1">
	    
			<div class="intro">
				<h1>Ideal for small screens</h1>
			</div>


	</div>
	<div class="section" id="section2">
		<div class="intro">
			<h1>Keep it simple!</h1>
		</div>
	</div>
</div>


</body>
</html>