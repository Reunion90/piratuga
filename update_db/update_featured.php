<?php
    require_once("../import/connection.php");
    mysqli_query($connection, "UPDATE config SET featured='".$_POST['featured']."'") or die(mysqli_error($connection));
    header("location:../admin/admin.php?msg=Sucesso!");
?>