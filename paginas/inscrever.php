<?php
include "../basedados/basedados.h";
global $conn;
session_start();

$username = $_SESSION["user"] ;

$nomeCurso = $_POST['nome'];
echo $nomeCurso;


$sql = "SELECT id_utilizador FROM utilizador WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
if($result && mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $id_user = $row["id_utilizador"];
}else{
   echo "erro select";
}
echo $id_user;

$sqlVerf = "SELECT *
            FROM util_curso
            WHERE id_utilizador = '$id_user'
            AND curso = '$nomeCurso'";
$resultVerf = mysqli_query($conn, $sqlVerf);

if(mysqli_num_rows($resultVerf) == 0){
        $sqlInsert = "INSERT INTO util_curso (id_utilizador, curso, aceite) VALUES ('$id_user', '$nomeCurso', 0)";
        $resultInsert = mysqli_query($conn, $sqlInsert);

        if($resultInsert){
            echo "<script>window.alert('Muito obrigado!\\nAguarde até que a sua inscrição seja validada!') ;</script>";
        }else{
            echo "<script>window.alert('erro') ;</script>";
        }
}else{
    echo "<script>alert('Já fez uma inscrição para este curso!')</script>";
}





?>