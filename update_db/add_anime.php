<?php 
    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }



    require_once("../classes/omdb.class.php");
    $omdb = new OMDB();
    $omdb->setParams(['apikey' => '5051a661']);
    $movie = $omdb->get_by_id($_POST['id']);

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
    if($_POST['alternative'] == ""){
        $alternative = $title;
    } else {
        $alternative = $_POST['alternative'];
    }
    mysqli_query($connection, "INSERT INTO animes (title, alternative, synopsis, poster, banner, stars, id, date_year) VALUES ('".$title."' , '".$_POST['alternative']."' , '".$plot."', '".$movie['Poster']."' , '".$banner_file."' , '".round($movie['imdbRating']/2)."', '".$_POST['id']."' , '".$movie['Year']."' )") or die(mysqli_error($connection));
    header("location:../admin/admin.php?msg=Sucesso!");
?>