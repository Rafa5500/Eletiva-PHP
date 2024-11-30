<?php

require_once 'cabecalho.php'; 
require_once 'navbar.php';
require_once '../funcoes/usuarios.php';  // Para buscar dados dos usuários (clientes)
require_once '../funcoes/agendamentos.php'; // Para buscar dados de agendamentos

// Função para obter o número de clientes
function contarClientes() {
    global $pdo;
    $stmt = $pdo->query("SELECT COUNT(*) FROM usuario WHERE nivel = 'cliente'");
    return $stmt->fetchColumn();
}

// Função para obter o número de agendamentos
function contarAgendamentos() {
    global $pdo;
    $stmt = $pdo->query("SELECT COUNT(*) FROM agendamento");
    return $stmt->fetchColumn();
}

// Função para obter o número de procedimentos agendados
function contarProcedimentosAgendados() {
    global $pdo;
    $stmt = $pdo->query("SELECT COUNT(*) FROM agendamento WHERE procedimento_id IS NOT NULL");
    return $stmt->fetchColumn();
}

// Obter contagens
$totalClientes = contarClientes();
$totalAgendamentos = contarAgendamentos();
$totalProcedimentos = contarProcedimentosAgendados();

?>

<main class="container">
    <div class="container mt-5">
        <h2>Dashboard</h2>

        <div class="row">
            <!-- Total de Clientes -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total de Clientes</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $totalClientes ?></h5>
                        <p class="card-text">Número total de clientes cadastrados na clínica.</p>
                    </div>
                </div>
            </div>

            <!-- Total de Agendamentos -->
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total de Agendamentos</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $totalAgendamentos ?></h5>
                        <p class="card-text">Número total de agendamentos realizados.</p>
                    </div>
                </div>
            </div>

            <!-- Total de Procedimentos Agendados -->
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Procedimentos Agendados</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $totalProcedimentos ?></h5>
                        <p class="card-text">Número de procedimentos agendados.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Outras seções podem ser adicionadas aqui, como gráficos de agendamentos por dia ou semana -->
    </div>
</main>

<?php require_once 'rodape.php'; ?>
