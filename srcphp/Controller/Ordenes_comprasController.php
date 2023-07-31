<?php
namespace proyecto\Controller;
use proyecto\Models\Ordenes_compras;
use proyecto\Models\Productos;
use proyecto\Models\ProductosInternos;
use proyecto\Response\Failure;
use proyecto\Response\Success;
use proyecto\models\Table;
use proyecto\Conexion;
use proyecto\Models\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Ordenes_comprasController {
    function insertarCompra(){
        try{
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
    
            $orden = new Ordenes_compras();
            $orden->fecha_compra = $dataObject->fecha_compra;
            $orden->fecha_pago = $dataObject->fecha_pago;
            $orden->cantidad = $dataObject->cantidad;
            $orden->precio_compra = $dataObject->precio_compra;
            $orden->estado = $dataObject->estado;
            $orden->id_empleado = $dataObject->id_empleado;
            $orden->id_proveedores = $dataObject->id_proveedores;
            $orden->id_producto = $dataObject->id_producto;
            $orden->precio_total = $dataObject->precio_total;
            $orden->id_tipoproducto = $dataObject->id_tipoproducto;
    
            $orden->save();
    
            $r = new Success($orden);
            return $r->send();
    
        }catch (\Exception $e){
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }
    

    // obtener todo de ordenes compras
    function TablaOrdenesCompras () {
        try {
            $resultados = Table::query("SELECT * FROM VistaOrdenesCompras;");
    
            $r = new Success($resultados);
            return $r->Send();
        } catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }
    }

    // obtiene todos los nmbres e id de los productos y productos_internos dependiendo del parametro que reciba(1, 2)
    function obtenerProductos() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            if (!isset($data['id_tipoproducto'])) {
                $r = new Failure(400, "El campo id_tipoproducto no fue proporcionado.");
                return $r->send();
            }
            $opcion = $data['id_tipoproducto'];
    
            $resultados = Table::queryParams("CALL ObtenerProductos(:opcion)", ['opcion' => $opcion]);
    
            if($resultados) {
                $r = new Success($resultados);
                return $r->send();
            } else {
                $r = new Failure(404, "No se encontraron productos para la opción proporcionada.");
                return $r->send();
            }
        } catch (\Exception $e) {
            $r = new Failure(500, $e->getMessage());
            return $r->send();
        }
    }
    
}

