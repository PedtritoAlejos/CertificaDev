<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario_controller
 *
 * @author Pedrito
 */
class Usuario_controller extends CI_Controller{
    
    public function login(){
        $this->load->view('login_view');
     }
    public function registrar_cuenta(){ //para el usuario tipo postulante
        $this->load->view('crear_cuenta_usuario_view');
     }
    public function inicio_postulante(){ //para el usuario tipo postulante
       
        $this->load->view('inicio_usuario_postulante_view');
     }
    public function postulante_crear_solicitud($run){ //para el usuario tipo postulante
      
        $this->load->model("insert_Model");
      $datos=$this->insert_Model->buscar_datos_run($run);
      foreach ($datos->result() as $fila) {
            $num_run=$fila->num_run;
             $dv_run=$fila->dv_run;
             $nombre=$fila->nombre;
             $apellido_p=$fila->apellido_p;
             $apellido_m=$fila->apellido_m;
             $sexo=$fila->sexo;
             $fecha_nacimiento=$fila->fecha_nacimiento;
             $telefono=$fila->telefono;
            $email=$fila->email;
            $direccion=$fila->direccion;
            $num_direccion=$fila->num_direccion;
           $comuna= $fila->comuna;
           $educacion=$fila->educacion;
      }
      $this->load->view('crear_solicitud_postulante_view',  compact("num_run","dv_run","nombre","apellido_p","apellido_m",
              "sexo","fecha_nacimiento","telefono","email","direccion","num_direccion","comuna","educacion"));
     }
    public function postulante_hisorial_solicitud(){ //para el usuario tipo postulante
        $this->load->view('historial_solicitudes_postulante_view');
     }
    public function usuario_inicio(){
        $this->load->model("insert_Model");
        $total=$this->insert_Model->contar_pendientes();
        $this->load->view('inicio_usuario_view',  compact("total"));
     }
     public function total_pendientes(){
          $this->load->model("insert_Model");
        $total=$this->insert_Model->contar_pendientes();
         return $total;
     }
    public function historial_solicitudes(){
         $this->load->model("insert_Model");
        $total=$this->insert_Model->contar_pendientes();
       $datos =$this->insert_Model->solicitudes_todas();
        $this->load->view('solicitudes_todas_view',  compact("total","datos"));
     }
    public function usuario_formulario(){
        $this->load->view('formulario_solicitud_view');
     }
     public function lista_datos(){
           $estado="Pendiente";
         $this->load->model("insert_Model");
        $datos =$this->insert_Model->solicitudes_pendientes($estado);
        return $datos;
     }
     
     public function reenviar(){
         $codigo=$this->input->post("codigo");
         $this->load->model("insert_Model");
         $lista=$this->insert_Model->ver_solicitud($codigo);
         $total=$this->total_pendientes();
         foreach ($lista->result() as $fila) {
             $num_run=$fila->num_run;
             $dv_run=$fila->dv_run;
             $nombre=$fila->nombre;
             $apellido_p=$fila->apellido_p;
             $apellido_m=$fila->apellido_m;
             $sexo=$fila->sexo;
             $fecha_nacimiento=$fila->fecha_nacimiento;
             $telefono=$fila->telefono;
            $email=$fila->email;
            $direccion=$fila->direccion;
            $num_direccion=$fila->num_direccion;
           $comuna= $fila->comuna;
           $educacion=$fila->educacion;
          
          $anio=$fila->anio;
         $modalidad= $fila->modalidad;
         $curso=$fila->curso;
         $tipo_estado=$fila->tipo_estado;
         
         }
         
         $this->load->view("formulario_solicitud_view", compact("total","codigo","num_run","dv_run","nombre",
                 "apellido_p","apellido_m","sexo","fecha_nacimiento","telefono","email","direccion","num_direccion","comuna",
                 "anio","modalidad","curso","tipo_estado","educacion"));
     }
     public function modificar_datos(){//|valid_email
       
         $this->form_validation->set_rules("nombre","Nombre","required|min_length[3]|max_length[25]|trim|alpha");
         $this->form_validation->set_rules("paterno","Apellido Paterno","required|min_length[3]|max_length[25]|trim");
         $this->form_validation->set_rules("materno","Apellido Materno","required|min_length[3]|max_length[25]|trim");
         $this->form_validation->set_rules("telefono","Telefono","required|numeric");
         $this->form_validation->set_rules("correo","Correo","required|valid_email");
         $this->form_validation->set_rules("nacimiento","Fecha de nacimiento","required|max_length[10]");
         $this->form_validation->set_rules("direccion","Direccion","required");
         $this->form_validation->set_rules("numero_direccion","Nro de direccion ","required|numeric");
         $this->form_validation->set_rules("sexo","Sexo","required");
         $this->form_validation->set_rules("opcion","Opcion","required");
         $this->form_validation->set_rules("rut","Run");
         if($this->form_validation->run()===true){
            $id_codigo=$this->input->post("id_soli"); 
            $run=$this->input->post("rut"); 
           
            $nombre=$this->input->post("nombre"); 
            $paterno=$this->input->post("paterno"); 
            $materno=$this->input->post("materno"); 
            $sexo=$this->input->post("sexo"); 
            $nacimiento=$this->input->post("nacimiento"); 
            $telefono=$this->input->post("telefono"); 
            $correo=$this->input->post("correo"); 
            $direccion=$this->input->post("direccion"); 
            $numero_direccion=$this->input->post("numero_direccion"); 
            $comuna=$this->input->post("comuna"); 
            $educacion=$this->input->post("educacion"); 
            $anio=$this->input->post("anio"); 
            $modalidad=$this->input->post("modalidad"); 
            $curso=$this->input->post("curso"); 
            $opcion=$this->input->post("opcion"); 
            $this->load->model("insert_Model");
          $estado=$this->insert_Model->actualizar_solicitud($id_codigo,$run,$nombre,$paterno,$materno,$sexo,$nacimiento
                    ,$telefono,$correo,$direccion,$numero_direccion,$comuna,$educacion,$anio,$modalidad,
                    $curso,$opcion);
             $total=$this->total_pendientes();
             $datos=$this->lista_datos();
             if($estado){ $mensaje="<script>alert('Actualizacion exitosa');</script>";}  else 
            {
                 $mensaje="<script>alert('Error al actualizar');</script>";
             }
             $this->load->view("solicitudes_view",compact("total","datos","mensaje"));
         }else{
             $total=$this->total_pendientes();
             $this->load->view("formulario_solicitud_view",compact("total"));
         }
     }
    public function usuario_solicitudes(){
        $estado="Pendiente";
         $this->load->model("insert_Model");
        $datos =$this->insert_Model->solicitudes_pendientes($estado);
         $total=$this->insert_Model->contar_pendientes();
          
        $this->load->view('solicitudes_view',compact("datos","total"));
     }
    public function buscar_solicitudes(){
       $this->load->model("insert_Model");
        $total=$this->insert_Model->contar_pendientes();
        $this->load->view('buscador_solicitudes_view',  compact("total"));
     }
    public function salir(){
        session_start(); 
        session_unset($_SESSION);
        session_unset();

        $this->load->view('login_view');
     }
     public function info()
     {
         $codigo=$this->input->post("codigo");
         $this->load->model("insert_Model");
        $dato=$this->insert_Model->ver_solicitud($codigo);
        if($dato->num_rows()>0)
        {
          $panel=$this->extraer_datos($dato);
         $btn=$this->imprimir_boton($codigo);
         $total=$this->total_pendientes();
         $datos=$this->lista_datos();
         $this->load->view("solicitudes_view",  compact("panel","btn","total","datos"));
        }
     }
     public function info_todos()
     {
         $codigo=$this->input->post("codigo");
         $this->load->model("insert_Model");
        $dato=$this->insert_Model->ver_solicitud($codigo);
        if($dato->num_rows()>0)
        {
          $panel=$this->extraer_datos($dato);
         $btn=$this->imprimir_boton($codigo);
         $total=$this->total_pendientes();
         $datos=$this->insert_Model->solicitudes_todas();
         $this->load->view("solicitudes_todas_view",  compact("panel","btn","total","datos"));
        }
     }
     public function info_por_rut()
     {
            $fecha_min=null;
            $fecha_max=null;
         if(null!==$this->input->post("f_min")){
             $fecha_min =$this->input->post("f_min");
             $fecha_max =$this->input->post("f_max");
         }
         $codigo=$this->input->post("codigo");
         $run=$this->input->post("run");
         $this->load->model("insert_Model");
        $dato=$this->insert_Model->ver_solicitud($codigo);
        if($dato->num_rows()>0)
        {
          $panel=$this->extraer_datos($dato);
         $btn=$this->imprimir_boton($codigo);
         $total=$this->total_pendientes();
         if(is_null($fecha_min) && is_null($fecha_max)){
             
         $datos=$this->insert_Model->insert_Model->tabla_porRun($run);
             
        $this->load->view("buscador_solicitudes_view",  compact("panel","btn","total","datos"));
         }else{
              $datos=$this->insert_Model->tabla_porfecha($fecha_min,$fecha_max);
             $this->load->view("buscador_solicitudes_view",  compact("panel","btn","total","datos","fecha_max","fecha_min"));
         }
          
        }
     }
    
     public function eliminar(){
         $codigo=$this->input->post("codigo");
         $this->load->model("insert_Model");
         $estado=$this->insert_Model->eliminar_solicitud($codigo);
         if($estado){
             $mensaje="<script>alert('Solicitud eliminada correctamente');</script>";
         }else{
            $mensaje="<script>alert('No se puede eliminar la solicitud');</script>"; 
         }
         $datos=$this->lista_datos();
         $total=$this->total_pendientes();
         $this->load->view("solicitudes_view",  compact("mensaje","total","datos"));
     }
    public function ObtenerIdUsuario($datos){
        $id="";
        foreach ($datos->result() as $fila) {
           $id=$fila->id_tipo_usuario; 
        }
        return $id;
    } 
    public function ingresar(){
        $this->form_validation->set_rules("run","Run","required");
        $this->form_validation->set_rules("clave","Clave","required");
         if($this->form_validation->run()===true){
           $run=$this->input->post("run");
           $run=substr($run, 0,8) ;
           $clave=$this->input->post("clave");
           $this->load->model('insert_Model');
//          $dato=$this->insert_Model->validar($run,$clave);
          $dato=$this->insert_Model->validar_completo1($run,$clave);
          
        if($dato->num_rows()>0){
//           $this->inicializar_session($dato);
            
            $num_tipo = $this->ObtenerIdUsuario($dato);
            if($num_tipo==2){
            
           $total=$this->insert_Model->contar_pendientes();
          
           $this->load->view('inicio_usuario_view', compact("dato","total"));
            }else if($num_tipo==3){
               $this->load->view('inicio_usuario_postulante_view',  compact("dato"));  
            }
        }else{
           
         $mensaje1="<div class='alert alert-danger'>
                        <button class='close' data-dismiss='alert'>
                           <span>&times</span>  
                        </button>
                         Datos incorrectos si no estas registrado haz Click en crear cuenta! &nbsp;</div> "; 
         $this->load->view('login_view', compact('mensaje1'));
        }
        
       }else{
           
           $this->load->view('login_view');
       }
      
     }
     public function inicializar_session($dato){
         session_start();
          foreach ($dato->result() as $fila) {
          $_SESSION['nombre']=$fila->nombre; 
          $_SESSION['apellido']=$fila->apellido_p;  
          $_SESSION['run']=$fila->run_persona;  
            
          
       } 
       
     }
     public function panel_estado_soli ($estado){
         $panel_estadao_usuario="";
         switch ($estado) {
             case "Aprobado":
                 $panel_estadao_usuario="<div class='modal fade' id='ventana1'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            
                            <div class='modal-header'>
                                <button type='button' class='close'
                                        data-dismiss='modal' aria-hidden='true'>&times;</button>
                                <h4>Información de la postulación</h4>
                            </div>
                            <div class='modal-body'>
                                <div class='row'>
                                <div class='container'>
                               <h3> Estado de la solicitud ".$estado."</h3>
                                   <h5>Dentro de un plazo máximo de 48 horas,uno de nuestros ejecutivos <br>se pondra en contacto con usted</h5>
                                   </div>
                                  </div>  
                             </div> 
                                <div class='modal-footer'>
                                    
                                   <button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar consulta</button>

                                 </div>
                            </div>
                        </div>
                    </div>";
                 
                 break;

             case "Pendiente":
                 $panel_estadao_usuario="<div class='modal fade' id='ventana1'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            
                            <div class='modal-header'>
                                <button type='button' class='close'
                                        data-dismiss='modal' aria-hidden='true'>&times;</button>
                                <h4>Información de la postulación</h4>
                            </div>
                            <div class='modal-body'>
                                <div class='row'>
                                <div class='container'>
                               <h3> Estado de la solicitud ".$estado."</h3>
                                   
                                   </div>
                                  </div>  
                             </div> 
                                <div class='modal-footer'>
                                    
                                   <button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar consulta</button>

                                 </div>
                            </div>
                        </div>
                    </div>";
                 break;
             case "Rechazado" :
                 $panel_estadao_usuario="<div class='modal fade' id='ventana1'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            
                            <div class='modal-header'>
                                <button type='button' class='close'
                                        data-dismiss='modal' aria-hidden='true'>&times;</button>
                                <h4>Información de la postulación</h4>
                            </div>
                            <div class='modal-body'>
                                <div class='row'>
                                <div class='container'>
                               <h3> Estado de la solicitud ".$estado."</h3>
                                   <h5>Para mas información puede llamarnos al número que aparece<br> en nuestra pagina oficial</h5>
                                   </div>
                                  </div>  
                             </div> 
                                <div class='modal-footer'>
                                    
                                   <button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar consulta</button>

                                 </div>
                            </div>
                        </div>
                    </div>";
                 break;
         }
          
          return $panel_estadao_usuario;
     }
     
     public function imprimir_boton($codigo){
         
         return $boton="<a href='#ventana1' class='btn btn-primary ' data-toggle='modal'>Ver datos consultados de la ficha con código ".$codigo."</a>";
     }
     public function extraer_datos($dato){
         
          
          
         foreach ($dato->result() as $fila) {
           $run=$fila->num_run;
           $dv_run=$fila->dv_run;
           $nombre=$fila->nombre;
           $paterno=$fila->apellido_p;
           $materno=$fila->apellido_m;
           $nacimiento=$fila->fecha_nacimiento;
           $sexo=$fila->sexo;
           $telefono=$fila->telefono;
           $email=$fila->email;
           $direccion=$fila->direccion;
           $num_direccion=$fila->num_direccion;
           $comuna=$fila->comuna;
           $educacion=$fila->educacion;
           $anio=$fila->anio;
           $modalidad=$fila->modalidad;
           $curso=$fila->curso;
           $codigo=$fila->id_solicitud;
           
         }
         $date = new DateTime($nacimiento);
         $fecha=$date->format('d-m-Y');
        $panel=" <div class='modal fade' id='ventana1'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            
                            <div class='modal-header'>
                                <button type='button' class='close'
                                        data-dismiss='modal' aria-hidden='true'>&times;</button>
                                <h4>Ficha del postulante ".$nombre." ".$paterno."</h4>
                            </div>
                            <div class='modal-body'>
                                <div class='row'>
                                <div class='container col-md-4'>           
                                    <div class='form-group'>
                                    <label >Run</label>
                                     <input class='form-control' value='".$run."-".$dv_run."' disabled/>
                                    </div>
                               </div>   
                                <div class='container col-md-4'>           
                                    <div class='form-group'>
                                    <label >Nombre</label>
                                     <input class='form-control' value='".$nombre."' disabled/>
                                    </div>
                               </div>   
                                <div class='container col-md-4'>           
                                    <div class='form-group'>
                                    <label >Apellido paterno</label>
                                     <input class='form-control' value='".$paterno."'  disabled/>
                                    </div>
                               </div>   
                                </div>    
                                <div class='row'>
                                <div class='container col-md-4'>           
                                    <div class='form-group'>
                                    <label >Apellido materno</label>
                                     <input class='form-control' value='".$materno."' disabled/>
                                    </div>
                               </div>   
                                <div class='container col-md-4'>           
                                    <div class='form-group'>
                                    <label >Fecha nacimiento</label>
                                     <input class='form-control' value='".$fecha."'  disabled/>
                                    </div>
                               </div>   
                                <div class='container col-md-4'>           
                                    <div class='form-group'>
                                    <label >Sexo</label>
                                     <input class='form-control' value='".$sexo."' disabled/>
                                    </div>
                               </div>   
                                </div>    
                                <div class='row'>
                                <div class='container col-md-4'>           
                                    <div class='form-group'>
                                    <label >Teléfono</label>
                                     <input class='form-control' value='".$telefono."' disabled/>
                                    </div>
                               </div>   
                                <div class='container col-md-4'>           
                                    <div class='form-group'>
                                    <label >Email</label>
                                     <input class='form-control' value='".$email."' disabled/>
                                    </div>
                               </div>   
                                <div class='container col-md-4'>           
                                    <div class='form-group'>
                                    <label >Dirección</label>
                                     <input class='form-control' value='".$direccion." #".$num_direccion." ' disabled/>
                                    </div>
                               </div>   
                                </div>    
                                <div class='row'>
                                <div class='container col-md-4'>           
                                    <div class='form-group'>
                                    <label >Comuna</label>
                                     <input class='form-control' value='".$comuna."' disabled/>
                                    </div>
                               </div>   
                                <div class='container col-md-4'>           
                                    <div class='form-group'>
                                    <label >Educación</label>
                                     <input class='form-control' value='".$educacion."' disabled/>
                                    </div>
                               </div>   
                                <div class='container col-md-4'>           
                                    <div class='form-group'>
                                    <label >Experiencia laboral</label>
                                     <input class='form-control' value='".$anio." años'  disabled/>
                                    </div>
                               </div>   
                                </div>  
                                <div class='row'>
                                  <div class='container col-md-4'>           
                                    <div class='form-group'>
                                    <label >Modalidad</label>
                                     <input class='form-control' value='".$modalidad."'  disabled/>
                                    </div>
                               </div>   
                                  <div class='container col-md-4'>           
                                    <div class='form-group'>
                                    <label >Curso</label>
                                     <input class='form-control' value='".$curso."'  disabled/>
                                    </div>
                               </div>   
                                  <div class='container col-md-4'>           
                                    <div class='form-group'>
                                        <label >Códido de solicitud</label>
                                     <input class='form-control' value='".$codigo."'  disabled/>
                                    </div>
                               </div>   
                                </div>
                             </div> 
                                <div class='modal-footer'>

                                   <button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar consulta</button>

                                 </div>
                            </div>
                        </div>
                    </div>";
        return $panel;
     }
     public function buscar_por_fechas(){
         
        $fecha_min= $this->input->post("fecha_inicio");
        $fecha_max= $this->input->post("fecha_final");
     
        if($fecha_min>$fecha_max){
         $mensaje_fecha="<div class='alert alert-danger'>
                        <button class='close' data-dismiss='alert'>
                           <span>&times</span>  
                        </button>
                           La fecha de inicio no debe ser mayor a la fecha final! ! &nbsp;</div> ";
          $total=$this->total_pendientes();
          $this->load->view('buscador_solicitudes_view',compact("total","mensaje_fecha"));
       }else {
     $this->load->model("insert_Model");
       $datos=$this->insert_Model->tabla_porfecha($fecha_min,$fecha_max);
       if(is_null($datos)){
         $total=$this->total_pendientes();
                  $mensaje_fecha="<div class='alert alert-danger'>
                        <button class='close' data-dismiss='alert'>
                           <span>&times</span>  
                        </button>
                           No se encuentra una solicitud con las fechas ingresadas ! &nbsp;</div> ";
      
      $this->load->view('buscador_solicitudes_view',compact("total","mensaje_fecha"));
           
      }else{
            $total=$this->total_pendientes();
            $this->load->view('buscador_solicitudes_view',compact("total","datos","fecha_min","fecha_max"));
       }
       }
        
        
     }
     
     public function info_solicitud_postulante(){
         
         $this->load->model("insert_Model");
         $code=$this->input->post("codigo");
         $run=$this->input->post("run");
         $estado_solicitud=$this->insert_Model->ver_estado_postulante($code);
         $panel_estados=$this->panel_estado_soli($estado_solicitud);
         $btn=$this->imprimir_boton($code);
           $this->load->model("insert_Model");
         $datos=$this->insert_Model->listar_estado_run($run);
         $this->load->view("historial_solicitudes_postulante_view",  compact("panel_estados","btn","datos"));
         
     }
     
     public function listar_por_run_postulante($run){//se lista todas las del uauario
         $this->load->model("insert_Model");
         $datos=$this->insert_Model->listar_estado_run($run);
         if(is_null($datos)){
          $mensaje_alerta="<div class='alert alert-danger'>
                        <button class='close' data-dismiss='alert'>
                           <span>&times</span>  
                        </button>
                           Lo sentimos usted no cuenta con solicitudes realizadas! &nbsp;</div> ";   
           $this->load->view("historial_solicitudes_postulante_view", compact("datos","mensaje_alerta"));
         }else{
             $this->load->view("historial_solicitudes_postulante_view", compact("datos","mensaje_alerta"));
         }
     }

     public function listar_por_run(){
         $datos="";
         $this->form_validation->set_rules('run',"Run","required");
         if($this->form_validation->run()===true){
             $run_completo=$this->input->post("run");
             $this->load->model("insert_Model");
             
             $datos=$this->insert_Model->solicitud_por_run($run_completo);
             if(is_null($datos)){
                  $total=$this->total_pendientes();
                  $mensaje_busqueda="<div class='alert alert-danger'>
                        <button class='close' data-dismiss='alert'>
                           <span>&times</span>  
                        </button>
                           No se encuentra una solicitud con el Run ingresado ! &nbsp;</div> ";
                 $this->load->view('buscador_solicitudes_view',compact("total","mensaje_busqueda"));
             }else{
                 $total=$this->total_pendientes();
                 $this->load->view('buscador_solicitudes_view',compact("total","datos"));
             }
             
             }else{
                  $total=$this->total_pendientes();
                 $this->load->view('buscador_solicitudes_view',compact("total"));
             }
     
     }
   
      /*------------ funciones roro------------*/
      function solicitud() {
        $this->load->model('insert_model');
        $datos = $this->insert_model->buscarPersona("11111111");
        $this->load->view('Registrar_solicitud_view', compact('datos'));
    }

   
    
       
    

    function insertarSolicitud() {
        $this->load->model('insert_model');
        $datos = $this->insert_model->buscarPersona("22222222");//variable session
        $aniosexperiencia = $this->input->post('aniosexperiencia');
        $curso = $this->input->post('curso');
        $modalidad = $this->input->post('modalidad');
        $fecha_origen = date("Y-m-d");
        $num_run = $this->input->post('num_run');
        $mensaje = "";
        if ($this->insert_model->insertarSolicitud($aniosexperiencia, $curso, $modalidad, $fecha_origen, $num_run)) {
            $mensaje = "Solicitud Registrada";
        } else {
            $mensaje = "Solicitud No Registrada";
        }


        $this->load->view('Registrar_solicitud_view', compact('datos', 'mensaje'));
    }

    
    function buscar()
    {
        $subrun = $this->input->post('run');
        $num_run = substr($subrun, 0, 8);
        $this->load->model('insert_model');
        $mensaje="";
        $persona=$this->insert_model->buscarPersona($num_run);
        if ($persona->num_rows()>0) {
            $mensaje="existe";
        }  else if ($persona->num_rows()==0) {           
        
        $mensaje="no existe";    
        }
        $this->load->view('Login',  compact('mensaje'));
        
        
        
    }
    
    /*-------------- funciones roro-----*/
    
    function insertarusu() {
        
        $mensaje = "";
        $this->load->model('insert_model');
        $subrun = $this->input->post('run');
        $num_run = substr($subrun, 0, 8);
        $persona = $this->insert_model->buscarPersona($num_run);
        $email = $this->input->post('email');
        $mail=$this->insert_model->buscarEmail($email);
        if ($this->form_validation->run()===TRUE)
            {
            if ($persona->num_rows() > 0 ) { 
                $mensaje='El run ya se encuentra registrado';  
                
            }  else if ($mail->num_rows()>0) {
                $mensaje="El E-mail ya se encuentra registrado";
                }else
                    {
                     $dv_run = substr($subrun, 9, 1);
                $nombre = $this->input->post('nombre');
                $apellido_p = $this->input->post('apellido_p');
                $apellido_m = $this->input->post('apellido_m');
                $clave = $this->input->post('clave');



                $fechaNacimiento = $this->input->post('fechaNacimineto');
                $fecha = date("Y-m-d", strtotime($fechaNacimiento));

                $telefono = $this->input->post('telefono');
                $sexo = $this->input->post('sexo');
                $direccion = $this->input->post('direccion');
                $comuna = $this->input->post('comuna');
                $educacion = $this->input->post('educacion');
                
                $num_direccion = $this->input->post('num_direccion');

                if ($this->insert_model->insertarPersona($num_run, $dv_run, $nombre, $apellido_p, $apellido_m, $clave, $fecha, $telefono, $sexo, $direccion, $num_direccion, $comuna, $educacion, $email) && $this->insert_model->insertarusuario($num_run, $clave)) {

                    $mensaje = "Usuario registrado";
                } else {

                    $mensaje = "Usuario no registrado";
                }
                    
                    }
            
            }
                
                
            
            $this->load->view('registro_usuario_view', compact('mensaje'));
            }
        
        
     /*--------------funciones roro------*/
    
      public  function crear_cuenta_usuario(){
        
        $mensaje = "";
        $this->load->model('insert_model');
        $subrun = $this->input->post('run_nuevo');
        $num_run = substr($subrun, 0, 8);
        $persona = $this->insert_model->buscarPersona($num_run);
        $email = $this->input->post('correo_nuevo');
        $mail=$this->insert_model->buscarEmail($email);
       
            if ($persona->num_rows() > 0 ) { 
                $mensaje = "<div class='row'><div class='container'>
                <div class='col-md-4'>
                    <div class='alert alert-danger'>
                        <button class='close' data-dismiss='alert'>
                            <span>&times</span>
                        </button>
                      El run ya se encuentra registrado!
                    </div> </div> </div></div>";
                
            }  else if ($mail->num_rows()>0) {
                $mensaje="<div class='row'><div class='container'><div class='col-md-4'><div class='alert alert-danger'>
                        <button class='close' data-dismiss='alert'>
                           <span>&times</span>  
                        </button>El correo electrónico ya existe!
                    </div></div></div></div>";
                }else
                    {
                $dv_run = substr($subrun, 9, 1);
                $nombre = $this->input->post('nombre_nuevo');
                $apellido_p = $this->input->post('paterno_nuevo');
                $apellido_m = $this->input->post('materno_nuevo');
                $clave = $this->input->post('clave1');

                $fechaNacimiento = $this->input->post('nacimiento_nuevo');
                $fecha = date("Y-m-d", strtotime($fechaNacimiento));

                $telefono = $this->input->post('telefono_nuevo');
                $sexo = $this->input->post('sexo');
                $direccion = $this->input->post('direccion_nuevo');
                $comuna = $this->input->post('nueva_comuna');
                $educacion = $this->input->post('educacion_nueva');
                
                $num_direccion = $this->input->post('num_direccion_nuevo');

                if ($this->insert_model->insertarPersona($num_run, $dv_run, $nombre, $apellido_p, $apellido_m, $clave, $fecha, $telefono, $sexo, $direccion, $num_direccion, $comuna, $educacion, $email) && $this->insert_model->insertarusuario($num_run, $clave)) {

                    $mensaje = "<div class='row'><div class='container'>
                        <div class='header'>
                <div class='col-md-4'>
                    Usuario creado exitosamente
                    </div> </div> </div></div>";
                } else {

                    $mensaje = " <div class='row'><div class='container'><div class='col-md-4'><div class='alert alert-danger'>
                        <button class='close' data-dismiss='alert'>
                           <span>&times</span>  
                        </button>No se puedo crear la cuenta de usuario
                    </div></div></div></div>  ";
                }
                    
                    }
            
          
                
                
            
            $this->load->view('crear_cuenta_usuario_view', compact('mensaje'));
            }
        /*--------------------   ---------------------------*/
            public function ingresar_postulacion_datos(){
                $this->form_validation->set_rules("anio","anio","required|numeric");
                $this->form_validation->set_rules("modalidad","Modalidad","required");
                $this->form_validation->set_rules("curso","Curso","required");
                if($this->form_validation->run()===true){
                  $run=$this->input->post("rut");
                  $anio=$this->input->post("anio");
                  $modalidad=$this->input->post("modalidad");
                  $curso=$this->input->post("curso");
                  $fecha_origen = date("Y-m-d");
                   $this->load->model("insert_Model");
                  $estado=$this->insert_Model->insertarSolicitud_postulante ($anio,$curso,$modalidad,$fecha_origen,$run);
                   if($estado===true){
                     
                  $mensaje = " <div class='row'><div class='container'><div class='col-md-4'><div class='alert alert-success'>
                        <button class='close' data-dismiss='alert'>
                           <span>&times</span>  
                        </button>Registro exitoso.
                    </div></div></div></div>  ";
                   }else{
                      $mensaje = " <div class='row'><div class='container'><div class='col-md-4'><div class='alert alert-danger'>
                        <button class='close' data-dismiss='alert'>
                           <span>&times</span>  
                        </button>No se puedo registrar la solicitud.
                    </div></div></div></div>  ";
                   }
                    $datos=$this->insert_Model->buscar_datos_run($run);
                foreach ($datos->result() as $fila) {
                      $num_run=$fila->num_run;
                       $dv_run=$fila->dv_run;
                       $nombre=$fila->nombre;
                       $apellido_p=$fila->apellido_p;
                       $apellido_m=$fila->apellido_m;
                       $sexo=$fila->sexo;
                       $fecha_nacimiento=$fila->fecha_nacimiento;
                       $telefono=$fila->telefono;
                      $email=$fila->email;
                      $direccion=$fila->direccion;
                      $num_direccion=$fila->num_direccion;
                     $comuna= $fila->comuna;
                     $educacion=$fila->educacion;
                }
                   
                   $this->load->view("crear_solicitud_postulante_view",  compact("mensaje","num_run","dv_run","nombre","apellido_p",
                           "apellido_m","sexo","fecha_nacimiento","telefono","email","direccion","num_direccion","comuna","educacion"));
                }else{
                    $this->load->view("crear_solicitud_postulante_view");
                }
                
            }
    
}
