<?php

namespace proyecto\Models;
use PDO;

class Consulta extends Models
{
    public $id_cita = "";
    public $observaciones_medicas = "";
    public $peso_kg = "";
    public $altura_mts = "";
    public $edad_meses = "";
    public $dosis = "";
    public $id_productosInternos = "";

   
    protected $filleable = [
        "id_cita",
        "observaciones_medicas",
        "peso_kg",
        "altura_mts",
        "edad_meses",
        "dosis",
        "id_productosInternos",
 
    ];

    protected $table = "consultas";
}
