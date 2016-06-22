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
		<title>Fale Conosco | CTNJ</title>
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
					<h1 class="title">Fale Conosco</h1>
					
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h4><strong>Agendamento de Entrevistas e Internações</strong></h4>
							
							<p align="justify">
								<strong>Marcio Roberto Calbente</strong>
								<br />
								(41) 9678–7373 - <strong><em>Vivo</em></strong>
								<br />
								(41) 9931–7997 - <strong><em>Tim</em></strong>
							</p>
							
							<div class="space-20"></div>
							
							<form class="form-horizontal">
								<fieldset>
									<legend>Formulário de Contato</legend>
									<div class="form-group">
										<label for="nome" class="col-lg-2 control-label">Nome</label>
										<div class="col-lg-5">
											<input type="text" class="form-control" name="nome" id="nome" placeholder="Digite seu nome" required>
										</div>
									</div>
									
									<div class="form-group">
										<label for="email" class="col-lg-2 control-label">E-mail</label>
										<div class="col-lg-5">
											<input type="email" class="form-control" name="email" id="email" placeholder="Digite seu e-mail" required>
										</div>
									</div>
									
									<div class="form-group">
										<label for="assunto" class="col-lg-2 control-label">Assunto</label>
										<div class="col-lg-5">
											<input type="text" class="form-control" name="assunto" id="assunto" placeholder="Digite o assunto desta mensagem" required>
										</div>
									</div>
									
									<div class="form-group">
										<label for="mensagem" class="col-lg-2 control-label">Mensagem</label>
										<div class="col-lg-5">
											<textarea class="form-control" name="mensagem" id="mensagem" placeholder="Digite sua mensagem" rows="5" required></textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label for="mensagem" class="col-lg-2 control-label">Newsletter</label>
										<div class="col-lg-5">
											<div class="checkbox">
										<label>
											<input type="checkbox" name="newsletter"> Desejo receber novidades e atualizações da Nova Jornada
										</label>
									</div>
										</div>
									</div>
								
									<div class="form-group">
										<div class="col-lg-2">
										</div>
										<div class="col-lg-5">
											<button type="reset" class="btn btn-default">Cancelar</button>
											<button type="submit" name="enviar" class="btn btn-primary">Enviar</button>
										</div>
									</div>
								</fieldset>
							</form>
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