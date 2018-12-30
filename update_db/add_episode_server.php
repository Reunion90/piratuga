<?php 
    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    require_once("../classes/omdb.class.php");
    $omdb = new OMDB();
    $omdb->setParams(['apikey' => '5051a661']);
    $omdb->setParam('type', 'episode');
    $episode = $omdb->get_by_id($_POST['id']);
    echo $_POST['id'];

    if($episode['Response'] == False){
        header("location:../admin/admin.php?msg=Há um erro na base de dados. Por favor adicione o episódio manualmente.");
        exit();
    }

    $subtitle_dir = "subtitles/";
    $subtitlename = generateRandomString(12) .".srt";
    $subtitle_file = $subtitle_dir . $subtitlename;
    echo $subtitle_file;

    $uploadOk = 1;
    if (file_exists($subtitle_file)) {
        header("location:../admin/admin.php?msg=Sorry, file already exists.");
        exit;
        $uploadOk = 0;
    }else {
        if (move_uploaded_file($_FILES["subtitle"]["tmp_name"], "../".$subtitle_file)) {
            echo "The file ". basename( $_FILES["subtitle"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    }

    require_once("../import/connection.php");
    $plot = mysqli_real_escape_string($connection, $episode['Plot']);
    $title = mysqli_real_escape_string($connection, $episode['Title']);
    $sv1 = $_POST['sv1']."?c1_file=https://piratu.ga/subtitles/".$subtitlename."&";
    mysqli_query($connection, "INSERT INTO episodes (tv_show_id, id, season, num, title, poster, stars, synopsis, server1, server2, server3, release_date) VALUES ('".$episode['seriesID']."' , '".$_POST['id']."' , '".$episode['Season']."' , '".$episode['Episode']."' , '".$title."' , '".$episode['Poster']."' , '".round($episode['imdbRating']/2)."' , '".$plot."' , '".$_POST['sv1']."', '".$_POST['sv2']."' , '".$_POST['sv3']."' , '".$episode['Released']."' )") or die(mysqli_error($connection));
    header("location:../admin/admin.php?msg=Sucesso!&p=add_episode&val=".$_POST['tv_show']);
?>