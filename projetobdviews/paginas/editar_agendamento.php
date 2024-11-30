<?php 
require_once 'cabecalho.php'; 
require_once 'navbar.php';  
require_once '../funcoes/agendamentos.php'; 
require_once '../funcoes/usuarios.php'; 
require_once '../funcoes/procedimentos.php'; 
require_once '../config/bancodedados.php';

// Adicione esta verificação
if (!function_exists('buscarProcedimentos')) {
    function buscarProcedimentos() {
        global $pdo;
        $sql = "SELECT * FROM procedimento";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Obter o ID do agendamento pela URL
$id = $_GET['id'] ?? null;

// Redireciona caso o ID não seja fornecido
if (!$id) {
    header("Location: agendamentos.php");
    exit;
}

// Buscar listas de clientes, profissionais e procedimentos
$clientes = buscarUsuarios('cliente');
$profissionais = buscarUsuarios('profissional');
$procedimentos = buscarProcedimentos();

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $profissional_id = $_POST['profissional_id'];
    $procedimento_id = $_POST['procedimento_id'];
    $data_hora = $_POST['data_hora'];

    try {
        atualizarAgendamento($id, $cliente_id, $profissional_id, $procedimento_id, $data_hora);
        header("Location: agendamentos.php?sucesso=1");
        exit;
    } catch (Exception $e) {
        $erro = "Erro ao atualizar o agendamento: " . $e->getMessage();
    }
}
?>

<div class="container mt-5">
    <h2>Editar Agendamento</h2>
    <form method="post">
        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente" class="form-control" required>
                <?php foreach ($clientes as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= $c['id'] == $agendamento['cliente_id'] ? 'selected' : '' ?>>
                        <?= $c['nome'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="profissional" class="form-label">Profissional</label>
            <select name="profissional_id" id="profissional" class="form-control" required>
                <?php foreach ($profissionais as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= $p['id'] == $agendamento['profissional_id'] ? 'selected' : '' ?>>
                        <?= $p['nome'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="procedimento" class="form-label">Procedimento</label>
            <select name="procedimento_id" id="procedimento" class="form-control" required>
                <?php foreach ($procedimentos as $proc): ?>
                    <option value="<?= $proc['id'] ?>" <?= $proc['id'] == $agendamento['procedimento_id'] ? 'selected' : '' ?>>
                        <?= $proc['nome'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="data_hora" class="form-label">Data e Hora</label>
            <input type="datetime-local" name="data_hora" id="data_hora" class="form-control" value="<?= date('Y-m-d\TH:i', strtotime($agendamento['data_hora'])) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Agendamento</button>
        <a href="agendamentos.php" class="btn btn-secondary">Cancelar</a>
    </form>
    <?php if (isset($erro)): ?>
        <p class="text-danger mt-3"><?= $erro ?></p>
    <?php endif; ?>
</div>

<?php require_once 'rodape.php'; ?>
