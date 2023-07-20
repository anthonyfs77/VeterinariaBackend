<?php

namespace proyecto\Controller;
use proyecto\Models\User;
use proyecto\Models\Cita;
use proyecto\Response\Failure;
use proyecto\Response\Success;


class UserController
{

    function registro()
    {
        try{
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
            $user = new User();
            $user->nombre = $dataObject->nombre;
            $user->apellido = $dataObject->apellido;
            $user->edad = $dataObject->edad;
            $user->correo = $dataObject->correo;
            $user->user = $dataObject->user;
            $user->contrasena = $dataObject->contrasena;
            $user->save();
            $r = new Success($user);



            return $r->Send();
        }catch (\Exception $e){
            $r = new Failure(401,$e->getMessage());
            return $r->Send();
        }
    }

 


    function eliminarAllUsers(){
         User::deleteAll();
    }
    function eliminarUsersbyId($id){
         User::delete($id);
    }



    function agendarcita(){
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
    
            $cita = new Cita();
            $cita->fecha_registro = date('Y-m-d');
            $cita->fecha_cita = $dataObject->fechaCita;
            $cita->id_cliente = $dataObject->id_cliente;
            $cita->id_mascota = $dataObject->id_mascota;
            $cita->estatus = $dataObject->estatus;
            $cita->motivo = $dataObject->motivo;
            $cita->servicio = $dataObject->servicio;
    
            $cita->save();
    
            $r = new Success($cita);
    
            return $r->Send();
        } catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());

        }
    }
}
