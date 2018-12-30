<?php
    require_once("../import/connection.php");
    mysqli_query($connection, "UPDATE config SET announcement='".$_POST['msg']."'") or die(mysqli_error($connection));
    mysqli_query($connection, "UPDATE config SET announcement_color='".$_POST['color']."'") or die(mysqli_error($connection));
    header("location:../admin/admin.php?msg=Sucesso!&p=edit_msg");
?>