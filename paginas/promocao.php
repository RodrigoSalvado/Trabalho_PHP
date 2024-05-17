<?php
global $conn;
include "../basedados/basedados.h";
include "./ConstUtilizadores.php";

$user = $_GET["user"];
$promover = $_GET["promover"];

if($promover == 1){

    $sqlTipo = "SELECT tipo_utilizador FROM utilizador WHERE username = '$user'";
    $resultTipo = mysqli_query($conn, $sqlTipo);
    if(mysqli_affected_rows($resultTipo)>0){
        $rowTipo = mysqli_fetch_assoc($resultTipo);
        $tipo_utilizador = $rowTipo["tipo_utilizador"];
    }
    if($tipo_utilizador <= ADMINISTRADOR){
        $tipo_utilizador +=1;
        $sql = "UPDATE utilizador SET tipo_utilizador = $tipo_utilizador";
        $result = mysqli_query($conn, $sql);

    }else{
        echo "<script>alert('O utilizador já tem o cargo máximo!')</script>";
        header("Location: gestaoUtilizadores.php");
    }

}else{
    $sqlTipo = "SELECT tipo_utilizador FROM utilizador WHERE username = '$user'";
    $resultTipo = mysqli_query($conn, $sqlTipo);
    if(mysqli_affected_rows($resultTipo)>0){
        $rowTipo = mysqli_fetch_assoc($resultTipo);
        $tipo_utilizador = $rowTipo["tipo_utilizador"];
    }
    if($tipo_utilizador >= ALUNO){
        $tipo_utilizador -=1;
        $sql = "UPDATE utilizador SET tipo_utilizador = $tipo_utilizador";
        $result = mysqli_query($conn, $sql);

    }else{
        echo "<script>alert('O utilizador já tem o cargo minimo!')</script>";
        header("Location: gestaoUtilizadores.php");
    }
}
