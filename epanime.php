<?php
    if(!isset($_GET['f'])){
        header("Location: animes.php");
        exit();
    } else {
        if($_GET['f'] == ""){
            header("Location: animes.php");
            exit();
        }
        $id = $_GET['f'];
    }
    require_once("import/connection.php");
    $result = mysqli_query($connection, "SELECT * FROM anime_eps WHERE id = '$id'") or header("Location: filmes.php");
    $hasrow = 0;
    while($row = mysqli_fetch_assoc($result)){
        $hasrow++;
        $anime_id = $row['anime_id'];
        $title = $row['title'];
        $stars = $row['stars'];
        $synopsis = $row['synopsis'];
        $query = mysqli_query($connection, "SELECT * FROM animes WHERE id = '$anime_id'") or header("Location: filmes.php");
        while($thisRow = mysqli_fetch_assoc($query)){
            $banner = $thisRow['banner'];
        }
        $sv = $row['sv'];
        $number = $row['num'];
        $poster = $row['poster'];
        $release = $row['release_date'];
        $season = $row['season'];
    }
    if($hasrow==0){
        header("Location: filmes.php");
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>PIRATU.GA | Filmes, Séries e Anime</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,700,800" rel="stylesheet"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">        <link rel="stylesheet" type="text/css" href="css/styles.css?<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="css/styles.css?<?php echo time(); ?>">
        <link rel="icon" href="icon.ico" sizes="16x16"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/main.js?<?php echo time(); ?>"></script>
    </head>
    <body>
    <?php require_once("import/header.php");?>

        <section id="banner" class="clearfix"><div class="bg-img"> <?php if($banner != ""){echo '<img src="'.$banner.'"/>';}?></div>
            <div id="banner_content_wrapper">
                <div id="poster">
                    <img class="poster-image" src="<?php echo $poster ?>" alt="<?php echo $title ?>">
                </div>
                <div id="content">
                    <h2 class="title"><?php echo $title ?></h2>
                    <div class="ratings">
                        <?php
                            $star_count = 0;
                            for($i = 0; $i < $stars; $i++){
                                echo "<i class='fa fa-star'></i>";
                                $star_count++;
                            }
                            if($star_count < 5){
                                for($i = 0; $i < (5 - $star_count); $i++){
                                    echo "<i class='fa fa-star inactive'></i>";
                                }
                            }
                        ?>
                    </div>

                    <p class="description"><?php echo $synopsis ?></p>
                    
                    <p class="info"><em>Data de Lançamento: </em><?php echo $release ?></p>
                </div>
            </div>
        </section>
        <div style="width:100%;background-color:black;padding-bottom: 5px;"><h2 class="videoTitle"> Temporada <?php echo $season?> Episódio <?php echo $number?> - <?php echo $title?></h2></div>
        <section class="video-player">
            <video class="htmlplayer" src="<?php echo $sv?>" controls="" autobuffer=""></video>
        </section>
        <?php require_once("import/footer.php");?>
    </body>
</html>