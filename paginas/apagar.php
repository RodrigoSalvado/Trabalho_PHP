<?php
global $conn;
include "../basedados/basedados.h";
include "./ConstUtilizadores.php";

$user = $_GET["user"];


$sql = "SELECT tipo_utilizador, id_utilizador FROM utilizador WHERE username = '$user'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
    $tipoUtilizador = $row["tipo_utilizador"];
    $id = $row["id_utilizador"];
}

switch ($tipoUtilizador){
    case ALUNO:
        $sql = "DELETE FROM utilizador WHERE id_utilizador = '$id'";
        mysqli_query($conn, $sql);

        $sql = "DELETE FROM util_curso WHERE id_utilizador = '$id'";
        mysqli_query($conn, $sql);
        break;

    default:

        break;

}