<?php
namespace proyecto\Models;
use PDO;

class OrdenesCompra extends Models{

    public $fecha_compra = "";
    public $fecha_pago = "";
    public $cantidad = "";
    public $precio_compra = "";
    public $nombre_producto = "";
    public $estado = "";
    public $id_empleado = "";
    
    protected $filleable = [
        "fecha_compra","fecha_pago","cantidad","precio_compra", "nombre_producto","estado","id_empleado"
    ];

    protected $table = "OrdenesCompra";

}