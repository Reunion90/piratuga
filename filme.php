<?php
    if(!isset($_GET['f'])){
        header("Location: filmes.php");
        exit();
    } else {
        if($_GET['f'] == ""){
            header("Location: filmes.php");
            exit();
        }
        $id = $_GET['f'];
    }
    require_once("import/connection.php");
    $result = mysqli_query($connection, "SELECT * FROM movies WHERE id = '$id'") or header("Location: filmes.php");
    $hasrow = 0;
    while($row = mysqli_fetch_assoc($result)){
        $poster = $row['poster'];
        $title = $row['title'];
        $stars = $row['stars'];
        $synopsis = $row['synopsis'];
        $banner = $row['banner'];
        $translated = $row['translated'];
        $server1 = $row['server1'];
        $server2 = $row['server2'];
        $server3 = $row['server3'];
        $hasrow++;
    }
    if($hasrow == 0){
        header("Location: filmes.php");
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>PIRATU.GA | Filmes, Séries e Anime</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,700,800" rel="stylesheet"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="css/styles.css?<?php echo time(); ?>">
        <link rel="icon" href="icon.ico" sizes="16x16"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="js/reports.js?<?php echo time(); ?>"></script>
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
                    
                    <p class="info"><em>Título em Portugal: </em><?php echo $translated ?></p>
                </div>
            </div>
        </section>
            <div style="width:100%;background-color:black;padding-bottom: 5px;"><h2 class="videoTitle"> <?php echo $translated;
            if($server1 != ""){ 
                ?><span id="sv1"><a href="filme.php?f=<?php echo $id ?>">Servidor Openload</a></span><?php 
            } if($server2 != ""){
                ?><span id="sv2"><a href="filme.php?f=<?php echo $id ?>&sv=2">Servidor Rapidvideo</a></span><?php 
            } if($server3 != ""){ 
                ?><span id="sv3"><a href="filme.php?f=<?php echo $id ?>&sv=3">Servidor Vidoza</a></span><?php 
            } ?><span id="sv2"><a href="javascript:void(0)" class="report">Reportar um Erro</a></span></h2>
            

            <div class="hover_bkgr_fricc">
                <span class="helper"></span>
                <div>
                    <div class="popupCloseButton">x</div>
                    <form action="report.php" method="post" id="repform">
                        <input type="hidden" id="id" name="id" value="<?php echo $id?>">
                        <textarea name="report" required></textarea>
                        <div class="g-recaptcha" data-sitekey="6Ldys1QUAAAAAH7Xsu-we8VM9jCVTzxC70SRhvTM"></div>
                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
            
        
        
        </div>
        <section class="video-player">
        <iframe src="
        <?php 
            $pattern = "/www.tugaflix(.*)\/legendas/";
            if(!isset($_GET['sv'])){
                $sv = preg_replace($pattern, $_SERVER['HTTP_HOST']."/subtitles", $server1);
                echo $sv;
                $dlink = preg_replace("/\/embed\//", "/f/", $sv);
            } else {
                if($_GET['sv'] == 2 && $server2 != ""){
                    $sv = preg_replace($pattern, $_SERVER['HTTP_HOST']."/subtitles", $server2);
                    echo $sv;
                    $dlink = preg_replace("/\/e\//", "/v/", $sv);
                } elseif($_GET['sv'] == 3 && $server3 != ""){
                    echo preg_replace($pattern, $_SERVER['HTTP_HOST']."/subtitles", $server3);
                } else {
                    $sv = preg_replace($pattern, $_SERVER['HTTP_HOST']."/subtitles", $server1);
                    echo $sv;
                    $dlink = preg_replace("/\/embed\//", "/f/", $sv);
                }
            }?>" frameborder="0" width="80%" height="100%;" scrolling="no" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
        </section>
        <div class="downloads">
            <a class="download" href="<?php
                if(isset($dlink)){
                    echo $dlink;
                }
                ?>"><i class="fas fa-download"></i>Transferir Série</a><span></span>
                <a class="download" href="<?php 
                $legenda = array();
                preg_match('/\/legendas\/(.*)&/', $server1, $legenda);
                if($legenda[1]){
                    echo '/subtitles/'.$legenda[1]?>"><i class="fas fa-download"></i>Transferir Legendas</a><?php
                } else {
                    preg_match('/\/subtitles\/(.*)&/', $server1, $legenda);
                    echo '/subtitles/'.$legenda[1]?>"><i class="fas fa-download"></i>Transferir Legendas</a><?php
                }?>
        </div>
        <?php require_once("import/footer.php");?>
    </body>
</html>