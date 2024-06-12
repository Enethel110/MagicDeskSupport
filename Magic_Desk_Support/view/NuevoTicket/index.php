<?php
  require_once("../../config/conexion.php"); 
  if(isset($_SESSION["usu_id"])){ 
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
	<title>Magic Desk Support - Nuevo Ticket</title>
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
                		<h3><strong>Nuevo Ticket</strong></h3>
            		</div>
        		</div>
    		</div>
		</header>


			<div class="box-typical box-typical-padding" style="border: .1px solid black;">
				
				<div class="row">
					<form method="post" id="ticket_form">

						<input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">

						<div class="col-lg-12">
							<fieldset class="form-group">
							    <label class="form-label semibold" for="tick_titulo">Título <span style="color: red;">(*)</span></label>
								<input type="text" class="form-control" id="tick_titulo" name="tick_titulo" placeholder="Titulo" required>
							</fieldset>
						</div>

						<div class="col-lg-6">
							<fieldset class="form-group">
							    <label class="form-label semibold" for="exampleInput">Categoría <span style="color: red;">(*)</span></label>
								<select id="cat_id" name="cat_id" class="form-control select2" required>
									<option value="">Seleccionar</option>
								</select>
							</fieldset>
						</div>

						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="exampleInput">Sub Categoria <span style="color: red;">(*)</span></label>
								<select id="cats_id" name="cats_id" class="form-control select2" required>
									<option value="">Seleccionar</option>
								</select>
							</fieldset>
						</div>

						<div class="col-lg-6">
							<fieldset class="form-group">
							    <label class="form-label semibold" for="exampleInput">Prioridad <span style="color: red;">(*)</span></label>
								<select id="prio_id" name="prio_id" class="form-control select2" required>
									<option value="">Seleccionar</option>
								</select>
							</fieldset>
						</div>

						<div class="col-lg-6">
							<fieldset class="form-group">
								<label name="fileElem" id="fileElem" for="exampleInput"></label>
							</fieldset>
						</div>

						<div class="col-lg-12">
						<label class="form-label semibold" for="tick_descrip">Descripción <span style="color: red;">(*)</span></label>
						</div>

						<div class="col-lg-12">
							<fieldset class="form-group" style="border: 1px solid black;">
								
								<div class="summernote-theme-1">
									<textarea id="tick_descrip" name="tick_descrip" class="summernote" name="name" required></textarea>
								</div>
							</fieldset>
						</div>
						

						<div class="col-lg-12" style="text-align: center;  ">
							<button type="submit" id="btnguardar" name="action" value="add" class="btn btn-rounded btn-inline btn-primary">
								Guardar
							</button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
	<!-- Contenido -->

	<?php require_once("../MainJs/js.php");?>

	<script type="text/javascript" src="nuevoticket.js"></script>

	<script type="text/javascript" src="../notificacion.js"></script>

</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>