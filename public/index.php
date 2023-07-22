<?php
namespace proyecto;
require("../vendor/autoload.php");

use proyecto\Controller\LoginController;
use proyecto\Controller\RegistroController;
use proyecto\Controller\MostrarProductosController;
use proyecto\Response\Success;

Router::headers();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


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

// Mandar Rango de precios 
Router::post('/precios', [MostrarProductosController::class, 'rangoPrecios']);


// funcion de prueba 
Router::get("/pru", function(){
    $r = new Success("funcionando");
    $r->Send();
});






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
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size: 2em;
        }

    </style>
</body>
</html>