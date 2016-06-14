<?php
	require_once "config/config.php";
	require_once "VerificaLogin.php";
	
	if(isset($_POST['add'])){
    	extract($_POST);
		
		// Verifica se existe a imagem
		if(!empty($_FILES['foto']['name'])){
		
			//INFO IMAGEM
			$file = $_FILES['foto'];
			
			//PASTA
			$folder	= '../uploads/noticias';
				
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
			$novoNome = $name . "-" . rand().".$extensao";
				
			if($error != 0){
				$msg[] = "<strong>$name :</strong> ".$errorMsg[$error];
			} else if(!in_array($type, $permite)){
				$msg[] = "<strong>$name :</strong> Erro imagem não suportada!";
			} else if($size > $maxSize){
				$msg[] = "<strong>$name :</strong> Erro imagem ultrapassa o limite de 5MB";
			} else {
				if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
					// Prepara o cadastro
					$query = $conn->prepare("INSERT INTO noticias (titulo, description, tags, imagem, descricao, status, unidade, data) VALUES (:titulo, :description, :tags, :imagem, :descricao, :status, :unidade, :data)");
					$query->bindValue(":titulo", $titulo);
					$query->bindValue(":description", $description);
					$query->bindValue(":tags", $tags);
					$query->bindValue(":imagem", $novoNome);
					$query->bindValue(":descricao", $descricao);
					$query->bindValue(":status", $status);
					$query->bindValue(":unidade", $unidade);
					$query->bindValue(":data", $data);

					if($query->execute()) {
						echo "<script>alert('Notícia cadastrada com sucesso!')</script>";
					} else {
						echo "<script>alert('Erro ao cadastrar notícia!')</script>";
					}
				} else {
					echo "<script>alert('Não foi possível carregar a foto da notícia!')</script>";
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
		
		// Verifica se existe a imagem
		if(!empty($_FILES['foto']['name'])){
		
			//INFO IMAGEM
			$file = $_FILES['foto'];
			
			//PASTA
			$folder	= '../uploads/noticias';
				
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
			$novoNome = $name . "-" . rand().".$extensao";
				
			if($error != 0){
				$msg[] = "<strong>$name :</strong> ".$errorMsg[$error];
			} else if(!in_array($type, $permite)){
				$msg[] = "<strong>$name :</strong> Erro imagem não suportada!";
			} else if($size > $maxSize){
				$msg[] = "<strong>$name :</strong> Erro imagem ultrapassa o limite de 5MB";
			} else {
				if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
					// Prepara o cadastro
					$query = $conn->prepare("UPDATE noticias SET titulo = ?, description = ?, tags = ?, imagem = ?, descricao = ?, status = ?, unidade = ? WHERE id = ?");
					$parametros = array($titulo, $description, $tags, $novoNome, $descricao, $status, $unidade, $id);

					if($query->execute($parametros)) {
						echo "<script>alert('Notícia editada com sucesso!')</script>";
					} else {
						echo "<script>alert('Erro ao editar notícia!')</script>";
					}
				} else {
					echo "<script>alert('Não foi possível carregar a foto da notícia!')</script>";
				}
			}						
			foreach($msg as $pop)
				echo $pop.'<br>';
		} else {
			$query = $conn->prepare("UPDATE noticias SET titulo = ?, description = ?, tags = ?, descricao = ?, status = ?, unidade = ? WHERE id = ?");
			$parametros = array($titulo, $description, $tags, $descricao, $status, $unidade, $id);
			if($query->execute($parametros)) {
				echo "<script>alert('Notícia editada com sucesso!')</script>";
			} else {
				echo "<script>alert('Erro ao editar notícia!')</script>";
			}
		}
    }
	
	if(isset($_POST['remove'])){
    	extract($_POST);
		
		$sql = "DELETE FROM noticias WHERE id = ?";
		$parametros = array($id);
		
		try {
			$query = $conn->prepare($sql);
			$query->execute($parametros);
			
			if($query->rowCount() == 1){
				echo "<script>alert('Notícia removida com sucesso!')</script>";
			} else {
				echo "<script>alert('Erro ao remover notícia!')</script>";
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
            <li>
              <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
              </a>
			</li>
            <li>
              <a href="paginas.php">
                <i class="fa fa-list"></i> <span>Páginas</span></i>
              </a>
			</li>
            <li class="active">
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
						Notícias
					</h1>
				</div>
				<div class="col-md-6">
					<a class="btn btn-app pull-right" data-toggle="modal" data-target="#add">
						<i class="fa fa-plus-square"></i> Nova Notícia
					</a>
				</div>
			</div>
        </section>

		<!-- Modal Item -->
		<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<form action="" method="post" enctype="multipart/form-data">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Adicionar Notícia</h4>
			  </div>
			  <div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<label for="titulo">Título</label>
						<input type="text" name="titulo" id="titulo" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<label for="foto">Imagem</label>
						<input type="file" name="foto" id="foto" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<label for="descricao">Descrição (Notícia)</label>
						<textarea name="descricao" id="descricao" class="form-control" rows="10"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<label for="unidade">Unidade</label>
						<select name="unidade" id="unidade" class="form-control" required>
							<option value="">SELECIONE</option>
							<option value="masc-sp">Masculina - São Paulo</option>
							<option value="fem-sp">Feminina - São Paulo</option>
							<option value="masc-pr">Masculina - Paraná</option>
						</select>
					</div>
					<div class="col-lg-6">
						<label for="status">Status</label>
						<select name="status" id="status" class="form-control" required>
							<option value="">SELECIONE</option>
							<option value="1">Ativo</option>
							<option value="0">Inativo</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<label for="description">Descrição (Google)</label>
						<textarea name="description" id="description" class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<label for="tags">Tags (Separado por ",")</label>
						<input type="text" name="tags" id="tags" class="form-control">
					</div>
				</div>
			  </div>
			  <div class="modal-footer">
				<input type="hidden" name="data" value="<?php echo date("Y-m-d"); ?>"/>
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
						  <h3 class="box-title">Notícias</h3>
						</div>
						<div class="box-body no-padding">
						  <table class="table table-striped">
							<tr>
							  <th>Título</th>
							  <th>Data</th>
							  <th>Unidade</th>
							  <th>Status</th>
							  <th></th>
							</tr>
							<?php
								$sql = "SELECT * FROM noticias";
								$query = $conn->prepare($sql);
								$query->execute();
								if($query->rowCount() >= 1){
									while($linha = $query->fetch(PDO::FETCH_OBJ)){
							?>
							<tr>
							  <td><?php echo $linha->titulo; ?></td>
							  <td><?php echo date("d/m/Y", strtotime($linha->data)); ?></td>
							  <td>
								<?php if($linha->unidade == "masc-sp") echo "Masculina - São Paulo"; ?>
								<?php if($linha->unidade == "fem-sp") echo "Feminia - São Paulo"; ?>
								<?php if($linha->unidade == "masc-pr") echo "Masculina - Paraná"; ?>
							  </td>
							  <td>
								<span class="badge bg-<?php if($linha->status == 0) { echo "red"; } if($linha->status == 1) { echo "green"; } if($linha->status == 2) { echo "orange"; } ?>">
									<?php if($linha->status == 0) { echo "Inativo"; } ?>
									<?php if($linha->status == 1) { echo "Ativo"; } ?>
								</span></td>
							  <td align="right">
								<?php
									if($_SESSION['UserAcess'] == "admin") {
								?>
								<a href="#edit-<?php echo $linha->id; ?>" data-toggle="modal" class="btn btn-primary btn-md"><i class="fa fa-edit"></i></a>
								<a href="#remove-<?php echo $linha->id; ?>" data-toggle="modal" class="btn btn-danger btn-md"><i class="fa fa-trash"></i></a>
								<?php } ?>
							  </td>
							</tr>
							
							<!-- Edit -->
							<div class="modal fade" id="edit-<?php echo $linha->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
								<form action="" method="post" enctype="multipart/form-data">
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Editar Notícia</h4>
								  </div>
								  <div class="modal-body">
									<div class="row">
										<div class="col-lg-12">
											<label for="titulo">Título</label>
											<input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $linha->titulo; ?>">
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<label for="foto">Imagem</label>
											<input type="file" name="foto" id="foto" class="form-control">
											
											<br />
											
											<img src="../uploads/noticias/<?php echo $linha->imagem; ?>" width="100%" />
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<label for="descricao">Descrição (Notícia)</label>
											<textarea name="descricao" id="descricao" class="form-control" rows="10"><?php echo $linha->descricao; ?></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<label for="unidade">Unidade</label>
											<select name="unidade" id="unidade" class="form-control" required>
												<option value="">SELECIONE</option>
												<option value="masc-sp" <?php if($linha->unidade == "masc-sp") { echo "selected"; } ?>>Masculina - São Paulo</option>
												<option value="fem-sp" <?php if($linha->unidade == "fem-sp") { echo "selected"; } ?>>Feminina - São Paulo</option>
												<option value="masc-pr" <?php if($linha->unidade == "masc-pr") { echo "selected"; } ?>>Masculina - Paraná</option>
											</select>
										</div>
										<div class="col-lg-6">
											<label for="status">Status</label>
											<select name="status" id="status" class="form-control">
												<option value="">SELECIONE</option>
												<option value="1" <?php if($linha->status == 1) { echo "selected"; } ?>>Ativo</option>
												<option value="0" <?php if($linha->status == 0) { echo "selected"; } ?>>Inativo</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<label for="description">Descrição (Google)</label>
											<textarea name="description" id="description" class="form-control" rows="3"><?php echo $linha->description; ?></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<label for="tags">Tags (Separado por ",")</label>
											<input type="text" name="tags" id="tags" class="form-control" value="<?php echo $linha->tags; ?>">
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
							
							<!-- Remove -->
							<div class="modal" id="remove-<?php echo $linha->id; ?>">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">Remover Notícia</h4>
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
    <!-- TinyMCE -->
    <script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "#descricao",
			language: "pt_BR",
			height: 300,
			plugins: [ 
				"advlist autolink link image lists charmap print preview hr anchor pagebreak", 
				"searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking", 
				"table contextmenu directionality emoticons paste textcolor filemanager" 
			], 
			image_advtab: true, 
			toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code"
        });
    </script>
  </body>
</html>
