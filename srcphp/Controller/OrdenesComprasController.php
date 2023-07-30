<?php

namespace proyecto\Controller;
use proyecto\Models\Ordenes_compras;
use proyecto\Response\Failure;
use proyecto\Response\Success;
use proyecto\models\Table;
use proyecto\Conexion;
use proyecto\Models\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrdenesComprasController{
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion('veterinaria', 'localhost', 'root', '');
    }


}
