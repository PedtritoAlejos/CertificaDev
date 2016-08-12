<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link href="<?php echo base_url('Componentes/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
         <?php session_start(); 
         if(isset($dato)){
           foreach ($dato->result() as $fila) {
          $_SESSION['nombre']=$fila->nombre; 
          $_SESSION['apellido']=$fila->apellido_p;  
          $_SESSION['run']=$fila->run_persona;  
          $_SESSION['rol']=$fila->descripcion;  
          $_SESSION['tipo']=$fila->id_tipo_usuario;
                }  } 
                
                if($_SESSION['tipo']==2){
                    
                }else {
                    redirect("usuario_controller/login");
                }
                ?>
         <title>Inicio Usuario</title>
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
                           
                            <li class="active"><?php echo anchor("usuario_controller/usuario_inicio", "<span class='glyphicon glyphicon-home'></span> Inicio"); ?> </li>
<!--                            <li><a href=""> Solicitudes pendientes <span class="badge">15</span></a> </li>-->
                            <li> <?php echo anchor("usuario_controller/usuario_solicitudes","<span class='glyphicon glyphicon-folder-open'></span> Solicitudes pendientes <span class='badge'>".$total."</span>"); ?> </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                <span class="glyphicon glyphicon-cog"></span> Opciones<span class="caret"></span>
                                </a> 
                                
                                 
                                <ul class="dropdown-menu">
                                     
<!--                                    <li><a href="#">Historial solicitudes</a></li>-->
                                    <li><?php echo anchor("usuario_controller/historial_solicitudes", " <span class='glyphicon glyphicon-list-alt'></span> Historial de solicitudes") ?></li>
<!--                                    <li><a href="#">Buscar solicitudes</a></li>-->
                                    <li><?php echo anchor("usuario_controller/buscar_solicitudes","<span class='glyphicon glyphicon-search'></span> Buscar solicitudes") ?></li>
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
       
              <div class="container">
                  
            <div class="jumbotron">
                <h1>Bienvenido!<small><?php 
               if(isset($_SESSION['nombre'])){ echo $_SESSION['nombre']." ".$_SESSION['apellido'];}?>
                    </small></h1>
                 <p>CertificaDev, es una entidad internacional que imparte cursos de preparación para la 
                 obtención de certificaciones en las áreas de programación y desarrollo.</p>
                
           
            </div>
                 <div class="container">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Cursos de CertificaDev
                        <small>Algunos cursos que se imparten</small></h1>
                           
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                             <p>
                                 Acontinuación de se menciona los cursos mas destacados con su breve descripcion de ello ,
                                 hemos tenido buenos resultados impartiendo clases y formando buenos profesionales.
                            </p>
                        </div>
                    </div>
                </div>
                
            </div>
               
          
      
             <div class="container">
                <div class="row">
                     <div class="col-xs-12 col-md-3">
                        <div class="thumbnail">
                           <img src="<?php echo base_url('Componentes/Icon-programacion/NET-300.png') ?>" alt=""/>
                           <div class="caption">
                               <p>.NET es un framework de Microsoft que hace un énfasis en la transparencia de redes, 
                                   con independencia de plataforma de hardware y que permita un rápido desarrollo de
                                   aplicaciones,basado en ella.</p>
                              
                           </div>
                        </div>
                    </div>
                   <div class="col-xs-12 col-md-3">
                        <div class="thumbnail">
                           <img src="<?php echo base_url('Componentes/Icon-programacion/android-300.jpg') ?>" alt=""/>
                           <div class="caption">
                               <p>Android es el rey indiscutible de las aplicaciones 
                                   (aunque no debamos menospreciar a iOS). Que dedicarse a
                                   crear aplicaciones Android, si se hace bien, puede ser rentable. 
                                   Y desarrollador juegos para Android, también.</p>
                              
                           </div>
                        </div>
                    </div>
                   <div class="col-xs-12 col-md-3">
                        <div class="thumbnail">
                           <img src="<?php echo base_url('Componentes/Icon-programacion/angularjs-300.png') ?>" alt=""/>
                           <div class="caption">
                               <p>AngularJS es un framework MVC de código abierto desarrollado por Google y 
                                   escrito en Javascript, que trabaja del lado del cliente y
                                   nos permite hacer más dinámica nuestra aplicación web, trabajando de la 
                                   mano con otras tecnologías.</p>
                              
                           </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <div class="thumbnail">
                           <img src="<?php echo base_url('Componentes/Icon-programacion/c++-300.png') ?>" alt=""/>
                           <div class="caption">
                               <p>C++ es un lenguaje de programación diseñado a mediados 
                                   de los años 1980 por Bjarne Stroustrup. La intención de 
                                   su creación fue el extender al lenguaje de programación C 
                                   mecanismos que permiten la manipulación de objetos.</p>
                              
                           </div>
                        </div>
                    </div>
                    
                
            </div>
                <div class="row ">
                   <div class="col-xs-12 col-md-3">
                        <div class="thumbnail">
                           <img src="<?php echo base_url('Componentes/Icon-programacion/html5jscss-300.png') ?>" alt=""/>
                           <div class="caption">
                               <p>HTML5 es un lenguaje markup (de hecho, las siglas de HTML 
                                   significan Hyper Text Markup Language) usado para estructurar y 
                                   presentar el contenido para la web. Es uno de los aspectos fundamentales
                                   para el funcionamiento de los sitios.</p>
                              
                           </div>
                        </div>
                    </div>
                   <div class="col-xs-12 col-md-3">
                        <div class="thumbnail">
                           <img src="<?php echo base_url('Componentes/Icon-programacion/java-300.jpg') ?>" alt=""/>
                           <div class="caption">
                               <p>Java es un lenguaje de programación de propósito general, 
                                   concurrente, orientado a objetos que fue diseñado específicamente 
                                   para tener tan pocas dependencias de implementación como fuera posible Su intención 
                                   es permitir portabilidad</p>
                              
                           </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <div class="thumbnail">
                           <img src="<?php echo base_url('Componentes/Icon-programacion/nodejs-300.png') ?>" alt=""/>  
                            <div class="caption">
                               <p>Node es un programa de servidor.Sin embargo, el producto base 
                                   de Node definitivamente No es como Apache o Tomcat. Esos servidores 
                                   básicamente son productos para servidor listos para instalar.</p>
                              
                           </div>
                        </div>
                       
                </div>
                    <div class="col-xs-12 col-md-3">
                        <div class="thumbnail">
                           <img src="<?php echo base_url('Componentes/Icon-programacion/php-300.png') ?>" alt=""/>
                           <div class="caption">
                               <p>PHP es un lenguaje de código abierto muy popular, adecuado para 
                                   desarrollo web y que puede ser incrustado en HTML. Es popular 
                                   porque un gran número de páginas y portales web están creadas 
                                   con PHP.</p>
                              
                           </div>
                        </div>
                    </div>
                    
                
            </div>
        </div>      
        </div>      
        </div>      
        <?php
    
      
        
      
       
        ?>
         
         <script src="<?php  echo base_url('Componentes/bootstrap/js/jquery-v1.12.1.min.js')?>" type="text/javascript"></script>
         <script src="<?php  echo base_url('Componentes/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
         
    </body>
</html>
