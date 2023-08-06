<?php

namespace proyecto\Models;

class Citas extends Models
{
    public $id;
    public $fecha_registro = "";
    public $fecha_cita = "";
    public $id_mascota = "";
    public $estatus = "";
    public $motivo = "";

    protected $filleable = [

        "fecha_registro",
        "fecha_cita",
        "id_mascota",
        "estatus",
        "motivo",
    ];

    protected $table = "citas";
}