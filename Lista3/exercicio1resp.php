<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Resposta do exercício 1</h1>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          try {
            $numeros = array(
                intval($_POST['num1']),
                intval($_POST['num2']),
                intval($_POST['num3']),
                intval($_POST['num4']),
                intval($_POST['num5']),
                intval($_POST['num6']),
                intval($_POST['num7'])
            );

            if (count(array_unique($numeros)) < 7) {
                throw new Exception("Os números devem ser diferentes.");
            }

            $menorValor = PHP_INT_MAX;
            $posicaoMenorValor = -1;

            for ($i = 0; $i < 7; $i++) {
                if ($numeros[$i] < $menorValor) {
                    $menorValor = $numeros[$i];
                    $posicaoMenorValor = $i;
                }
            }

            echo "<p>O menor valor é: " . $menorValor . "</p>";
            echo "<p>A posição do menor valor na sequência é: " . ($posicaoMenorValor + 1) . "</p>";

        } catch (Exception $e) {
            echo "<p style='color:red;'>Erro: " . $e->getMessage() . "</p>";
        }
        }
    
    ?>
  </body>