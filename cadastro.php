<?php
require 'config.php';
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    conferir_token();
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($senha) < 6) {
        $erro = 'Preencha os dados. A senha precisa de 6 caracteres ou mais.';
    } else {
        $verificar = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $verificar->execute([$email]);
        if ($verificar->fetch()) {
            $erro = 'Esse e-mail já foi cadastrado.';
        } else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $salvar = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $salvar->execute([$nome, $email, $hash]);
            header('Location: login.php');
            exit;
        }
    }
}
include 'cabecalho.php';
?>
<h1>Criar conta</h1>
<p class="erro"><?= limpar($erro) ?></p>
<form method="post" class="formulario">
<input type="hidden" name="token" value="<?= token() ?>">
<label>Nome<input name="nome" maxlength="100" required></label>
<label>E-mail<input type="email" name="email" required></label>
<label>Senha<input type="password" name="senha" minlength="6" required></label>
<button>Cadastrar</button>
</form>
<?php include 'rodape.php'; ?>