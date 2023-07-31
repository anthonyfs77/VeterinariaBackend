<?php

namespace proyecto\Models;
use PDO;

class Proveedores extends Models
{
    public $empresa = "";
    public $proveedor = "";
    public $direccion = "";
    public $telefono1 = "";
    public $telefono2 = "";
   
    protected $filleable = [
        "empresa",
        "proveedor",
        "direccion",
        "telefono1",
        "telefono2",

    ];

    protected $table = "proveedores";
}
