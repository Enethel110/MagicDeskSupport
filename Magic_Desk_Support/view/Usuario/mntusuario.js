var tabla;

function init(){
    $("#usuario_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

/* * Guardar datos de los input */
function guardaryeditar(e){
    e.preventDefault();
	var formData = new FormData($("#usuario_form")[0]);
    $.ajax({
        url: "../../controller/usuario.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){    
            console.log(datos);
            if(datos == "1"){
                $('#usuario_form')[0].reset();
                /* *Ocultar Modal */
                $("#modalmantenimiento").modal('hide');
                $('#usuario_data').DataTable().ajax.reload();

                /* *Mensaje de Confirmacion */
                swal({
                    title: "",
                    text: "Registrado Correctamente.",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            }else if(datos == "2"){
                $('#usuario_form')[0].reset();
                /* *Ocultar Modal */
                $("#modalmantenimiento").modal('hide');
                $('#usuario_data').DataTable().ajax.reload();

                /* *Mensaje de Confirmacion */
                swal({
                    title: "",
                    text: "Actualizado Correctamente.",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            }else if(datos=="0"){
                $("#usu_correo").addClass("form-control-error");
                $("<small class='text-muted text-danger'>El Registro ya existe</small>").insertAfter("#usu_correo");
            }
        }
    }); 
}

$(document).ready(function(){

    $('#rol_id').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    tabla=$('#usuario_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'lBfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
      buttons: [		    
            {
                extend: 'excelHtml5',
                text: 'Exportar a Excel', // Cambiar el texto del botón si lo deseas
                className: 'btn  btn-inline btn-secundary', // Cambiar la clase CSS del botón si lo deseas
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
        "ajax":{
            url: '../../controller/usuario.php?op=listar',
            type : "post",
            dataType : "json",						
            error: function(e){
                console.log(e.responseText);	
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    }).DataTable();
});

/* * Mostrar informacion segun ID en los inputs */
function editar(usu_id){
    $('#mdltitulo').html('Editar Registro');

    $("#usu_correo").removeClass("form-control-error");
    $("#usu_correo + small").remove();

    /* * Mostrar Informacion en los inputs */
    $.post("../../controller/usuario.php?op=mostrar", {usu_id : usu_id}, function (data) {
        console.log(data);
        data = JSON.parse(data);
        $('#usu_id').val(data.usu_id);
        $('#usu_nom').val(data.usu_nom);
        $('#usu_ape').val(data.usu_ape);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_pass').val(data.usu_pass);
        $('#rol_id').val(data.rol_id).trigger('change');
        $('#usu_telf').val(data.usu_telf);
    }); 

    /* * Mostrar Modal */
    $('#modalmantenimiento').modal('show');
}

/* * Cambiar estado a eliminado en caso de confirmar mensaje */
function eliminar(usu_id){
    swal({
        title: "",
        text: "Esta seguro de eliminar el registro?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/usuario.php?op=eliminar", {usu_id : usu_id}, function (data) {

            }); 

            $('#usuario_data').DataTable().ajax.reload();	

            swal({
                title: "",
                text: "Registro Eliminado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

/* * Limpiar Inputs */
$(document).on("click","#btnnuevo", function(){
    $('#usu_id').val('');
    $('#mdltitulo').html('Nuevo Registro');
    $('#usuario_form')[0].reset();

    $("#usu_correo").removeClass("form-control-error");
    $("#usu_correo + small").remove();

    /* *Mostrar Modal */
    $('#modalmantenimiento').modal('show');
});

init();