<?php

namespace proyecto\Models;

class citas_tservicios extends Models
{
    public $cita = "";
    public $tipo_servicio = "";

    protected $filleable = [
        "cita",
        "tipo_servicio",
 
    ];

    protected $table = "citas_tservicios";
}