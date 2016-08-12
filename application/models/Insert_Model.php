<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Insert_Model
 *
 * @author Pedrito
 */
class Insert_Model extends CI_Model {

    public function _construct() {
        parent::CI_Model;
    }

 
    
    function validar($num_run, $clave) {
       
        $dato=$this->db->get_where('usuario',array('run_persona'=>$num_run,'clave'=>$clave));
        
        return $dato;
    }
   function contar_pendientes(){
       $contador=$this->db->query("select count(solicitud.tipo_estado) as 'total'
from solicitud WHERE solicitud.tipo_estado='Pendiente'");
       foreach ($contador->result() as $fila) {
          $numero=$fila->total; 
       }
       return $numero;
   }
   public function validar_run_completo($run_completo){
       
       $num_run =substr($run_completo,0,-2);
       $dv_run =  substr($run_completo,-1 );
       
       $fila = $this->db->query("select * from persona, solicitud WHERE solicitud.run = persona.num_run and persona.dv_run='$dv_run'  and solicitud.run=$num_run");
       if($fila->num_rows()>0){
           
           return $fila;
       }else{
           return null;
       }
}

   

   public function solicitud_por_run($run_completo){
      $resultado = $this->validar_run_completo($run_completo);
      
      if(is_null($resultado)){
          return null;
      }else if($resultado->num_rows()>0){
           return $resultado;
       }
       
      
   }
  
   
   function ver_solicitud($codigo_solicitud){
       
      return $dato=$this->db->query("select persona.num_run ,persona.dv_run ,persona.nombre ,persona.apellido_p,persona.apellido_m,persona.fecha_nacimiento,
persona.sexo,persona.telefono,persona.email,persona.direccion,persona.num_direccion,persona.comuna,persona.educacion,
solicitud.anio,solicitud.modalidad,solicitud.curso,solicitud.id_solicitud,solicitud.tipo_estado
from persona,solicitud 
WHERE persona.num_run=solicitud.run and solicitud.id_solicitud=$codigo_solicitud");
   }
    function solicitudes_pendientes($estado) {
     
       $dato=$this->db->query("select solicitud.id_solicitud, solicitud.run ,persona.dv_run, persona.nombre,
           persona.apellido_p ,
           persona.apellido_m,solicitud.tipo_estado
from solicitud , persona 
where solicitud.run=persona.num_run and solicitud.tipo_estado='$estado'");
        
    return $dato;}
    function solicitudes_todas() {
     
      $dato=$this->db->query("select solicitud.id_solicitud, solicitud.run ,persona.dv_run, persona.nombre,
           persona.apellido_p ,
           persona.apellido_m,solicitud.tipo_estado
from solicitud , persona 
where solicitud.run=persona.num_run");
        
        
    return $dato;}
       
    function validar_completo($num_run, $clave) {
       
        $dato=$this->db->query("select persona.nombre ,persona.apellido_p ,usuario.run_persona
from persona  ,usuario  where persona.num_run = usuario.run_persona AND 
usuario.clave='$clave' AND usuario.run_persona='$num_run'");
        
        return $dato;
    }
    
    function buscar_datos_run($run){
        
        return $this->db->get_where("persona",array('num_run'=>$run));
    }
    
    function validar_completo1($num_run, $clave) {
$this->db->select("persona.nombre ,persona.apellido_p ,usuario.run_persona,tipousuario.descripcion,tipousuario.id_tipo_usuario");       
$this->db->join("persona", "persona.num_run = usuario.run_persona");
$this->db->join("tipousuario", "tipousuario.id_tipo_usuario = usuario.id_tipo_usuario");
$this->db->where("usuario.clave",$clave);
$this->db->where("usuario.run_persona",$num_run);
$datos = $this->db->get("usuario");
        
        return $datos;
    }
    
  
    function actualizar_solicitud($id_codigo,$run,$nombre,$paterno,$materno,$sexo,$nacimiento
                    ,$telefono,$correo,$direccion,$numero_direccion,$comuna,$educacion,$anio,$modalidad,
                    $curso,$opcion)
     {
         $ficha=$this->actualizar_ficha($id_codigo, $anio, $modalidad, $curso, $opcion);
   $data =array('nombre'=>$nombre,'apellido_p'=>$paterno,'apellido_m'=>$materno,'sexo'=>$sexo,
     'fecha_nacimiento'=>$nacimiento,'telefono'=>$telefono,'email'=>$correo,'direccion'=>$direccion ,'num_direccion'=>$numero_direccion,
         'comuna'=>$comuna,'educacion'=>$educacion);
    $this->db->where('num_run', $run);
     $personal= $this->db->update("persona",$data);
     if($personal){
         if($ficha)
         {
             return $ficha;
         }else{
             return false;
         }
     }
        
     }
   /*
   $estado=$this->db->query("update persona 
set persona.nombre ='$nombre' ,persona.apellido_p='$paterno',persona.apellido_m='$materno',persona.sexo='$sexo',persona.fecha_nacimiento='$nacimiento',
persona.telefono=$telefono,persona.email='$correo',persona.direccion='$direccion',persona.num_direccion=$numero_direccion,persona.comuna='$comuna',persona.educacion='$educacion'
where persona.num_run=$run");
    *     */                 
                    
   

function actualizar_solicitudes($tipo_estado, $id_solicitud) {
    $update = array(
        'tipo_estado' => $tipo_estado,
    );


    $this->db->where("id_solicitud", $id_solicitud);
    $this->db->update("solicitud", $update);
}




function eliminar_solicitud($codigo){
   return $this->db->query("delete from solicitud WHERE solicitud.id_solicitud=$codigo");
}

function tabla_porRun($run){
       
      $dato=$this->db->query("select solicitud.id_solicitud, solicitud.run ,persona.dv_run, persona.nombre,
           persona.apellido_p ,
           persona.apellido_m,solicitud.tipo_estado
from solicitud , persona 
where solicitud.run=persona.num_run and solicitud.run=$run");
      return $dato;
       
   }
function tabla_porfecha($fecha_min,$fecha_max){
       
      $dato=$this->db->query("select solicitud.id_solicitud, solicitud.run ,persona.dv_run, persona.nombre,
           persona.apellido_p ,
           persona.apellido_m,solicitud.tipo_estado
from solicitud , persona 
where solicitud.run=persona.num_run and solicitud.fecha_origen BETWEEN '$fecha_min' and '$fecha_max'");
    if($dato->num_rows()>0){
        return $dato;
    }else{
        return NULL;
    }
       
   }
    function actualizar_ficha($id_codigo,$anio,$modalidad,$curso,$opcion){
       
        $data=array('tipo_estado'=>$opcion,'modalidad'=>$modalidad,'curso'=>$curso,'anio'=>$anio
            );
        
      return  $this->db->update("solicitud",$data,array('id_solicitud'=>$id_codigo));
    }
 /*.----- funciones ----- */
 function insertarPersona($num_run,$dv_run,$nombre,$apellido_p,$apellido_m,$clave,$fechaNacimiento,$telefono,$sexo,$direccion,$num_direccion,$comuna,$educacion,$email) {
        
           $datosPersona = array(
            'num_run' => $num_run,
            'dv_run' => $dv_run,
            'nombre' => $nombre,
            'apellido_p' => $apellido_p,
            'apellido_m' => $apellido_m,
            'fecha_nacimiento' => $fechaNacimiento,
            'sexo' => $sexo,
            'telefono' => $telefono,
            'email' => $email,
            'direccion' => $direccion,
            'num_direccion' => $num_direccion,
            'educacion' => $educacion,
            'comuna' => $comuna);
       
        return $this->db->insert('persona', $datosPersona);
     
    }
    function insertarUsuario($num_run,$clave)
    {
             $datosUsuario=array
            ('id_tipo_usuario'=>3,
             'run_persona'=>$num_run,
            'clave'=>$clave
            
            );
        return $this->db->insert('usuario', $datosUsuario);
        
    }
    
    function buscarPersona($num_run) {
        
        return $query =$this->db->get_where('persona', array('num_run' => $num_run));
    }
    
        function buscarEmail($emal) {
        
        return $query =$this->db->get_where('persona', array('email' => $emal));
    }
    
    
    function insertarSolicitud($aniosexperiencia,$curso,$modalidad,$fecha_origen,$num_run) {
         $datosSolicitud=array
            ('tipo_estado'=>'Pendiente',
             'modalidad'=>$modalidad,
            'anio'=>$aniosexperiencia,
             'curso'=>$curso,
             'run'=>$num_run,
             'fecha_origen'=>$fecha_origen
            
            );
        return $this->db->insert('solicitud', $datosSolicitud);
    }
   /*.---- funciones ------ */
public function listar_estado_run($run){
    
    $datos=$this->db->query("SELECT solicitud.id_solicitud, solicitud.fecha_origen,
        solicitud.modalidad,solicitud.curso ,solicitud.run,persona.dv_run ,
        solicitud.tipo_estado ,solicitud.anio from solicitud ,persona WHERE 
        persona.num_run=solicitud.run and solicitud.run=$run
");
    if($datos->num_rows()>0){
    return $datos;
    }else{
        return null;
    }
}
public function ver_estado_postulante($code){
    $info =$this->db->query("select solicitud.tipo_estado from solicitud where solicitud.id_solicitud=$code");
    foreach ($info->result() as $fila) {
        $estado=$fila->tipo_estado;
    }
    return $estado;
}
/*------------------------ CREAR POSTLACION   ----------------------*/
  function insertarSolicitud_postulante ($aniosexperiencia,$curso,$modalidad,$fecha_origen,$num_run) {
         $datosSolicitud=array
            ('tipo_estado'=>'Pendiente',
             'modalidad'=>$modalidad,
             'anio'=>$aniosexperiencia,
             'curso'=>$curso,
             'run'=>$num_run,
             'fecha_origen'=>$fecha_origen
            
            );
        return $this->db->insert('solicitud', $datosSolicitud);
    }
}


