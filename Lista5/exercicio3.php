<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 3</title>
</head>
<body>
    <form action="" method="POST">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <div>
                <label for="produto<?= $i ?>">Produto <?= $i ?>:</label>
                <input type="text" id="produto<?= $i ?>" name="nomes[]" placeholder="Nome do produto">
                <input type="number" name="codigos[]" placeholder="Código do produto">
                <input type="number" name="precos[]" placeholder="Preço do produto">
            </div>
        <?php endfor; ?>
        <button type="submit">Enviar</button>
    </form>

    <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                try {
                    $codigos = $_POST['codigos'];
                    $nomes = $_POST['nomes'];
                    $precos = $_POST['precos'];

                    $produtos = [];
                    for ($i = 0; $i < count($codigos); $i++) {

                        $precoFinal = $precos[$i] > 100 ? $precos[$i] * 0.9 : $precos[$i];

                        $produtos[$codigos[$i]] = [
                            'nome' => $nomes[$i],
                            'preco' => $precoFinal
                        ];
                    }
                    
                    uasort($produtos, function($a, $b) {
                        return strcmp($a['nome'], $b['nome']);
                    });
                    foreach ($produtos as $codigo => $infoProduto) {
                        echo "<p>Código: {$codigo}, Nome: {$infoProduto['nome']}, Preço: R$ " . number_format($infoProduto['preco'], 2) . "</p>";
                    }

                } catch (Exception $e) {
                    echo "Erro: " . $e->getMessage();
                }
            }
        ?>
</body>
</html>