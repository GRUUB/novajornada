<?php
	require_once "config/config.php";
	require_once "VerificaLogin.php";
	
	if(isset($_POST['add'])){
    	extract($_POST);
		
		$sql = "INSERT INTO catalogo (referencia, descricao, medidas, preco, status) VALUES (:referencia, :descricao, :medidas, :preco, :status)";
	
		try {
			$query = $conn->prepare($sql);
			$query->bindValue(":referencia", $referencia);
			$query->bindValue(":descricao", $descricao);
			$query->bindValue(":medidas", $medidas);
			$query->bindValue(":preco", $preco);
			$query->bindValue(":status", $status);
			
			if($query->execute()){
				echo "<script>alert('Item cadastrado com sucesso!')</script>";
			} else {
				echo "<script>alert('Erro ao cadastrar item!')</script>";
			}
		} catch (PDOException $e){
			return "Erro: ".$e->getMessage();
		}
    }
	
	if(isset($_POST['pic'])){
    	extract($_POST);
		
		// Verifica se existe a imagem
		if(!empty($_FILES['foto']['name'])){
		
			//INFO IMAGEM
			$file = $_FILES['foto'];
			
			//PASTA
			$folder	= '../images/catalogo';
				
			//REQUISITOS
			$permite = array('image/jpg', 'image/jpeg', 'image/png');
			$maxSize = 1024 * 1024 * 5;
				
			//MENSAGENS
			$msg = array();
			$errorMsg = array(
				1 => 'O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini.',
				2 => 'O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE que foi especificado no formulário HTML',
				3 => 'o upload do arquivo foi feito parcialmente',
				4 => 'Não foi feito o upload do arquivo'
			);
			
			$name = $file['name'];
			$type = $file['type'];
			$size = $file['size'];
			$error = $file['error'];
			$tmp = $file['tmp_name'];
			
			$extensao = @end(explode('.', $name));
			$novoNome = $referencia . "-" . rand().".$extensao";
				
			if($error != 0){
				$msg[] = "<strong>$name :</strong> ".$errorMsg[$error];
			} else if(!in_array($type, $permite)){
				$msg[] = "<strong>$name :</strong> Erro imagem não suportada!";
			} else if($size > $maxSize){
				$msg[] = "<strong>$name :</strong> Erro imagem ultrapassa o limite de 5MB";
			} else {
				if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
					// Prepara o cadastro
					$query = $conn->prepare("INSERT INTO fotos (referencia, nome, ordem) VALUES (:referencia, :nome, :ordem)");
					$query->bindValue(":referencia",$referencia);
					$query->bindValue(":nome",$novoNome);
					$query->bindValue(":ordem","");

					//Valida o cadastro
					$validarQuery = $conn->prepare("SELECT * FROM fotos WHERE referencia = ?");
					$validarQuery->execute(array($referencia));

					if($validarQuery->rowCount() == 0) {
						// Executa Query
						$query->execute();
						echo "<script>alert('Foto cadastrada com sucesso!')</script>";
					} else {
						echo "<script>alert('Erro ao cadastrar foto!')</script>";
					}
				} else {
					echo "<script>alert('Erro ao cadastrar foto!')</script>";
				}
			}						
			foreach($msg as $pop)
				echo $pop.'<br>';
		} else {
			echo "<script>alert('Você deve selecionar uma foto!')</script>";
		}
    }
	
	if(isset($_POST['edit'])){
    	extract($_POST);
		
		$sql = "UPDATE catalogo SET referencia = ?, descricao = ?, medidas = ?, preco = ?, status = ? WHERE id = ?";
		$parametros = array($referencia, $descricao, $medidas, $preco, $status, $id);
	
		try {
			$query = $conn->prepare($sql);
			
			if($query->execute($parametros)){
				echo "<script>alert('Item editado com sucesso!')</script>";
			} else {
				echo "<script>alert('Erro ao editar item!')</script>";
			}
		} catch (PDOException $e){
			return "Erro: ".$e->getMessage();
		}
    }
	
	if(isset($_POST['remove'])){
    	extract($_POST);
		
		$sql = "DELETE FROM catalogo WHERE id = ?";
		$parametros = array($id);
		
		try {
			$query = $conn->prepare($sql);
			$query->execute($parametros);
			
			if($query->rowCount() == 1){
				echo "<script>alert('Item removido com sucesso!')</script>";
			} else {
				echo "<script>alert('Erro ao remover item!')</script>";
			}
		} catch (PDOException $e){
			return "Erro: ".$e->getMessage();
		}
    }
	
	if(isset($_GET['remove'])){
    	extract($_GET);
		
		$sql = "DELETE FROM fotos WHERE id = ?";
		$parametros = array($remove);
		
		try {
			$query = $conn->prepare($sql);
			$query->execute($parametros);
			
			if($query->rowCount() == 1){
				echo "<script>alert('Foto removida com sucesso!')</script>";
			} else {
				echo "<script>alert('Erro ao remover foto!')</script>";
			}
		} catch (PDOException $e){
			return "Erro: ".$e->getMessage();
		}
    }
	
	if(isset($_GET['logout'])){
		session_destroy();
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Painel de Administração - CTNJ</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>CT</b>NJ</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>CT</b>NJ</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- LOGOUT -->
              <li>
                <a href="?logout"><i class="fa fa-sign-out"></i> Sair</a>
              </li>
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU DE NAVEGAÇÃO</li>
            <li class="active">
              <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
              </a>
			</li>
            <li>
              <a href="paginas.php">
                <i class="fa fa-list"></i> <span>Páginas</span></i>
              </a>
			</li>
            <li>
              <a href="noticias.php">
                <i class="fa fa-newspaper-o"></i> <span>Notícias</span></i>
              </a>
			</li>
            <li>
              <a href="galerias.php">
                <i class="fa fa-picture-o"></i> <span>Galerias</span></i>
              </a>
			</li>
            <li>
              <a href="usuarios.php">
                <i class="fa fa-users"></i> <span>Usuários</span></i>
              </a>
			</li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
		  <div class="row">
				<div class="col-md-6">
					<h1>
						Dashboard
					</h1>
				</div>
				<div class="col-md-6">
					<a class="btn btn-app pull-right" data-toggle="modal" data-target="#add">
						<i class="fa fa-plus-square"></i> Novo Item
					</a>
					<!--
					<a class="btn btn-app pull-right" data-toggle="modal" data-target="#addColecao">
						<i class="fa fa-folder-open"></i> Nova Coleção
					</a>
					-->
				</div>
			</div>
        </section>

		<!-- Modal Item -->
		<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<form action="" method="post">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Adicionar Item</h4>
			  </div>
			  <div class="modal-body">
				<div class="row">
					<div class="col-lg-3">
						<label for="referencia">Referência</label>
						<input type="text" name="referencia" id="referencia" class="form-control">
					</div>
					<div class="col-lg-4">
						<label for="preco">Preço</label>
						<input type="text" name="preco" id="preco" class="form-control">
					</div>
					<div class="col-lg-5">
						<label for="status">Status</label>
						<select name="status" id="status" class="form-control">
							<option value="">SELECIONE</option>
							<option value="1">Ativo</option>
							<option value="0">Inativo</option>
							<option value="2">Esgotado</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<label for="medidas">Medidas</label>
						<textarea name="medidas" id="medidas" class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<label for="descricao">Descrição</label>
						<textarea name="descricao" id="descricao" class="form-control" rows="5"></textarea>
					</div>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button type="submit" name="add" class="btn btn-primary">Salvar</button>
			  </div>
			</div>
			</form>
		  </div>
		</div>
		<!-- Modal Item -->
		
        <!-- Main content -->
        <section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-header">
						  <h3 class="box-title">Catálogo</h3>
						</div>
						<div class="box-body no-padding">
						  <table class="table table-striped">
							<tr>
							  <th>Ref.</th>
							  <th>Coleção</th>
							  <th>Status</th>
							  <th></th>
							</tr>
							<?php
								$sql = "SELECT * FROM catalogo";
								$query = $conn->prepare($sql);
								$query->execute();
								if($query->rowCount() >= 1){
									while($linha = $query->fetch(PDO::FETCH_OBJ)){
							?>
							<tr>
							  <td><?php echo $linha->referencia; ?></td>
							  <td>Coleção 2016</td>
							  <td>
								<span class="badge bg-<?php if($linha->status == 0) { echo "red"; } if($linha->status == 1) { echo "green"; } if($linha->status == 2) { echo "orange"; } ?>">
									<?php if($linha->status == 0) { echo "Inativo"; } ?>
									<?php if($linha->status == 1) { echo "Ativo"; } ?>
									<?php if($linha->status == 2) { echo "Esgotado"; } ?>
								</span></td>
							  <td align="right">
								<a href="#edit-<?php echo $linha->id; ?>" data-toggle="modal" class="btn btn-primary btn-md"><i class="fa fa-edit"></i></a>
								<a href="#pic-<?php echo $linha->id; ?>" data-toggle="modal" class="btn btn-success btn-md"><i class="fa fa-picture-o"></i></a>
								<a href="#remove-<?php echo $linha->id; ?>" data-toggle="modal" class="btn btn-danger btn-md"><i class="fa fa-trash"></i></a>
							  </td>
							</tr>
							
							<!-- Edit -->
							<div class="modal fade" id="edit-<?php echo $linha->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
								<form action="" method="post">
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Editar Item</h4>
								  </div>
								  <div class="modal-body">
									<div class="row">
										<div class="col-lg-3">
											<label for="referencia">Referência</label>
											<input type="text" name="referencia" id="referencia" class="form-control" value="<?php echo $linha->referencia; ?>">
										</div>
										<div class="col-lg-4">
											<label for="preco">Preço</label>
											<input type="text" name="preco" id="preco" class="form-control" value="<?php echo $linha->preco; ?>">
										</div>
										<div class="col-lg-5">
											<label for="status">Status</label>
											<select name="status" id="status" class="form-control">
												<option value="">SELECIONE</option>
												<option value="1" <?php if($linha->status == 1) { echo "selected"; } ?>>Ativo</option>
												<option value="0" <?php if($linha->status == 0) { echo "selected"; } ?>>Inativo</option>
												<option value="2" <?php if($linha->status == 2) { echo "selected"; } ?>>Esgotado</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<label for="medidas">Medidas</label>
											<textarea name="medidas" id="medidas" class="form-control" rows="3"><?php echo $linha->medidas; ?></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<label for="descricao">Descrição</label>
											<textarea name="descricao" id="descricao" class="form-control" rows="5"><?php echo $linha->descricao; ?></textarea>
										</div>
									</div>
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
									<button type="submit" name="edit" class="btn btn-primary">Salvar</button>
									<input type="hidden" name="id" value="<?php echo $linha->id; ?>">
								  </div>
								</div>
								</form>
							  </div>
							</div>
							<!-- Edit -->
							
							<!-- Pic -->
							<div class="modal fade" id="pic-<?php echo $linha->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
								<form action="" method="post" enctype="multipart/form-data">
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Fotos</h4>
								  </div>
								  <div class="modal-body">
									<div class="row">
										<?php
											$sqlPic = "SELECT * FROM fotos WHERE referencia = {$linha->referencia}";
											$queryPic = $conn->prepare($sqlPic);
											$queryPic->execute();
											if($queryPic->rowCount() >= 1){
												while($linhaPic = $queryPic->fetch(PDO::FETCH_OBJ)){
										?>
										<div class="col-lg-6">
											<img src="../images/catalogo/<?php echo $linhaPic->nome; ?>" width="100%" height="100%">
										</div>
										
										<br />
										<br />
										
										<div class="col-lg-12">
											<a href="?remove=<?php echo $linhaPic->id; ?>" onClick="confirm('Você tem certeza que deseja remover esta foto?')" class="btn btn-danger btn-md"><i class="fa fa-trash"></i></a>
										</div>
										<?php }} else { ?>
										<div class="col-lg-12">
											<label for="foto">Adicionar Foto</label>
											<input type="file" name="foto" id="foto" />
										</div>
										<?php } ?>
									</div>
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
									<button type="submit" name="pic" class="btn btn-primary">Salvar</button>
									<input type="hidden" name="id" value="<?php echo $linha->id; ?>">
									<input type="hidden" name="referencia" value="<?php echo $linha->referencia; ?>">
								  </div>
								</div>
								</form>
							  </div>
							</div>
							<!-- Pic -->
							
							<!-- Remove -->
							<div class="modal" id="remove-<?php echo $linha->id; ?>">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">Remover Item</h4>
										</div>
										<form action="" method="post">
											<div class="modal-body">
												<p>
													<div class="alert alert-warning">
														Você está prestes a remover este registro.<br /><br />
														Esta ação não pode ser desfeita! <br /><br />
														<label class="label label-danger">Você tem certeza?</label>
													</div>
												</p>
													
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
												<button type="submit" name="remove" class="btn btn-primary">Salvar</button>
												<input type="hidden" name="id" value="<?php echo $linha->id; ?>">
											  </div>
										</form>
									</div>
								</div>
							</div>
							<!-- Remove -->
							<?php }} ?>
						  </table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Versão</b> 1.0.0
        </div>
        <strong>CTNJ &copy; <?php echo date("Y"); ?></strong> - <a href="http://studiobnt.com.br">STUDIOBNT</a>
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>
</html>
