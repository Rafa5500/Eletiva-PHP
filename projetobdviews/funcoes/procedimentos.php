<?php
require_once '../config/bancodedados.php';
require_once 'funcoes_comuns.php';

function criarProcedimento($nome, $descricao, $valor) {
    global $pdo;
    
    try {
        $sql = "INSERT INTO procedimento (nome, descricao, valor) VALUES (:nome, :descricao, :valor)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':valor', $valor);
        
        $stmt->execute();
        
        return true; // Retorna true se a inserção for bem-sucedida
    } catch(PDOException $e) {
        // Você pode logar o erro ou tratá-lo de outra forma
        echo "Erro ao criar procedimento: " . $e->getMessage();
        return false;
    }
}

// Função para adicionar um novo procedimento
function adicionarProcedimento($nome, $descricao) {
    global $pdo;

    $sql = "INSERT INTO procedimento (nome, descricao) VALUES (:nome, :descricao)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    
    return $stmt->execute();
}

// Função para editar um procedimento existente
function editarProcedimento($id, $nome, $descricao) {
    global $pdo;

    $sql = "UPDATE procedimento SET nome = :nome, descricao = :descricao WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    
    return $stmt->execute();
}

// Função para excluir um procedimento
function excluirProcedimento($id) {
    global $pdo;

    $sql = "DELETE FROM procedimento WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    
    return $stmt->execute();
}
function buscarProcedimentoPorId($id) {
    global $pdo;
    
    try {
        $sql = "SELECT * FROM procedimento WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        // Log do erro
        error_log("Erro ao buscar procedimento: " . $e->getMessage());
        throw new Exception("Não foi possível buscar o procedimento.");
    }
}

function atualizarProcedimento($id, $nome, $descricao, $valor) {
    global $pdo;
    
    try {
        $sql = "UPDATE procedimento 
                SET nome = :nome, 
                    descricao = :descricao, 
                    preco = :valor 
                WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
        
        return $stmt->execute();
    } catch(PDOException $e) {
        // Log do erro
        error_log("Erro ao atualizar procedimento: " . $e->getMessage());
        throw new Exception("Não foi possível atualizar o procedimento.");
    }
}
?>