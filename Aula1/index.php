<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hoje é dia <?php echo date("d/m/Y"); ?></h1>
    <form action="resposta.php" method="POST">
        <input type="text" name="valor" />
        <buttom type="submit">Enviar</button>
    </form>


</body>
</html>