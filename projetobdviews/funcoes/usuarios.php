<?php

declare(strict_types = 1);

require_once('../config/bancodedados.php');

// Função para mapear o nível do usuário para exibição
function mapearNivelUsuario(string $nivel): string {
    switch ($nivel) {
        case 'cliente':
            return 'Cliente';  // Exibe somente "Cliente"
        case 'profissional':
            return 'Profissional';  // Exibe somente "Profissional"
        default:
            return 'Desconhecido';  // Caso o nível não seja reconhecido
    }
}

function login(string $email, string $senha){
    global $pdo;
    
    //Inserção do usuário adm
    $stament = 
        $pdo->query("SELECT * FROM usuario WHERE email = 'adm@adm.com'");
    $usuario = $stament->fetchAll(PDO::FETCH_ASSOC);
    //verifica se o usuário não existe, se não existir, vamos criar
    if (!$usuario){
        novoUsuario('Administrador', 'adm@adm.com', 'adm', 'adm');
    }

    //Verificar email e senha do usuário
    $stament = 
        $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
        //validar os valores com EXPRESSÕES REGULARES - validar se é um email
    $stament->execute([$email]);
    $usuario = $stament->fetch(PDO::FETCH_ASSOC);
    if($usuario && password_verify($senha, $usuario['senha'])){
        return $usuario;
    } else {
        return null;
    }
}

// Função para verificar se o email já existe no banco de dados
function emailExiste($email) {
    global $pdo;
    $sql = "SELECT COUNT(*) FROM usuario WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    return $stmt->fetchColumn() > 0; // Retorna true se o email já existir
}

// Função para criar um novo usuário
function novoUsuario($nome, $email, $senha, $nivel) {
    global $pdo;

    // Validar o tipo do nível do usuário (cliente ou profissional)
    if ($nivel !== 'cliente' && $nivel !== 'profissional') {
        throw new Exception("O nível do usuário é inválido! Deve ser 'cliente' ou 'profissional'.");
    }

    // Criptografar a senha antes de salvar no banco
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Inserir o novo usuário na tabela "usuario"
    $sql = "INSERT INTO usuario (nome, email, senha, nivel) VALUES (:nome, :email, :senha, :nivel)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $senhaHash,
        ':nivel' => $nivel  // Certifique-se de que o nível correto é passado para o banco
    ]);
}

// Função para excluir usuário
function excluirUsuario(int $id): bool {
    global $pdo;
    $stament = $pdo->prepare("DELETE FROM usuario WHERE id = ?");
    return $stament->execute([$id]);
}

// Função para buscar todos os usuários (exceto os admins)
function todosUsuarios(): array {
    global $pdo;
    $stament = $pdo->query("SELECT * FROM usuario WHERE nivel <> 'adm'");
    $usuarios = $stament->fetchAll(PDO::FETCH_ASSOC);

    // Mapeando os níveis para exibição
    foreach ($usuarios as &$usuario) {
        $usuario['nivel_exibicao'] = mapearNivelUsuario($usuario['nivel']);
    }

    return $usuarios;
}

// Função para buscar um usuário por ID
function retornaUsuarioPorId(int $id): ?array {
    global $pdo;
    $stament = $pdo->prepare("SELECT * FROM usuario WHERE id = ? AND nivel <> 'adm'");
    $stament->execute([$id]);
    $usuario = $stament->fetch(PDO::FETCH_ASSOC);
    
    if ($usuario) {
        $usuario['nivel_exibicao'] = mapearNivelUsuario($usuario['nivel']);
        return $usuario;
    }
    
    return null;
}