<?php

function Calcular()
{
    if (isset($_POST['calc'])) {

        $v1 = $_POST['n1'];
        $v2 = $_POST['n2'];

        switch ($_POST['operacao']) {
            case 'somar':
                $resultado = $v1 + $v2;
                break;
            case 'sub':
                $resultado = $v1 - $v2;
                break;
            case 'mult':
                $resultado = $v1 * $v2;
                break;
            case 'div':
                if ($v2 != 0) {
                    $resultado = $v1 / $v2;
                } else {
                    $resultado = "Divisão por zero!";
                }
                break;
            case 'pot':
                $resultado = pow($v1, $v2);
                break;
            case 'percent':
                $resultado = ($v1 * $v2) / 100;
                break;
            case 'fat':
                $resultado = 1;
                for ($i = 1; $i <= $v1; $i++) {
                    $resultado *= $i;
                }
                break;
            default:
                $resultado = "Operação inválida!";
                break;
        }
        return $resultado;
    }
}