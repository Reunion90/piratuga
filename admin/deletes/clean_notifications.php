<?php
require_once("../../import/connection.php");
$sql = mysqli_query($connection, "DELETE FROM notifications WHERE notification_time < DATE_SUB(NOW(), INTERVAL 15 DAY)") or die(mysqli_error($connection));
mysqli_fetch_assoc($connection, $sql);
header("location:../admin.php?p=notifications");
?>