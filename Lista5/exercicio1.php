<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="container">
    <h1>Exercício 1</h1>
    <form action="" method="POST">
        <label for="numero1" class="form-label">Informe o contato 1:</label>
        <?php for ($i = 0; $i < 5; $i++) : ?>
            <div class="row">
                <div class="col">
                    <input type="number" class="form-control" name="numeros[]" placeholder="Numero <?= $i ?>">
                    <input type="text" class="form-control" name="nomes[]" placeholder="Nome <?= $i ?>">
                </div>
            <?php endfor ?>

            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
            <?php
                $nomes = $_POST['nomes'];
                $numeros = $_POST['numeros'];
                $pessoas = [];

                //adicionando valor e chave no mapa ordenado pessoas 
                for($i = 0; $i < count($nomes); $i++){
                    $pessoas[$nomes[$i]] = $numeros[$i];
                }

                //exibindo vetor pessoas
                foreach ($pessoas as $nome => $numero) {
                    echo "<p>Nome: {$nome} Numero: {$numero}</p>";
                }

            ?>
    </form>
</body>