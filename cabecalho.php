<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ReCircula</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header>
  <h2><a href="index.php">♻ ReCircula</a></h2>
  <nav>
    <a href="index.php">Início</a>
    <?php if (isset($_SESSION['id'])): ?>
      <a href="anunciar.php">Anunciar</a>
      <a href="meus_anuncios.php">Meus anúncios</a>
      <a href="logout.php">Sair</a>
    <?php else: ?>
      <a href="login.php">Entrar</a>
      <a href="cadastro.php">Cadastrar</a>
    <?php endif; ?>
  </nav>
</header>
<main>