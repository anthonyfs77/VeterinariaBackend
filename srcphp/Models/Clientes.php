<?php
namespace proyecto\Models;

class Clientes extends Models{

    public $nombre = "";
    public $last = "";
    public $contrasena = "";
    public $correo = "";
    public $tel1 = "";
    public $tel2 = "";

    protected $filleable = [
        "nombre","last","contrasena","correo","tel1","tel2"
    ];

    protected $table = "clientes";
}