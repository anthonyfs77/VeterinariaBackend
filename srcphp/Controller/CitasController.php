<?php
namespace proyecto\Controller;
use proyecto\models\Table;
use proyecto\Response\Success;
use proyecto\Models\Citas;


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

    function agendarcita(){
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
    
            $cita = new Citas();
            $cita->fecha_registro = date('Y-m-d');
            $cita->fecha_cita = $dataObject->fechaCita;
            $cita->id_cliente = $dataObject->id_cliente;
            $cita->id_mascota = $dataObject->id_mascota;
            $cita->estatus = $dataObject->estatus;
            $cita->motivo = $dataObject->motivo;
            $cita->tipo_servicio = $dataObject->tipo_servicio;
            $cita->servicio = $dataObject->id_servicio;
            $cita->save();
    
            $r = new Success($cita);
            return $r->Send();
        } catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
        }
    }

    function MascotasUsuario () {

        try{

            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
            
            $resultados = Table::query("CALL MascotasUsuario ('{$dataObject->id_cliente}') ");

            $r = new Success($resultados);
            return $r->Send();
        }catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }

    function servicio () {

        try{

            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
            
            $resultados = Table::query("SELECT * FROM ObtenerServicios;) ");

            $r = new Success($resultados);
            return $r->Send();
        }catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }

    function tiposservicios () {

        try{

            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
            
            $resultados = Table::query("CALL ObtenerTSid ('{$dataObject->id_servicio}') ");

            $r = new Success($resultados);
            return $r->Send();
        }catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }

}




