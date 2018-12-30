<?php
    $connection = mysqli_connect("sql303.epizy.com", "epiz_22161598", "piraTUGAadmin18", "epiz_22161598_piratuga");
    $result = mysqli_query($connection, "SELECT * FROM config") or die(mysqli_error($connection));
    while($row = mysqli_fetch_assoc($result)) {
        $featured = $row['featured'];
    }
?>