<?php
global $conn;
include "../basedados/basedados.h";

$user = $_GET["user"];

$sql = "SELECT username FROM utilizador WHERE username = '$user'";
mysqli_query($conn, $sql);
