<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/agendamentos.php';
    require_once '../funcoes/funcoes_comuns.php';

    $agendamento = null; // Inicializa a variável

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {
            $id = intval($_POST['id']);
            if (excluirAgendamento($id)){
                header('Location: agendamento.php?success=1');
                exit();
            } else {
                $erro = "Erro ao excluir o agendamento!";
            }
        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    } else {
        if (isset($_GET['id'])){
            $id = intval($_GET['id']);
            $agendamento = buscarAgendamentoPorId($id);
            
            // Verifica se o agendamento foi encontrado
            if (empty($agendamento)){
                header('Location: agendamento.php?error=Agendamento não encontrado');
                exit();
            }
        } else {
            header('Location: agendamento.php?error=ID não especificado');
            exit();
        }
    }
    
    // Função para buscar detalhes completos do agendamento
    function buscarDetalhesAgendamento($id) {
        global $pdo;
        $sql = "SELECT 
                    a.id, 
                    c.nome AS cliente, 
                    p.nome AS profissional, 
                    pr.nome AS procedimento, 
                    a.data_hora
                FROM agendamento a
                JOIN usuario c ON a.cliente_id = c.id
                JOIN usuario p ON a.profissional_id = p.id
                JOIN procedimento pr ON a.procedimento_id = pr.id
                WHERE a.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buscar detalhes completos do agendamento
    $agendamentoDetalhado = buscarDetalhesAgendamento($id);
?>

<div class="container mt-5">
    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <?php if ($agendamentoDetalhado): ?>
        <h2>Excluir Agendamento</h2>

        <p>Tem certeza de que deseja excluir o agendamento abaixo?</p>

        <ul>
            <li><strong>Cliente: <?= htmlspecialchars($agendamentoDetalhado['cliente'] ?? 'N/A') ?></strong></li>
            <li><strong>Profissional: <?= htmlspecialchars($agendamentoDetalhado['profissional'] ?? 'N/A') ?></strong></li>
            <li><strong>Procedimento: <?= htmlspecialchars($agendamentoDetalhado['procedimento'] ?? 'N/A') ?></strong></li>
            <li><strong>Data e Hora: <?= date('d/m/Y H:i', strtotime($agendamentoDetalhado['data_hora'])) ?></strong></li>
        </ul>

        <form method="post">
            <input type="hidden" name="id" value="<?= intval($agendamentoDetalhado['id']) ?>" />
            <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
            <a href="agendamento.php" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php else: ?>
    <?php endif; ?>
</div>

<?php require_once 'rodape.php'; ?>