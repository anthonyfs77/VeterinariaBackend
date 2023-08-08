<?php

namespace proyecto\Controller;
use proyecto\Models\Proveedores;
use proyecto\Response\Failure;
use proyecto\Response\Success;
use proyecto\Models\Table;
use proyecto\Models\Models;
use PDO;

class ProveedorController {
    function registrarProveedor(){
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $Proveedor = new Proveedores();
            $Proveedor->empresa = $dataObject->empresa;
            $Proveedor->proveedor = $dataObject->nombre;
            $Proveedor->direccion=$dataObject->direccion;
            $Proveedor->telefono1=$dataObject->telefono1;
            $Proveedor->telefono2=$dataObject->telefono2;
    
            $Proveedor->save();
    
            $r = new Success($Proveedor);
            return $r->Send();
        } catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
        }
    }

    function TablaProveedor () {

        try{
    
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
            
            $resultados = Table::query("SELECT * FROM vistatablaproveedores;");
    
            $r = new Success($resultados);
            return $r->Send();
        }catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    
    }


    // obtener id, nombre de todos los provedores
    function NombreIDProveedor () {
        try {
            $resultados = Table::query("SELECT * FROM VistaProveedores;");
            $r = new Success($resultados);
            return $r->Send();
        } catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }  
    }
    
}