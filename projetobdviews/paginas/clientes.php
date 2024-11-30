<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';  
    require_once '../funcoes/usuarios.php';

    $clientes = buscarUsuarios('cliente'); // Função que retorna apenas clientes
?>

<div class="container mt-5">
    <h2>Gerenciamento de Clientes</h2>
    <a href="novo_cliente.php" class="btn btn-success mb-3">Novo Cliente</a>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $c) : ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= $c['nome'] ?></td>
                <td><?= $c['email'] ?></td>
                <td><?= $c['telefone'] ?></td>
                <td>
                    <a href="editar_cliente.php?id=<?= $c['id'] ?>" class="btn btn-warning">Editar</a>
                    <a href="excluir_cliente.php?id=<?= $c['id'] ?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'rodape.php'; ?>
