<?php

namespace proyecto\Models;
use PDO;

class Cita extends Models
{
    public $id_cliente = "";
    public $fecha_registro = "";
    public $fecha_cita = "";
    public $id_mascota = "";
    public $estatus = "";
    public $motivo = "";
    public $servicio = "";

    protected $filleable = [
        "id_cliente",
        "fecha_registro",
        "fecha_cita",
        "id_mascota",
        "estatus",
        "motivo",
        "servicio"
    ];

    protected $table = "citas";
}
