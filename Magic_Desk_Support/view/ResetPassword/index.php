<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Magic Desk Support - Recuperar Contraseña</title>

    <link rel="stylesheet" href="../../public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="../../public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/main.css">

    <link rel="stylesheet" href="../../public/css/lib/bootstrap-sweetalert/sweetalert.css">
    <link rel="stylesheet" href="../../public/css/separate/vendor/sweet-alert-animations.min.css">
    <style>
        .login-container {
            background-color: rgba(255, 255, 255, 0.0); /* Ajusta la opacidad del contenedor del formulario */
            padding: 20px;
            margin-top: 0px; /* Ajusta según sea necesario */
            border-radius: 0px;
        }

    </style>
</head>
<body>
    <div class="login-container">
    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                <form class="sign-box reset-password-box" style="text-align: center;">
                    <header class="sign-title">Recuperar Contraseña</header>
                    <div class="form-group" >
                        <input type="email" id="usu_correo" name="usu_correo" class="form-control" placeholder="e-mail"/>
                    </div>
                    <button type="button" id="btnenviar" class="btn btn-rounded">Enviar</button> o <a href="../../index.php">Regresar</a>
                </form>
            </div>
        </div>
    </div><!--.page-center-->
    </div>
<script src="../../public/js/lib/jquery/jquery.min.js"></script>
<script src="../../public/js/lib/tether/tether.min.js"></script>
<script src="../../public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="../../public/js/plugins.js"></script>
<script type="text/javascript" src="../../public/js/lib/match-height/jquery.matchHeight.min.js"></script>
<script src="../../public/js/lib/bootstrap-sweetalert/sweetalert.min.js"></script>
<script>
    $(function() {
        $('.page-center').matchHeight({
            target: $('html')
        });

        $(window).resize(function(){
            setTimeout(function(){
                $('.page-center').matchHeight({ remove: true });
                $('.page-center').matchHeight({
                    target: $('html')
                });
            },100);
        });
    });
</script>
<script src="../../public/js/app.js"></script>
<script type="text/javascript" src="resetpassword.js"></script>
</body>
</html>