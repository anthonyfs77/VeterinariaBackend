<?php
namespace proyecto\Models;
use proyecto\Models\Models;


class Productos extends models{

    public $id = '';
    public $nom_producto = '';
    public $descripcion = '';
    public $existencias = '';
    public $precio_venta = '';
    public $id_categoria = '';
    public $id_proveedor = '';
    public $precio_compra = '';

    protected $filleable = [
        "id", "nom_producto", "descripcion", "existencias", "precio_venta", 
        "id_categoria", "id_proveedor", "precio_compra"
    ];

    public $table = "productos";
}