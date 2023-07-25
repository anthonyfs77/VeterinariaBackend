<?php

namespace proyecto\Models;
use proyecto\Models\Models;
use proyecto\Auth;
use PDO;

class Proveedores extends Models{

    public $proveedor = "";
    public $direccion = "";
    public $telefono1 = "";
    public $telefono2 = "";

    protected $filleable = [
        "proveedor", "direccion", "telefono1", "telefono2"
    ];

    protected $table = "proveedores"; 

}
