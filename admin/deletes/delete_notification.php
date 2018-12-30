<?php
require_once("../../import/connection.php");
$sql = mysqli_query($connection, "DELETE FROM notifications WHERE notification_id = '".$_GET['num']."'") or die(mysqli_error($connection));
mysqli_fetch_assoc($connection, $sql);
header("location:../admin.php?p=notifications");
?>