<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php'; 
    require_once '../funcoes/usuarios.php';

    $erro = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $nivel = $_POST['nivel']; // Agora o nível será enviado pelo formulário

            // Verificar se o email já existe no banco de dados
            if (empty($nome) || empty($email) || empty($senha) || empty($nivel)) {
                $erro = "Todos os campos são obrigatórios!";
            } else {
                // Função para verificar se o email já existe
                if (emailExiste($email)) {
                    $erro = "Este email já está cadastrado!";
                } else {
                    if (novoUsuario($nome, $email, $senha, $nivel)){
                        header('Location: usuarios.php');
                        exit();
                    } else {
                        $erro = "Erro ao criar o usuário!";
                    }
                }
            }
        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Criar Novo Usuário</h2>

    <?php if (!empty($erro)): ?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nivel" class="form-label">Nível</label>
            <select name="nivel" id="nivel" class="form-control" required>
                <option value="cliente">Cliente</option>
                <option value="profissional">Profissional</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Criar Usuário</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
