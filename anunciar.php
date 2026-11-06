<?php
require 'config.php';
entrar_obrigatorio();
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    conferir_token();
    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $tipo = $_POST['tipo'] ?? '';
    if ($titulo === '' || $descricao === '' || !in_array($tipo, ['doacao', 'troca'], true)) {
        $erro = 'Preencha todos os campos.';
    } else {
        $salvar = $pdo->prepare("INSERT INTO objetos (usuario_id, titulo, descricao, tipo) VALUES (?, ?, ?, ?)");
        $salvar->execute([$_SESSION['id'], $titulo, $descricao, $tipo]);
        header('Location: meus_anuncios.php');
        exit;
    }
}
include 'cabecalho.php';
?>
<h1>Publicar anúncio</h1>
<p class="erro"><?= limpar($erro) ?></p>
<form method="post" class="formulario">
<input type="hidden" name="token" value="<?= token() ?>">
<label>Título<input name="titulo" maxlength="120" required></label>
<label>Descrição<textarea name="descricao" maxlength="1000" required></textarea></label>
<label>Tipo<select name="tipo"><option value="doacao">Doação</option><option value="troca">Troca</option></select></label>
<button>Publicar</button>
</form>
<?php include 'rodape.php'; ?>