<?php
include('../import/connection.php');
$tvshow = $_POST['tvshow'];
$username = mysqli_real_escape_string($connection, $_POST['username']);

mysqli_query($connection, "DELETE FROM subscriptions WHERE (username = '$username' AND tvshow = '$tvshow')") or die ("Ocorreu um erro");

?>