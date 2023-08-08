<?php
namespace proyecto\Models;
use proyecto\Auth;
use proyecto\Models\Models;
use PDO;

class Ordenes_compras extends Models{
    public $id = "";
    public $fecha_compra = "";
    public $fecha_pago = "";
    public $estado_pago = "";
    public $id_empleado = "";
    public $estado = "";
    public $proveedor = "";
    protected $filleable = [
        "id",
       "fecha_compra",
       "fecha_pago",
       "estado_pago",
       "id_empleado",
       "estado",
       "proveedor"
    ];

    protected $table = "ordenes_compras";
}
