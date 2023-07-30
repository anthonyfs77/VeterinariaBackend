<?php
namespace proyecto\Models;
use proyecto\Models\Models;


class Ordenes_compras extends models{
    public $fecha_compra = '';
    public $fecha_pago = '';
    public $cantidad = '';
    public $precio_compra = '';
    public $nombre_producto = '';
    public $estado = '';
    public $id_empleado = '';

    protected $filleable  = [
        'fecha_compra',
        'fecha_pagado',
        'cantidad',
        'precio_compra'
        ,'nombre_producto'
        ,'estado'
        ,'id_empleado'
    ];

    protected $table = 'ordenes_compras';
}
