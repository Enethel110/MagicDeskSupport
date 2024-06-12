<!-- * Index para no mostrar archivos de la carpeta models -->
<?php
    /* * Cadena de Conexion */
    require_once("../config/conexion.php"); 
    /* * Ruta Login */
    header("Location:".Conectar::ruta()."index.php");
?>