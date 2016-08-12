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
        <title>Realizar una solicitud</title>
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
               <li class='active'> 
                    <?php
                    $run =$_SESSION['run'];
               echo anchor("usuario_controller/postulante_crear_solicitud/$run","<span class='glyphicon glyphicon-pencil'></span> Realizar solicitud <span class='badge'></span>");
                    ?> </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                 <span class="glyphicon glyphicon-cog"></span> Opciones<span class="caret"></span>
                                </a> 
                                
                                 
                                <ul class="dropdown-menu">
<!--                                    <li><a href="#">Historial solicitudes</a></li>-->
                                    <li><?php echo anchor("usuario_controller/postulante_hisorial_solicitud", "<span class='glyphicon glyphicon-list-alt'></span> Historial de solicitudes") ?></li>
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
        <!-- Formulario del postulante-->
        <div class="container">
                <div class='col-md-12'>
                    <div class="page-header">
                        <h1>Formulario del postulacion
                        </h1>
                         <?php
                                    
                                       if(isset($mensaje)){
                                        echo $mensaje;
                                    }
                                    ?>
                    </div>
                    <div class="row">
                      
                             <div class="panel panel-primary ">
                                <div class="panel-heading">
                                    Formulario para registrar una postulación a una certificación
                                 
                                </div>
                                 
                           <div class="panel-body ">
                               <?php 
                               
                                   
                               echo form_open("usuario_controller/ingresar_postulacion_datos");
                               // <form action="" >
                                       //<!--cajas de texto------>

                                    echo   "<div class='col-md-4'>";
                               
                                   
                                   echo " <div class='form-group'>";
                            
                                 echo form_label("Ingrese el Run","run"); //<label for='rut'>Ingrese el rut </label>";
                                 if(isset($num_run)){
                                 echo form_input("run_persona",$num_run ,"class='form-control' disabled" ) ;//" <input class='form-control' name='rut' />";
                                 echo form_hidden("rut", $num_run);
                                 }else{
                                     echo form_input("run_persona","" ,"class='form-control' disabled" ) ;
                                 }
                                
                                 echo form_error("run_persona"); 
                                 
                                  echo" </div>";
                                  
                                   echo "<div class='form-group'>";
                                 echo form_label("Ingrese el dv-run","dv_run");//"<label for='dv_rut'>Ingrese el dv-rut </label>";
                                 if(isset($dv_run)){
                                 echo form_input("dv_run",$dv_run, "class='form-control' disabled") ;
                                 }else{
                                  echo form_input("dv_run","", "class='form-control' disabled") ;   
                                 }
                                 echo form_error("dv_run"); //  <input type='text' class='form-control' name='dv_rut' placeholder='K'/>
                                  echo " </div>";
                                  
                                  echo " <div class='form-group'>";
                                
                                      echo form_label("Ingrese el nombre","nombre") ; //<label class="sr-only" for="nombre">Ingrese el nombre </label>
                                     if(isset($nombre)){
                                  echo form_input("nombre",$nombre, "class='form-control' disabled required");
                                     }else{
                                         echo form_input("nombre","", "class='form-control' disabled required"); 
                                     }
                                  echo form_error("nombre");
                                    //<input class='form-control'  name="nombre" placeholder="Mi nombre..."/>
                                    echo " </div>";
                                echo " <div class='form-group'>";
                                echo form_label("Ingrese el apellido paterno", "paterno");
                                    //<label class="sr-only" for="paterno">Ingrese el apellido paterno </label>
                                    if(isset($apellido_p)){
                                echo form_input("paterno",$apellido_p,"class='form-control' disabled required" );
                                    }else{
                                        echo form_input("paterno","","class='form-control' disabled required" );
                                    }
                                   echo form_error("paterno");
                                  //  <input class='form-control' name="paterno" placeholder="Mi apellido paterno..."/>
                                    
                                  echo " </div>";
                               echo  " <div class='form-group'>";
                                  echo form_label("Ingrese el apallido materno","materno");   //      <label class="" for="materno">Ingrese apellido materno  </label>
                               if(isset($apellido_m)){ 
                                 echo form_input("materno",$apellido_m, "class='form-control' disabled required") ;
                               }else{
                                  echo form_input("materno","", "class='form-control' disabled required") ; 
                               }
                                  echo form_error("materno"); //  <input type="text" class='form-control' name="materno" placeholder="Mi apellido materno..."/>
                                  echo " </div>";
                                   echo "<div class='form-group'>";
                                 echo form_label("Selecciione su sexo","sexo");//      <label  for="sexo">Seleccione su sexo </label>
                                $comparacio="Masculino";
                                if(isset($sexo)){
                                 if (strcmp ($sexo ,$comparacio ) == 0)     
                                 {
                                     echo "<label class='radio-inline'>";
                                     echo form_radio("sexo", "Masculino",true,"disabled");
                                            //  <input type="radio" value="masculino" name="sexo"/>
                                      echo "Masculino</label>";
                                       echo  "<label class='radio-inline'>";
                                        echo  form_radio("sexo", "Femenino","","disabled");//<input type="radio" value="femenino" name="sexo"/>
                                        echo "Femenino</label>";
                                      }else{
                                           echo "<label class='radio-inline'>";
                                     echo form_radio("sexo", "Masculino");
                                            //  <input type="radio" value="masculino" name="sexo"/>
                                      echo "Masculino</label>";
                                       echo  "<label class='radio-inline'>";
                                        echo  form_radio("sexo", "Femenino",true,"disabled");//<input type="radio" value="femenino" name="sexo"/>
                                        echo "Femenino</label>";
                                      }
                                }else{
                                 /* aqui empieza */   
                                    echo "<label class='radio-inline'>";
                                     echo form_radio("sexo", "Masculino",true,"disabled");
                                            //  <input type="radio" value="masculino" name="sexo"/>
                                      echo "Masculino</label>";
                                       echo  "<label class='radio-inline'>";
                                        echo  form_radio("sexo", "Femenino","","disabled");//<input type="radio" value="femenino" name="sexo"/>
                                        echo "Femenino</label>";
                                 /* aqui termina */   
                                }

                                 echo " </div>";
                               echo " </div> ";
                                    
                                   // <!--     -----  cajas de texto------>
                             echo " <div class='col-md-4'> ";
                               echo "<div class='form-group'>";
                               echo form_label("Ingrese su fecha de nacimiento","nacimiento");
                        //   <label class="" for="nacimiento">Ingrese su fecha de nacimiento </label>
                           if(isset($fecha_nacimiento)){
                               echo form_input("nacimiento",$fecha_nacimiento, "class='form-control' disabled required id='nacimiento'");
                           }else{
                                echo form_input("nacimiento","", "class='form-control' disabled required placeholder='1999-07-10' id='nacimiento'");
                           } 
                               echo form_error("nacimiento");
                                       //<input type="date" class="form-control" name="nacimiento" />
                                 echo" </div>";
                                  echo  "<div class='form-group'>";
                                    echo form_label("Ingrese su teléfono","telefono");  //<label class="" for="nacimiento">Ingrese teléfono </label>
                                   if(isset($telefono)){
                                    echo form_input("telefono",$telefono,"class='form-control' disabled id='telefono' required"); //     <input type="number" class="form-control" name="telefono" />
                                   }else{
                                       echo form_input("telefono","","class='form-control' disabled id='telefono' required"); 
                                   }
                                    echo form_error("telefono");
                                     echo "</div>";
                                  
                                  
                                echo  "<div class='form-group'>" ;
                               echo form_label("Ingrese su email","correo"); // <label class="" for="correo">Ingrese su email </label>
                               if(isset($email)) {
                               echo form_input("correo",$email, "class='form-control' disabled id='correo' required") ;//<input type="email" class='form-control' name="correo" />
                               }else{
                                 echo form_input("correo","", "class='form-control' disabled id='correo' required") ;
                               }
                                echo form_error("correo");
                                echo   "</div>";
                                echo " <div class='form-group'>";
                               echo form_label("Ingrese su direccion","direccion"); // <label class="" for="direccion">Ingrese su dirección </label>
                            if(isset($direccion)){
                               echo form_input("direccion",$direccion,"class='form-control' disabled required "); //<input type="text" class='form-control' name="direccion" />
                            }else{
                                echo form_input("direccion","","class='form-control' disabled required ");
                            }
                              
                           
                             echo strip_tags(form_error("direccion"));
                             echo "    </div>";
                                echo " <div class='form-group'>";
                               echo form_label("Ingrese el número de su direccion","numero_direccion"); // <label class="" for="direccion">Ingrese su dirección </label>
                           if(isset($num_direccion))
                           {  echo form_input("numero_direccion",$num_direccion,"class='form-control' disabled required id='num_direc' "); //<input type="text" class='form-control' name="direccion" />
                           }else{
                               echo form_input("numero_direccion","","class='form-control' required disabled id='num_direc'");
                           }
                               echo form_error("numero_direccion");
                             echo "    </div>";
                             echo " <div class='form-group'>";
                              echo form_label("Ingrese su comuna","comuna") ;   //   <label class="" for="comuna">Ingrese su comuna </label>
                              
                              if(isset($comuna))
                              {
                              echo form_input("comuna",$comuna,"class='form-control' disabled required"); // <input type="text" class='form-control' name="comuna" />
                              }else{
                                 echo form_input("comuna","","class='form-control' disabled required"); 
                              }
                              echo form_error("comuna");
                                 echo " </div>";
                                   
                              echo " </div> ";
//<!--             -----  cajas de texto------>
                            echo " <div class='col-md-4'>";
                               
                                   echo "<div class='form-group'>";
                                    echo form_label("Ingrese su educación","educacion");
                                  if(isset($educacion)){
                                    echo form_dropdown("educacion", $options=array('Profesional'=>'Profesional','Tecnico'=>'Tecnico','Media'=>'Media','Basica'=>'Basica','No posse'=>'No posee estudios'),$educacion, "class='form-control' disabled");
                                  }else{
                                     echo form_dropdown("educacion", $options=array('Profesional'=>'Profesional','Tecnico'=>'Tecnico','Media'=>'Media','Basica'=>'Basica','No posse'=>'No posee estudios'),"", "class='form-control' disabled");
                                 
                                  } 
                                    echo form_error("educacion");
                                    
                                   echo "</div>";
                                echo " <div class='form-group'>";
                                  echo form_label("Marque si es correcto", "experiencia");// <label>Marque si es correcto</label>
                                  echo " <div class='checkbox'>";
                                       echo " <label for='experiencia'>";
                                      $comparacion="SI"; 
                                      if(isset($anio))
                                      {
                                      if($anio>0)
                                       {
                                      echo form_checkbox("experiencia", "positivo",true,"id='che_experiencia'"); //<input type="checkbox"  name="experiencia"/>
                                      echo "  Tengo experiencia en el area de la programación ";
                                      echo" </label> ";
                                      echo " </div>";
                                      echo "</div>";
                                      echo " <div class='form-group'>";
                                      echo form_label("Ingrese la cantidad de años","anios"); // <label>Ingrese la cantidad de años</label>
                                      
                                      echo form_input("anio",$anio,"class='form-control' min='0' required id='anio'");  
                                      echo form_error("anio");
                            // <input type="number" min="1" name="anios" class='form-control' disabled/>
                                      echo "</div>";
                                       }else{
                                            echo form_checkbox("experiencia", "positivo","","id='che_experiencia'"); //<input type="checkbox"  name="experiencia"/>
                                            echo "  Tengo experiencia en el area de la programación ";
                                            echo" </label> ";
                                            echo " </div>";
                                            echo "</div>";
                                            echo " <div class='form-group'>";
                                            echo form_label("Ingrese la cantidad de años","anios"); // <label>Ingrese la cantidad de años</label>
                                            echo form_input("anio",$anio,"class='form-control' min='0' required id='anio'");  
                                            echo form_error("anio");
                            // <input type="number" min="1" name="anios" class='form-control' disabled/>
                                            echo "</div>";
                                       }
                                   }else{
                                      echo form_checkbox("experiencia", "positivo",true,"id='che_experiencia'"); //<input type="checkbox"  name="experiencia"/>
                                      echo "  Tengo experiencia en el area de la programación ";
                                      echo" </label> ";
                                      echo " </div>";
                                      echo "</div>";
                                      echo " <div class='form-group'>";
                                      echo form_label("Ingrese la cantidad de años","anios"); // <label>Ingrese la cantidad de años</label>
                                      echo form_input("anio","","class='form-control' min='0' value='1' required id='anio'");  
                                      echo form_error("anio"); 
                                        echo "</div>";//no estaba este div
                                   }  
                               echo " <div class='form-group'>";
                                  echo  " <div class='panel panel-default'>";
                             echo" <div class='panel-heading'>";
                                  echo" Modalidad y certificación a la que postula";
                                     echo  "  </div>";
                                     echo " <div class='panel-body'>";
                                        echo " <div class='form-group'>";
                                            echo   "<label for='modalidad'>Modalidad</label>";
                                            if(isset($modalidad))
                                            {   
                                    echo form_dropdown("modalidad", $options=array('Vespertino'=>'Vespertino','Diurno'=>'Diurno'),$modalidad,"class='form-control'"); // <select name="modalidad" class='form-control'>
                                   
                                            }else{
                                      echo form_dropdown("modalidad", $options=array(''=>'Seleccione','Vespertino'=>'Vespertino','Diurno'=>'Diurno'),"","class='form-control' required='true'");          
                                            }
                                    echo "</div>";      
                                    echo   "<div class='form-group'>";
                                    echo" <label for='curso'>Curso</label>";
                                   if(isset($curso))
                                   {
                                    echo form_dropdown("curso", $options=array(''=>'Seleccione','PHP'=>'PHP','JAVA'=>'JAVA','.NET'=>'.NET'),$curso, "class='form-control' required='true'"); //<select name="curso" class='form-control'>
                                   }else{
                                     echo form_dropdown("curso", $options=array(''=>'Seleccione','PHP'=>'PHP','JAVA'=>'JAVA','.NET'=>'.NET'),"", "class='form-control' required='true'");  
                                   }
                                    echo " </div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo  "</div>";
                                    echo "</div>";
                                    echo "</div>"; 
                                    echo" <div class='panel-footer'>";
                                 
                                   /*-------*/
                                    echo "<div class='col-md-offset-5'>";
                                     echo "&nbsp;<button type='submit' class='btn btn-primary btn-lg' ><span class='glyphicon glyphicon-saved'></span> Registrar Postulación</button>";
                                     echo "</div>";
                                     echo "</div>";
                                    
                                     
                                     echo form_close();
                                   
                               
                                       ?>
                          </div>
                        </div>
                        </div>
                    
                     </div>
                        
                    
                    </div>
                </div>
        
        
         <script src="<?php  echo base_url('Componentes/bootstrap/js/jquery-v1.12.1.min.js')?>" type="text/javascript"></script>
         <script src="<?php  echo base_url('Componentes/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
         <script>
        $(document).ready(function(){  
        
   $("#anio").get(0).type = 'number';
    $("#anio").val(1);
   $("#telefono").get(0).type = 'number';
   $("#correo").get(0).type = 'email';
   $("#num_direc").get(0).type = 'number';
   $("#nacimiento").get(0).type = 'date';
   
   //$("#che_experiencia").click(function() {  
   $("#che_experiencia").change(function(){
         if($("#che_experiencia").is(':checked')) {  
           
             $("#anio").prop('disabled', false);
            $("#anio").val(1);
        } else {  
            
            $("#anio").prop('disabled', true);
            $("#anio").val(0);
            
        } 
           
	});
   
});  
        </script>
    </body>
</html>
