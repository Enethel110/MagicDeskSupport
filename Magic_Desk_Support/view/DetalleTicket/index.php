<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {

?>
  <!DOCTYPE html>
  
  <html>
  <?php require_once("../MainHead/head.php"); ?>
  <title>Magic Desk Support - Detalle Ticket</title>
  <link rel="stylesheet" href="../../public/styles.css">
  </head>

  <body class="with-side-menu"  style="background-color: white;">

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
                <h3 id="lblnomidticket">  </h3>
                <div id="tick_rank"></div>
                <span class="custom-label" style="font-family: Arial, sans-serif;" id="lblnomusuario"></span>
                <span class="custom-label " id="lblfechcrea"></span>
              </div>
            </div>
          </div>
        </header>

        <div class="box-typical box-typical-padding" style="border: .1px solid black;">
          <div class="row">

              <div class="col-lg-12">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="tick_titulo">Titulo</label>
                  <input type="text" class="form-control" id="tick_titulo" name="tick_titulo" readonly>
                </fieldset>
              </div>

              <div class="col-lg-4">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="cat_nom">Categoria</label>
                  <input type="text" class="form-control" id="cat_nom" name="cat_nom" readonly>
                </fieldset>
              </div>

              <div class="col-lg-4">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="cat_nom">SubCategoria</label>
                  <input type="text" class="form-control" id="cats_nom" name="cats_nom" readonly>
                </fieldset>
              </div>

              <div class="col-lg-4">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="cat_nom">Prioridad</label>
                  <input type="text" class="form-control" id="prio_nom" name="prio_nom" readonly>
                </fieldset>
              </div>

             


              <div class="col-lg-12">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="tickd_descripusu">Descripción</label>
                  <div class="summernote-theme-1">
                    <textarea id="tickd_descripusu" name="tickd_descripusu" class="summernote" name="name"></textarea>
                  </div>

                </fieldset>
              </div>

          </div>
        </div>

        <section class="activity-line" id="lbldetalle" style="border: .1px solid black;">

        </section>

        <div class="box-typical box-typical-padding" id="pnldetalle" style="border: .1px solid black;">
          <p>
            Ingrese su duda o consulta
          </p>
          <div class="row">
              <div class="col-lg-12">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="tickd_descrip">Descripción</label>
                  <div class="summernote-theme-1">
                    <textarea id="tickd_descrip" name="tickd_descrip" class="summernote" name="name"></textarea>
                  </div>
                </fieldset>
              </div>

              <!-- * Agregar archivos adjuntos -->
              <div class="col-lg-12">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="fileElem">Documentos Adicionales</label>
                  <input type="file" name="fileElem" id="fileElem" class="form-control" multiple>
                </fieldset>
              </div>

              <div class="col-lg-12" style="text-align: center;">
                <button type="button" id="btnenviar" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
                <button type="button" id="btncerrarticket" class="btn btn-rounded btn-inline btn-danger">Cerrar Ticket</button>
              </div>
          </div>
			  </div>

      </div>
    </div>
    <!-- Contenido -->

    <?php require_once("../MainJs/js.php"); ?>

    <script type="text/javascript" src="detalleticket.js"></script>

    <script type="text/javascript" src="../notificacion.js"></script>

  </body>

  </html>
<?php
} else {
  header("Location:" . Conectar::ruta() . "index.php");
}
?>