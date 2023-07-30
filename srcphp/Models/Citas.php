<?php

namespace proyecto\Models;

class Cita extends Models
{
    public $id_cliente = "";
    public $fecha_registro = "";
    public $fecha_cita = "";
    public $id_mascota = "";
    public $estatus = "";
    public $motivo = "";
    public $tipo_servicio = "";
    public $servicio = "";

    protected $filleable = [
        "id_cliente",
        "fecha_registro",
        "fecha_cita",
        "id_mascota",
        "estatus",
        "motivo",
        "tipo_servicio",
        "servicio"
    ];

    protected $table = "citas";
}