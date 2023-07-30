<?php
namespace proyecto;
require("../vendor/autoload.php");

use proyecto\Controller\LoginController;
use proyecto\Controller\RegistroController;
use proyecto\Controller\MostrarProductosController;
use proyecto\Response\Success;
use proyecto\Controller\VentasController;
use proyecto\Controller\Ordenes_comprasController;
use proyecto\Controller\citasController;
use proyecto\Controller\ProductoController;

Router::headers();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// funcion de prueba
Router::get("/pru", function(){
    $r = new Success("funcionando");
    $r->Send();
});






// Ruta de registro de clientes [Pantalla Registro]
Router::post('/registro', [RegistroController::class, 'registrar']);

// Consulta para mostrar todos los registros
Router::get('/mostrarR', [RegistroController::class, 'mostrarR']);

// Verificiacion de usuario en login BD -> login
Router::post('/verificacion', [LoginController::class, 'verificar']);

// Mandar Productos
Router::get('/productos', [MostrarProductosController::class, 'mostrarP']);

// Mandar Productos internos
Router::get('/productosInternos', [MostrarProductosController::class, 'mostrarProductsInter']);

// Mandar Rango de precios de productos Internos
Router::post('/precios', [MostrarProductosController::class, 'rangoPrecios']);

// Mandar Productos Publicos
Router::get('/productosPublicos', [MostrarProductosController::class, 'mostrarProductsPublic']);

// Mandar Rango de precios de productos Publicos
Router::post('/preciosPublicos', [MostrarProductosController::class,'rangoPreciosPublics']);

// datos para la grafica
Router::post('/data', [VentasController::class, 'fecha']);

// busqueda de productos
Router::post('/buscar', [MostrarProductosController::class, 'buscarProducto']);

// busqueda de productos internos
Router::post('/buscarInterno', [MostrarProductosController::class, 'buscarProductoInterno']);

// Realizar compra 
Router::post('/compra', [Ordenes_comprasController::class, 'insertarVenta']);

// Mostrar ventas recientes 
Router::get('/ventasRecientes', [VentasController::class, 'mostrarVentasRecientes']);

// Citas pendientes
Router::get('/citasPendientes', [citasController::class, 'mostrarCitasPendientes']);

// AGREGAR PRODUCTO 
Router::post('/agregarProducto', [ProductoController::class, 'AgregarProductoPublico']);

// ALTER PRODUCTO
Router::post('/alterProduct', [ProductoController::class, 'modificarProducto']);

// ALTER DATA PRODUCT
Router::post('/dataProd', [ProductoController::class, 'modificarDataProducto']);

// AGREGAR PRODUCTO INTERNO
Router::post('/dataProdInterno', [ProductoController::class, 'AgregarProductoInterno']);

// MODIFICAR PRODUCTO INTERNO
Router::post('/alterProdInterno', [ProductoController::class, 'modificarProductoInterno']);

// MODIFICAR PRODUCTO EXISTENTE
Router::post('/alterProdInternoExistente', [ProductoController::class, 'modificarDataProductoInterno']);


















?>

    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Backend</title>
        </head>
        <body>
            <div class="ctn">
                <div class="title">
                    <h1>Backend.</h1><br>
                </div>
            </div>

            <style>
                body{
                    margin: 0;
                    padding: 0;
                }
                .ctn{
                    background-color: #f3b606;
                    width: 100%;
                    height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                .title{
                    font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif;
                    font-size: 2em;
                }

            </style>
        </body>
        </html>
















