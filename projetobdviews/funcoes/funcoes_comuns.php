<?php
require_once '../config/bancodedados.php';

// Função para buscar todos os procedimentos
if (!function_exists('buscarProcedimentos')) {
    function buscarProcedimentos() {
        global $pdo;
        $sql = "SELECT * FROM procedimento";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
if (!function_exists('retornaUsuarioPorId')) {
    function retornaUsuarioPorId($id) {
        global $pdo;
        $sql = "SELECT * FROM usuario WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        // Retorna false se nenhum usuário for encontrado
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}