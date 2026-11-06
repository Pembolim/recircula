<?php
require 'config.php';
$busca = trim($_GET['busca'] ?? '');
$consulta = $pdo->prepare("SELECT objetos.*, usuarios.nome FROM objetos JOIN usuarios ON usuarios.id = objetos.usuario_id WHERE objetos.titulo LIKE ? ORDER BY objetos.id DESC");
$consulta->execute(['%' . $busca . '%']);
$objetos = $consulta->fetchAll(PDO::FETCH_ASSOC);
include 'cabecalho.php';
?>
<section class="destaque"><h1>Doe, troque e reutilize!</h1><p>Objetos parados podem ganhar uma nova vida.</p></section>
<form method="get" class="busca">
<input name="busca" placeholder="Buscar objetos" value="<?= limpar($busca) ?>">
<button>Buscar</button>
</form>
<h2>Anúncios disponíveis</h2>
<div class="grade">
<?php foreach ($objetos as $objeto): ?>
<article class="cartao">
<h3><?= limpar($objeto['titulo']) ?></h3>
<p><?= limpar($objeto['descricao']) ?></p>
<p><strong><?= limpar(ucfirst($objeto['tipo'])) ?></strong> • <?= limpar($objeto['nome']) ?></p>
</article>
<?php endforeach; ?>
</div>
<?php if (!$objetos): ?><p>Nenhum anúncio encontrado.</p><?php endif; ?>
<?php include 'rodape.php'; ?>