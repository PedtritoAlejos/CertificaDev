<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        session_start();
        if ($_SESSION['tipo'] == 2) {
            
        } else {
            redirect("usuario_controller/login");
        }
        ?>
        <title>Buscador</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo base_url('Componentes/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url('Componentes/script/validaciones_script.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('Componentes/script/script.js') ?>" type="text/javascript"></script>    
        <script src="<?php echo base_url('Componentes/dist/sweetalert-dev.js') ?>"type="text/javascript" ></script>
        <link rel="stylesheet" href="<?php echo base_url('Componentes/dist/sweetalert.css') ?>" rel="stylesheet" type="text/css"/>

        <style>
            body{ padding-top:80px;}
        </style>
    </head>
    <body>
        <div class="container">
            <header>
                <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1">
                                <span class="sr-only">Menu</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>

                            </button>
                            <a href="#" class="navbar-brand">CertificaDev</a>
                        </div>
                        <div class="collapse navbar-collapse" id="navbar-1">
                            <ul class="nav navbar-nav">

                                <li ><?php echo anchor("usuario_controller/usuario_inicio", "<span class='glyphicon glyphicon-home'></span> Inicio"); ?> </li>
    <!--                            <li><a href=""> Solicitudes pendientes <span class="badge">15</span></a> </li>-->
                                <li> <?php echo anchor("usuario_controller/usuario_solicitudes", "<span class='glyphicon glyphicon-folder-open'></span> Solicitudes pendientes <span class='badge'>" . $total . "</span>"); ?> </li>
                                <li class="dropdown active">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                        <span class="glyphicon glyphicon-cog"></span> Opciones<span class="caret"></span>
                                    </a> 


                                    <ul class="dropdown-menu">
                                        <!--                                    <li><a href="#">Historial solicitudes</a></li>-->
                                        <li><?php echo anchor("usuario_controller/historial_solicitudes", "<span class='glyphicon glyphicon-list-alt'></span> Historial de solicitudes") ?></li>
                                        <!--                                    <li><a href="#">Buscar solicitudes</a></li>-->
                                        <li class="active"><?php echo anchor("usuario_controller/buscar_solicitudes", "<span class='glyphicon glyphicon-search'></span> Buscar solicitudes") ?></li>
                                        <li class="divider"></li>
                                        <li><a href="#"><span class='glyphicon glyphicon-user'></span> Tipo usuario <?php if (isset($_SESSION['rol'])) {
            echo $_SESSION['rol'];
        } ?></a></li>

                                    </ul>
                                </li>
                            </ul>
                            <?php
                            echo form_open("usuario_controller/salir", "class='navbar-form navbar-left' role='search'");
                            echo "<div class='form-group'>";
                            echo "<button type='submit' name='salir' class='btn btn-danger'><span class='glyphicon glyphicon-user'></span> Cerrar Sesión</button>";
                            echo "</div>";
                            echo form_close();
                            ?>


                        </div>
                    </div>
                </nav>
            </header>
            <div class="container">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Buscador de solicitudes
                            <small> busqueda por rut y fecha</small></h1>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                En esta sección se encuentra todas las solicitudes de certificación pendientes por parte de los postulantes.
                            </p>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Buscador por Run
                                </div>

                                <div class="panel-body">


                                    <?php
                                    echo form_open("usuario_controller/listar_por_run", "class='form-inline'");
                                    echo "  <div class='form-group'>";
                                    echo form_input("run", "", " class='form-control' onBlur='Valida_Rut(this)' maxlength='10' required placeholder='run completo : 11111111-k'");
                                    echo form_error('run');

                                    echo " </div>";


                                    echo "  <button class='btn btn-primary' type='submit' ><span class='glyphicon glyphicon-search'></span> Buscar</button>";
                                    if (isset($mensaje_busqueda)) {
                                        echo "<div class='row'>";
                                        echo "<div class='container'>";

                                        echo "<div class='form-group'>";
                                        echo "<br>";
                                        echo $mensaje_busqueda;
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                    echo form_close();
                                    ?>







                                    <!-- aqui va la tabla inicio-->      

                                    <!-- aqui va la tabla final-->              
                                </div>

                                <!-- aqui tiene que ir -->
                                <?php
                                if (isset($datos)) {
                                    ?>

                                    <div class="container col-md-12">
                                        <br><br>
                                        <?php
                                        if (isset($btn)) {
                                            echo $btn;
                                        }
                                        ?>
                                        <div class="table-responsive">
                                            <table class="table  table-bordered table-hover ">
                                                <tr class="success"> 
                                                    <th>Código solicitud</th>    
                                                    <th>Run</th>
                                                    <th>Nombre</th>
                                                    <th>Estado</th>
                                                    <th>Información</th>
                                                    <th>Modificar</th>
                                                    <th>Borrar</th>

                                                </tr>
                                                <?php
                                                if (isset($datos)) {
                                                    foreach ($datos->result() as $fila) {
                                                        echo "<tr>";
                                                        echo "<td>" . $fila->id_solicitud . "</td>";
                                                        echo "<td>" . $fila->run . "-" . $fila->dv_run . "</td>";
                                                        echo "<td>" . $fila->nombre . " " . $fila->apellido_p . " " . $fila->apellido_m . "</td>";
                                                        echo "<td>" . $fila->tipo_estado . "</td>";
                                                        echo "<td>";
                                                        echo form_open("usuario_controller/info_por_rut");

                                                        echo form_hidden("codigo", $fila->id_solicitud);
                                                        echo form_hidden("run", $fila->run);
                                                        if (isset($fecha_min)) {
                                                            echo form_hidden("f_min", $fecha_min);
                                                            echo form_hidden("f_max", $fecha_max);
                                                        }
                                                        echo "<button type='submit' id='#ventana1' class='btn btn-primary' data-toggle='modal'><span class='glyphicon glyphicon-envelope'></span> Consultar datos</button> ";
                                                        echo form_close();
                                                        echo "</td>";
                                                        echo "<td>";
                                                        echo form_open("usuario_controller/reenviar");
                                                        echo form_hidden("codigo", $fila->id_solicitud);
                                                        echo "<button  type='submit' class='btn btn-warning'><span class='glyphicon glyphicon-edit'></span> Editar</button> ";
                                                        echo form_close();
                                                        echo "</td>";
                                                        echo "<td>";
                                                        echo form_open("usuario_controller/eliminar");
                                                        echo form_hidden("codigo", $fila->id_solicitud);
                                                        echo " <a href='#ventana2' class='btn btn-danger' data-toggle='modal'><span class='glyphicon glyphicon-remove'></span> Eliminar</a>";
                                                        echo "      
                <div class='modal fade' id='ventana2'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            
                            <div class='modal-header'>
                                <button type='button' class='close'
                                        data-dismiss='modal' aria-hidden='true'>&times;</button>
                                <h4>¿ Estas seguro de eliminar esta solicitud ?</h4>
                            </div>
                            <div class='modal-body'>
                                Una vez eliminado esta solicitud no podra recuperarla , los datos se borraran permanentemente!.
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>";
                                                        echo form_submit("eliminar", "Si deseo eliminar", "class='btn btn-danger'");
                                                        /* <button type='submit' class='btn btn-danger' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Si deseo eliminar</button> */

                                                        echo "  </div>";
                                                        echo"  </div>";
                                                        echo "  </div>";
                                                        echo"  </div>";


                                                        echo form_close();
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                                ?>

                                            </table>
                                            <!-- panel inicio modal------->

                                            <?php
                                            if (isset($panel)) {
                                                echo $panel;
                                            }
                                            ?>
                                            <!--------------------panel modal    /**/-->
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>

                        </div>


                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Buscador por fecha
                                </div>
                                <div class="panel-body">


                                    <?php
                                    echo form_open("usuario_controller/buscar_por_fechas");
                                    echo "  <div class='form-group col-md-4'>";
                                    echo " <label  for='fecha_inicio'>Ingrese una fecha de inicio </label>";
                                    echo "<input class='form-control' required type='date' id='fecha1' name='fecha_inicio'/>";
                                    echo "</div>";

                                    echo " <div class='form-group col-md-4'>";
                                    echo " <label  for='fecha_final'>Ingrese una fecha final </label>";
                                    echo "<input class='form-control' required type='date'  id='fecha2'  name='fecha_final'/>";
                                    echo "</div>";
                                    echo "<div class='form-group col-md-12'>";
                                    echo "<button class='btn btn-primary'  type='submit' ><span class='glyphicon glyphicon-search'></span> Buscar</button>";

                                    echo " </div>";
                                    if (isset($mensaje_fecha)) {
                                        echo "<div class='row'>";
                                        echo "<div class='container'>";

                                        echo "<div class='form-group col-md-5'>";
                                        echo "<br>";
                                        echo $mensaje_fecha;
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                    }

                                    echo form_close();
                                    ?>


                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>  
        </div>  
        <?php
        // put your code here
        ?>
        <script src="<?php echo base_url('Componentes/bootstrap/js/jquery-v1.12.1.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('Componentes/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>

    </body>
</html>