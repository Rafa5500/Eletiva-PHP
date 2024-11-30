<?php 
require_once 'cabecalho.php'; 
require_once 'navbar.php'; 
require_once '../funcoes/procedimentos.php';

// Verifica se foi passado um ID de procedimento
if (!isset($_GET['id'])) {
    header('Location: procedimentos.php');
    exit();
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$erro = '';
$sucesso = '';

// Busca os dados do procedimento
try {
    $procedimento = buscarProcedimentoPorId($id);
    
    if (!$procedimento) {
        $erro = "Procedimento não encontrado.";
    }
} catch (Exception $e) {
    $erro = "Erro ao buscar procedimento: " . $e->getMessage();
}

// Processamento do formulário de edição
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados do formulário
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    $valor = filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT);

    // Validações
    if (empty($nome) || empty($descricao)) {
        $erro = "Nome e descrição são obrigatórios.";
    } elseif ($valor === false) {
        $erro = "Valor inválido.";
    } else {
        // Tenta atualizar o procedimento
        try {
            if (atualizarProcedimento($id, $nome, $descricao, $valor)) {
                $sucesso = "Procedimento atualizado com sucesso!";
                // Atualiza os dados do procedimento para exibição
                $procedimento = buscarProcedimentoPorId($id);
            } else {
                $erro = "Erro ao atualizar o procedimento.";
            }
        } catch (Exception $e) {
            $erro = "Erro ao atualizar: " . $e->getMessage();
        }
    }
}
?>

<div class="container mt-5">
    <h2>Editar Procedimento</h2>

    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($erro) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($sucesso)): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($sucesso) ?>
        </div>
    <?php endif; ?>

    <?php if ($procedimento): ?>
        <form method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input 
                    type="text" 
                    name="nome" 
                    id="nome" 
                    class="form-control" 
                    value="<?= htmlspecialchars($procedimento['nome'] ?? '') ?>" 
                    required
                >
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea 
                    name="descricao" 
                    id="descricao" 
                    class="form-control" 
                    required
                ><?= htmlspecialchars($procedimento['descricao'] ?? '') ?></textarea>
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
                    value="<?= number_format($procedimento['preco'] ?? 0, 2, '.', '') ?>" 
                    placeholder="Digite o valor do procedimento" 
                    required
                >
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Atualizar Procedimento</button>
                <a href="procedimentos.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php require_once 'rodape.php'; ?>