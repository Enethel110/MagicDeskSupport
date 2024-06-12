<!DOCTYPE html>
<html>
<head>
	<title>Encuesta - Encuesta Magic Desk Support</title>
<!--<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
-->
    <link rel="stylesheet" href="../../public/css/bootstrap.css">
    <link rel="stylesheet" href="../../public/css/star-rating.min.css">
    <link rel="stylesheet" href="../../public/css/lib/bootstrap-sweetalert/sweetalert.css">
    <link rel="stylesheet" href="../../public/css/separate/vendor/sweet-alert-animations.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('../../public/img/review.jpg')no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            opacity: 1; 
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.4); /* Ajusta la opacidad del contenedor del formulario */
            padding: 20px;
            margin-top: 0px; /* Ajusta según sea necesario */
            border-radius: 0px;
        }
   </style>

</head>

<body>

    <div class="container"  class="login-container">
        <section class="row">
            <div class="col-md-12">
                <h1 class="text-center">Encuesta de Satisfacción.</h1>
            </div>
        </section>
        <hr><br />
        <section class="row">
           
        </section>
        <section class="row">
            <section class="col-md-12">
                <section class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombreCompleto"># Ticket</label>
                            <input type="text" class="form-control" id="lblnomidticket" name="lblnomidticket" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombreCompleto">Fecha de Cierre</label>
                            <input type="text" class="form-control" id="lblfechcierre" name="lblfechcierre" readonly>
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombreCompleto">Título</label>
                            <input type="text" class="form-control" id="tick_titulo" name="tick_titulo" readonly>
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-md-4">
                        <label for="tipoAtencion">Categoría</label>
                        <input type="text" class="form-control" id="cat_nom" name="cat_nom" readonly>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaActual">Sub Categoría</label>
                            <input type="text" class="form-control" id="cats_nom" name="cats_nom" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaActual">Prioridad</label>
                            <input type="text" class="form-control" id="prio_nom" name="prio_nom" readonly>
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-md-4">
                        <label for="tipoAtencion">Usuario</label>
                        <input type="text" class="form-control" id="lblnomusuario" name="lblnomusuario" readonly>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaActual">Estado</label>
                            <input type="text" class="form-control" id="lblestado" name="lblestado" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaActual">Fecha Creación</label>
                            <input type="text" class="form-control" id="lblfechcrea" name="lblfechcrea" readonly>
                        </div>
                    </div>
                </section>

            </section>
        </section>
        <hr />

        <div id="panel1">

            <section class="row">
                <div class="col-md-12 text-center">
                    <input id="tick_estre" name="tick_estre" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="0">
                </div>
            </section>

            <section class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="comment">Comentarios:</label>
                        <textarea  style="border: .2px solid black;" id="tick_coment" name="tick_coment" class="form-control" rows="6" id="comentarios"></textarea>
                    </div>
                </div>
            </section>

            <section class="row" style="text-align: center;">
                <div class="col-md-12" style="padding-top: 10px; padding-bottom: 50px;">
                    <button type="button" class="btn btn-inline btn-info" id="btnguardar">Enviar</button>
                </div>
            </section>

        </div>
    </div>


<script src="../../public/js/jquery.js"></script>
<script src="../../public/js/star-rating.min.js"></script>

<script src="../../public/js/lib/bootstrap-sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="encuesta.js"></script>
<script>
    $('#tick_estre').rating({ 
        showCaption: false
    });
</script>
</body>
</html>