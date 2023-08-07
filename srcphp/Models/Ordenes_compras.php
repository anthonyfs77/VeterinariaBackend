<?php
namespace proyecto\Models;
use proyecto\Auth;
use proyecto\Models\Models;
use PDO;

class Ordenes_compras extends Models{
    public $id = "";
    public $fecha_compra = "";
    public $fecha_pago = "";
    public $estado = "";
    public $id_empleado = "";
    public $estatus = "";
    public $proveedor = "";
    protected $filleable = [
        "id",
       "fecha_compra",
       "fecha_pago",
       "estado",
       "id_empleado",
       "estatus",
       "proveedor"
    ];

    protected $table = "ordenes_compras";
}
