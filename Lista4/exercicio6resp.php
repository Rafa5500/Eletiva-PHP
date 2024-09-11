<?php
    declare(strict_types=1);
    ?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Resposta do exercício 6</h1>
    <?php
        function numeroArredondado(float $valor1):float
        {
          return round($valor1);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            try{
                
                $valor1 =(float) $_POST['valor1'];
                echo "<p class='mt-3'>O número $valor1 arredondado é: ".numeroArredondado($valor1)."</p>";
                
            } catch(Exception $e) {
                echo "Erro!".$e->getMessage();

            }
        }
    
    ?>
  </body>