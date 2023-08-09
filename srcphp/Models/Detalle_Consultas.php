<?php

namespace proyecto\Models;
use PDO;

class Detalle_Consultas extends Models
{
    public $id_consulta = "";
    public $id_tservicio = "";

    

    protected $filleable = [
        "id_consulta",
        "id_tservicio",


    ];

    protected $table = "detalle_consultas";
}