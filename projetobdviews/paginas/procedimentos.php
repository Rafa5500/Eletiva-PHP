<?php
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';  
    require_once '../funcoes/procedimentos.php'; // Correto caminho para o arquivo de funções

    // Buscar todos os procedimentos
    $procedimentos = buscarProcedimentos();
?>
<div class="container mt-5">
    <h2>Gerenciamento de Procedimentos</h2>
    <a href="novo_procedimento.php" class="btn btn-success mb-3">Novo Procedimento</a>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($procedimentos as $proc): ?>
            <tr>
                <td><?= $proc['id'] ?></td>
                <td><?= $proc['nome'] ?></td>
                <td><?= $proc['descricao'] ?></td>
                <td>
                    <a href="editar_procedimento.php?id=<?= $proc['id'] ?>" class="btn btn-warning">Editar</a>
                    <a href="excluir_procedimento.php?id=<?= $proc['id'] ?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'rodape.php'; ?>
