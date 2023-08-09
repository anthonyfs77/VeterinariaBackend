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
            
            $entities = [
                'cliente' => [
                    'model' => new Clientes(),
                    'data' => [
                        'nombre' => $dataObject->nombre,
                        'apellido' => $dataObject->apellido,
                        'telefono1' => $dataObject->telefono1,
                        'telefono2' => $dataObject->telefono2
                    ],
                    'error_message' => "Hubo un error al crear el cliente."
                ],
                'animal' => [
                    'model' => new Animales(),
                    'data' => [
                        'nombre' => $dataObject->nombre_animal,
                        'propietario' => $dataObject->cliente->id,
                        'especie' => $dataObject->especie,
                        'raza' => $dataObject->raza,
                        'genero' => $dataObject->genero
                    ],
                    'error_message' => "Hubo un error al registrar el animal."
                ],
                'cita' => [
                    'model' => new Citas(),
                    'data' => [
                        'fecha_registro' => date('Y-m-d H:i:s'),
                        'fecha_cita' => $dataObject->fecha_cita,
                        'id_mascota' => $dataObject->animal->id,
                        'estatus' => $dataObject->estatus,
                        'motivo' => $dataObject->motivo
                    ],
                    'error_message' => "Hubo un error al programar la cita."
                ]
            ];
            
            $results = [];
            foreach ($entities as $key => $entity) {
                foreach ($entity['data'] as $prop => $val) {
                    $entity['model']->$prop = $val;
                }
                $entity['model']->save();
                if (!$entity['model'] || !isset($entity['model']->id)) {
                    $r = new Failure(400, $entity['error_message']);
                    return $r->send();
                }
                $results[$key] = $entity['model'];
            }
    
            $r = new Success("Datos registrados exitosamente.", $results);
            return $r->send();
            
        } catch (\Exception $e) {
            $r = new Failure(500, $e->getMessage());
            return $r->send();
        }
    }
    
    

}
