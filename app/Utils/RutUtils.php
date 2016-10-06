<?php

namespace App\Utils;

/**
 * Description of Rut
 *
 * @author Sebastián Salazar Molina <ssalazar@orangepeople.cl>
 */
class RutUtils {

    public static function rut($rut_str) {
        $r = str_replace(array('.', ',', '-'), "", strtoupper($rut_str));
        $rut = (int) substr($r, 0, strlen($r) - 1);
        return $rut;
    }

    public static function dv($rut) {
        $rut = str_replace(".", "", "$rut");
        $r = (int) $rut;
        $s = 1;
        for ($m = 0; $r != 0; $r/=10) {
            $s = ($s + $r % 10 * (9 - $m++ % 6)) % 11;
        }
        return strtoupper(chr($s ? $s + 47 : 75));
    }

    public static function isRut($r) {

        $resultado = false;

        $r = str_replace(array('.', ',', '-'), "", strtoupper($r));
        $sub_rut = substr($r, 0, strlen($r) - 1);
        $sub_dv = substr($r, -1);
        $x = 2;
        $s = 0;

        for ($i = strlen($sub_rut) - 1; $i >= 0; $i--) {
            if ($x > 7) {
                $x = 2;
            }
            $s += $sub_rut[$i] * $x;
            $x++;
        }

        $dv = 11 - ($s % 11);

        if ($dv == 10) {
            $dv = 'K';
        }

        if ($dv == 11) {
            $dv = '0';
        }

        if ($dv == $sub_dv) {
            $resultado = true;
        }

        return (bool) $resultado;
    }

    public static function formatear($rut) {
        $nuevo_rut = number_format($rut, 0, ",", ".") . "-" . self::dv($rut);
        return $nuevo_rut;
    }

}

?>

