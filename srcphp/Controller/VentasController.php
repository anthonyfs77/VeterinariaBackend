<?php

namespace proyecto\Controller;

use proyecto\Models\Table;
use proyecto\Response\Success;


class VentasController
{

    function fecha()
    {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $fechaI = $dataObject->fechaI;
            $fechaF = $dataObject->fechaF;

            $result = $this->ventasTot($fechaI, $fechaF);

            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (\Exception $e) {
            $errorResponse = ['message' => "Error en el servidor: " . $e->getMessage()];
            header('Content-Type: application/json');
            echo json_encode($errorResponse);
            http_response_code(500);
        }
    }


    function ventasTot($fechaI, $fechaF)
    {
        $t = table::queryParams("SELECT ventas.fecha, 
            COUNT(ventas.id) AS cantidad
            FROM ventas
            WHERE ventas.fecha BETWEEN :fechaI and :fechaF
            GROUP BY ventas.fecha", ['fechaI' => $fechaI, 'fechaF' => $fechaF]);

        return $t;
    }

    function mostrarVentasRecientes()
    {
        $t = Table::query("CALL ventasActuales()");
        $r = new Success($t);
        $json_response = json_encode($r);

        header('Content-Type: application/json');
        echo $json_response;
    }
}
