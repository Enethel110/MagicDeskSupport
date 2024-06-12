<?php
    /* * Rol 1 es de Usuario */
    if ($_SESSION["rol_id"]==1){
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">

                <li class="blue-dirty">
                   <a href="../Home/">
                     <span class="font-icon" ></span>
                     <span style=" font-style: italic; font-weight: bold;"><?php echo $_SESSION["usu_nom"] ?> <?php echo $_SESSION["usu_ape"] ?></span>
                   </a>
                </li>

                <div class="dropdown-divider"></div>

                    <li class="blue-dirty">
                        <a href="..\Home\">
                            <span class="glyphicon glyphicon-home"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>

                    <div class="dropdown-divider"></div>

                    <li class="blue-dirty">
                        <a href="..\NuevoTicket\">
                            <span class="glyphicon glyphicon-plus"></span>
                            <span class="lbl">Nuevo Ticket</span>
                        </a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li class="blue-dirty">
                        <a href="..\ConsultarTicket\">
                            <span class="glyphicon glyphicon-search"></span>
                            <span class="lbl">Consultar Ticket</span>
                        </a>
                    </li>

                    <div class="dropdown-divider"></div>

                    <li class="gold with-sub">
                        <a href="../Perfil/">
                            <span class="font-icon font-icon-lock" ></span>
                            <span class="lbl">Cambiar contraseña</span>
                        </a>
                    </li>
                    
                    <div class="dropdown-divider"></div>
                    <a href="mailto:magicdeskteam@gmail.com"><span class="font-icon glyphicon glyphicon-question-sign"></span>Ayuda</a>


                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../Layout/logout.php"><span class="font-icon glyphicon glyphicon-log-out"></span>Cerrar Sesion</a>
                     
                    

                </ul>
            </nav>
        <?php
    }else{
        ?>
            <nav class="side-menu" >
                <ul class="side-menu-list">

                <li class="blue-dirty">
                <a href="../Home/">
                     <span class="font-icon" ></span>
                     <span style=" font-style: italic; font-weight: bold;"><?php echo $_SESSION["usu_nom"] ?> <?php echo $_SESSION["usu_ape"] ?></span>
                </a>
                </li>

                    <li class="blue-dirty">
                        <a href="..\Home\">
                            <span class="glyphicon glyphicon-home"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\NuevoTicket\">
                            <span class="glyphicon glyphicon-plus"></span>
                            <span class="lbl">Nuevo Ticket</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\ConsultarTicket\">
                            <span class="glyphicon glyphicon-search"></span>
                            <span class="lbl">Consultar Ticket</span>
                        </a>
                    </li>

                    <li class="brown whith-sub">
                        <a href="..\PredicTicket\">
                            <span class="font-icon font-icon-zigzag"></span>
                            <span class="lbl">Predicción Tickets</span>
                        </a>
                    </li>
                    

                    <li class="blue-dirty">
                        <a href="..\Prioridad\">
                            <span class="font-icon glyphicon glyphicon-tasks"></span>
                            <span class="lbl">Prioridad</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\Categoria\">
                            <span class="font-icon font-icon-notebook"></span>
                            <span class="lbl">Categoria</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\SubCategoria\">
                            <span class="glyphicon  glyphicon-folder-open"></span>
                            <span class="lbl"> Sub Categoria</span>
                        </a>
                    </li>
                    
                    <li class="blue-dirty">
                        <a href="..\Usuario\">
                            <span class="font-icon font-icon-user"></span>
                            <span class="lbl">Usuario</span>
                        </a>
                    </li>
                    
                    <li class="gold with-sub">
                        <a href="../Perfil/">
                            <span class="font-icon font-icon-lock"></span>
                            <span class="lbl">Cambiar contraseña</span>
                        </a>
                    </li>

                    <a href="mailto:magicdeskteam@gmail.com"><span class="font-icon glyphicon glyphicon-question-sign"></span>Ayuda</a>


                    <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../Layout/logout.php"><span class="font-icon glyphicon glyphicon-log-out"></span>Cerrar Sesion</a>
                        </div>
                    
                </ul>
            </nav>
        <?php
    }
?>
