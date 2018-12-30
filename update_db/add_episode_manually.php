<?php 
    $subtitle_dir = "../subtitles/";
    $url = array();
    preg_match("/tugaflix(.*)srt/" ,$_POST['sv1'], $url);
    $address = "https://www.".$url[0];
    $subtitle_file = $subtitle_dir . basename($address);

    $uploadOk = 1;
    if (file_exists($subtitle_file)) {
        header("location:../admin/admin.php?msg=Sorry, file already exists.");
        exit;
        $uploadOk = 0;
    }else {
        file_put_contents($subtitle_file, file_get_contents($address));
    }
    
    require_once("../import/connection.php");
    $plot = mysqli_real_escape_string($connection, $_POST['synopsis']);
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    mysqli_query($connection, "INSERT INTO episodes (tv_show_id, id, season, num, title, poster, stars, synopsis, server1, server2, server3, release_date) VALUES ('".$_POST['tv_show']."' , '".$_POST['id']."' , '".$_POST['season']."' , '".$_POST['num']."' , '".$title."' , '".$_POST['poster']."' , '".$_POST['stars']."' , '".$plot."' , '".$_POST['sv1']."', '".$_POST['sv2']."' , '".$_POST['sv3']."' , '".$_POST['release_date']."' )") or die(mysqli_error($connection));
    header("location:../admin/admin.php?msg=Sucesso!");
?>