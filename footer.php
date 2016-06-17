		<footer>
			<div class="container">
				<div id="main-footer" class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xl-12">
						<h1 class="title">Institucional</h1>
						
						<ul id="footer-menu">
							<li><a href="quem-somos.php">Quem Somos</a></li>
							<li><a href="equipe.php">Equipe</a></li>
							<li><a href="noticias.php">Notícias</a></li>
							<li><a href="galeria.php">Galeria</a></li>
							<li><a href="fale-conosco.php">Fale Conosco</a></li>
						</ul>
					</div>
					
					<div class="col-lg-4 col-md-4 col-sm-4 col-xl-12">
						<h1 class="title">Últimas Notícias</h1>
						
						<ul id="footer-news">
							<?php
								$sql = "SELECT * FROM noticias WHERE unidade = 'masc-pr' AND status = 1 ORDER BY id DESC LIMIT 3";
								$query = $conn->prepare($sql);
								$query->execute();
								if($query->rowCount() == 0){
									echo "Nenhuma notícia encontrada!";
								} else {
									while($linha = $query->fetch(PDO::FETCH_OBJ)){
							?>
							<li><a href="verNoticia.php?id=<?php echo $linha->id; ?>"><?php echo $linha->titulo; ?></a></li>
							<?php }} ?>
						</ul>
					</div>
					
					<div class="col-lg-4 col-md-4 col-sm-4 col-xl-12">
						<h1 class="title">Newsletter</h1>
						
						<input type="text" name="nome" placeholder="Seu nome" class="form-control" />
						<div class="space-5"></div>
						<input type="text" name="email" placeholder="Seu e-mail" class="form-control" />
						<div class="space-5"></div>
						<button type="submit" class="btn btn-default pull-right">Enviar</button>
					</div>
					
					<!--
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
					-->
				</div>
            </div>
        </footer>