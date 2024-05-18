<?php
global $conn;
include "../basedados/basedados.h";
include "./ConstUtilizadores.php";


$user = isset($_GET["user"])? $_GET["user"]:Null;
$curso = isset($_GET["curso"])? $_GET["curso"]:Null;



if(isset($user)){
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

            echo "<script>alert('Utilizador ".$user." Apagado')</script>";
            break;

        case DOCENTE||ADMINISTRADOR:
            $sql = "DELETE FROM utilizador WHERE id_utilizador = '$id'";
            mysqli_query($conn, $sql);

            $sql = "UPDATE curso SET docente = '' WHERE docente = '$user'";
            mysqli_query($conn, $sql);

            echo "<script>alert('Utilizador ".$user." Apagado')</script>";
            break;

    }
}

if(isset($curso)){
    $sql = "DELETE FROM curso WHERE nome = '$curso'";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM util_curso WHERE curso = '$curso'";
    mysqli_query($conn, $sql);

    echo "<script>alert('Curso ".$curso." Apagado')</script>";
}
