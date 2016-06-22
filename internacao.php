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
		<title>Internação | CTNJ</title>
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
					<h1 class="title">Internação</h1>
					
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h4><strong>PROCEDIMENTOS INICIAIS PARA REALIZAR UMA INTERNAÇÃO</strong></h4>
							
							<p align="justify">
								<a href="http://www.novajornada.org.br/masculina-sjp-pr/arquivos/MANUAL.pdf" target="_blank" class="btn btn-danger btn-sm" target="_self" title="Baixar Enxoval Básico e Manual para Residentes e Familiares"><i class="glyphicon glyphicon-download-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Baixar Enxoval Básico e Manual para Residentes e Familiares</a>
							</p>
							
							<p align="justify">
								Para ser um candidato à internação é necessário preencher alguns critérios básicos de admissão
							</p>
							<p align="justify">
								<ul>
									<li>Sexo Masculino</li>
									<li>Idade entre 18 e 65 anos</li>
									<li>Não possuir distúrbios mentais graves</li>
									<li>Não possuir deficiências físicas ou mentais que impeçam a autonomia</li>
									<li>Não ser portador de doenças que comprometam a convivência no mesmo ambiente (Ex.: tuberculose, hanseníase, etc.) Casos de HIV e Hepatite C são aceitos.</li>
									<li>Solicitar voluntariamente a internação</li>
								</ul>
							</p>
							<p align="justify">
								Os candidatos devem também realizar uma série de exames médicos antes do ingresso, a fim de avaliar o estado de saúde física, sendo estes:
							</p>
							
							<p align="justify">
								<ul>
									<li>HIV</li>
									<li>Hemograma Completo</li>
									<li>Fezes</li>
									<li>Urina I</li>
									<li>Rx de Tórax</li>
									<li>Avaliação dentária</li>
								</ul>
							</p>
							<p align="justify">
								Se o candidato estiver de acordo com estas condições pode nos contatar através do formulário no link CONTATO deste site, para agendar uma entrevista de internação, ou através dos telefones de contato.
							</p>
							<p align="justify">
								O candidato também pode acessar aqui o <a href="http://www.novajornada.org.br/masculina-sjp-pr/arquivos/MANUAL.pdf" target="_blank">MANUAL PARA RESIDENTES E FAMILIARES</a>, para informar-se melhor dos procedimentos da CT, assim como ter acesso aos documentos que deverão ser assinados por ele e pela família no ato da internação.
							</p>
							<p align="justify">
								Para realizar a internação será necessário providenciar os itens constantes no Enxoval Básico, contido no Manual acima.
							</p>
							<p align="justify">
								A mensalidade e a taxa de entrada serão definidas pessoalmente.
							</p>
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