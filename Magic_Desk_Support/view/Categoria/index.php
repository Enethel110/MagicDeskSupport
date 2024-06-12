<?php
  require_once("../../config/conexion.php"); 
  if(isset($_SESSION["usu_id"])){ 
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
	<title>Magic Desk Support - Categoria</title>
</head>
<body class="with-side-menu" style="background-color: white;">

    <?php require_once("../MainHeader/header.php");?>

    <div class="mobile-menu-left-overlay"></div>
    
    <?php require_once("../MainNav/nav.php");?>

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">
		<header style="text-align: center;">
    		<div class="tbl">
        		<div class="tbl-row">
            		<div class="tbl-cell">
                		<h3><strong>Categoría</strong></h3>
            		</div>
        		</div>
    		</div>
		</header>

			<div class="box-typical box-typical-padding" style="border: .1px solid black;">
				<button type="button" id="btnnuevo" class="btn btn-inline btn-success">Nuevo</button>
				<table id="usuario_data" class="table table-bordered table-striped table-vcenter js-dataTable-full" style="border: .1px solid black;">
					<thead>
						<tr>
							<th style="width: 10%;">Nombre</th>
							<th class="text-center" style="width: 5%;">Editar</th>
							<th class="text-center" style="width: 5%;">Eliminar</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>

		</div>
	</div>
	<!-- Contenido -->

	<?php require_once("modalmantenimiento.php");?>

	<?php require_once("../MainJs/js.php");?>
	
	<script type="text/javascript" src="mntcategoria.js"></script>

	<script type="text/javascript" src="../notificacion.js"></script>

</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>