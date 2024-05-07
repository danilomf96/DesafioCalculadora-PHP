<?php
session_start();
if (!isset($_SESSION["historico"])) {
    $_SESSION["historico"] = array();
}
if (!isset($_SESSION["operacoes"])) {
    $_SESSION["operacoes"] = "";
}
function adicionarOperacao($operacao) {
    $_SESSION["operacoes"] .= "<p>{$operacao}</p>";
}
include "Funcao.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio Calculadora</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: green;
        }
        .calculadora {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .calculadora label {
            font-weight: bold;
        }
        .calculadora form {
            margin-bottom: 20px;
        }
        .calculadora input[type="text"],
        .calculadora select {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .calculadora input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .calculadora input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .calculadora p {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="calculadora">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="n1">Numero 1</label>
                            <input type="text" class="form-control" name="n1" id="n1" placeholder="X">
                        </div>
                        <div class="form-group">
                            <label for="operacao">Operação</label>
                            <select class="form-control" name="operacao" id="operacao">
                                <option value="somar">+</option>
                                <option value="sub">-</option>
                                <option value="mult">*</option>
                                <option value="div">/</option>
                                <option value="pot">^</option>
                                <option value="percent">%</option>
                                <option value="fat">!</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="n2">Numero 2</label>
                            <input type="text" class="form-control" name="n2" id="n2" placeholder="Y">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="calc" value="Calcular">
                            <input type="submit" class="btn btn-success" name="save" value="Salvar Valores">
                            <input type="submit" class="btn btn-info" name="load" value="Pegar Valores">
                            <input type="submit" class="btn btn-danger" name="limpar" value="Limpar Historico">
                        </div>
                    </form>
                    <div class="historico">
                        <?php echo $_SESSION["operacoes"]; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

echo $_SESSION["operacoes"];

    if (!isset($_SESSION["historico"])) {
        $_SESSION["historico"] = array();
    }

    if (isset($_POST['calc'])) {
        $n1 = $_POST['n1'];
        $n2 = $_POST['n2'];
        $operacao = $_POST['operacao'];
        $resultado = Calcular($n1, $n2, $operacao);
        echo "<p>{$n1} {$operacao} {$n2} = {$resultado}</p>";
        adicionarOperacao("{$n1} {$operacao} {$n2} = {$resultado}");
    }

    if (isset($_POST['save'])) {
        if (isset($resultado)) {
            $_SESSION["historico"][] = $resultado;
        }
    }

    if (isset($_POST['load'])) {
        echo "<p>Histórico:</p>";
        foreach ($_SESSION["historico"] as $value) {
            echo "<p>{$value}</p>";
        }
    }

    if (isset($_POST['limpar'])) {
        session_destroy();
        $_SESSION["historico"] = array();
        $_SESSION["operacoes"] = "";
    }
    ?>

</body>

</html>