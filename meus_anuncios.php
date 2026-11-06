<?php
require 'config.php';
entrar_obrigatorio();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    conferir_token();
    $excluir = $pdo->prepare("DELETE FROM objetos WHERE id = ? AND usuario_id = ?");
    $excluir->execute([(int)($_POST['id'] ?? 0), $_SESSION['id']]);
    header('Location: meus_anuncios.php');
    exit;
}
$consulta = $pdo->prepare("SELECT * FROM objetos WHERE usuario_id = ? ORDER BY id DESC");
$consulta->execute([$_SESSION['id']]);
$objetos = $consulta->fetchAll(PDO::FETCH_ASSOC);
include 'cabecalho.php';
?>
<h1>Meus anúncios</h1>
<div class="grade">
<?php foreach ($objetos as $objeto): ?>
<article class="cartao">
<h3><?= limpar($objeto['titulo']) ?></h3>
<p><?= limpar($objeto['descricao']) ?></p>
<p><?= limpar(ucfirst($objeto['tipo'])) ?></p>
<form method="post" onsubmit="return confirm('Excluir este anúncio?')">
<input type="hidden" name="token" value="<?= token() ?>">
<input type="hidden" name="id" value="<?= (int)$objeto['id'] ?>">
<button class="perigo">Excluir</button>
</form>
</article>
<?php endforeach; ?>
</div>
<?php if (!$objetos): ?><p>Você ainda não publicou anúncios.</p><?php endif; ?>
<?php include 'rodape.php'; ?>