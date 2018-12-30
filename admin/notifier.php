<?php
require_once("../import/connection.php");
    if($_POST['tvshow']){
        $sql = mysqli_query($connection, "SELECT * FROM subscriptions WHERE tvshow = '".$_POST['tvshow']."'") or die(mysqli_error($connection));
        while($row = mysqli_fetch_assoc($sql)){
            $sql2 = mysqli_query($connection, "SELECT * FROM tv_shows WHERE id = '".$_POST['tvshow']."'") or die(mysqli_error($connection));
            while($row2 = mysqli_fetch_assoc($sql2)){
                $tvshow = $row2['title'];
            }
            $subject = mysqli_real_escape_string($connection, $tvshow);
            $text = mysqli_real_escape_string($connection, "Saiu um novo episódio! Clica para ver.");
            $user = $row['username'];
            $link = "ep.php?f=".$_POST['episode'];
            mysqli_query($connection, "INSERT INTO notifications (notification_subject, notification_text, notification_user, notification_link) VALUES ('$subject' , '$text' , '$user' , '$link')") or die(mysqli_error($connection));
        }
    }
    header("location:../admin/admin.php?msg=Sucesso!&p=notifications");
?>