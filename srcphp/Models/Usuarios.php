<?php

namespace proyecto\Models;
use PDO;

class Usuarios extends Models{

public $nombre = "";
public $apellido = "";
public $correo = "";
public $telefono1 = "";
public $telefono2 = "";
public $contra = "";

public $tipo_usuario = "";


protected $filleable = [

"nombre",
"apellido",
"correo",
"telefono1",
"telefono2",
"contra",
"tipo_usuario"

];

protected $table = "usuarios";

}