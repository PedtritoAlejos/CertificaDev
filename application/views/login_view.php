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
        <title>Certificados Dev &biguplus;</title>
        <link href="<?php echo base_url('Componentes/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url('Componentes/script/validaciones_script.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('Componentes/script/script.js') ?>" type="text/javascript"></script>
        <link href="<?php echo base_url('Componentes/bootstrap/css/estilos.css') ?>" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url('Componentes/dist/sweetalert-dev.js') ?>"type="text/javascript" ></script>
        <link rel="stylesheet" href="<?php echo base_url('Componentes/dist/sweetalert.css') ?>" rel="stylesheet" type="text/css"/>

    </head>
    <body>
        <header>
            <div class="container">
                <h1>CetificaDev</h1>
            </div>
        </header>

        <div class="jumbotron">
            <div class="container">
                <h1>Bienvenido a nuestro sitio web</h1>
                <p>Si no estas registrado puedes hacerlo en línea, solicitar certificaciones en línea </p>
            </div>
        </div>


        <div class="container">     

 <?php if (isset($mensaje1)) {
                echo $mensaje1;
            }
         
?>


            <?php
            echo " <div class='row'>";

            echo " <div class='col-xs-12 col-sm-6 col-md-4'>";
            echo " <h2>Inisiar sesión </h2>";
            echo form_open("usuario_controller/ingresar");
            echo "<div class='form-group'>";
            echo form_label("Ingrese su run", "run");
            echo form_input("run", "", "class='form-control'  maxlength='10' required='true' placeholder='RUN:12345678-9' onBlur='Valida_Rut(this)'");
            echo "<span style='color:red'>" . form_error("run") . "</span>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo form_label("Ingrese su clave", "clave");
            echo form_password("clave", "", "class='form-control' required='true' min='14' ");
            echo "<span style='color:red'>" . form_error("clave") . "</span>";
            echo "</div>";


            echo "<div class='form-group'>";
            echo form_submit("btn_enviar", "Ingresar", "class='btn btn-primary'");
            echo anchor("usuario_controller/registrar_cuenta", "Crear cuenta", "class='btn btn-primary'");
            echo "</div>";
           
            echo form_close();
            echo "</div>";
            ?>

        </div>
     





        <script src="<?php echo base_url('Componentes/bootstrap/js/jquery-v1.12.1.min.js') ?>" type="text/javascript"></script>

        <script src="<?php echo base_url('Componentes/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>

    </body>
</html>
