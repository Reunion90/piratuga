<?php
    require_once("../import/connection.php");
    $subject = mysqli_real_escape_string($connection, $_POST['subject']);
    $text = mysqli_real_escape_string($connection, $_POST['msg']);
    mysqli_query($connection, "INSERT INTO notifications (notification_subject, notification_text, notification_user, notification_link) VALUES ('$subject' , '$text' , '_general' , '".$_POST['link']."')") or die(mysqli_error($connection));
    header("location:../admin/admin.php?msg=Sucesso!&p=notifications");
?>