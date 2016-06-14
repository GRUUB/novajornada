<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1">
		<meta name="keywords" content="ctnj, comunidade terapeutica, nova jornada, tratamento alcool, tratamento drogas, tratamento maconha, tratamento crack, tratamento cocaina, dependencia quimica, dependencia alcool, dependencia drogas, dependencia maconha, dependencia crack, dependencia cocaina, alcool, drogas, maconha, crack, cocaina" />
		<meta name="description" content="Somos uma Comunidade Terapêutica especializada na recuperação de dependentes químicos do álcool e das drogas" />
		<meta name="author" content="GRUUB" />
		<meta name="robot" content="index, follow" />
		<title>Comunidade Terapêutica Nova Jornada - Especializada no Tratamento para a Dependência Química</title>
		<link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/full-slider.css">
	</head>
	
	<body>
		<header>
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<h1 class="logo" title="Comunidade Terapêutica Nova Jornada - Especializada no Tratamento para a Dependência Química">
							<a href="index.php">
								<img src="imagens/logo.png" alt="Comunidade Terapêutica Nova Jornada - Especializada no Tratamento para a Dependência Química" />
							</a>
						</h1>
					</div>
					<div class="col-lg-8">
						<a href="index.php">
							<img src="imagens/contatos.png" alt="Comunidade Terapêutica Nova Jornada - Especializada no Tratamento para a Dependência Química" />
						</a>
					</div>
				</div>
			</div>
		</header>
		
		<?php include "menu.php"; ?>
		
		<!-- Slide -->
		<div id="myCarousel" class="carousel slide">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
			</ol>

			<!-- Wrapper for Slides -->
			<div class="carousel-inner">
				<div class="item active">
					<!-- Set the first background image using inline CSS below. -->
					<div class="fill" style="background-image:url('imagens/slides/01.jpg');"></div>
				</div>
				<div class="item">
					<!-- Set the second background image using inline CSS below. -->
					<div class="fill" style="background-image:url('imagens/slides/02.jpg');"></div>
				</div>
			</div>

			<!-- Controls
			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
				<span class="icon-prev"></span>
			</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">
				<span class="icon-next"></span>
			</a> -->
		</div>
		<!-- End Slide -->
		
		<div class="space-20"></div>
		
		<div class="container">
			<div class="row">
				<div id="content" class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right">
					<h1 class="title">Últimas Notícias</h1>
					<div class="row">
						<div class="news col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<a href="#"><a href="#"><img src="imagens/noticias/1.jpg" class="img-resposive" /></a></a>
							<a href="#"><h1 class="title">Maconha vicia e gera prejuízos permanentes no cérebro, diz novo estudo</h1></a>
							
							<p align="justify">
								Já faz um certo tempo que é considerada a ideia de que as pessoas que ocasionalmente fumam maconha podem, em breve, se tornarem viciadas. Agora, os cientistas afirmam ter chegado ao real motivo dessa questão. Segundo eles...
							</p>
							
							<a href="#" class="more btn btn-xs btn-primary pull-right">Leia Mais</a>
						</div>
						
						<div class="news col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<a href="#"><img src="imagens/noticias/2.jpg" class="img-resposive" /></a>
							<a href="#"><h1 class="title">Instituto Manassés: exploracao e preconceito em nome de Jesus</h1></a>
							
							<p align="justify">
								"Algum abençoado paga minha passagem ?"
								<br />
								Assim começa a saga diária de jovens que, aos berros, pregam dentro de ônibus, contando sua libertação das drogas por obra do Senhor Jesus. São os 'Manassés' em...
							</p>
							
							<a href="#" class="more btn btn-xs btn-primary pull-right">Leia Mais</a>
						</div>
						
					</div>
					
					<div class="row">						
						<div class="news col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<a href="#"><img src="imagens/noticias/3.jpg" class="img-resposive" /></a>
							<a href="#"><h1 class="title">Epidemia de crack atinge dois milhões e coloca Brasil no topo do ranking de consumo da droga</h1></a>
							
							<p align="justify">
								Assim como na ficção, na vida real, o crack (variação mais barata da cocaína) pode causar perda de apetite, do sono, depressão, e pode até matar, de acordo com especialistas ouvidos pelo <a href="http://www.uniad.org.br/interatividade/noticias/item/23592-epidemia-de-crack-atinge-dois-milh%C3%B5es-e-coloca-brasil-no-topo-do-ranking-de-consumo-da-droga" target="_blank">R7</a>...
							</p>
							
							<a href="#" class="more btn btn-xs btn-primary pull-right">Leia Mais</a>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left">
					
					<?php include "sidebar.php"; ?>
					
				</div>
			</div>
		</div>
		
        <footer>
			<div class="container">
				<div id="main-footer" class="row">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xl-12">
						<h1 class="title">Institucional</h1>
						
						<ul id="footer-menu">
							<li><a href="#">Quem Somos</a></li>
							<li><a href="#">Equipe</a></li>
							<li><a href="#">Notícias</a></li>
							<li><a href="#">Galeria</a></li>
							<li><a href="#">Fale Conosco</a></li>
						</ul>
					</div>
					
					<div class="col-lg-3 col-md-3 col-sm-6 col-xl-12">
						<h1 class="title">Últimas Notícias</h1>
						
						<ul id="footer-news">
							<li><a href="#">Na trilha dos 12 passos</a></li>
							<li><a href="#">A "Síndrome dos três meses"</a></li>
							<li><a href="#">A Comunidade Terapêutica para recuperação da dependência do álcool e outras drogas no Brasil</a></li>
						</ul>
					</div>
					
					<div class="col-lg-3 col-md-3 col-sm-6 col-xl-12">
						<h1 class="title">Newsletter</h1>
						
						<input type="text" name="nome" placeholder="Seu nome" class="form-control" />
						<div class="space-5"></div>
						<input type="text" name="email" placeholder="Seu e-mail" class="form-control" />
						<div class="space-5"></div>
						<button type="submit" class="btn btn-default pull-right">Enviar</button>
					</div>
					
					<div class="col-lg-3 col-md-3 col-sm-6 col-xl-12">
						<h1 class="title">Links Úteis</h1>
						
						<ul id="footer-menu">
							<li><a href="#">II Lenad</a></li>
							<li><a href="#">Lenad Família</a></li>
							<li><a href="#">Mouse Party</a></li>
							<li><a href="#">Ratolândia</a></li>
							<li><a href="#">Cartilhas</a></li>
						</ul>
					</div>
				</div>
            </div>
        </footer>
	</body>
	<script src="js/jquery-1.11.3.js"></script>
	<script src="js/bootstrap.js"></script>
	
	<script>
		$('.carousel').carousel({
			interval: 5000 //changes the speed
		})
    </script>
</html>