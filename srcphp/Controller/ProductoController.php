<?php

namespace proyecto\Controller;

use proyecto\Models\Productos;
use proyecto\Response\Failure;
use proyecto\Response\Success;
use proyecto\Models\Table;

class ProductoController
{
    function AgregarProducto()
    {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
            $pro = new productos();

            $pro->nom_producto = $dataObject->nom_producto;
            $pro->descripcion = $dataObject->descripcion;
            $pro->existencias = $dataObject->existencias;
            $pro->precio_venta = $dataObject->precio_venta;
            $pro->id_categoria = $dataObject->id_categoria;
            $pro->id_proveedor = $dataObject->id_proveedor;
            $pro->precio_compra = $dataObject->precio_compra;


            $pro->save();
            $r = new Success($pro);

            return $r->send();
        } catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage("No se añadio el producto"));
            return $r->Send();
        }
    }
}
