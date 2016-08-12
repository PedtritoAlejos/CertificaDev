<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Crear cuenta</title>
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
                <h1>Crear cuenta de usuario</h1>
                <p>Registrate, Para la obtención de tus certificados en el área de desarrollo y programación. </p>
                <div class="container">
                <?php
                if (isset($mensaje)) {
                    echo $mensaje;
                }
                ?></div>
            </div>
        </div>
        <div class='container'>
            <?php echo form_open("usuario_controller/crear_cuenta_usuario", 'name=form1'); ?>
            <div class="row">
                <div class="col-sm-5 col-md-4">
                    <div class="form-group">
                        <label>Ingrese su run</label>
                        <input class="form-control" required onBlur="Valida_Rut(this)" maxlength="10" name="run_nuevo" placeholder="12345678-9"/>
                    </div>
                </div>

                <div class="col-sm-5 col-md-4">
                    <div class="form-group">
                        <label>Ingrese su nombre</label>
                        <input class="form-control" required="true" autocomplete="off" onkeypress="return val(event);" name="nombre_nuevo" placeholder="Runolio"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5 col-md-4">
                    <div class="form-group">
                        <label>Ingrese su apellido paterno</label>
                        <input class="form-control" required="true" autocomplete="off" onkeypress="return val(event);" name="paterno_nuevo" placeholder="López"/>
                    </div>
                </div>

                <div class="col-sm-5 col-md-4">
                    <div class="form-group">
                        <label>Ingrese su apellido materno</label>
                        <input class="form-control" required="true" autocomplete="off" onkeypress="return val(event);" name="materno_nuevo" placeholder="Caceres"/>
                    </div>
                </div>
            </div>
            <!-- separacio-->
            <div class="row">
                <div class="col-sm-5 col-md-4">
                    <div class="form-group">
                        <label>Ingrese su fecha nacimiento</label>
                        <input class="form-control" required="true" autocomplete="off" type="date"  name="nacimiento_nuevo" />
                    </div>
                </div>

                <div class="col-sm-5 col-md-4">
                    <div class="form-group">
                        <label>Seleccine su sexo</label><br>
                        <label class='radio-inline'>

                            <input type="radio"  required="true"  value="Masculino" name="sexo"/>
                            Masculino</label>
                        <label class='radio-inline'>
                            <input type="radio" required="true"  value="Femenino" name="sexo"/>
                            Femenino</label>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5 col-md-4">
                    <div class="form-group">

                        <label>Ingrese su número de teléfono</label>
                        <input class="form-control" type="number" onkeypress="return isNumber(event);" required="true"autocomplete="off"  name="telefono_nuevo" maxlength="8" placeholder="87377837"/>
                    </div>
                </div>

                <div class="col-sm-5 col-md-4">
                    <div class="form-group">
                        <label>Ingrese su dirección</label>
                        <input class="form-control" required="true" autocomplete="off"onkeypress="return val(event);" maxlength="30" name="direccion_nuevo" placeholder="direccion"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5 col-md-4">
                    <div class="form-group">

                        <label>Ingrese su número de dirección</label>
                        <input class="form-control" required="true" autocomplete="off" type="number" onkeypress="return isNumber(event);" min="1" max="999999"  name="num_direccion_nuevo" maxlength="8" placeholder="873"/>
                    </div>
                </div>

                <div class="col-sm-5 col-md-4">
                    <div class="form-group">
                        <label>Ingrese su comuna</label>
                        <select class="form-control" required="true" name='nueva_comuna'>
                            <option value="">Seleccione</option>
                            <option value="Santiago">Santiago</option> 
                            <option value="Cerrillos">Cerrillos</option> 
                            <option value="Cerro Navia">Cerro Navia</option> 
                            <option value="Conchalí"> 	Conchalí</option> 
                            <option value="El Bosque"> El Bosque</option> 
                            <option value="Estación Central"> Estación Central</option> 
                            <option value="Huechuraba"> 	Huechuraba</option> 
                            <option value="Independencia"> Independencia</option> 
                            <option value="La Cisterna"> La Cisterna</option> 
                            <option value="La Florida	"> La Florida</option> 
                            <option value="La Granja"> La Granja</option> 
                            <option value="La Pintana	"> La Pintana</option> 
                            <option value="La Reina"> 	La Reina</option> 
                            <option value="Las Condes"> 	Las Condes</option> 
                            <option value="Lo Barnechea"> 	Lo Barnechea</option> 
                            <option value="Lo Espejo"> 	Lo Espejo</option> 
                            <option value="Lo Prado"> 	Lo Prado</option> 
                            <option value="Macul"> 	Macul</option> 
                            <option value="Maipú"> 	Maipú</option> 
                            <option value="Ñuñoa">	Ñuñoa</option> 
                            <option value="Pedro Aguirre Cerda"> 	Pedro Aguirre Cerda</option> 
                            <option value="Peñalolén"> 	Peñalolén</option> 
                            <option value="Providencia"> 	Providencia</option> 
                            <option value="Pudahuel"> 	Pudahuel</option> 
                            <option value="Quilicura"> 	Quilicura</option> 
                            <option value="Quinta Normal"> 	Quinta Normal</option> 
                            <option value="Recoleta"> 	Recoleta</option> 
                            <option value="Renca"> 	Renca</option> 
                            <option value="San Joaquín"> 	San Joaquín</option> 
                            <option value="San Miguel"> 	San Miguel</option> 
                            <option value="San Ramón"> 	San Ramón</option> 
                            <option value="Vitacura"> 	Vitacura</option> 
                            <option value="Puente Alto"> 	Puente Alto</option> 
                            <option value="Pirque"> 	Pirque</option> 
                            <option value="San José de Maipo"> 	San José de Maipo</option> 
                            <option value="Colina"> 	Colina</option> 
                            <option value="Lampa"> 	Lampa</option> 
                            <option value="Til til"> 	Til til</option> 
                            <option value="San Bernardo"> 	San Bernardo</option> 
                            <option value="Buin"> 	Buin</option> 
                            <option value="Calera de Tango	"> Calera de Tango</option> 
                            <option value="Paine"> 	Paine</option> 
                            <option value="Melipilla"> 	Melipilla</option> 
                            <option value="Alhué"> 	Alhué</option> 
                            <option value="Curacaví"> 	Curacaví</option> 
                            <option value="María Pinto"> 	María Pinto</option> 
                            <option value="San Pedro"> 	San Pedro</option> 
                            <option value="Talagante"> 	Talagante</option> 
                            <option value="El Monte"> 	El Monte</option> 
                            <option value="Isla de Maipo"> 	Isla de Maipo</option> 
                            <option value="Padre Hurtado"> 	Padre Hurtado</option> 
                            <option value="Peñaflor"> 	Peñaflor</option> 

                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5 col-md-4">
                    <div class="form-group">

                        <label>Ingrese su educación</label>
                        <select class='form-control' required="true" name='educacion_nueva'>
                            <option value="">Seleccione</option>
                            <option value="Profesional">Profesional</option>
                            <option value="Tecnico">Tecnico</option>
                            <option value="Media">Media</option>
                            <option value="Basica">Basica</option>
                            <option value="No posee">No posee</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-5 col-md-4">
                    <div class="form-group">
                        <label>Ingrese su correo eléctronico</label>
                        <input class="form-control" required="true" autocomplete="off" type="email" name="correo_nuevo" placeholder="micorreo@gmail.cl"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5 col-md-4">
                    <div class="form-group">

                        <label>Ingrese una nueva contraseña</label>
                        <input type="password" required="true" autocomplete="off" class="form-control" name="clave1" />
                    </div>
                </div>

                <div class="col-sm-5 col-md-4">
                    <div class="form-group">
                        <label>Repita contraseña</label>
                        <input class="form-control" autocomplete="off" required oninput="validarclave(this)" type="password" name="clave2"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5 col-md-4">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Crear cuenta"/>
                        <?php echo anchor("usuario_controller/login", "volver al login", "class='btn btn-success'"); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php echo form_close(); ?>

</div>

<script src="<?php echo base_url('Componentes/bootstrap/js/jquery-v1.12.1.min.js') ?>" type="text/javascript"></script>

<script src="<?php echo base_url('Componentes/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>

</body>
</html>
