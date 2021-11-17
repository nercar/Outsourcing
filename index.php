<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Garzón | Outsourcing</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome/css/all.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.css">
	<!-- Datepicker Bootstrap -->
	<link rel="stylesheet" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" class="rel">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.css">
	<link rel="stylesheet" href="dist/css/jquery-ui.css">
	<!-- Icon Favicon -->
	<link rel="shortcut icon" href="dist/img/favicon.png" />
	<style>
		table.dataTable tbody td, table.dataTable thead th, table.dataTable tfoot th {
			padding: 4px;
		}
	</style>
</head>
<body class="hold-transition" onload="consulta()">
	<!-- BEGIN TOP BAR -->
	<div class="pre-header">
		<div class="container">
			<div class="row">
				<!-- BEGIN TOP BAR LEFT PART -->
				<div class="col-md-6 col-sm-6 additional-shop-info">
					<ul class="list-unstyled list-inline">
						<li><i class=""></i><span>www.elgarzon.com</span></li>
						<li><i class="fa fa-facebook"></i><span>GarzonHipermercados</span></li>
						<li><i class="fa fa-twitter"></i><span>GarzonHiper</span></li>
						<li><i class="fa fa-instagram"></i><span>GarzonHiper</span></li>
						<!-- <li><i class="fa fa-youtube"></i><span>HiperGarzonTV1</span></li> -->
					</ul>
				</div>
				<!-- END TOP BAR LEFT PART -->
				<!-- BEGIN TOP BAR MENU -->
				<form action="" method="post">
				<div class="col-md-6 col-sm-6 additional-nav">
					<ul class="list-unstyled list-inline pull-right">
						<?php if(!$sesion): ?>
						<li class="<?= $pagina== 'login' ? 'active' : ''; ?> ">
						<a class="btn btn-sm btn-primary" href="?p=login" name="ingresar" style="color: #FFFFFF">INTRANET</a>
						</li>
						<?php else:?>
						 <button name="salir" id="salir"  type="submit" class="btn btn-sm btn-primary" >Salir</button>
						 
						<?php endif?>
						<!-- <li><a href="page-reg-page.html">Registration</a></li> -->
					</ul>
				</div>
				<!-- END TOP BAR MENU -->
				</form>
			</div>
		</div>            
			 
	</div>
	<!-- END TOP BAR -->
	<!-- BEGIN HEADER -->
	<div class="header">
		<div class="container">
		<a class="site-logo" href="index.php"><img width="100" src="img/logoGarzonGroup-amarillo.png" alt="Metronic FrontEnd"></a>


		<!-- BEGIN NAVIGATION -->
		<a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
		<div class="header-navigation pull-right font-transform-inherit">
			<ul>
				<!-- <?php var_dump($pagina); ?> -->


			<li>
			<?php if(!$sesion): ?>
			<li class="<?= $pagina == 'index' ? 'active' : ''; ?> ">
			<a  href="?p=index" >Home</a>
			</li>
			<?php else:?>
			<li class="<?= $pagina == 'home' ? 'active' : ''; ?> ">
			<a  href="?p=home"><strong> Intranet </strong></a>
			</li>
			<?php endif?>
			</li>

			<?php if($sesion):?>
			<li class="<?= $pagina == 'index' ? 'active' : ''; ?> ">
			<a  href="?p=index">Home</a>
			</li>
			<?php endif ?>

			<li class="<?= $pagina == 'page-faq' ? 'active' : ''; ?> ">
			<a href="?p=page-faq">Extensiones</a>
			</li>

			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
				Paginas
				</a>                
				<ul class="dropdown-menu">
				<li><a href="?p=portfolio-4">Sucursales</a></li>
				<li><a href="?p=page-about">Nosotros</a></li>
				<li><a href="?p=corporativo">Coorporativo</a></li>           
				</ul>
			</li>

			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
				Descargas 
				</a>
				
				<ul class="dropdown-menu">
				<li><a href="files/viaticos.pdf" target="_blank">Viáticos</a></li>              
				</ul>
			</li>
			<!-- END TOP SEARCH -->
			</ul>
		</div>
		<!-- END NAVIGATION -->
		</div>
	</div>
	<!-- Header END -->
	<!-- Navbar -->
	<div class="row border-bottom bg-dark elevation-2 p-0 m-0">
		<img src="dist/img/logo-ppal.png" class="pl-1 pr-1 pb-0 pt-0 bg-transparent d-flex align-items-center col-md-1 col-sm-12" width="100px;">
		<h2 id="titulo" class="d-flex align-items-center col-md-11 col-sm-12">
			Información del Personal Subcontratado
		</h2>
	</div>
	<!-- /.navbar -->

	<!-- Content Wrapper. Contains page content -->
	<div class="content">
		<!-- Main content -->
		<section id="contenido" class="content">

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content -->

	<!-- Modal -->
	<div class="modal fade" id="ModalDatos" tabindex="-1" role="dialog" aria-labelledby="ModalDatosLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary pb-1 pt-1 pr-1">
					<h5 class="modal-title">Personal Outsourcing</h5>
					<button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger btn-lg float-right">
						<span class="fas fa-window-close float-right" aria-hidden="true"></span>
					</button>
				</div>
				<div class="modal-body">
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery -->
	<script src="plugins/jquery/jquery.js"></script>
	<!-- jQuery UI -->
	<script src="plugins/jQueryUI/jquery-ui.js"></script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- DataTables -->
	<script src="plugins/datatables/jquery.dataTables.js"></script>
	<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
	<!-- Datepicker bootstrap -->
	<script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.es.min.js"></script>
	<!-- InputMask -->
	<script src="plugins/input-mask/jquery.inputmask.js"></script>
	<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<!-- FastClick -->
	<script src="plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.js"></script>
	<!-- JS propias app -->
	<script src="app/js/app.js"></script>
</body>
</html>
