<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Solicitudes</title>
        <?php
        session_start();
        if ($_SESSION['tipo'] == 2) {
            
        } else {
            redirect("usuario_controller/login");
        }
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo base_url('Componentes/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
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
                                <li  class="active"class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                        <span class="glyphicon glyphicon-cog"></span> Opciones<span class="caret"></span>
                                    </a> 


                                    <ul class="dropdown-menu">
                                        <!--                                    <li><a href="#">Historial solicitudes</a></li>-->
                                        <li  class="active"><?php echo anchor("usuario_controller/historial_solicitudes", "<span class='glyphicon glyphicon-list-alt'></span> Historial de solicitudes") ?></li>
                                        <!--                                    <li><a href="#">Buscar solicitudes</a></li>-->
                                        <li><?php echo anchor("usuario_controller/buscar_solicitudes", "<span class='glyphicon glyphicon-search'></span> Buscar solicitudes") ?></li>
                                        <li class="divider"></li>
                                        <li><a href="#"><span class='glyphicon glyphicon-user'></span> Tipo usuario <?php
                                                if (isset($_SESSION['rol'])) {
                                                    echo $_SESSION['rol'];
                                                }
                                                ?></a></li>

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
            <div class="container col-md-12">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Solicitudes de certificación
                            <small> Pendientes</small></h1>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                En esta sección se encuentra todas las solicitudes de certificación pendientes por parte de los postulantes.
                            </p>
                        </div>
                    </div>
                </div>
            </div>   
            <div class="container col-md-12">
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
                                echo form_open("usuario_controller/info_todos");

                                echo form_hidden("codigo", $fila->id_solicitud);
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
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Información
                            </div>
                            <div class="panel-body">
                                En esta sección solo se muestran las solicitudes pendientes.<br/>
                                Haciendo click en el botón consultar datos se desplegara la información del postulante.<br/>
                                Haciendo click en el botón editar se podrá gestionar  la solicitud.<br/>
                                Haciendo click en el botón eliminar se borrara dicha solicitud.<br/>
                            </div>
                            <div class="panel-footer">

                            </div>


                        </div>

                    </div>

                </div>

            </div>
        </div>

        <?php
        if (isset($mensaje)) {
            echo $mensaje;
        }
        ?>

        <script src="<?php echo base_url('Componentes/bootstrap/js/jquery-v1.12.1.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('Componentes/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>

    </body>
</html>
