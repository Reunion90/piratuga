<?php 
    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }



    require_once("../classes/omdb.class.php");
    $omdb = new OMDB();
    $omdb->setParams(['apikey' => '5051a661']);
    $movie = $omdb->get_by_id($_POST['id']);

    if($movie['Response'] == False){
        header("location:../admin/admin.php?msg=Há um erro na base de dados. Por favor adicione o episódio manualmente.");
        exit();
    }

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




    $banner_dir = "banners/";
    $banner_file = $banner_dir . generateRandomString(12) .".jpg";
    $uploadOk = 1;
    $fileTypeBan = strtolower(pathinfo($banner_file,PATHINFO_EXTENSION));
    if (file_exists($banner_file)) {
        header("location:../admin/admin.php?msg=Sorry, file already exists.");
        exit;
        $uploadOk = 0;
    } 
    /*if($fileTypeBan != "jpg" || $fileType != "png") {
        header("location:../admin/admin.php?msg=Sorry, only JPG PNG files are allowed");
        exit;
        $uploadOk = 0;
    }*/
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["banner"]["tmp_name"], "../".$banner_file)) {
            echo "The file ". basename( $_FILES["banner"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


    
    require_once("../import/connection.php");
    $plot = mysqli_real_escape_string($connection, $movie['Plot']);
    $title = mysqli_real_escape_string($connection, $movie['Title']);
    mysqli_query($connection, "INSERT INTO movies (title, translated, synopsis, server1, server2, server3, poster, banner, stars, id, date_year) VALUES ('".$title."' , '".$_POST['translated']."' , '".$plot."' , '".$_POST['sv1']."' , '".$_POST['sv2']."' , '".$_POST['sv3']."' , '".$movie['Poster']."' , '".$banner_file."' , '".round($movie['imdbRating']/2)."' , '".$_POST['id']."' , '".$movie['Year']."' )") or die(mysqli_error($connection));
    header("location:../admin/admin.php?msg=Sucesso!");
?>