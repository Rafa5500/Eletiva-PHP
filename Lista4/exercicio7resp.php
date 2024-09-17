<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Resposta do exercício 7</h1>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $data1 = new DateTime($_POST['data1']);
                $data2 = new DateTime($_POST['data2']);

                $intervalo = $data1->diff($data2);
                echo "<p class='mt-3'>A diferença entre as datas são de " . $intervalo->days . " dias.</p>";
            } catch (Exception $e) {
                echo "Erro: Formato de data inválido.";
            }
        }
    ?>
</body>
</html>