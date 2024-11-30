<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/usuarios.php';
    

    $usuario = null; // Inicializa a variável

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {
            $id = intval($_POST['id']);
            if (excluirUsuario($id)){
                header('Location: usuarios.php?success=1');
                exit();
            } else {
                $erro = "Erro ao excluir o usuário!";
            }
        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    } else {
        if (isset($_GET['id'])){
            $id = intval($_GET['id']);
            $usuario = retornaUsuarioPorId($id);
            
            // Verifica se o usuário foi encontrado
            if (empty($usuario)){
                header('Location: usuarios.php?error=Usuario não encontrado');
                exit();
            }
        } else {
            header('Location: usuarios.php?error=ID não especificado');
            exit();
        }
    }
    
?>

<div class="container mt-5">
    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <?php if ($usuario): ?>
        <h2>Excluir Usuário</h2>

        <p>Tem certeza de que deseja excluir o usuário abaixo?</p>

        <ul>
            <li><strong>Nome: <?= htmlspecialchars($usuario['nome'] ?? 'N/A') ?></strong></li>
            <li><strong>Email: <?= htmlspecialchars($usuario['email'] ?? 'N/A') ?></strong></li>
            <li><strong>Nível: <?= htmlspecialchars($usuario['nivel'] ?? 'N/A') ?></strong></li>
        </ul>

        <form method="post">
            <input type="hidden" name="id" value="<?= intval($usuario['id']) ?>" />
            <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
            <a href="usuarios.php" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php else: ?>
        <div class="alert alert-warning">Usuário não encontrado.</div>
    <?php endif; ?>
</div>

<?php require_once 'rodape.php'; ?>