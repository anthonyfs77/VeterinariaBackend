<?php
namespace proyecto\Models;
use proyecto\Auth;
use proyecto\Models\Models;
use PDO;

class Ventas extends Models{

    public $id = "";
    public $fecha = "";
    public $id_cliente = "";
    public $tipo_pago = "";
    public $monto_pagado = "";

    protected $filleable = [
       "id", "fecha","id_cliente","tipo_pago","monto_pagado"
    ];

    protected $table = "ventas";

}
