<?php

namespace Metapod\SoporteBundle\Model;

use Metapod\SoporteBundle\Model\om\BaseBitacora;

class Bitacora extends BaseBitacora {

    public static function escribir($usuario, $ip, $descripcion, $estado, $tabla, $datoTabla, $error, $datoError) {
        $bitacora = new Bitacora();
        if ($usuario) {
            $bitacora->setUsuarioId($usuario->getId());
        }
        $bitacora->setDireccion($ip);
        $bitacora->setDescripcion($descripcion);
        $bitacora->setEstado($estado);
        $bitacora->setTabla($tabla);
        $bitacora->setDatoTabla($datoTabla);
        $bitacora->setError($error);
        $bitacora->setDatoError($datoError);
        $bitacora->setFechaHora(date('Y-m-d H:i:s'));
        $bitacora->save();
    }

}
