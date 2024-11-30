<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';  
    require_once '../funcoes/agendamentos.php'; 

    // Buscar todos os agendamentos
    $agendamentos = buscarAgendamentos();

    // Verificar se há mensagem de sucesso
    $success = isset($_GET['success']) ? $_GET['success'] : null;
?>

<div class="container mt-5">
    <h2>Agendamentos</h2>

    <?php if ($success): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Agendamento realizado com sucesso!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <a href="novo_agendamento.php" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Novo Agendamento
    </a>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Profissional</th>
                    <th>Procedimento</th>
                    <th>Data e Hora</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($agendamentos) > 0): ?>
                    <?php foreach ($agendamentos as $agendamento): ?>
                        <tr>
                            <td><?= $agendamento['id'] ?></td>
                            <td><?= $agendamento['cliente'] ?></td>
                            <td><?= $agendamento['profissional'] ?></td>
                            <td><?= $agendamento['procedimento'] ?></td>
                            <td>
                                <?= date('d/m/Y H:i', strtotime($agendamento['data_hora'])) ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="editar_agendamento.php?id=<?= $agendamento['id'] ?>" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <a href="#" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="confirmarExclusao(<?= $agendamento['id'] ?>)">
                                        <i class="fas fa-trash"></i> Excluir
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Nenhum agendamento encontrado.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="modalExclusao" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir este agendamento?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="linkExclusao" class="btn btn-danger">Confirmar</a>
            </div>
        </div>
    </div>
</div>

<?php require_once 'rodape.php'; ?>

<script>
function confirmarExclusao(id) {
    // Configura o link de exclusão no modal
    document.getElementById('linkExclusao').href = 'excluir_agendamento.php?id=' + id;
    
    // Mostra o modal de confirmação
    var modalExclusao = new bootstrap.Modal(document.getElementById('modalExclusao'));
    modalExclusao.show();
}
</script>