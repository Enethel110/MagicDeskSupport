<header class="site-header">
    <div class="container-fluid">

        <a href="#" class="site-logo">
        <h7 style="background: white; font-family: Robot;  font-size: 17px; color: black; text-align: center; font-weight: bold; padding: 5px;">Magic Desk Support &nbsp;</h7>
        </a>

        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
          <span>toggle menu</span>
        </button>

        <button class="hamburger hamburger--htla">
            <span>toggle menu</span>
        </button>

        <div class="site-header-content">
            <div class="site-header-content-in">
                <div class="site-header-shown">
                    
                    <div class="dropdown dropdown-notification notif">
                        <?php if ($_SESSION["rol_id"] == 1): ?>
                        <!-- No mostrar el icono de la alarma -->
                        <?php else: ?>
                        <a href="../Notificacions/" class="header-alarm">
                            <i class="font-icon-alarm" style="color: #8B4513"></i>
                        </a>
                         <?php endif; ?>
                    </div>

                    <div class="dropdown user-menu">
    <img src="../../public/img/<?php echo $_SESSION["rol_id"] ?>.jpg" alt="" style="max-width: 25px; max-height: 25px;">
</div>


                </div>

                <div class="mobile-menu-right-overlay"></div>
                <input type="hidden" id="user_idx" value="<?php echo $_SESSION["usu_id"] ?>"><!-- ID del Usuario-->
                <input type="hidden" id="rol_idx" value="<?php echo $_SESSION["rol_id"] ?>"><!-- Rol del Usuario-->

               

            </div>
        </div>
    </div>
</header>