<?php
    $host = "localhost";
    $db = "banco_php";
    $usuario = "root";
    $senha = "";
    $port = "3306";

    try {
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $usuario, $senha);

    } catch (Exception $e) {
        echo "Erro: ".$e->getMessage();
    }

    function executarQuery($sql, $parametros = []) {
        global $pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->execute($parametros);
        return $stmt;
    }
?>
