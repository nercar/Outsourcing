<!-- Este contenido se agrega al section main de la página index.php -->
<!-- Main row -->
<div class="row mt-1">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<h5 class="card-title">Consulta de Personal Outsourcing</h5>
					</div>
					<div id="regnvo" class="col-md-6 col-sm-12 text-right d-none">Registrar Nuevo Personal
						<button type="button" data-func="dt-add" class="btn btn-success btn-xs dt-add">
							<span class="fas fa-plus float-right" aria-hidden="true"></span>
						</button>
					</div>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="listarpersonal" class="table table-striped table-hover table-bordered w-100">
					<thead class="bg-dark-gradient">
					<tr>
						<th width="0%" class="d-none">Id</th>
						<th width="10%">Cédula</th>
						<th width="20%">Nombre</th>
						<th width="20%">Empresa</th>
						<th width="10%">Ingreso</th>
						<th width="10%">Egreso</th>
						<th width="20%">Observación</th>
						<th width="10%">Opciones</th>
					</tr>
					</thead>
				</table>
			</div>
			<!-- ./card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row (main row) -->

<script>
	// Para llenar la tabla del inicio
	listarpersonal();
</script>