<?php
namespace proyecto\Controller;
use proyecto\models\Table;
use proyecto\Response\Success;
use proyecto\Models\Citas;
use proyecto\Models\Animales;
use proyecto\Models\Clientes;
use proyecto\Models\citas_tservicios;
use proyecto\Response\Failure;


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
            $cita->fecha_registro = date('Y-m-d H:i:s');        
            $cita->fecha_cita = $dataObject->fechaCita;
            $cita->id_mascota = $dataObject->id_mascota;
            $cita->estatus = $dataObject->estatus;
            $cita->motivo = $dataObject->motivo;
            $cita->save();

            foreach( $dataObject->servicios as $item){
                $cs = new citas_tservicios;
                $cs -> cita = $cita -> id;
                $cs -> tipo_servicio = $item;
                $cs -> save();
            }
    
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


    function ServiciosClinicos () {

        try{

            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
            
            $resultados = Table::query("SELECT * FROM ServiciosClinicos;) ");

            $r = new Success($resultados);
            return $r->Send();
        }catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }

    function ServiciosEsteticos () {

        try{

            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
            
            $resultados = Table::query("SELECT * FROM ServiciosEsteticos;) ");

            $r = new Success($resultados);
            return $r->Send();
        }catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }

    // generar cliente, mascota y cita
    function CrearRegistroVeterinario() {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
    
            $cliente = new Clientes();
            $cliente->nombre = $dataObject->nombre;
            $cliente->apellido = $dataObject->apellido;
            $cliente->telefono1 = $dataObject->telefono1;
            $cliente->telefono2 = $dataObject->telefono2;
            $cliente->save();
    
            if(!$cliente || !isset($cliente->id)) {
                $r = new Failure(400, "Hubo un error al crear el cliente.");
                return $r->send();
            }
    
            $animal = new Animales();
            $animal->nombre = $dataObject->nombre_animal;
            $animal->propietario = $cliente->id;
            $animal->especie = $dataObject->especie;
            $animal->raza = $dataObject->raza;
            $animal->genero = $dataObject->genero;
            $animal->save();
    
            if(!$animal || !isset($animal->id)) {
                $r = new Failure(400, "Hubo un error al registrar el animal.");
                return $r->send();
            }
    
            $cita = new Citas();
            $cita->fecha_registro = date('Y-m-d H:i:s');
            $cita->fecha_cita = $dataObject->fecha_cita;
            $cita->id_mascota = $animal->id;
            $cita->estatus = $dataObject->estatus;
            $cita->motivo = $dataObject->motivo;
            $cita->save();
    
            if(!$cita) {
                $r = new Failure(400, "Hubo un error al programar la cita.");
                return $r->send();
            }
    
            $r = new Success("Datos registrados exitosamente.", [
                'cliente' => $cliente,
                'animal' => $animal,
                'cita' => $cita
            ]);
    
            return $r->send();
    
        } catch (\Exception $e) {
            $r = new Failure(500, $e->getMessage());
            return $r->send();
        }
    }
    

}




