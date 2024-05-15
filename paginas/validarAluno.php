<?php
global $conn;
include "../basedados/basedados.h";

$id = $_GET["id"];
$validado = $_GET["validar"];

if($validado == 1){
    echo "1";
    /*
    $sql = "UPDATE util_curso SET aceite = 1";
    mysqli_query($conn, $sql);
    */
}else{
    echo "0";
    /*
    $sql = "UPDATE util_curso SET aceite = 0";
    mysqli_query($conn, $sql);
    */
}
