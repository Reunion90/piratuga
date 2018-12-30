<?php 
    require_once("../classes/omdb.class.php");
    $omdb = new OMDB();
    $omdb->setParams(['apikey' => '5051a661']);
    $omdb->setParam('type', 'episode');
    $episode = $omdb->get_by_id($_POST['id']);

    if($episode['Response'] == False){
        header("location:../admin/admin.php?msg=Há um erro na base de dados. Por favor adicione o episódio manualmente.");
        exit();
    }

    $subtitle_dir = "../subtitles/";
    $url = array();
    preg_match("/tugaflix(.*)srt/" ,$_POST['sv1'], $url);
    $address = "https://www.".$url[0];
    $subtitle_file = $subtitle_dir . basename($address);

    require_once("../import/connection.php");
    $plot = mysqli_real_escape_string($connection, $episode['Plot']);
    $title = mysqli_real_escape_string($connection, $episode['Title']);
    mysqli_query($connection, "INSERT INTO episodes (tv_show_id, id, season, num, title, poster, stars, synopsis, server1, server2, server3, release_date) VALUES ('".$episode['seriesID']."' , '".$_POST['id']."' , '".$episode['Season']."' , '".$episode['Episode']."' , '".$title."' , '".$episode['Poster']."' , '".round($episode['imdbRating']/2)."' , '".$plot."' , '".$_POST['sv1']."', '".$_POST['sv2']."' , '".$_POST['sv3']."' , '".$episode['Released']."' )") or die(mysqli_error($connection));
    $uploadOk = 1;
    if (file_exists($subtitle_file)) {
        header("location:../admin/admin.php?msg=Sorry, file already exists.");
        exit;
        $uploadOk = 0;
    }else {
        file_put_contents($subtitle_file, file_get_contents($address));
    }

    if($_POST['notify']){
        $sql = mysqli_query($connection, "SELECT * FROM subscriptions WHERE tvshow = '".$episode['seriesID']."'") or die(mysqli_error($connection));
        while($row = mysqli_fetch_assoc($sql)){
            $sql2 = mysqli_query($connection, "SELECT * FROM tv_shows WHERE id = '".$episode['seriesID']."'") or die(mysqli_error($connection));
            while($row2 = mysqli_fetch_assoc($sql2)){
                $tvshow = $row2['title'];
            }
            $subject = mysqli_real_escape_string($connection, $tvshow);
            $text = mysqli_real_escape_string($connection, "Saiu um novo episódio! Clica para ver.");
            $user = $row['username'];
            $link = "ep.php?f=".$_POST['id'];
            mysqli_query($connection, "INSERT INTO notifications (notification_subject, notification_text, notification_user, notification_link) VALUES ('$subject' , '$text' , '$user' , '$link')") or die(mysqli_error($connection));
        }
    }

    header("location:../admin/admin.php?msg=Sucesso!&p=add_episode&val=".$_POST['tv_show']);
?>