<?php
// Obtener la fecha actual
$fecha_actual = date("Y-m-d");

// Definir los rangos para los comboboxes
$rango1_3 = range(1, 3);
$rango1_29 = range(1, 29);
$rango1_50 = range(1, 50);
$num_a_palabra = [
	1 => 'Aloha',
	2 => 'Asignación',
	3 => 'BI',
	4 => 'Cambio',
	5 => 'CARP',
	6 => 'Carpetas en Red',
	7 => 'Contpaq',
	8 => 'Delitech',
	9 => 'DVR',
	10 => 'Facturación',
	11 => 'Facturas',
	12 => 'GMAIL',
	13 => 'Infraestructura',
	14 => 'Instalación',
	15 => 'Mantenimiento',
	16 => 'MBP',
	17 => 'Plataformas', 
	18 => 'Programas Otros',
	19 => 'Protheus',
	20 => 'Respaldo',
	21 => 'Revisión',
	22 => 'Servidor GIRO',
	23 => 'Solicitud de equipo',
	24 => 'Soporte',
	25 => 'Spoonity',
	26 => 'WEB',
	27 => 'WEB Server',
	28 => 'Windows',
	29 => 'Zetus'
];

$num_a_palabra1 = [
	1 => 'Archivo-Inventario',
	2 => 'Artículos-Alta',
	3 => 'Artículos-Baja',
	4 => 'Articulos-Modificación',
	5 => 'Artículos-Nuevo',
	6 => 'ATO-Asignar Pedido',
	7 => 'ATO-Conexión B.D.',
	8 => 'ATO-Consecutivo Tickets',
	9 => 'ATO-Otros',
	10 => 'BD-No inica',
	11 => 'BI-caido',
	12 => 'Cambio de Hora-Factura',
	13 => 'Cambio de Hora-Factura',
	14 => 'Cancelación-Factura',
	15 => 'CFC-Acceso o Permiso',
	16 => 'CFC-Contraseña',
	17 => 'Correo-nuevo',
	18 => 'Correo-Saturado',
	19 => 'DRS-caído',
	20 => 'DRS-otros',
	21 => 'DVR-NAS',
	22 => 'Envio-Fallido',
	23 => 'Equipos-Impresora',
	24 => 'Equipos-Servidor',
	25 => 'Equipos-Terminal',
	26 => 'Impresora-Toner',
	27 => 'Inventario-Ajuste',
	28 => 'Inventario-Claves',
	29 => 'Migrar-Sucursal',
	30 => 'Nolo-Conexión',
	31 => 'Otro-Duda',
	32 => 'Otro-Soporte',
	33 => 'Pantalla-Trabada',
	34 => 'Portal-error',
	35 => 'Precios-Cambio',
	36 => 'Precio-incorrecto',
	37 => 'Promociones-Baja',
	38 => 'Promociones-Modificacón',
	39 => 'Tickets-Error',
	40 => 'Tickets-Soporte',
	41 => 'Transferencias',
	42 => 'Transferencias-Otros',
	43 => 'Usuario-Baja',
	44 => 'Usuario-Password',
	45 => 'Acces-Point',
	46 => 'Audio',
	47 => 'Antivirus',
	48 => 'Camara',
	49 => 'Claves-telefónicas',
	50 => 'Equipo-sucursal',
];


// Función para realizar solicitudes GET y manejar errores
function safe_get_contents($url)
{
	try {
		$response = @file_get_contents($url);
		if ($response === FALSE) {
			throw new Exception("Error al obtener contenido de la URL: $url");
		}
		return $response;
	} catch (Exception $e) {
		return null; // Retorna null en caso de error
	}
}

// Obtener el estado del modelo
$url_status_model = 'https://enethel100.pythonanywhere.com/statusModel';
$response_status = safe_get_contents($url_status_model);
$data_status = $response_status ? json_decode($response_status, true) : null;
$train = $data_status['trained'] ?? 'NO TRAINED';

// Obtener la predicción
$url_predic = 'https://enethel100.pythonanywhere.com/predic';
$response_predic = safe_get_contents($url_predic);
$data_predic = $response_predic ? json_decode($response_predic, true) : null;
$valorPre = $data_predic['valor'] ?? '--';
$dia = $data_predic['dia'] ?? '--';
$mes = $data_predic['mes'] ?? '--';
$año = $data_predic['año'] ?? '--';

// Obtener  tipoTicket
$url_TipTicket = 'https://enethel100.pythonanywhere.com/TipTicket';
$response_TipTicket = safe_get_contents($url_TipTicket);
$data_TipTicket = $response_TipTicket ? json_decode($response_TipTicket, true) : null;
$priority = $data_TipTicket['priori'] ?? '--';
$categoria = $data_TipTicket['categ'] ?? '--';
$subcategoria = $data_TipTicket['subcateg'] ?? '--';
?>
<?php
  require_once("../../config/conexion.php"); 
  if(isset($_SESSION["usu_id"])){ 
?>

	<!DOCTYPE html>
	<html>
	<?php require_once("../MainHead/head.php"); ?>
	<title>Magic Desk Support - Predecir Tickets</title>
	</head>

	<body class="with-side-menu" style="background-color: white;">

		<?php require_once("../MainHeader/header.php"); ?>

		<div class="mobile-menu-left-overlay"></div>

		<?php require_once("../MainNav/nav.php"); ?>

		<!-- Contenido -->
		<div class="page-content">
			<div class="container-fluid">

				<header class="section-header" style="text-align: center;">
					<div class="tbl">
						<div class="tbl-row">
							<div class="tbl-cell">
								<h3> <strong>Predecir Tickets  </strong></h3>
							</div>
						</div>
					</div>
				</header>
				

				<div class="box-typical box-typical-padding" style="border: .1px solid black;">
					<div class="container">

						<form class="row g-3" id="pre" action="https://enethel100.pythonanywhere.com/" method="post">

							<div class="col-lg-3">
								<label class="form-label  align-items-center" for="fecha">Fecha:</label>
								<input type="date" id="fecha" name="fecha" value="<?php echo $fecha_actual; ?>" class="form-control">
							</div>

							<div class="col-lg-3">
								<label class="form-label" for="prioridad">Prioridad:</label>
								<select class="select2" id="prioridad" name="prioridad">
									<?php foreach ($rango1_3 as $valor) { ?>
										<option value="<?php echo $valor; ?>">
											<?php echo $valor; ?>
										</option>
									<?php } ?>
								</select>
							</div>

							<div class="col-lg-3">
								<label class="form-label" for="categoria">Categoría:</label>
								<select class="select2" id="categoria" name="categoria">
									<?php foreach ($rango1_29 as $valor) { ?>
										<option value="<?php echo $valor; ?>">
											<?php echo $num_a_palabra[$valor]; ?>
										</option>
									<?php } ?>
								</select>
							</div>

							<div class="col-lg-3">
								<label class="form-label" for="subcategoria">Subcategoria:</label>
								<select class="select2" id="subcategoria" name="subcategoria">
									<?php foreach ($rango1_50 as $valor) { ?>
										<option value="<?php echo $valor; ?>">
											<?php echo $num_a_palabra1[$valor]; ?>
										</option>
									<?php } ?>
								</select>

								

							</div>

								<div class="col-lg-12" style="padding-top: 20px; text-align: center;">
									<button  id="predecir" class="btn btn-rounded btn-primary"> Predecir</button>
								</div>


						</form>

					</div>
				</div>


				<div class="box-typical box-typical-padding" style="border: .1px solid black;">
					<div class="container">
						<div class="row">

							<div class="col-lg-4">
								<p style="font-weight: bold;"> Tipo Ticket </p>
									<p><?php echo "Prioridad: $priority"; ?></p>
							</div>

							<div class="col-lg-4">
							<p style="padding-top: 35px;"><?php echo "Categoría: $categoria"; ?></p>
							</div>
							<div class="col-lg-4">
							<p style="padding-top: 35px;"><?php echo "Subcategoría: $subcategoria"; ?></p>
							</div>
						</div>
					</div>
				</div>

				<div class="box-typical box-typical-padding" style="border: .1px solid black;">
					<div class="container">
						<div class="row">
							<div class="col-lg-5">
								<p style="font-weight: bold;">Predicción</p>
								<?php echo "La predicción para <span style='color: black; font-weight: bold;'>$dia/$mes/$año</span> es de: <span style='color: black; font-weight: bold;'>$valorPre tickets</span>"; ?>

							</div>

							<div class="col-lg-3">
								<p style="font-weight: bold;"> Status Model </p>
								<p style="color: red;"><?php echo $train; ?></p>
							</div>

							<div class="col-lg-3" style="padding-top: 22px; text-align: center;">
								<form id="rest" action="https://enethel100.pythonanywhere.com/change_model_state" method="post">
									<button id="reset" class="btn btn-rounded btn-primary" name="reset_model"> Reset Model </button>
								</form>
							</div>



						</div>


					</div>
				</div>
			</div>
		</div>

		<!-- Contenido -->
    <?php require_once("modalasignar.php"); ?>

	<?php require_once("../MainJs/js.php");?>
	<script type="text/javascript" src="consultarticket.js"></script>
	<script type="text/javascript" src="mntsubcategoria.js"></script>
    
	<script type="text/javascript" src="../notificacion.js"></script>
	</body>

	</html>
<?php
} else {
	header("Location:" . Conectar::ruta() . "index.php");
}
?>
