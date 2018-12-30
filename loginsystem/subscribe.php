<?php
include('../import/connection.php');
$tvshow = $_POST['tvshow'];
$username = mysqli_real_escape_string($connection, $_POST['username']);

mysqli_query($connection, "INSERT INTO subscriptions (username, tvshow) VALUES ('$username', '$tvshow')") or die ("Ocorreu um erro");

?>