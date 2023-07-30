<?php
namespace proyecto\Controller;
use proyecto\models\Table;
use proyecto\Response\Success;


class citasController {
    function mostrarCitasPendientes() {
        $t = Table::query("SELECT id, fecha_cita, motivo
        FROM citas
        WHERE estatus = 'pendiente'
        LIMIT 5;        
    ");
    $r = new Success($t);
    $json_response = json_encode($r);

    header('Content-Type: application/json');
    echo $json_response;


    }
}




