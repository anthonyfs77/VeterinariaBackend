<?php
namespace proyecto\Models;
use proyecto\Auth;
use proyecto\Models\Models;
use PDO;


class tipos_servicios extends Models{

    public $tipo_servicio = "";
    public $id_servicio = "";

    protected $filleable = [
        "tipo_servicio", "id_servicio"
    ];

    protected $table = "tipos_servicios";

}