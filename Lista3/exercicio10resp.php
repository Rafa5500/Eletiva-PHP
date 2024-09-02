<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 10</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok7YctnYmDr5pNlyT2bRjXh0JMhjY7hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Resposta do exercício 10</h1>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            try
            { 
                $valor = (int) $_POST['valor'] ?? 0;
                for ($i = 1; $i <= 10; $i++) {
                    $resultado = $valor * $i;
                    echo "<p>$valor x $i = $resultado</p>";
                }
            }
            catch(Exception $e) 
            {
                echo "Erro!".$e->getMessage();
            }
        }
    ?>
  </body>