<?php
session_start();

$pdo = new PDO("mysql:host=localhost;dbname=recircula_simples;charset=utf8mb4", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function limpar($texto) {
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}
function entrar_obrigatorio() {
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit;
    }
}
function token() {
    if (!isset($_SESSION['token'])) $_SESSION['token'] = bin2hex(random_bytes(16));
    return $_SESSION['token'];
}
function conferir_token() {
    if (!hash_equals(token(), $_POST['token'] ?? '')) exit('Formulário inválido. Volte e tente novamente.');
}
?>