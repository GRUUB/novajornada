<?php
	require_once "painel/config/config.php";
	function limitarTexto($texto, $limite){
		$contador = strlen($texto);
		if ( $contador >= $limite ) {   
			$texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
			return $texto;
		} else {
			return $texto;
		}
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1">
		<meta name="keywords" content="ctnj, comunidade terapeutica, nova jornada, tratamento alcool, tratamento drogas, tratamento maconha, tratamento crack, tratamento cocaina, dependencia quimica, dependencia alcool, dependencia drogas, dependencia maconha, dependencia crack, dependencia cocaina, alcool, drogas, maconha, crack, cocaina" />
		<meta name="description" content="Somos uma Comunidade Terapêutica especializada na recuperação de dependentes químicos do álcool e das drogas" />
		<meta name="author" content="GRUUB" />
		<meta name="robot" content="index, follow" />
		<title>Notícias | CTNJ</title>
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
					<h1 class="title">Últimas Notícias</h1>
					<div class="row">
						<?php
							$sql = "SELECT * FROM noticias WHERE unidade = 'masc-pr' AND status = 1 ORDER BY id DESC";
							$query = $conn->prepare($sql);
							$query->execute();
							if($query->rowCount() == 0){
								echo "<h4>Nenhuma notícia encontrada!</h4>";
							} else {
								$count = 0;
								while($linha = $query->fetch(PDO::FETCH_OBJ)){
									$count++;
						?>
						<div class="news col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<a href="verNoticia.php?id=<?php echo $linha->id; ?>"><img src="uploads/noticias/<?php echo $linha->imagem; ?>" class="img-resposive" /></a>
							<a href="verNoticia.php?id=<?php echo $linha->id; ?>"><h1 class="title"><?php echo $linha->titulo; ?></h1></a>
							
							<p align="justify">
								<?php echo nl2br((limitarTexto($linha->descricao, $limite = 250))); ?>
							</p>
							
							<a href="verNoticia.php?id=<?php echo $linha->id; ?>" class="more btn btn-xs btn-primary pull-right">Leia Mais</a>
						</div>
						<?php if($count == 2) { echo "</div><div class='row'>"; } }} ?>
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