<?php

namespace proyecto\Controller;
use proyecto\Models\Clientes;
use proyecto\Response\Failure;
use proyecto\Response\Success;
use proyecto\models\Table;


class LoginController
{
    public function verificar()
    {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $correo = $dataObject->correo;
            $contrasena = $dataObject->contrasena;

            $resultado = $this->verificarUsuario($correo, $contrasena);

            if ($resultado) {
                $r = new Success("Inicio de sesión exitoso");
                return $r->send();
            } else {
                $r = new Failure(401, "No se encontró el usuario o la contraseña es incorrecta");
                return $r->Send();
            }
        } catch (\Exception $e) {
            $r = new Failure(500, "Error en el servidor: " . $e->getMessage());
            return $r->Send();
        }
    }
    
    private function verificarUsuario($correo, $contrasena)
    {
 
        $resultados = Table::queryParams("SELECT * FROM clientes WHERE correo = :correo", ['correo' => $correo]);

        if (count($resultados) > 0) {

            $usuario = $resultados[0];
            if ($usuario->contrasena === $contrasena) {
                return true;
            }
        }
        return false;
    }
}