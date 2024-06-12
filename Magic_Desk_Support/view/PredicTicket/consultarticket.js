/*
// Para el botón de Predecir
$('form[id="pre"]').submit(function(event) {
    event.preventDefault(); // Prevenir el envío del formulario por defecto
    
    // Deshabilitar el botón y mostrar el spinner
    $('#predecir').prop("disabled",true);
    $('#predecir').html('<i class="fa fa-spinner fa-spin"></i> Espere..');

    // Envía el formulario
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(data) {
            // Procesa la respuesta aquí
            // Por ejemplo, si la predicción fue exitosa, muestra un mensaje
            swal("Correcto!", "Predicción realizada correctamente", "success");
        },
        error: function() {
            // Maneja los errores si es necesario
        },
        complete: function() {
            // Habilitar el botón y restaurar el texto
            $('#predecir').prop("disabled",false);
            $('#predecir').html('Predecir');
        }
    });
});

// Para el botón de Reset Model
$('form[id=rest]').submit(function(event) {
    event.preventDefault(); // Prevenir el envío del formulario por defecto
    
    // Deshabilitar el botón y mostrar el spinner
    $('#reset').prop("disabled",true);
    $('#reset').html('<i class="fa fa-spinner fa-spin"></i> Espere..');

    // Envía la solicitud para restablecer el modelo
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(data) {
            // Procesa la respuesta aquí
            // Por ejemplo, si el modelo se reinició correctamente, muestra un mensaje
            swal("Correcto!", "Modelo reiniciado correctamente", "success");
        },
        error: function() {
            // Maneja los errores si es necesario
        },
        complete: function() {
            // Habilitar el botón y restaurar el texto
            $('#reset').prop("disabled",false);
            $('#reset').html('Reset Model');
        }
    });
});
*/