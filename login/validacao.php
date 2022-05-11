<?php

session_start();

$login = $_POST['login'];
$senha = MD5($_POST['senha']);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "multilojas";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM empresários WHERE email='$login' and senha='$senha'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {
    $id_empresario = $row["id_empresário"];
    $possui_loja = $row["possui_loja"];
  }
  $_SESSION['login'] = $login;
  $_SESSION['id_empresario'] = $id_empresario;
  $_SESSION['possui_loja'] = $possui_loja;

  $conn->close();
  
}
else{
  unset ($_SESSION['login']);
  unset ($_SESSION['id_empresario']);
  header('location:index.html');
  exit();
}

if ($id_empresario) {
  $conn = new mysqli($servername, $username, $password, $dbname);
  $sql = "SELECT * FROM lojas WHERE id_empresário='$id_empresario'";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()) {
    $id_loja = $row["id_loja"];
  }

  $_SESSION['id_loja'] = $id_loja;

  header('location:../painel/index.php');

}
?>