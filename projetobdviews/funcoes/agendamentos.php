<?php
require_once '../config/bancodedados.php';
require_once 'funcoes_comuns.php';

// Função para buscar usuários por nível (cliente, profissional)
function buscarUsuarios($nivel) {
    global $pdo;
    $sql = "SELECT * FROM usuario WHERE nivel = :nivel";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nivel' => $nivel]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Função para salvar um agendamento no banco de dados
function salvarAgendamento($cliente_id, $profissional_id, $procedimento_id, $data_hora) {
    global $pdo;
    $sql = "INSERT INTO agendamento (cliente_id, profissional_id, procedimento_id, data_hora) 
            VALUES (:cliente_id, :profissional_id, :procedimento_id, :data_hora)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':cliente_id' => $cliente_id,
        ':profissional_id' => $profissional_id,
        ':procedimento_id' => $procedimento_id,
        ':data_hora' => $data_hora
    ]);
}

// Função para buscar todos os agendamentos (com detalhes dos relacionamentos)
function buscarAgendamentos() {
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
            ORDER BY a.data_hora DESC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Função para buscar um único agendamento pelo ID
function buscarAgendamentoPorId($id) {
    global $pdo;
    $sql = "SELECT * FROM agendamento WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Função para atualizar um agendamento
function atualizarAgendamento($id, $cliente_id, $profissional_id, $procedimento_id, $data_hora) {
    global $pdo;
    $sql = "UPDATE agendamento 
            SET cliente_id = :cliente_id, 
                profissional_id = :profissional_id, 
                procedimento_id = :procedimento_id, 
                data_hora = :data_hora 
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':cliente_id' => $cliente_id,
        ':profissional_id' => $profissional_id,
        ':procedimento_id' => $procedimento_id,
        ':data_hora' => $data_hora
    ]);
}

// Função para excluir um agendamento
function excluirAgendamento($id) {
    global $pdo;
    $sql = "DELETE FROM agendamento WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
}


