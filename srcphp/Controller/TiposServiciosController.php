<?php

namespace proyecto\Controller;
use proyecto\Models\tipos_servicios_borrador;
use proyecto\Response\Failure;
use proyecto\Response\Success;
use proyecto\models\Table;
use proyecto\Conexion;
use proyecto\Models\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TiposServiciosController{

    function crearServicioBorrador() {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
    
            $borrador = new tipos_servicios_borrador();
            $borrador->tipo_servicio = $dataObject->tipo_servicio;
            $borrador->id_servicio = $dataObject->id_servicio;
            $borrador->descripcion = $dataObject->descripcion;
            $borrador->image = $dataObject->image;
            
            $borrador->save();
    
            $r = new Response($borrador);
            return $r->Send();
        } catch (\Exception $e) {
            $r = new NotFoundException(500, $e->getMessage());
            return $r->Send();
        }
    }

    public function publicarServicio() {
        try {
          $JSONData = file_get_contents("php://input");
          $dataObject = json_decode($JSONData);
    
          $resultados = Table::queryParams("CALL MoverServicioAPublico(:id)", ["id" => $dataObject->id_servicio]);
    
          $r = new Success($resultados);
          return $r->Send();
        } catch (\Exception $e) {
          $r = new Failure(500, $e->getMessage());
          return $r->Send();
        }
      }
    
      public function despublicarServicio() {
        try {
          $JSONData = file_get_contents("php://input");
          $dataObject = json_decode($JSONData);
    
          $resultados = Table::queryParams("CALL MoverServicioABorrador(:id)", ["id" => $dataObject->id_servicio]);
    
          $r = new Success($resultados);
          return $r->Send();
        } catch (\Exception $e) {
          $r = new Failure(500, $e->getMessage());
          return $r->Send();
        }
      }

      public static function obtenerTiposServiciosBorradorPorIdServicio()
      {
          try {
              $JSONData = file_get_contents("php://input");
              $dataObject = json_decode($JSONData);
      
              $resultados = Table::queryParams("CALL obtenerTiposServiciosBorradorPorIdServicio(:id_servicio)", ["id_servicio" => $dataObject->id_servicio]);
      
              $r = new Result\Success($resultados);
              return $r->Send();
          } catch (\Exception $e) {
              $r = new Result\Failure(500, $e->getMessage());
              return $r->Send();
          }
      }
      
      public static function obtenerTiposServiciosPublicosPorIdServicio()
      {
          try {
              $JSONData = file_get_contents("php://input");
              $dataObject = json_decode($JSONData);
      
              $resultados = Table::queryParams("CALL obtenerTiposServiciosPublicosPorIdServicio(:id_servicio)", ["id_servicio" => $dataObject->id_servicio]);
      
              $r = new Result\Success($resultados);
              return $r->Send();
          } catch (\Exception $e) {
              $r = new Result\Failure(500, $e->getMessage());
              return $r->Send();
          }
      }
      public static function obtenerTodosTiposServiciosBorradorView()
      {
          try {
              $resultados = Table::query("SELECT * FROM tipos_servicios_borrador_view");
  
              $r = new Result\Success($resultados);
              return $r->Send();
          } catch (\Exception $e) {
              $r = new Result\Failure(500, $e->getMessage());
              return $r->Send();
          }
      }
  
      public static function obtenerTodosTiposServiciosView()
      {
          try {
              $resultados = Table::query("SELECT * FROM tipos_servicios_view");
  
              $r = new Result\Success($resultados);
              return $r->Send();
          } catch (\Exception $e) {
              $r = new Result\Failure(500, $e->getMessage());
              return $r->Send();
          }
      }
  



}