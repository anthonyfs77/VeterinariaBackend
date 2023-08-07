<?php
namespace proyecto\Models;
use proyecto\Auth;
use proyecto\Models\Models;
use PDO;

class tipos_servicios_borrador extends Models {

    public $tipo_servicio = "";
    public $id_servicio = "";
    public $descripcion = "";
    public $image = "";

    protected $filleable = [
         "tipo_servicio", "id_servicio", "descripcion", "image"
    ];

    protected $table = "tipos_servicios_borrador";

}
