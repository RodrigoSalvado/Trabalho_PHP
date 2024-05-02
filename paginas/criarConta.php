<?php

$user = $_POST["user"];
$pass = $_POST["pass"];
$tml = $_POST["tml"];
$email = $_POST["email"];

$sql = "INSERT INTO utilizador (username, password, telemovel, email) 
                    VALUES ('".$user."',".md5($pass)."','".$tlm."', '".$email."');";
//echo $sql;
$res = mysqli_query ($conn, $sql);
header ("Location:./paginaPrincipal.htlm");
