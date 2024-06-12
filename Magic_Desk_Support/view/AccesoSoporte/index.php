<?php
    require_once("../../config/conexion.php");
    if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
        require_once("../../models/Usuario.php");
        $usuario = new Usuario();
        $usuario->login();
    }
?>
<!DOCTYPE html>
<html>
<head lang="es">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" href="../../public/img/icono.ico" type="image/x-icon">
	<title>Magic Desk Support - Acceso Soporte</title>

    <link rel="stylesheet" href="../../public/css/lib/bootstrap-sweetalert/sweetalert.css">
    <link rel="stylesheet" href="../../public/css/separate/vendor/sweet-alert-animations.min.css">

    <link rel="stylesheet" href="../../public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="../../public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/main.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('../../public/img/IT.jpg')no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            opacity: 0.8; /* Ajusta la opacidad de la imagen de fondo según sea necesario */
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.5); /* Ajusta la opacidad del contenedor del formulario */
            padding: 20px;
            margin-top: 0px; /* Ajusta según sea necesario */
            border-radius: 0px;
        }
    </style>
</head>
<body >
    <div class="login-container">
    <div class="page-center" >
        <div class="page-center-in">
            <div class="container-fluid">

                <form class="sign-box" action="" method="post" id="login_form">

                    <input type="hidden" id="rol_id" name="rol_id" value="2">

                    <div class="sign-avatar">
                        <img src="../../public/img/2.jpg" alt="" id="imgtipo">
                    </div>
                    <header class="sign-title">Soporte</header>

                    <!-- * validar segun valor al iniciar session -->
                    <?php
                        if (isset($_GET["m"])){
                            switch($_GET["m"]){
                                case "1";
                                    ?>
                                        <div class="alert alert-warning alert-icon alert-close alert-dismissible fade in" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <i class="font-icon font-icon-warning"></i>
                                            Usuario y/o Contraseña son incorrectos.
                                        </div>
                                    <?php
                                break;

                                case "2";
                                    ?>
                                        <div class="alert alert-warning alert-icon alert-close alert-dismissible fade in" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <i class="font-icon font-icon-warning"></i>
                                            Campos estan vacios.
                                        </div>
                                    <?php
                                break;
                            }
                        }
                    ?>

                    <div class="form-group">
                        <input type="text" id="usu_correo" name="usu_correo" class="form-control" placeholder="Correo Electronico"/>
                    </div>
                    <div class="form-group">
                        <input type="password" id="usu_pass" name="usu_pass" class="form-control" placeholder="Contraseña"/>
                    </div>
                    <div class="form-group">
                        <div class="float-right reset">
                            <a href="../../view/ResetPassword/">Olvidaste tu contraseña</a>
                        </div>
                        <div class="float-left reset">
                            <a href="../../index.php">Usuario</a>
                        </div>
                    </div>
                    <div class="form-group" style="display: flex; justify-content: center; align-items: center;">
                        <!--* Botón "Iniciar sesión con Google" con atributos de datos HTML para la API -->
                        <div id="g_id_onload"
                            data-client_id="592225408682-0k7df94bqpucikiovudb27idooij9slm.apps.googleusercontent.com"
                            data-context="signin"
                            data-ux_mode="popup"
                            data-callback="handleCredentialResponse"
                            data-auto_prompt="false"
                        >
                        </div>

                        
                    </div>
                    <input type="hidden" name="enviar" class="form-control" value="si">
                    <button type="submit" style="margin-top: 20px;" class="btn btn-rounded">Acceder</button>
                </form>
            </div>
        </div>
    </div>
    </div>        
<script src="../../public/js/lib/jquery/jquery.min.js"></script>
<script src="../../public/js/lib/tether/tether.min.js"></script>
<script src="../../public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="../../public/js/plugins.js"></script>
<!-- * Liberia SweetAlert -->
<script src="../../public/js/lib/bootstrap-sweetalert/sweetalert.min.js"></script>
<script src="../../public/js/lib/match-height/jquery.matchHeight.min.js" type="text/javascript" ></script>
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
<script src="https://accounts.google.com/gsi/client" async></script>
<script type="text/javascript" src="accesosoporte.js"></script>

</body>
</html>