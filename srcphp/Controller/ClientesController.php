<?php

namespace proyecto\Controller;
use proyecto\Models\Clientes;
use proyecto\Response\Failure;
use proyecto\Response\Success;

class ClientesController{

    // Método para actualizar un cliente
    function actualizarCliente(){
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
    
            $id = $dataObject->id;
            $correo = $dataObject->correo;
            $contrasena = $dataObject->contrasena;
    
            // Crea una conexión PDO
            $db = new \PDO('mysql:host=localhost;dbname=veterinaria; port=3307; charset=utf8mb4', 'root', '');
    
            // Prepara la consulta SQL
            $sql = "UPDATE clientes SET correo = :correo, contrasena = :contrasena WHERE id = :id";
            $stmt = $db->prepare($sql);
    
            // Ejecuta la consulta
            $stmt->execute(['correo' => $correo, 'contrasena' => $contrasena, 'id' => $id]);
    
            $r = new Success($stmt->rowCount()); // Retorna la cantidad de filas afectadas
            return $r->send();
        } catch (\PDOException $e){
            $r = new Failure(401, $e->getMessage());
            return $r->send();
        }
    }
    
        // buscar cliente por nombre o id

        function buscarPorNombreOId(){
            try{
                $JSONData = file_get_contents("php://input");
                $dataObject = json_decode($JSONData);
                
                if(isset($dataObject->nombre)) {
                    $resultados = Clientes::where("nombre", "=", $dataObject->nombre);
                } else if(isset($dataObject->id)) {
                    $resultados = Clientes::find($dataObject->id);
                } else {
                    throw new \Exception("Debe proporcionar un nombre o ID para buscar.");
                }
    
                $r = new Success($resultados);
                return $r->Send();
            }catch (\Exception $e){
                $r = new Failure(404, $e->getMessage());
                return $r->Send();
            }
        }
        
    
    function consultarIDcliente() {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
    
            $cliente = Clientes::where('correo', $dataObject->correo)->first();
    
            if($cliente) {
                $r = new Success($cliente->id);
                return $r->send();
            } else {
                $r = new Failure(404, "No se encontró un cliente con el correo proporcionado.");
                return $r->send();
            }
        } catch (\Exception $e) {
            $r = new Failure(500, $e->getMessage());
            return $r->send();
        }
    }

    // obtener info del cliente x id
    
    function obtenerClientePorID() {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
    
            $cliente = Clientes::find($dataObject->id);
    
            if($cliente) {
                $r = new Success($cliente);
                return $r->send();
            } else {
                $r = new Failure(404, "No se encontró un cliente con el ID proporcionado.");
                return $r->send();
            }
        } catch (\Exception $e) {
            $r = new Failure(500, $e->getMessage());
            return $r->send();
        }
    }
    
    
}
