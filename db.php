<?php
$host = '162.241.61.180';
$port = 3306;
$dbname = 'hg99so63_wp360';
$username = 'hg99so63_simuladorvfbank';
$password = 'VFBank@2024';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
