<?php

namespace proyecto\Models;
use PDO;

class Animal extends Models
{
    public $nombre = "";
    public $propietario = "";
    public $especie = "";
    public $raza = "";
    public $genero = "";

    protected $filleable = [
        "nombre",
        "propietario",
        "especie",
        "raza",
        "genero"
    ];

    protected $table = "animales";
}