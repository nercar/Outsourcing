<!-- Este contenido se agrega al section main de la página index.php -->
<!-- Main row -->
<input id="id" type="hidden" name="id" value="0">
<div class="row">
	<div class="col-md-12 col-sm-12">
		<!-- form start -->
		<form id="frmregistrar" onsubmit="return false;" role="form" action="javascript:guardar_personal(<?php echo $parametro=$_GET['tipo_accion']; ?>, $('#id').val())">
			<div class="row">
				<div class="col-md-4 col-sm-12">
					<label>Cédula</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text pb-0">
								<label>
									<input id="letrav" type="radio" name="letra" value="1" required checked>&nbsp;V&nbsp;
								</label>
							</span>
							<span class="input-group-text pb-0">
								<label>
									<input id="letrae" type="radio" name="letra" value="2" required>&nbsp;E&nbsp;
								</label>
							</span>
						</div>
						<input required name="cedula" type="text" class="form-control" 
								placeholder="12.345.678" onkeydown="soloNumeros()">
					</div>
					<!-- /input-group -->
				</div>
				<div class="col-md-8 col-sm-12">
					<label>Nombres y Apellidos</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-id-card"></i></span>
						</div>
						<input required name="nombreapellido" type="text" class="form-control" placeholder="Ingrese el nombre completo del personal a registrar">
					</div>
					<!-- /input-group -->
				</div>
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<label>Empresa donde labora o laboró</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-industry"></i></span>
						</div>
						<input name="nombreempresa" type="text" class="form-control" placeholder="Ingrese el nombre completo de la empresa...">
					</div>
					<!-- /input-group -->
				</div>
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-md-4 col-sm-12">
					<label>Fecha de ingreso</label>
					<div class="input-group date gfechas">
						<input id="fingreso" name="fingreso" type="text" class="form-control" required 
								data-inputmask="'alias': 'dd-mm-yyyy'"
								data-mask placeholder="dd-mm-yyyy">
						<span class="input-group-addon btn alert-secondary rounded-0">
							<i class="fas fa-calendar"></i>
						</span>
					</div>
					<!-- /.input group -->
				</div>
				<div class="col-md-4 col-sm-12 text-center">
					<label>Continúa en la empresa</label>
					<div class="input-group justify-content-center">
						<div class="input-group-prepend">
							<span class="input-group-text pb-0">
								<label>
									<input id="continua1" type="radio" name="continua" value="1" checked onclick="javascript:$('#divfegreso').addClass('d-none')">&nbsp;Si&nbsp;
								</label>
							</span>
							<span class="input-group-text pb-0">
								<label>
									<input id="continua2" type="radio" name="continua" value="2" onclick="javascript:$('#divfegreso').removeClass('d-none')">&nbsp;No&nbsp;
								</label>
							</span>
						</div>
					</div>
					<!-- /input-group -->
				</div>
				<div id="divfegreso" class="col-md-4 col-sm-12 d-none">
					<label>Fecha de Egreso</label>
					<div class="input-group date gfechas">
						<input name="fegreso" type="text" class="form-control"
								data-inputmask="'alias': 'dd-mm-yyyy'"
								data-mask placeholder="dd-mm-yyyy">
						<span class="input-group-addon btn alert-secondary rounded-0">
							<i class="fas fa-calendar"></i>
						</span>
					</div>
					<!-- /.input group -->
				</div>
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<label>Observaciones, Notas o Comentarios</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text align-items-start"><i class="fas fa-info-circle"></i></span>
						</div>
						<textarea name="observaciones" class="form-control" rows="2" placeholder="Ingrese una observación de ser necesario..."></textarea>
					</div>
					<!-- /input-group -->
				</div>
			</div>
			<!-- /.row -->
			<div class="text-right pt-2 pb-0">
				<?php
					if($_GET['tipo_accion']==1) { ?>
						<button type="reset" class="btn btn-warning">Limpiar Datos</button>
					<?php }
				?>
				<button onclick="submit()" class="btn btn-success">Guardar Datos</button>
			</div>
			<!-- /.row -->
		</form>
	</div>
	<!-- /.col -->
</div>
<!-- /.row (main row) -->