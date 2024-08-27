<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 15</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Resposta do exercício 15</h1>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            try{
                $kg = (float) $_POST['kg'] ?? 0;
                $metros = floatval($_POST['metros']) ?? 0;
                $resultado = $kg / ($metros ** 2);
                echo "<p>Seu Índice de massa corporal: $resultado </p>";
            }
            catch(Exception $e) {
                echo "Erro! ".$e->getMessage();

            }   
        }
    ?>
  </body>