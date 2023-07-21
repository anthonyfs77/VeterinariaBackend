<?php

namespace proyecto\Controller;
use proyecto\Models\Clientes;
use proyecto\Response\Failure;
use proyecto\Response\Success;
use proyecto\models\Table;


class RegistroController{
    function registrar(){
        try{
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
            $reg = new clientes();
            $reg->nombre = $dataObject->nombre;
            $reg->apellido = $dataObject->last;
            $reg->correo = $dataObject->correo;
            $reg->telefono1 = $dataObject->tel1;
            $reg->telefono2  = $dataObject->tel2;
            $reg->contrasena = $dataObject->contrasena;
            
            $reg->save();
            $r = new Success($reg);
            
            return $r->send();

        }catch (\Exception $e){
            $r = new Failure(401,$e->getMessage("No se realizo el registro"));
            return $r->Send();
        }
    }

    function mostrarR(){
        $t=Table::query("select * from clientes");
        $r= new Success($t);
        return $r->Send();
    }
}