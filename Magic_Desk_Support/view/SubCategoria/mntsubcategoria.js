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
        url: "../../controller/subcategoria.php?op=guardaryeditar",
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
                $("#cats_nom").addClass("form-control-error");
                $("<small class='text-muted text-danger'>El Registro ya existe</small>").insertAfter("#cats_nom");
            }
        }
    }); 
}

$(document).ready(function(){

    $.post("../../controller/categoria.php?op=combo",function(data, status){
        $('#cat_id').html(data);
    });

    tabla=$('#usuario_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        
        "searching": true,
        lengthChange: false,
        colReorder: true,
        
        "ajax":{
            url: '../../controller/subcategoria.php?op=listar',
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
function editar(cats_id){
    $('#mdltitulo').html('Editar Registro');

    $("#cats_nom").removeClass("form-control-error");
    $("#cats_nom + small").remove();

    /* * Mostrar Informacion en los inputs */
    $.post("../../controller/subcategoria.php?op=mostrar", {cats_id : cats_id}, function (data) {
        data = JSON.parse(data);
        $('#cats_id').val(data.cats_id);
        $('#cat_id').val(data.cat_id).trigger('change');
        $('#cats_nom').val(data.cats_nom);
    });

    /* * Mostrar Modal */
    $('#modalmantenimiento').modal('show');
}

/* * Cambiar estado a eliminado en caso de confirmar mensaje */
function eliminar(cats_id){
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
            $.post("../../controller/subcategoria.php?op=eliminar", {cats_id : cats_id}, function (data) {

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
    $('#cats_id').val('');
    $('#cat_id').val('').trigger('change');
    $('#mdltitulo').html('Nuevo Registro');
    $('#usuario_form')[0].reset();

    $("#cats_nom").removeClass("form-control-error");
    $("#cats_nom + small").remove();

    /* *Mostrar Modal */
    $('#modalmantenimiento').modal('show');
});

init();