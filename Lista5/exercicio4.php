<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Exercício 4</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <form action="" method="POST" class="container">
    <h2>Informe os itens</h2>
    <?php for($i=1;$i<=5;$i++): ?>
      <div class="row mb-3">
        <label for="item<?= $i ?>" class="col-sm-3 col-form-label">Item <?= $i ?></label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="item<?= $i ?>" name="nomes[]" placeholder="Nome do item">
        </div>
        <div class="col-sm-5">
          <input type="number" class="form-control" id="preco<?= $i ?>" name="precos[]" placeholder="Preço (R$)">
        </div>
      </div>
    <?php endfor; ?>

    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>

  <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      try {
        $nomes = $_POST['nomes'];
        $precos = $_POST['precos'];

        $itens = [];
        for ($i = 0; $i < count($nomes); $i++) {
          $precoFinal = $precos[$i] * 1.15;
          $itens[$nomes[$i]] = $precoFinal;
        }

        asort($itens);

        echo "<h2>Itens com Preço Final</h2>";
        echo "<ul class='list-group'>";
        foreach ($itens as $nome => $preco) {
          echo "<li class='list-group-item'>Nome: {$nome}, Preço com imposto: R$ " . number_format($preco, 2) . "</li>";
        }
        echo "</ul>";
      } catch (Exception $e) {
        echo "<p class='alert alert-danger'>Erro: " . $e->getMessage() . "</p>";
      }
    }
  ?>
</body>
</html>