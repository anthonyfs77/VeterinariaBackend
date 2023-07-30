<?php
namespace proyecto\Models;
use proyecto\Auth;
use PDO;

class Clientes extends Models{


    public $id = "";
    public $nombre = "";
    public $apellido = "";
    public $correo = "";
    public $telefono1 = "";
    public $telefono2 = "";
    public $contrasena = "";
    public $fotourl = "";

    protected $filleable = [
       "id", "nombre","apellido","correo","telefono1","telefono2","contrasena", "fotourl"
    ];

    protected $table = "clientes";

}