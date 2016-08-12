<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
           <?php session_start(); 
           
                if($_SESSION['tipo']==3){
                    
                }else {
                    redirect("usuario_controller/login");
                }
           ?>
        <title>Historial de solicitudes</title>
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
                           
                            <li ><?php echo anchor("usuario_controller/inicio_postulante", "<span class='glyphicon glyphicon-home'></span> Inicio"); ?> </li>
<!--                            <li><a href=""> Solicitudes pendientes <span class="badge">15</span></a> </li>-->
               <!-- arreglar esto despues--> 
              <li> 
                    <?php
                     $run=$_SESSION['run'];
               echo anchor("usuario_controller/postulante_crear_solicitud/$run","<span class='glyphicon glyphicon-pencil'></span> Realizar solicitud <span class='badge'></span>");
                    ?> </li>
                            <li class="dropdown active">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                 <span class="glyphicon glyphicon-cog"></span> Opciones<span class="caret"></span>
                                </a> 
                                
                                 
                                <ul class="dropdown-menu">
<!--                                    <li><a href="#">Historial solicitudes</a></li>-->
                                    <li class="active"><?php echo anchor("usuario_controller/postulante_hisorial_solicitud", "<span class='glyphicon glyphicon-list-alt'></span> Historial de solicitudes") ?></li>
<!--                                    <li><a href="#">Buscar solicitudes</a></li>-->
                                   
                                    <li class="divider"></li>
                                    <li><a href="#"><span class='glyphicon glyphicon-user'></span> Tipo usuario <?php if(isset($_SESSION['rol'])){echo $_SESSION['rol'];} ?></a></li>
                                    
                                </ul>
                            </li>
                        </ul>
                        <?php 
                        echo form_open("usuario_controller/salir","class='navbar-form navbar-left' role='search'");
                        echo "<div class='form-group'>";
                       echo "<button type='submit' name='salir' class='btn btn-danger'><span class='glyphicon glyphicon-user'></span> Cerrar Sesión</button>";
                        echo "</div>";
                        echo form_close();
                        ?>
                
                      
                    </div>
                </div>
            </nav>
        </header>
        </div>
        
        <!-- solicitudes  -->
        
         <div class="container">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Historial de mis solicitudes
                           </h1>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                En esta sección se encuentra todas las solicitudes de certificación realizadas podras ver el estado de la solicitud.
                            </p>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Mis solicitudes enviadas
                                </div>

                                <div class="panel-body">


                                    <?php
                                    $mirun = $_SESSION['run'];
                                    echo form_open("usuario_controller/listar_por_run_postulante/$run", "class='form-inline'");
                                    echo "  <div class='form-group'>";
                                  
                                  
                                    echo "<button type='submit'class='btn btn-primary' ><span class='glyphicon glyphicon-eye-open'></span> Ver el estado de mis solicitudes</button>";
                                    echo " </div>";


                                   
                                    if (isset($mensaje_alerta)) {
                                        echo "<div class='row'>";
                                        echo "<div class='container'>";

                                        echo "<div class='form-group'>";
                                        echo "<br>";
                                        echo $mensaje_alerta;
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                    echo form_close();
                                    ?>







                                    <!-- aqui va la tabla inicio-->      

                                    <!-- aqui va la tabla final-->              
                                </div>

                                <!-- aqui tiene que ir los datos de la tabla --> 
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
                                                    <th>Fecha origen</th>
                                                    <th>Modalidad</th>
                                                    <th>Curso</th>
                                                    <th>Anio</th>
                                                    <th>Consultar estado de solicitud</th>
                                                    

                                                </tr>
                                                <?php
                                                if (isset($datos)) {
                                                    foreach ($datos->result() as $fila) {
                                                        echo "<tr>";
                                                        echo "<td>" . $fila->id_solicitud . "</td>";
                                                        $date = new DateTime($fila->fecha_origen);
                                                        echo "<td>" .$date->format('d-m-Y')."</td>";
                                                        echo "<td>" . $fila->modalidad."</td>";
                                                        echo "<td>" . $fila->curso."</td>";
                                                        echo "<td>" . $fila->anio."</td>";
                                                        echo "<td>";
                                                        echo form_open("usuario_controller/info_solicitud_postulante");
                                                        echo form_hidden("codigo",$fila->id_solicitud);
                                                        echo form_hidden("run",$fila->run);
                                                      
                                                       
                                                        echo "<button type='submit' id='#ventana1' class='btn btn-primary' data-toggle='modal'><span class='glyphicon glyphicon-envelope'></span> Consultar estado</button> ";
                                                        echo form_close();
                                                        echo "</td>";
                                                        
                                                    }
                                                }
                                                ?>

                                            </table>
                                            <!-- panel inicio modal------->

                                            <?php
                                            if (isset($panel_estados)) {
                                                echo $panel_estados;
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


                     

                            </div>

                        </div>
                    </div>
         
        
        
        <script src="<?php  echo base_url('Componentes/bootstrap/js/jquery-v1.12.1.min.js')?>" type="text/javascript"></script>
         <script src="<?php  echo base_url('Componentes/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
        
    </body>
</html>
