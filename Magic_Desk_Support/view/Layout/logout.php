<?php
    require_once("../../config/conexion.php");
    /* * Destruir Session */
    session_destroy();
    if($_SESSION["rol_id"] == 1){
        /* * Luego de cerrar session enviar a la pantalla de login */
        header("Location:".Conectar::ruta()."index.php");
    }elseif($_SESSION["rol_id"] == 2){
        header("Location:".Conectar::ruta()."view/AccesoSoporte/index.php");
    }

    exit();
?>