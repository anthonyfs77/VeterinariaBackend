<?php

namespace proyecto\Controller;
use proyecto\Models\Clientes;
use proyecto\Response\Failure;
use proyecto\Response\Success;
use proyecto\Models\Table;
use proyecto\Models\Models;




class RegistroController {
    function registrar() {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);;
            $reg = new Clientes();
            $reg->nombre = $dataObject->nombre;
            $reg->apellido = $dataObject->last;
            $reg->correo = $dataObject->correo;
            $reg->telefono1 = $dataObject->tel1;
            $reg->telefono2 = $dataObject->tel2;
            $reg->contraseña = $dataObject->contrasena;

            $reg->save();
            $r = new Success($reg);

            return $r->send();

        } catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage()); 
            return $r->send();
        }
    }

    function mostrarR() {
        $t = Table::query("select * from clientes");
        $r = new Success($t);
        return $r->send();
    }
}
