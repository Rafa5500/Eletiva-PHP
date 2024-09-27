<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 5</title>
</head>
<body>
    <form action="" method="post">
        <h2>Cadastro de Livros</h2>
        <?php
        for ($i = 1; $i <= 5; $i++) {
            echo "<div>";
            echo "<label for='livro{$i}'>Livro {$i}:</label>";
            echo "<input type='text' name='titulos[]' id='livro{$i}' placeholder='Título do livro'>";
            echo "<input type='number' name='quantidades[]' min='0' placeholder='Quantidade em estoque'>";
            echo "</div>";
        }
        ?>
        <button type="submit">Salvar</button>
    </form>

    <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                try {

                    $titulos = $_POST['titulos'];
                    $quantidades = $_POST['quantidades'];

                    $livros = [];

                    for ($i = 0; $i < count($titulos); $i++) {
                        $livros[$titulos[$i]] = $quantidades[$i];
                    }
                    ksort($livros);

                    foreach ($livros as $titulo => $quantidade) {
                        if ($quantidade < 5) {
                            echo "<p>Baixa quantidade - Título: {$titulo}, Quantidade: {$quantidade}</p>";
                        } else {
                            echo "<p>Título: {$titulo}, Quantidade: {$quantidade}</p>";
                        }
                    }

                } catch (Exception $e) {
                    echo "Erro: " . $e->getMessage();
                }
            }
        ?>
</body>
</html>