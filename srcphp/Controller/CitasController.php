<?php

namespace proyecto\Controller;

use proyecto\Models\Models;
use proyecto\models\Table;
use proyecto\Response\Success;
use proyecto\Models\Citas;
use proyecto\Models\Animales;
use proyecto\Models\Clientes;
use proyecto\Response\Failure;

class citasController {
    function mostrarCitasPendientes() {
        $t = Table::query("SELECT id, fecha_cita, motivo
            FROM citas
            WHERE estatus = 'pendiente'
            LIMIT 5;");
        $r = new Success($t);
        $json_response = json_encode($r);
        $t = Table::query("SELECT *
        FROM citas
        WHERE DATE(fecha_cita) >= CURDATE() AND DATE(fecha_cita) <= CURDATE() + INTERVAL 2 DAY
        LIMIT 3;
        ");
    $r = new Success($t);
    $json_response = json_encode($r);

    header('Content-Type: application/json');
    echo $json_response;

        header('Content-Type: application/json');
        echo $json_response;
    }

    function agendarcita() {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $cita = new Citas();
            $cita->fecha_registro = date('Y-m-d H:i:s');
            $cita->fecha_cita = $dataObject->fechaCita;
            $cita->id_mascota = $dataObject->id_mascota;
            $cita->estatus = $dataObject->estatus;
            $cita->motivo = $dataObject->motivo;
            $cita->save();

            $r = new Success($cita);
            return $r->Send();
        } catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }

    function MascotasUsuario() {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $resultados = Table::query("CALL MascotasUsuario ('{$dataObject->id_cliente}') ");

            $r = new Success($resultados);
            return $r->Send();
        } catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }

    function ServiciosClinicos() {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $resultados = Table::query("SELECT * FROM ServiciosClinicos; ");

            $r = new Success($resultados);
            return $r->Send();
        } catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }

    function ServiciosEsteticos() {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $resultados = Table::query("SELECT * FROM ServiciosEsteticos; ");

            $r = new Success($resultados);
            return $r->Send();
        } catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }

    function CitasPendientesCliente() {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $resultados = Table::query(" CALL CitasPendientesCliente ('{$dataObject->id_cliente}') ");

            $r = new Success($resultados);
            return $r->Send();
        } catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }
    // generar cliente, mascota y cita
        function CrearRegistroVeterinario() {
            try {
                $JSONData = file_get_contents("php://input");
                $dataObject = json_decode($JSONData);
                
                // Preparar los parámetros
                $params = [
                    'nombre' => $dataObject->nombre,
                    'apellido' => $dataObject->apellido,
                    'telefono1' => $dataObject->telefono1,
                    'telefono2' => $dataObject->telefono2,
                    'nombre_animal' => $dataObject->nombre_animal,
                    'especie' => $dataObject->especie,
                    'raza' => $dataObject->raza,
                    'genero' => $dataObject->genero,
                    'fecha_cita' => $dataObject->fecha_cita,
                    'estatus' => $dataObject->estatus,
                    'motivo' => $dataObject->motivo
                ];
                
                // Llamada al procedimiento almacenado
                $resultados = Table::queryParams("CALL CrearRegistroVeterinario(:nombre, :apellido, :telefono1, :telefono2, :nombre_animal, :especie, :raza, :genero, :fecha_cita, :estatus, :motivo, @cliente_id, @animal_id, @cita_id)", $params);
                
                // Recuperar las IDs
                $ids = Table::queryParams("SELECT @cliente_id as clienteId, @animal_id as animalId, @cita_id as citaId");
                
                if($ids) {
                    $resultados['ids'] = $ids[0];
                } else {
                    throw new \Exception("Error al obtener las IDs después de insertar.");
                }
                
                $r = new Success("Datos registrados exitosamente.", $resultados);
                return $r->send();
                
            } catch (\Exception $e) {
                $r = new Failure(500, $e->getMessage());
                return $r->send();
            }
        }
    
}
