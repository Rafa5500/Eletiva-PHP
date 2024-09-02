<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 8</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok7YctnYmDr5pNlyT2bRjXh0JMhjY7hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Resposta do exercício 8</h1>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            try
            { 
                $valor = (int) $_POST['valor'] ?? 0;
                do {
                    echo $valor . "\n";
                    $valor--;
                } while ($valor >= 0);
                echo "\n";
            
            } 
            catch(Exception $e) 
            {
                echo "Erro!".$e->getMessage();
            }
        }
    ?>
  </body>