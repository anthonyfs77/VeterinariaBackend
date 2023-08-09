<?php

namespace proyecto\Models;
use PDO;

class Usuarios extends Models{

public $nombre = "";
public $apellido = "";
public $correo = "";
public $telefono1 = "";
public $telefono2 = "";
public $contraseña = "";


protected $filleable = [

"nombre",
"apellido",
"correo",
"telefono1",
"telefono2",
"contraseña"

];

protected $table = "usuarios";

}