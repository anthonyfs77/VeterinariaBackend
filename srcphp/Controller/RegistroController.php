<?php
namespace proyecto\Controller;
use proyecto\models\clientes;
use proyecto\Response\Failure;
use proyecto\Response\Success;


class RegistroController{
    function registrar(){
        try{
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $reg = new clientes();
            $reg->nombre = $dataObject->nombre;
            $reg->last = $dataObject->last;
            $reg->contrasena = $dataObject->contrasena;
            $reg->correo = $dataObject->correo;
            $reg->tel1  = $dataObject->tel1;
            $reg->tel2 = $dataObject->tel2;

            $reg->save();
            $r = new Success($reg);

            return $r->Send();

        }catch (\Exception $e){
            $r = new Failure(401,$e->getMessage());
            return $r->Send();
        }
    }
}