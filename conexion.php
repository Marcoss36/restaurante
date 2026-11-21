<?php
$host = "bx0nacugsn4wfkcqsn7d-mysql.services.clever-cloud.com";
$user = "urjxp93dyoquav4c";
$password = "X80WFp2oTwRqtReBZiNY";
$dbname = "bx0nacugsn4wfkcqsn7d";
$port = 3306;

$conexion = mysqli_connect($host, $user, $password, $dbname, $port);

if (!$conexion) {
    die("Error de conexión con la base de datos remota: " . mysqli_connect_error());
}
?>