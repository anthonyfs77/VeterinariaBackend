<?php

namespace proyecto\Models;
use PDO;

class Detalle_Consultas extends Models
{
    public $id_consulta = "";
    public $id_producto = "";
    public $dosis = "";
    public $cantidad = "";
    

    protected $filleable = [
        "id_consulta",
        "id_producto",
        "dosis",
        "cantidad"

    ];

    protected $table = "detalle_consultas";
}