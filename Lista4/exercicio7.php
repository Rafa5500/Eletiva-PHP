<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="container">
    <h1>Exercício 7</h1>
    <form action="exercicio7resp.php" method="POST">
        <div class="row">
            <div class="col">
                <label for="data1" class="form-label">Informe valor 1:</label>
                <input type="date" class="form-control" name="data1" id="data1">
            </div>
            <div class="col">
                <label for="data2" class="form-label">Informe valor 2:</label>
                <input type="date" class="form-control" name="data2" id="data2">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </form>
  </body>