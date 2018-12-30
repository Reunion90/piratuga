<?php 
    require_once("design/playBtn.php");
    require_once("import/config.php");
    require_once('import/connection.php');
    $result = mysqli_query($connection, "SELECT * FROM movies WHERE id = '$featured'") or die(mysqli_error($connection));
    while($row = mysqli_fetch_assoc($result)){
        $featured_poster_url = $row['poster'];
        $featured_title = $row['title'];
        $featured_stars = $row['stars'];
        $featured_synopsis = $row['synopsis'];
        $featured_banner_url = $row['banner'];
        $featured_translated = $row['translated'];
        $featured_id = $row['id'];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PIRATU.GA | Filmes, Séries e Anime</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,700,800" rel="stylesheet"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">        <link rel="stylesheet" type="text/css" href="css/styles.css?<?php echo time(); ?>">
        <link rel="icon" href="icon.ico" sizes="16x16"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/main.js?<?php echo time(); ?>"></script>
        <meta name="description" content="O teu novo site de filmes e séries."/>
        <link rel="image_src" href="design/logobranco.jpg"/>
        <meta property='og:image' content='http://piratu.ga/design/logobranco.jpg'/>
        <meta name="google-site-verification" content="4EVYLzUSOuv5gyQqTgeTlSHVE_X9muGj650zrX5lC5k" />
    </head>
    <body>
        <?php require_once("import/header.php");?>
        
        <section id="banner" class="clearfix">
        <div class="bg-img"> <?php if($featured_banner_url != ""){echo '<img src="'.$featured_banner_url.'"/>';}?></div>
            <div id="banner_content_wrapper">
                <div id="poster">
                    <img class="poster-image" id="poster" src="<?php echo $featured_poster_url?>" alt="<?php echo $featured_title?>">
                    <a href="filme.php?f=<?php echo $featured_id?>">
                        <?php echo $playBtn ?>
                    </a>
                </div>
                <div id="content">
                    <h2 class="title"><?php echo $featured_title?></h2>
                    <div class="ratings">
                        <?php
                            $star_count = 0;
                            for($i = 0; $i < $featured_stars; $i++){
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
                    <p class="description"><?php echo $featured_synopsis?></p>
                    <p class="info"><em>Título em Portugal: </em><?php echo $featured_translated?></p>
                </div>
            </div>
        </section>
        <section id="top_movies" class="clearfix">
            <div class="wrapper">
                <header class="clearfix">
                    <h2>Filmes Recentes</h2>
                    <a href="filmes.php"><p class="view_more">Ver Todos</p></a>
                </header>
                <div class="row">
                    <?php
                        $result = mysqli_query($connection, "SELECT * FROM movies ORDER BY date_year DESC, order_id DESC") or die(mysqli_error($connection));
                        $count = 0;
                        while(($row = mysqli_fetch_assoc($result)) && ($count < 6)){
                            ?>
                            <a href="filme.php?f=<?php echo $row['id'];?>"><div class="post">
                                <img id="poster" src="<?php echo $row['poster']?>" alt="<?php echo $row['title']?>">
                                <h3 class="title"><?php echo $row['title']?></h3>
                                <p class="post_info"><?php echo $row['date_year']?></p>
                            </div></a>
                        <?php $count++;
                    }?>
                </div>
            </div>
        </section>

        <section id="top_shows" class="clearfix">
            <div class="wrapper">
                <header class="clearfix">
                    <h2>Séries Atualizadas</h2>
                    <a href="series.php"><p class="view_more">Ver Todas</p></a>
                </header>
                <div class="row">
                    <?php
                        $result = mysqli_query($connection, "SELECT DISTINCT tv_show_id, order_id FROM episodes ORDER BY order_id DESC") or die(mysqli_error($connection));
                        $used_ids = array();
                        while($row = mysqli_fetch_assoc($result)){
                            if(!in_array($row['tv_show_id'], $used_ids)){
                                array_push($used_ids, $row['tv_show_id']);
                                $tvshowid = $row["tv_show_id"];
                                $sql = mysqli_query($connection, "SELECT * FROM tv_shows WHERE (id = '$tvshowid')") or die(mysqli_error($connection));
                                while($thisrow = mysqli_fetch_assoc($sql)){
                                ?>
                                <a href="serie.php?f=<?php echo $thisrow['id'];?>"><div class="post">
                                    <img id="poster" src="<?php echo $thisrow['poster']?>" alt="<?php echo $thisrow['title']?>">
                                    <h3 class="title"><?php echo $thisrow['title']?></h3>
                                    <p class="post_info"><?php echo $thisrow['date_year']?></p>
                                </div></a>
                                <?php
                                }
                            }
                            if(count($used_ids) == 6){
                                break;
                            }
                        }
                        ?>
                </div>
            </div>
        </section>

        <section id="top_anime" class="clearfix">
            <div class="wrapper">
                <header class="clearfix">
                    <h2>Animes Atualizados</h2>
                    <a href="animes.php"><p class="view_more">Ver Todos</p></a>
                </header>
                <div class="row">
                    <?php
                        $result = mysqli_query($connection, "SELECT anime_id FROM anime_eps ORDER BY order_id DESC") or die(mysqli_error($connection));
                        $used_ids = array();
                        while($row = mysqli_fetch_assoc($result)){
                            if(!in_array($row['anime_id'], $used_ids)){
                                array_push($used_ids, $row['anime_id']);
                                $animeid = $row["anime_id"];
                                $sql = mysqli_query($connection, "SELECT * FROM animes WHERE (id = '$animeid')") or die(mysqli_error($connection));
                                while($thisrow = mysqli_fetch_assoc($sql)){
                                ?>
                                <a href="anime.php?f=<?php echo $thisrow['id'];?>"><div class="post">
                                    <img id="poster" src="<?php echo $thisrow['poster']?>" alt="<?php echo $thisrow['title']?>">
                                    <h3 class="title"><?php echo $thisrow['title']?></h3>
                                    <p class="post_info"><?php echo $thisrow['date_year']?></p>
                                </div></a>
                                <?php 
                                }
                            }
                            if(count($used_ids) == 6){
                                break;
                            }
                        }
                        ?>
                </div>
            </div>
        </section>

        <section id="newsletter">
            <div class="newsletter-inner">
                <h2>Recebe o melhor conteúdo do PIRATU.GA diretamente no teu email</h2>
                <form class="sign_up_form" action="newsletter.php" method="post">
                    <input required type="text" placeholder="Nome" id="newsletter-name" name="name">
                    <input required type="email" placeholder="Email" id="newsletter-email" name="email">
                    <button class="button" onclick="newsletterSubscribe();">Subscrever</button>
                </form>
            </div>
        </section>
        <?php require_once("import/footer.php");?>
    </body>
</html>