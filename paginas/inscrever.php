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


// Verifica quantos utilizadores estao no curso
$sqlCount = "SELECT COUNT(id_utilizador) as total FROM util_curso WHERE curso = '$nomeCurso'";
$resultCount = mysqli_query($conn, $sqlCount);

if(mysqli_num_rows($resultCount)>0){
    $row = mysqli_fetch_assoc($resultCount);
    $total = $row["total"]; // total de utilizadores

    $sqlCurso = "SELECT max_num FROM curso WHERE nome = '$nomeCurso'";
    $resultCurso = mysqli_query($conn, $sqlCurso);

    if(mysqli_num_rows($resultCurso)>0){
        $row = mysqli_fetch_assoc($resultCurso);
        $max_num = $row["max_num"]; // vagas para o curso
    }


    if($total<$max_num){ // ve se ha vagas

        // Verifica se o aluno ja fez algum registo
        $sqlVerf = "SELECT *
            FROM util_curso
            WHERE id_utilizador = '$id_user'
            AND curso = '$nomeCurso'";
        $resultVerf = mysqli_query($conn, $sqlVerf);

        if(mysqli_num_rows($resultVerf) == 0){ // Se ainda nao se tinha inscrito
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
    }else{
        echo "<script>alert('Não há mais vagas para este curso!')</script>";
    }
}






?>