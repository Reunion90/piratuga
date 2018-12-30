<?php
    if(!isset($_GET['f'])){
        header("Location: series.php");
        exit();
    } else {
        if($_GET['f'] == ""){
            header("Location: series.php");
            exit();
        }
        $id = $_GET['f'];
    }
    require_once('import/connection.php');
    $result = mysqli_query($connection, "SELECT * FROM tv_shows WHERE id = '$id'") or header("Location: filmes.php");
    $hasrow = 0;
    while($row = mysqli_fetch_assoc($result)){
        $hasrow++;
        $poster = $row['poster'];
        $title = $row['title'];
        $stars = $row['stars'];
        $synopsis = $row['synopsis'];
        $banner = $row['banner'];
        $translated = $row['translated'];
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
        <script src="js/subscriptions.js?<?php echo time(); ?>"></script>
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
                    
                    <p class="info"><em>Título em Portugal: </em><?php echo $translated ?></p>
                    <?php if(isset($_SESSION['username'])){
                        ?>
                        <script>
                            var tvshow = '<?php echo $id?>';
                            var username = '<?php echo $_SESSION['username']?>';
                        </script>
                        <button class="subscribe">Subscrever esta Série</button><?php
                    }?>
                    
                </div>
            </div>
        </section>
        <section id="episodes">
            <?php 
                require_once('import/connection.php');
                $seasons = array();
                $sql = mysqli_query($connection, "SELECT * FROM episodes WHERE (tv_show_id = '$id')");
                if($sql != FALSE){
                    while ($row = mysqli_fetch_assoc($sql)){
                        if(!in_array($row['season'], $seasons)){
                            array_push($seasons, $row['season']);
                        }
                    }
                    
                }
                asort($seasons);
                foreach($seasons as $season){
                    ?>
                    <section id="top_shows" class="clearfix">
                        <div class="wrapper">
                            <header class="clearfix">
                                <h2>Temporada <?php echo $season ?></h2>
                            </header>
                            <div class="row">
                    <?php 
                    require_once('import/connection.php');
                    $query = mysqli_query($connection, "SELECT * FROM episodes WHERE (tv_show_id = '$id' AND season = '$season') ORDER BY num");
                    while ($row = mysqli_fetch_assoc($query)){
                        ?>
                        <a href="ep.php?f=<?php echo $row['id']?>"><div class="post">
                            <img class="resized" src="<?php echo $row['poster']?>" alt="<?php echo $row['title']?>">
                            <h3 class="title"><?php echo $row['title']?></h3>
                            <p class="post_info">Episódio <?php echo $row['num']?></p>
                        </div></a>
                        <?php
                    }
                    ?>
                            </div>
                        </div>
                    </section><?php
                }
            ?>
            
        </section>
        <?php require_once("import/footer.php");?>
    </body>
</html>