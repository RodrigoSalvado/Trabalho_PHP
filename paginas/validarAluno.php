<?php

$nomeUtilizador = $_GET["IdUser"];

$updateSql = "UPDATE utilizador SET tipoUtilizador = '2' WHERE nomeUtilizador = '".$nomeUtilizador."'";

$updateRes = mysqli_query($conn, $updateSql);

header("Location: PgGestUtilizadores.php");