<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/procedimentos.php';
    require_once '../funcoes/funcoes_comuns.php';

    $procedimento = null; // Inicializa a variável

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {
            $id = intval($_POST['id']);
            
            // Verificar se há agendamentos vinculados
            $agendamentos = verificarAgendamentosProcedimento($id);
            
            if (!empty($agendamentos)) {
                $erro = "Não é possível excluir o procedimento. Existem agendamentos vinculados.";
            } else {
                if (excluirProcedimento($id)){
                    header('Location: procedimentos.php?success=1');
                    exit();
                } else {
                    $erro = "Erro ao excluir o procedimento!";
                }
            }
        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    } else {
        if (isset($_GET['id'])){
            $id = intval($_GET['id']);
            $procedimento = buscarProcedimentoPorId($id);
            
            // Verifica se o procedimento foi encontrado
            if (empty($procedimento)){
                header('Location: procedimentos.php?error=Procedimento não encontrado');
                exit();
            }
        } else {
            header('Location: procedimentos.php?error=ID não especificado');
            exit();
        }
    }

    // Função para verificar agendamentos vinculados ao procedimento
    function verificarAgendamentosProcedimento($procedimento_id) {
        global $pdo;
        $sql = "SELECT id FROM agendamento WHERE procedimento_id = :procedimento_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':procedimento_id' => $procedimento_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>

<div class="container mt-5">
    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <?php if ($procedimento): ?>
        <h2>Excluir Procedimento</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detalhes do Procedimento</h5>
                <p><strong>ID:</strong> <?= htmlspecialchars($procedimento['id']) ?></p>
                <p><strong>Nome:</strong> <?= htmlspecialchars($procedimento['nome']) ?></p>
                <p><strong>Descrição:</strong> <?= htmlspecialchars($procedimento['descricao']) ?></p>
            </div>
        </div>

        <div class="alert alert-warning mt-3">
            <strong>Atenção:</strong> Tem certeza de que deseja excluir este procedimento?
        </div>

        <form method="post" class="mt-3">
            <input type="hidden" name="id" value="<?= intval($procedimento['id']) ?>" />
            <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
            <a href="procedimentos.php" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php else: ?>
        <div class="alert alert-warning">Procedimento não encontrado.</div>
    <?php endif; ?>
</div>

<?php require_once 'rodape.php'; ?>