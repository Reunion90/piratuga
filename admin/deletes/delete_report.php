<?php
require_once("../../import/connection.php");
$sql = mysqli_query($connection, "DELETE FROM reports WHERE num = '".$_GET['num']."'");
mysqli_fetch_assoc($connection, $sql);
header("location:../admin.php?p=supp_team");
?>