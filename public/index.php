<?php
namespace proyecto;
require("../vendor/autoload.php");

use proyecto\Controller\crearPersonaController;
use proyecto\Controller\UserController;
use proyecto\Controller\RegistroController;
use proyecto\Models\User;
use proyecto\Models\Cita;
use proyecto\Response\Failure;
use proyecto\Response\Success;
use proyecto\response\save;

Router::headers();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Router::post('/agendarcita', [UserController::class, 'agendarcita']);

Router::get('/registro', [RegistroController::class, 'registrar']);

Router::get("/pru", function(){
    $r = new Success("funcionando");
    $r->Send();
});




