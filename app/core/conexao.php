<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'bazar';

$con = new mysqli($host, $usuario, $senha, $banco);

if ($con->connect_error) {
    die("Erro na conexão: " . $con->connect_error);
}
?>
