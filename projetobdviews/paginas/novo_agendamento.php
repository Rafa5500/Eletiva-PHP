<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';  
    require_once '../funcoes/agendamentos.php'; 
    $clientes = buscarUsuarios('cliente');
    $profissionais = buscarUsuarios('profissional');
    $procedimentos = buscarProcedimentos();

    // Verifica se o formulário foi submetido
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recupera os dados do formulário
        $cliente_id = $_POST['cliente_id'];
        $profissional_id = $_POST['profissional_id'];
        $procedimento_id = $_POST['procedimento_id'];
        $data_hora = $_POST['data_hora'];

        // Chama a função para salvar o agendamento
        try {
            salvarAgendamento($cliente_id, $profissional_id, $procedimento_id, $data_hora);
            // Redireciona com mensagem de sucesso
            header("Location: listar_agendamentos.php?success=1");
            exit();
        } catch (Exception $e) {
            // Em caso de erro, pode exibir uma mensagem de erro
            $erro = "Erro ao salvar agendamento: " . $e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Novo Agendamento</h2>
    
    <?php 
    // Exibe mensagem de erro se houver
    if (isset($erro)): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente" class="form-control" required>
                <?php foreach ($clientes as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="profissional" class="form-label">Profissional</label>
            <select name="profissional_id" id="profissional" class="form-control" required>
                <?php foreach ($profissionais as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= $p['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="procedimento" class="form-label">Procedimento</label>
            <select name="procedimento_id" id="procedimento" class="form-control" required>
                <?php foreach ($procedimentos as $proc): ?>
                    <option value="<?= $proc['id'] ?>"><?= $proc['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="data_hora" class="form-label">Data e Hora</label>
            <input type="datetime-local" name="data_hora" id="data_hora" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Agendar</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>