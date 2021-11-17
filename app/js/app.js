/**
 * outsourcing.js
 * funciones especificas y generales
 */

/**
 * Funcion principal que se ejecuta al cargar la pagina
 */
$( function() {
	// Resolve conflict in jQuery UI tooltip with Bootstrap tooltip
	$.widget.bridge('uibutton', $.ui.button)

	// configuracion de opciones para los datatables
	$.extend( true, $.fn.dataTable.defaults, {
		dom: '<"row"<"col-md-4 col-sm-12"i><"col-md-4 col-sm-12 d-flex align-items-center justify-content-center"p><"col-md-4 col-sm-12"f>>t',
		language: {
			emptyTable        : "No hay información para mostrar",
			info              : "Mostrando _START_ de _END_ de _TOTAL_",
			infoEmpty         : "No hay información para mostrar",
			infoFiltered      : "(filtrado de _MAX_ entradas totales)",
			search            : "Buscar",
			infoPostFix       : "",
			lengthMenu        : "Mostrar _MENU_ líneas",
			loadingRecords    : "Cargando...",
			zeroRecords       : "No se encontraron registros",
			paginate: {
				first         : "Primero",
				last          : "Último",
				next          : "Siguiente",
				previous      : "Anterior"
			},
			aria: {
				sortAscending : ": activar orden ascendente de la columna",
				sortDescending: ": activar orden descendente de la columna"
			}
		}
	});
});

/**
 * define la funcion de inicio de la pagina,
 * se carga el contenido de consulta.php
 * a la seccion contenido de la pagina prncipal
 */
function consulta() {
	$('#contenido').load('app/consulta.php?time='+Date.now());
}

/**
 * funcion que permite llenar la tabla princial con los datos del personal
 */
function listarpersonal() {
	// Agrega el botón editar en cada registro de la tabla de personal
	var opciones = 
		'<button type="button" class="btn btn-primary dt-edit">' +
			'<span class="fas fa-pencil-alt float-right" aria-hidden="true"></span>' +
		'</button>';

	// Se define la data que contendra la tabla de personal
	$('#listarpersonal').dataTable({
		ajax: {
			url: "app/DBProcs.php", // archivo que consulta los datos en la BBDD
			data: {opcion: "listarpersonal"}, // parametro para archivo de consulta de la BBDD
			type: 'post',
			dataType: "json",
		},
		columns: [
			{data: "id", orderable: false, visible: false, searchable: false},
			{data: "cedula", sClass: "align-middle"},
			{data: "nombre", sClass: "align-middle"},
			{data: "empresa", sClass: "align-middle"},
			{data: "fingreso", sClass: "text-center align-middle" },
			{data: "fegreso", sClass: "text-center align-middle" },
			{data: "observacion", sClass: "align-middle"},
			{data: null, sClass: "text-center align-middle m-0 p-0", defaultContent: opciones, orderable: false},
		],
		initComplete:function( settings, json ){ // Al completarse la carga de los datos en la tabla de personal
			// Mostrar boton agregar en la cabecera
			$('#regnvo').removeClass('d-none');
		}
	});

	// Boton de agregar personal
	$('.dt-add').each(function () {
		$(this).on('click', function(evt) {
			$('div.modal-body').load('app/registrar.php?tipo_accion=1&time='+Date.now(), function(){
				$('.gfechas').datepicker({
					format: "dd-mm-yyyy",
					todayBtn: "linked",
					language: "es",
					autoclose: true,
					todayHighlight: true
				});
				$('[data-mask]').inputmask();
				$('#frmregistrar').keypress(function(e){
					if(e.keyCode == 13) {
						return false;
					}
				});
			});
			$('#ModalDatos').modal('show');
			setTimeout('$("[name=\'cedula\']").focus()', 1000);
		});
	});

	// Boton de editar personal de la fila
	$('#listarpersonal tbody').on('click', '.dt-edit', function(evt){
		var dtRow = $('#listarpersonal').DataTable().row($(this).parents('tr')).data();
		$('div.modal-body').load('app/registrar.php?tipo_accion=2&time='+Date.now(), function(){
			$('.gfechas').datepicker({
				format: "dd-mm-yyyy",
				todayBtn: "linked",
				language: "es",
				autoclose: true,
				todayHighlight: true
			});
			$('[data-mask]').inputmask();
			$('#frmregistrar').keypress(function(e){
				if(e.keyCode == 13) {
					return false;
				}
			});
			$("[name=\'id\']").val(dtRow['id']);
			if(dtRow['cedula'].substring(0, 1)=='V') {
				$("#letrav").prop('checked', true);
				$("#letrae").prop('checked', false);
			} else {
				$("#letrav").prop('checked', false);
				$("#letrae").prop('checked', true);
			}
			$("[name=\'cedula\']").val(dtRow['cedula'].substring(1));
			$("[name=\'nombreapellido\']").val(dtRow['nombre']);
			$("[name=\'nombreempresa\']").val(dtRow['empresa']);
			$("#fingreso").datepicker('update', dtRow['fingreso'].replace(/(\d{2})\-(\d{2})\-(\d{4})/,'$2-$1-$3'));
			$("#fingreso").val(dtRow['fingreso'])
			if(dtRow['fegreso']!=null) {
				$("#continua1").prop('checked', false);
				$("#continua2").prop('checked', true);
				$("[name=\'fegreso\']").val(dtRow['fegreso']);
				$("#divfegreso").removeClass('d-none');
			} else {
				$("#continua1").prop('checked', true);
				$("#continua2").prop('checked', false);
				$("[name=\'fegreso\']").val('');
				$("#divfegreso").addClass('d-none');
			}
			$("[name=\'observaciones\']").val(dtRow['observacion']);

			var OldValue;
			$("form :input").on('focus', function () {
				var field= ($(this).attr('name'));
				OldValue= ($(this).val());
			})
		});
		$('#ModalDatos').modal('show');
		setTimeout('$("[name=\'cedula\']").focus()', 1000);
	});
}

/**
 * funcion que permite guardar los datos registrados del personal en la BBDD
 * @param  {int} tipo_accion 1 = nuevo -- 2 = edit
 * @param  {int} id          si tipo_accion = 2 id del registro que se quiere editar
  */
function guardar_personal(tipo_accion, id) {
	var opcion = 'opcion=guardar_personal&tipo_accion=' + tipo_accion + '&id=' + id + '&';
	$.ajax({
		type: "POST",
		url: "app/DBProcs.php",
		data: opcion + $("#frmregistrar").serialize(),
		success: function(data) {
			if(data.indexOf("SQLSTATE[23000]")>0) {
				alert('Información ya existe\n\nPor favor verifique los datos del formulario...')
			} else {
				$('#ModalDatos').modal('hide');
				$('#listarpersonal').DataTable().ajax.reload(null, false);
			}
		}
	});
}

/**
 * Funciones generales
 */

/**
 * funcion solonumeros para limitar los inpuntbox a permitir solo numeros
 */
function soloNumeros(evt) {
	var e = evt || window.event;
	var key = e.keyCode || e.which;
	if(e.char=="'" || e.key=="'" ||
		e.char=="#" || e.key=="#" ||
		e.char=="$" || e.key=="$" ||
		e.char=="%" || e.key=="%" ||
		e.char=="&" || e.key=="&" ||
		e.char=="(" || e.key=="(" ||
		e.char=="." || e.key=="." ||
		e.char=="," || e.key=="," ||
		e.char==">" || e.key==">" ||
		e.char==">" || e.key==">" ||
		e.char==":" || e.key==":")
		key = 0
	if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
	// numbers   
	key >=  48 && key <= 57  ||
	// numbers pad
	key >=  96 && key <= 105 ||
	// Home and End
	key == 110 || key == 190 ||
	key ==  35 || key == 36  ||
	// Backspace and Tab and Enter
	key ==  8  || key == 9   || key == 13 ||
	// left and right arrows
	key ==  37 || key == 39  ||
	// up and down arrows
	key ==  38 || key == 40  ||
	// Del and Ins
	key ==  46 || key == 116) {
		// input is VALID
	} else {
		// input is INVALID
		e.returnValue = false;
		if (e.preventDefault) e.preventDefault();
	}
};