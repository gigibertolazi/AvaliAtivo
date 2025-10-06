<?php
$hostname = "localhost"; 
$username = "root";
$password = "";
$dbname = "avaliativo";


$conexao = new mysqli($hostname, $username, $password, $dbname);
if (!$conexao) {
    die( "Conexão falhou: " . $conexao->connect_error);
}

?>