<?php 
require_once 'cabecalho.php'; 
require_once 'navbar.php'; 
require_once '../funcoes/procedimentos.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor']; // Novo campo de valor

    // Função para criar um novo procedimento
    if (criarProcedimento($nome, $descricao, $valor)) {
        header('Location: procedimentos.php');
        echo 'Procedimento criado com sucesso.';
        exit();
    } else {
        $erro = "Erro ao criar o procedimento!";
    }
}
?>

<div class="container mt-5">
    <h2>Criar Novo Procedimento</h2>

    <?php if (!empty($erro)): ?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input 
                type="number" 
                name="valor" 
                id="valor" 
                class="form-control" 
                step="0.01" 
                min="0" 
                placeholder="Digite o valor do procedimento" 
                required
            >
        </div>
        <button type="submit" class="btn btn-primary">Criar Procedimento</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>