<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$dbname = "avaliativo";


$conn = new mysqli($servername, $username, $password, $dbname);
//if (!$conn) {
    //die( "Conexão falhou: " . $conn->connect_error);
    //echo "Erro na conexão com o banco de dados.";
//}
//lse {
   // echo "Conexão bem-sucedida.";
//}
?>