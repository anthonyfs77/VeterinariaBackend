<?php
namespace proyecto\Models;
use proyecto\Auth;
use proyecto\Models\Models;
use PDO;

class DetalleCompras extends Models{

    public $orden_compra = "";
    public $producto = "";
    public $cantidad = "";
    public $precio_compra = "";

    protected $filleable = [
       "orden_compra", "producto", "cantidad", "precio_compra"
    ];

    protected $table = "detalle_compras";

}
