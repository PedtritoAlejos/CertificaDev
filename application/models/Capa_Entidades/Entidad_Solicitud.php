<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Entidad_Solicitud
 *
 * @author Pedrito
 */
class Entidad_Solicitud {
    private $Id_solicitud;
    private $TipoEstado;
   
    
    public function get_Id_Solicitud(){
        return $this->Id_solicitud;
    }
    public function Set_Id_Solicitud($Id_solicitud){
        return $this->Id_solicitud=$Id_solicitud;
    }
}
