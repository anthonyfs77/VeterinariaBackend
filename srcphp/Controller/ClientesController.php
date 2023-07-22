<?php

namespace proyecto\Controller;
use proyecto\Models\Clientes;
use proyecto\Response\Failure;
use proyecto\Response\Success;
use proyecto\models\Table;

class ClientesController{
    
    // Método para actualizar un cliente
    function actualizarCliente(){
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            // Crear una nueva instancia del modelo
            $cliente = Clientes::find($dataObject->id);

            // Actualizar los datos del cliente
            $cliente->nombre = $dataObject->nombre;
            $cliente->apellido = $dataObject->apellido;
            $cliente->correo = $dataObject->correo;
            $cliente->telefono1 = $dataObject->telefono1;
            $cliente->telefono2 = $dataObject->telefono2;
            $cliente->contrasena = $dataObject->contrasena;
            
            // Guardar los cambios
            $cliente->save();

            $r = new Success($cliente);
            return $r->send();
        } catch (\Exception $e){
            $r = new Failure(401, $e->getMessage());
            return $r->send();
        }
    }
}
