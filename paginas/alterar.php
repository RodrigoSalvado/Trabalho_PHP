<?php
session_start();
include "../basedados/basedados.h";
include "ConstUtilizadores.php";
global $conn;

$alterado = false;

$userLogado = $_SESSION["user"];

$sql = "SELECT tipo_utilizador FROM utilizador WHERE username = '$userLogado'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)){
    $row = mysqli_fetch_assoc($result);
    $tipo = $row["tipo_utilizador"];
}

$id_utilizador = isset($_POST["nomeUser"])? $_POST["nomeUser"]: -1;

$sql = "SELECT username, email, id_utilizador, password FROM utilizador WHERE id_utilizador = '$id_utilizador'";
$result = mysqli_query($conn, $sql);

if($result && mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $username = $row["username"];
        $email = $row["email"];
        $id_utilizador = $row["id_utilizador"];
        $pass = $row["password"];


        if(isset($_POST["username"]) && strcmp($_POST["username"], $username) != 0){
            $novoUser = $_POST["username"];
            echo $novoUser."<br>";
        }
        if(isset($_POST["email"]) && strcmp($_POST["email"], $email) != 0){
            $novoEmail = $_POST["email"];
            echo $novoEmail."<br>";
        }

        if(isset($_POST["pass"]) && strcmp($_POST["pass"], $pass) != 0){
            $novaPass = md5($_POST["pass"]);
            echo $novaPass."<br>";
        }
    }
}






if(isset($_POST["botao"])){

        if(isset($novoUser)){
            $sqlUser = "UPDATE utilizador SET username = '$novoUser' WHERE id_utilizador = '$id_utilizador'";
            mysqli_query($conn, $sqlUser);
            $alterado = true;
        }
        if(isset($novoEmail)){
            $sqlUser = "UPDATE utilizador SET  email = '$novoEmail' WHERE id_utilizador = '$id_utilizador'";
            mysqli_query($conn, $sqlUser);
            $alterado = true;
        }
        if(isset($novaPass)){
            $sqlUser = "UPDATE utilizador SET password = '$novaPass' WHERE id_utilizador = '$id_utilizador'";
            mysqli_query($conn, $sqlUser);
            $alterado = true;
        }



    if ($alterado){
        echo "alterou";
        if($tipo == ADMINISTRADOR){
            echo "<script>window.alert('Dados alterados com sucesso') ; window.location.href = 'gestaoUtilizadores.php';</script>";
        }else if($tipo == ALUNO){
            echo "<script>window.alert('Dados alterados com sucesso!') ; window.location.href = 'login.html';</script>";
        }
    }else{
        echo "<script>window.alert('Insira algum dado para ser alterado') ; window.location.href = 'gerirDados.php';</script>";
    }

}

?>