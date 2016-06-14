<?php
	require_once "config/config.php";
	require_once "VerificaLogin.php";
	
	if(isset($_POST['add'])){
    	extract($_POST);
		
		$hash = hash('whirlpool', $senha);
		
		$sql = "INSERT INTO usuarios (nome, login, senha, status, acesso) VALUES (:nome, :login, :senha, :status, :acesso)";
	
		try {
			$query = $conn->prepare($sql);
			$query->bindValue(":nome", $nome);
			$query->bindValue(":login", $login);
			$query->bindValue(":senha", $hash);
			$query->bindValue(":status", $status);
			$query->bindValue(":acesso", $acesso);
			
			if($query->execute()){
				echo "<script>alert('Usuário cadastrado com sucesso!')</script>";
			} else {
				echo "<script>alert('Erro ao cadastrar usuário!')</script>";
			}
		} catch (PDOException $e){
			return "Erro: ".$e->getMessage();
		}
    }
	
	if(isset($_POST['edit'])){
    	extract($_POST);
		
		if($senha != ""){
			$hash = hash('whirlpool', $senha);
			$sql = "UPDATE usuarios SET nome = ?, login = ?, senha = ?, status = ?, acesso = ? WHERE id = ?";
			$parametros = array($nome, $login, $hash, $status, $acesso, $id);
		} else {
			$sql = "UPDATE usuarios SET nome = ?, login = ?, status = ?, acesso = ? WHERE id = ?";
			$parametros = array($nome, $login, $status, $acesso, $id);
		}
	
		try {
			$query = $conn->prepare($sql);
			
			if($query->execute($parametros)){
				echo "<script>alert('Usuário editado com sucesso!')</script>";
			} else {
				echo "<script>alert('Erro ao editar usuário!')</script>";
			}
		} catch (PDOException $e){
			return "Erro: ".$e->getMessage();
		}
    }
	
	if(isset($_POST['remove'])){
    	extract($_POST);
		
		$sql = "DELETE FROM usuarios WHERE id = ?";
		$parametros = array($id);
		
		try {
			$query = $conn->prepare($sql);
			$query->execute($parametros);
			
			if($query->rowCount() == 1){
				echo "<script>alert('Usuário removido com sucesso!')</script>";
			} else {
				echo "<script>alert('Erro ao remover usuário!')</script>";
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
            <li>
              <a href="galerias.php">
                <i class="fa fa-picture-o"></i> <span>Galerias</span></i>
              </a>
			</li>
            <li class="active">
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
						Usuários
					</h1>
				</div>
				<?php
					if($_SESSION['UserAcess'] == "admin") {
				?>
				<div class="col-md-6">
					<button class="btn btn-app pull-right" data-toggle="modal" data-target="#add">
						<i class="fa fa-plus-square"></i> Novo Usuário
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
				<h4 class="modal-title" id="myModalLabel">Adicionar Usuário</h4>
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
						<label for="login">Login</label>
						<input type="text" name="login" id="login" class="form-control" required>
					</div>
					<div class="col-lg-6">
						<label for="senha">Senha</label>
						<input type="password" name="senha" id="senha" class="form-control" required>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<label for="acesso">Nível de Acesso</label>
						<select name="acesso" id="acesso" class="form-control" required>
							<option value="">SELECIONE</option>
							<option value="admin">Administrador</option>
							<option value="normal">Normal</option>
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
                  <h3 class="box-title">Usuários</h3>
                </div>
                <div class="box-body no-padding">
                  <table class="table table-striped">
                    <tr>
                      <th>Nome</th>
                      <th>Login</th>
                      <th></th>
                    </tr>
					<?php
						$sql = "SELECT * FROM usuarios";
						$query = $conn->prepare($sql);
						$query->execute();
						if($query->rowCount() >= 1){
							while($linha = $query->fetch(PDO::FETCH_OBJ)){
					?>
                    <tr>
                      <td><?php echo $linha->nome; ?></td>
                      <td><?php echo $linha->login; ?></td>
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
						<form action="" method="post">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Editar Usuário</h4>
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
									<label for="login">Login</label>
									<input type="text" name="login" id="login" class="form-control" value="<?php echo $linha->login; ?>">
								</div>
								<div class="col-lg-6">
									<label for="senha">Senha</label>
									<input type="password" name="senha" id="senha" class="form-control" placeholder="Deixe em branco para NÃO EDITAR">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<label for="acesso">Nível de Acesso</label>
									<select name="acesso" id="acesso" class="form-control" required>
										<option value="admin" <?php if($linha->acesso == "admin") echo "selected"; ?>>Administrador</option>
										<option value="normal" <?php if($linha->acesso == "normal") echo "selected"; ?>>Normal</option>
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
									<h4 class="modal-title">Remover Usuário</h4>
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
