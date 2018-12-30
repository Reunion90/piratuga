<?php
require_once("../import/connection.php");
    if($_POST['username']){
        $subject = mysqli_real_escape_string($connection, "O teu pedido foi atendido!");
        $text = mysqli_real_escape_string($connection, "Já temos '".$_POST['request']."'! Clica para ver.");
        $user = $_POST['username'];
        $link = $_POST['link'];
        mysqli_query($connection, "INSERT INTO notifications (notification_subject, notification_text, notification_user, notification_link) VALUES ('$subject' , '$text' , '$user' , '$link')") or die(mysqli_error($connection));
    }
    header("location:../admin/admin.php?msg=Sucesso!&p=notifications");
?>