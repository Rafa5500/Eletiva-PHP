<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Resposta do exercício 5</h1>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            try{
                $valor1 = (int) $_POST['valor1'] ?? 0;
                $raiz_quadrada = sqrt($valor1);
                echo "<p>A raíz quadrada de $valor1 é igual a: $raiz_quadrada</p>";
            } catch(Exception $e) {
                echo "Erro!".$e->getMessage();

            }
        }
    
    ?>
  </body>