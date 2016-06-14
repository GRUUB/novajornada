<?php
	require_once "config/config.php";
	require_once "VerificaLogin.php";
	
	if(isset($_POST['add'])){
    	extract($_POST);
		
		$sql = "INSERT INTO galerias (nome, unidade, status) VALUES (:nome, :unidade, :status)";
	
		try {
			$query = $conn->prepare($sql);
			$query->bindValue(":nome", $nome);
			$query->bindValue(":unidade", $unidade);
			$query->bindValue(":status", $status);
			
			if($query->execute()){
				echo "<script>alert('Galeria cadastrada com sucesso!')</script>";
			} else {
				echo "<script>alert('Erro ao cadastrar galeria!')</script>";
			}
		} catch (PDOException $e){
			return "Erro: ".$e->getMessage();
		}
    }
	
	if(isset($_POST['edit'])){
    	extract($_POST);
		
		$sql = "UPDATE galerias SET nome = ?, unidade = ?, status = ? WHERE id = ?";
		$parametros = array($nome, $unidade, $status, $id);
	
		try {
			$query = $conn->prepare($sql);
			
			if($query->execute($parametros)){
				echo "<script>alert('Galeria editada com sucesso!')</script>";
			} else {
				echo "<script>alert('Erro ao editar galeria!')</script>";
			}
		} catch (PDOException $e){
			return "Erro: ".$e->getMessage();
		}
    }
	
	if(isset($_POST['remove'])){
    	extract($_POST);
		
		$sql = "DELETE FROM galerias WHERE id = ?";
		$parametros = array($id);
		
		try {
			$query = $conn->prepare($sql);
			$query->execute($parametros);
			
			if($query->rowCount() == 1){
				echo "<script>alert('Galeria removida com sucesso!')</script>";
			} else {
				echo "<script>alert('Erro ao remover galeria!')</script>";
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
        <a href="index2.html" class="logo">
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
            <li>
              <a href="noticias.php">
                <i class="fa fa-newspaper-o"></i> <span>Notícias</span></i>
              </a>
			</li>
            <li class="active">
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
						Galerias
					</h1>
				</div>
				<?php
					if($_SESSION['UserAcess'] == "admin") {
				?>
				<div class="col-md-6">
					<button class="btn btn-app pull-right" data-toggle="modal" data-target="#add">
						<i class="fa fa-plus-square"></i> Nova Galeria
					</button>
				</div>
				<?php } ?>
			</div>
        </section>
		
		<!-- Modal -->
		<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<form action="" method="post">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Adicionar Galeria</h4>
			  </div>
			  <div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<label for="nome">Nome</label>
						<input type="text" name="nome" id="nome" class="form-control">
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
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button type="submit" name="add" class="btn btn-primary">Salvar</button>
			  </div>
			</div>
			</form>
		  </div>
		</div>
		<!-- Modal -->

        <!-- Main content -->
        <section class="content">			
			<div class="box">
				<div class="box-header">
                  <h3 class="box-title">Galerias</h3>
                </div>
                <div class="box-body no-padding">
                  <table class="table table-striped">
                    <tr>
                      <th>Nome</th>
                      <th>Unidade</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
					<?php
						$sql = "SELECT * FROM galerias";
						$query = $conn->prepare($sql);
						$query->execute();
						if($query->rowCount() >= 1){
							while($linha = $query->fetch(PDO::FETCH_OBJ)){
					?>
                    <tr>
                      <td><?php echo $linha->nome; ?></td>
                      <td>
						<?php if($linha->unidade == "masc-sp") echo "Masculina - São Paulo"; ?>
						<?php if($linha->unidade == "fem-sp") echo "Feminia - São Paulo"; ?>
						<?php if($linha->unidade == "masc-pr") echo "Masculina - Paraná"; ?>
					  </td>
                      <td><?php if($linha->status == 1) echo "Ativo"; else echo "Inativo"; ?></td>
                      <td align="right">
						<a href="?galeria=<?php echo $linha->id; ?>" class="btn btn-success btn-md"><i class="fa fa-picture-o"></i></a>
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
						<form action="" method="post">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Editar Galeria</h4>
						  </div>
						  <div class="modal-body">
							<div class="row">
								<div class="col-lg-12">
									<label for="nome">Nome</label>
									<input type="text" name="nome" id="nome" class="form-control" value="<?php echo $linha->nome; ?>">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<label for="unidade">Unidade</label>
									<select name="unidade" id="unidade" class="form-control" required>
										<option value="masc-sp" <?php if($linha->unidade == "masc-sp") echo "selected"; ?>>Masculina - São Paulo</option>
										<option value="fem-sp" <?php if($linha->unidade == "fem-sp") echo "selected"; ?>>Feminina - São Paulo</option>
										<option value="masc-pr" <?php if($linha->unidade == "masc-pr") echo "selected"; ?>>Masculina - Paraná</option>
									</select>
								</div>
								<div class="col-lg-6">
									<label for="status">Status</label>
									<select name="status" id="status" class="form-control" required>
										<option value="1" <?php if($linha->status == 1) echo "selected"; ?>>Ativo</option>
										<option value="0" <?php if($linha->status == 0) echo "selected"; ?>>Inativo</option>
									</select>
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
									<h4 class="modal-title">Remover Galeria</h4>
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
