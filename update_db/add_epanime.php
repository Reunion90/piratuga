<?php 
    require_once("../classes/omdb.class.php");
    $omdb = new OMDB();
    $omdb->setParams(['apikey' => '5051a661']);
    $omdb->setParam('type', 'episode');
    $episode = $omdb->get_by_id($_POST['id']);
    echo $_POST['id'];

    require_once("../import/connection.php");
    $plot = mysqli_real_escape_string($connection, $episode['Plot']);
    $title = mysqli_real_escape_string($connection, $episode['Title']);
    mysqli_query($connection, "INSERT INTO anime_eps (anime_id, id, season, num, title, poster, stars, synopsis, sv, release_date) VALUES ('".$_POST['anime']."' , '".$_POST['id']."' , '".$episode['Season']."' , '".$episode['Episode']."' , '".$title."' , '".$episode['Poster']."' , '".round($episode['imdbRating']/2)."' , '".$plot."' , '".$_POST['sv']."' , '".$episode['Released']."' )") or die(mysqli_error($connection));
    header("location:../admin/admin.php?msg=Sucesso!");
?>