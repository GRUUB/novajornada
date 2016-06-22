<?php
	require_once "painel/config/config.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1">
		<meta name="keywords" content="ctnj, comunidade terapeutica, nova jornada, tratamento alcool, tratamento drogas, tratamento maconha, tratamento crack, tratamento cocaina, dependencia quimica, dependencia alcool, dependencia drogas, dependencia maconha, dependencia crack, dependencia cocaina, alcool, drogas, maconha, crack, cocaina" />
		<meta name="description" content="Somos uma Comunidade Terapêutica especializada na recuperação de dependentes químicos do álcool e das drogas" />
		<meta name="author" content="STUDIOBNT" />
		<meta name="robot" content="index, follow" />
		<title>Questionário de Avaliação de Visita de Ressocialização | CTNJ</title>
		<link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" href="css/style.css" />
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
        
		<div class="space-20"></div>
		
		<div class="container">
			<div class="row">
				<div id="content" class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right">
					<h1 class="title">Questionário de Avaliação de Visita de Ressocialização</h1>
					
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<iframe src="https://docs.google.com/forms/d/1rF1-d29UOkdWOsR0gkEWHNf9QxSafBNRp0j78Q54jQM/viewform?embedded=true" height="700" width="100%" frameborder="0" marginwidth="0" marginheight="0"></iframe>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left">
					<?php include "sidebar.php"; ?>
				</div>
			</div>
		</div>
		
        <?php include "footer.php"; ?>
	</body>
	<script src="js/jquery-1.11.3.js"></script>
	<script src="js/bootstrap.js"></script>
</html>