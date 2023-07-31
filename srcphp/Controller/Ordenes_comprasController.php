<?php
namespace proyecto\Controller;
use proyecto\Models\Ordenes_compras;
use proyecto\Response\Failure;
use proyecto\Response\Success;
use proyecto\models\Table;
use proyecto\Conexion;
use proyecto\Models\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Ordenes_comprasController {
    function insertarVenta()
    {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
    
            
            $result = $this->callInsertarCompraProcedure($JSONData);
    
            
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Procedimiento ejecutado correctamente', 'data' => $result]);
    
        } catch (\Exception $e) {
            $errorResponse = ['message' => "Error en el servidor: " . $e->getMessage()];
            header('Content-Type: application/json');
            echo json_encode($errorResponse);
            http_response_code(500);
        }
    }
    
    
    function callInsertarCompraProcedure($jsonData)
    {
        $result = Table::queryParams("CALL InsertarCompra(:jsonData)", ['jsonData' => $jsonData]);
        return $result;
    }
}

