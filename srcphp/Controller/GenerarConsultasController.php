<?php

namespace proyecto\Controller;
use proyecto\Response\Failure;
use proyecto\Response\Success;
use proyecto\Models\Consultas;
use proyecto\Response\Response; 
use proyecto\Models\Table;
use proyecto\Models\Models;
use PDO;

class GenerarConsultasController{

    function RegistroConsulta (){

        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
    
           $Consulta = new Consulta();
           $Consulta->id_cita = $dataObject->id_cita;
           $Consulta->observaciones_medicas=$dataObject->observaciones;
           $Consulta->peso_kg = $dataObject->peso;
           $Consulta->altura_mts = $dataObject->altura;
           $Consulta->edad_meses = $dataObject->edad;
           $Consulta->dosis = $dataObject->dosis;
           $Consulta->id_productosInternos = $dataObject->id_productosInternos;

           $Consulta->save();
    
            $r = new Success($Consulta);
            return $r->Send();
        } catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
        }
    }

    function GenerarConsultas (){
        try{

            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
            
            $resultados = Table::query("SELECT * FROM GenerarConsultas ");

            $r = new Success($resultados);
            return $r->Send();
        }catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }

    function GenerarConsultasCliente () {

        try{

            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
            
            $resultados = Table::query("CALL GenerarConsultasCliente ('{$dataObject->Nombre}','{$dataObject->Apellido}') ");

            $r = new Success($resultados);
            return $r->Send();
        }catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }

    function GenerarConsultasFecha () {

        try{

            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
            
            $resultados = Table::query("CALL GenerarConsultasFecha ('{$dataObject->Fecha}') ");

            $r = new Success($resultados);
            return $r->Send();
        }catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }

    function BuscarMedicamentos (){
        try{

            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
            
            $resultados = Table::query("SELECT * FROM BuscarMedicamentos ");

            $r = new Success($resultados);
            return $r->Send();
        }catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }

}

  