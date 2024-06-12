<!-- * Index para no mostrar archivos de la carpeta controller -->
<?php
    /* * Cadena de Conexion */
    require_once("../config/conexion.php"); 
    /* * Ruta Login */
    header("Location:".Conectar::ruta()."index.php");
?>