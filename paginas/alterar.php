<?php

include "../basedados/basedados.h";
global $conn;

if(isset($_POST["nomeUser"])){
    $user = $_POST["nomeUser"];
}



if (isset($_POST["username"])) {
    $novoUser = $_POST["username"];
}

if (isset($_POST["email"])) {
    $novoEmail = $_POST["email"];
}

if (isset($_POST["pass"])) {
    $novaPass = md5($_POST["pass"]);
}


if(isset($_POST["botao"])){
    $alterado = false;

    if($novoUser!=null){
        $sqlUser = "UPDATE utilizador SET username = '$novoUser' , email = '$novoEmail', password = '$novaPass' WHERE username = '$user'";
        mysqli_query($conn, $sqlUser);
        $alterado = true;
    }

    if ($alterado){
        echo "<script>window.alert('Dados alterados com sucesso!') ; window.location.href = 'login.html';</script>";
    }else{
        echo "<script>window.alert('Insira algum dado para ser alterado') ; window.location.href = 'gerirDados.php';</script>";
    }

}

?>