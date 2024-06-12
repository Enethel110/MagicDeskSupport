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
        url: "../../controller/categoria.php?op=guardaryeditar",
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
                $("#cat_nom").addClass("form-control-error");
                $("<small class='text-muted text-danger'>El Registro ya existe</small>").insertAfter("#cat_nom");
            }
        }
    });
}

$(document).ready(function(){
    /* * Mostrar listado de registros */
    tabla=$('#usuario_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        
        "searching": true,
        lengthChange: false,
        colReorder: true,
       
        "ajax":{
            url: '../../controller/categoria.php?op=listar',
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
            "sInfo":           "_TOTAL_ registros",
            "sInfoEmpty":      "0 registros",
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
function editar(cat_id){
    $('#mdltitulo').html('Editar Registro');

    $("#cat_nom").removeClass("form-control-error");
    $("#cat_nom + small").remove();

    /* * Mostrar Informacion en los inputs */
    $.post("../../controller/categoria.php?op=mostrar", {cat_id : cat_id}, function (data) {
        data = JSON.parse(data);
        $('#cat_id').val(data.cat_id);
        $('#cat_nom').val(data.cat_nom);
    }); 

    /* * Mostrar Modal */
    $('#modalmantenimiento').modal('show');
}

/* * Cambiar estado a eliminado en caso de confirmar mensaje */
function eliminar(cat_id){
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
            $.post("../../controller/categoria.php?op=eliminar", {cat_id : cat_id}, function (data) {

            }); 

            /* * Recargar Datatable JS */
            $('#usuario_data').DataTable().ajax.reload();	

            /* * Mensaje de Confirmacion */
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
    $('#cat_id').val('');
    $('#mdltitulo').html('Nuevo Registro');
    $('#usuario_form')[0].reset();
    /* *Mostrar Modal */

    $("#cat_nom").removeClass("form-control-error");
    $("#cat_nom + small").remove();

    $('#modalmantenimiento').modal('show');
});

init();