<?php
  require_once("../../config/conexion.php"); 
  if(isset($_SESSION["usu_id"])){ 
?>
<!DOCTYPE html>
<html>

    <?php require_once("../MainHead/head.php");?>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<link rel="stylesheet" href="../../public/css/lib/fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet" href="../../public/css/separate/pages/calendar.min.css">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
     <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  
	<title>Magic Desk Support - Home</title>
</head>
<body class="with-side-menu" style="background-color: #0000;">

    <?php require_once("../MainHeader/header.php");?>

    <div class="mobile-menu-left-overlay"></div>

    <?php require_once("../MainNav/nav.php");?>

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">
			

		<div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      
        <div class="header-body">
          <div class="row">
            
		   <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body" style="border: .1px solid black;">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Tickets Totales</h5>
                      <span class="h2 font-weight-bold mb-0" id="lbltotal" >    </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>
            
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body" style="border: .1px solid black;">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Tickets Abiertos</h5>
                      <span class="h2 font-weight-bold mb-0" id="lbltotalabierto" >    </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>

			<div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body" style="border: .1px solid black;">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Tickets Cerrados</h5>
                      <span class="h2 font-weight-bold mb-0" id="lbltotalcerrado" >    </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>

          </div>
        
      </div>
    </div>
    <!-- Page content -->
  </div>

			<section class="" style="text-align: center; font-size: 20px; ">
				<header class="card-header" >
				Gráfico de Estadisticas
				</header>
				<div class="card-block" style="border: .1px solid black;">
					<div id="divgrafico" style="height: 250px;" ></div>
				</div>
			</section>

      <section class="card" style="text-align: center;"> <!-- Cambia el color de fondo aquí -->
    <header class="card-header" style="font-size: 18px;">
        Calendario
    </header>
    <div class="card-block" style="padding: 0; border: .1px solid black;">
        <div id="idcalendar" style="font-size: 12px;"></div>
    </div>
</section>



		</div>
	</div>
	<!-- Contenido -->

	<?php require_once("../MainJs/js.php");?>

	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

	<script type="text/javascript" src="../../public/js/lib/moment/moment-with-locales.min.js"></script>
	<script src="../../public/js/lib/fullcalendar/fullcalendar.min.js"></script>

	<script type="text/javascript" src="home.js"></script>

	<script type="text/javascript" src="../notificacion.js"></script>

</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>