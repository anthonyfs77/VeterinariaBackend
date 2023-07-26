<?php
namespace proyecto\Controller;
use proyecto\Response\Success;
use proyecto\Models\Table;

class MostrarProductosController{

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
                WHEN existencias = 0 THEN 'Sin stock'
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
            WHEN existencias = 0 THEN 'sin stock'
            ELSE 'con stock'
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
    nom_producto,
    existencias,
    precio_venta,
    precio_compra, 
    (precio_venta * 0.16) as iva,
    CASE 
        WHEN existencias = 0 THEN 'sin stock'
        ELSE 'con stock'
    END as estado
FROM productos;
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
    $t = table::queryParams("SELECT id, 
    nom_producto, 
    existencias, 
    precio_venta,  
    (precio_venta * 0.16) as iva,
    CASE 
        WHEN existencias = 0 THEN 'sin stock'
        ELSE 'con stock'
    END as estado
    FROM productos_internos
    WHERE precio_venta BETWEEN :minPrice and :maxPrice", ['minPrice' => $minPrice, 'maxPrice' => $maxPrice]);

    return $t;
}


// Mandar Rango de precios de productos Publicos

function rangoPreciosPublics(){
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

function rangoPreciosPublicQuery($minPrice, $maxPrice){
    $t = table::queryParams("SELECT id, 
    nom_producto, 
    existencias, 
    precio_venta, 
    (precio_venta * 0.16) as iva,
    CASE 
        WHEN existencias = 0 THEN 'sin stock'
        ELSE 'con stock'
    END as estado
    FROM productos
    WHERE precio_venta BETWEEN :minPrice and :maxPrice", ['minPrice' => $minPrice, 'maxPrice' => $maxPrice]);

    return $t;
}  

}
