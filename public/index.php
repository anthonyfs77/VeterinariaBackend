<?php
namespace proyecto;
require("../vendor/autoload.php");

use proyecto\Controller\LoginController;
use proyecto\Controller\RegistroController;
use proyecto\Response\Success;

Router::headers();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Ruta de registro de clientes [Pantalla Registro]
Router::post('/registro', [RegistroController::class, 'registrar']);

// Consulta para mostrar todos los registros
Router::get('/mostrarR', [RegistroController::class, 'mostrarR']);

// Verificiacion de usuario en login BD -> login
Router::post('/verificacion', [LoginController::class, 'verificar']);





// Ruta de verificacion de login



// funcion de prueba 
Router::get("/pru", function(){
    $r = new Success("funcionando");
    $r->Send();
});




