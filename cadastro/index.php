<?php

$nome0 = $_POST['name'];
$sobrenome = $_POST['sobrenome'];
$nome = "{$nome0} {$sobrenome}";
$senha = MD5($_POST['password']);
$email = $_POST['email'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "multilojas";

// Criar Conexão
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "INSERT INTO empresários (possui_loja,email, nome_empresário, senha)
VALUES ('0', '$email', '$nome', '$senha')";

if ($conn->query($sql) === TRUE) {
  header("Location: ../login/index.html");
  exit;
} else {
  echo "Erro Encontrado: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>