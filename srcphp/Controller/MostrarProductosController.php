<?php

namespace proyecto\Controller;

use proyecto\Response\Success;
use proyecto\Models\Table;

class MostrarProductosController
{

    /// MUESTRA DE PRODUCTOS 

    function mostrarP()
    {
        $t = Table::query("SELECT 
            id, 
            nom_producto, 
            descripcion,
            existencias,
            precio_venta, 
            precio_compra, 
            (precio_venta * 0.16) as iva,
            CASE 
                WHEN existencias <= 0 THEN 'Sin stock'
                ELSE 'Stock'
            END as estado
        FROM productos
        ");
        $r = new Success($t);
        $json_response = json_encode($r);

        header('Content-Type: application/json');
        echo $json_response;
    }

    function mostrarProductsInter()
    {
        $t = Table::query("SELECT 
        nom_producto,
        existencias,
        precio_venta,
        (precio_venta * 0.16) as iva,
        CASE 
            WHEN existencias <= 0 THEN 'Sin stock'
            ELSE 'Stock'
        END as estado
    FROM productos_internos;
    ");
        $r = new Success($t);
        $json_response = json_encode($r);

        header('Content-Type: application/json');
        echo $json_response;
    }


    function mostrarProductsPublic()
    {
        $t = Table::query("SELECT 
        id, 
        nom_producto, 
        descripcion,
        MAX(existencias) as existencias,
        MAX(precio_venta) as precio_venta, 
        MAX(precio_compra) as precio_compra, 
        (MAX(precio_venta) * 0.16) as iva,
        CASE 
            WHEN MAX(existencias) = 0 THEN 'Sin stock'
            ELSE 'Stock'
        END as estado
    FROM productos
    GROUP BY nom_producto;
    
");
        $r = new Success($t);
        $json_response = json_encode($r);

        header('Content-Type: application/json');
        echo $json_response;
    }



    // Mandar Rango de precios de productos internos

    function rangoPrecios()
    {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $minPrice = $dataObject->minPrice;
            $maxPrice = $dataObject->maxPrice;

            $productsInRange = $this->rangoPreciosQuery($minPrice, $maxPrice);

            header('Content-Type: application/json');
            echo json_encode($productsInRange);
        } catch (\Exception $e) {
            $errorResponse = ['message' => "Error en el servidor: " . $e->getMessage()];
            header('Content-Type: application/json');
            echo json_encode($errorResponse);
            http_response_code(500);
        }
    }

    function rangoPreciosQuery($minPrice, $maxPrice)
    {
        $t = table::queryParams("CALL obtener_productos_internos_por_precio(:minPrice,:maxPrice);
        ", ['minPrice' => $minPrice, 'maxPrice' => $maxPrice]);

        return $t;
    }


    // Mandar Rango de precios de productos Publicos

    function rangoPreciosPublics()
    {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $minPrice = $dataObject->minPrice;
            $maxPrice = $dataObject->maxPrice;

            $productsInRange = $this->rangoPreciosPublicQuery($minPrice, $maxPrice);

            header('Content-Type: application/json');
            echo json_encode($productsInRange);
        } catch (\Exception $e) {
            $errorResponse = ['message' => "Error en el servidor: " . $e->getMessage()];
            header('Content-Type: application/json');
            echo json_encode($errorResponse);
            http_response_code(500);
        }
    }

    function rangoPreciosPublicQuery($minPrice, $maxPrice)
    {
        $t = table::queryParams("CALL obtener_productos_publicos_por_rango_precio(:minPrice, :maxPrice)", ['minPrice' => $minPrice, 'maxPrice' => $maxPrice]);

        return $t;
    }


    // BUSQUEDA DE PRODUCTOS POR NOMBRE

    function buscarProducto()
    {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $nombre = $dataObject->nombre;

            $products = $this->buscarProductoQuery($nombre);

            $response = ['data' => $products];


            header('Content-Type: application/json');
            echo json_encode($response);
        } catch (\Exception $e) {
            $errorResponse = ['message' => "Error en el servidor: " . $e->getMessage()];
            header('Content-Type: application/json');
            echo json_encode($errorResponse);
            http_response_code(500);
        }
    }

    function buscarProductoQuery($nombre)
    {
        $t = table::queryParams("CALL ObtenerProductosPorNombre(:nombre)", ['nombre' => $nombre]);

        return $t;
    }


    //  PRODUCTOS POR NOMBRE INTERNOS
    function buscarProductoInterno()
    {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $nombre = $dataObject->nombre;

            $products = $this->buscarProductoInternoQuery($nombre);

            $response = ['data' => $products];


            header('Content-Type: application/json');
            echo json_encode($response);
        } catch (\Exception $e) {
            $errorResponse = ['message' => "Error en el servidor: " . $e->getMessage()];
            header('Content-Type: application/json');
            echo json_encode($errorResponse);
            http_response_code(500);
        }
    }

    function buscarProductoInternoQuery($nombre)
    {
        $t = table::queryParams("CALL ObtenerProductosInternosPorNombre(:nombre)", ['nombre' => $nombre]);

        return $t;
    }
}
