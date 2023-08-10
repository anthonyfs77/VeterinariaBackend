<?php

namespace proyecto\Models;
use PDO;

class Detalle_Consultas extends Models
{
    public $consulta_id = "";
    public $tservicios_id = "";

    

    protected $filleable = [
        "consulta_id",
        "tservicios_id",


    ];

    protected $table = "detalle_consultas";
}