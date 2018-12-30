<?php
    require_once("design/playBtn.php");
    require_once("import/connection.php");

    if(isset($_POST["s"])){
        $string = $_POST["s"];
        if($string != ""){
            $resultsTitle = "<h2>Resultados da pesquisa para '$string'</h2>";
            $safe_value = mysqli_real_escape_string($connection, $string);
            $result = mysqli_query($connection, "SELECT * FROM movies WHERE (title LIKE '%$safe_value%' OR translated LIKE '%$safe_value%') ORDER BY order_id DESC") or die(mysqli_error($connection));
            $totalCount = 0;
            $count = 0;
            $searchResults = "";
            while($row = mysqli_fetch_assoc($result)) {
                if($count == 0){
                    $searchResults .= '<div class="row">';
                }
                $searchResults .= ' <a href="filme.php?f='.$row['id'].'"><div class="post"><img id="poster" src="'.$row['poster'].'" alt="'.$row['title'].'"><h3 class="title">'.$row['title'].'</h3><p class="post_info">'.$row['date_year'].'</p></div></a>';
                $count = $count + 1;
                $totalCount = $totalCount + 1;
                if($count == 6){
                    $searchResults .= '</div>';
                    $count = 0;
                }
            }

            if($totalCount == 0){
                $resultsTitle = "<h2>Não foram encontrados resultados para '$string'</h2>";
            }

            if(($totalCount % 6) > 0){
                $searchResults .= '</div>';
            }
        } else {
            $resultsTitle = "<h2>Todos os Filmes</h2>";
            $result = mysqli_query($connection, "SELECT * FROM movies ORDER BY order_id DESC") or die(mysqli_error($connection));
            $totalCount = 0;
            $count = 0;
            $searchResults = "";
            while($row = mysqli_fetch_assoc($result)) {
                if($count == 0){
                    $searchResults .= '<div class="row">';
                }
                $searchResults .= ' <a href="filme.php?f='.$row['id'].'"><div class="post"><img id="poster" src="'.$row['poster'].'" alt="'.$row['title'].'"><h3 class="title">'.$row['title'].'</h3><p class="post_info">'.$row['date_year'].'</p></div></a>';
                $count = $count + 1;
                $totalCount = $totalCount + 1;
                if($count == 6){
                    $searchResults .= '</div>';
                    $count = 0;
                }
            }

            if($totalCount == 0){
                $resultsTitle = "<h2>Não foram encontrados resultados</h2>";
            }

            if(($totalCount % 6) > 0){
                $searchResults .= '</div>';
            }
        }
    } else {
        $resultsTitle = "<h2>Todos os Filmes</h2>";
        $result = mysqli_query($connection, "SELECT * FROM movies ORDER BY date_year DESC, order_id DESC") or die(mysqli_error($connection));
        $totalCount = 0;
        $count = 0;
        $searchResults = "";
        while($row = mysqli_fetch_assoc($result)) {
            if($count == 0){
                $searchResults .= '<div class="row">';
            }
            $searchResults .= ' <a href="filme.php?f='.$row['id'].'"><div class="post"><img id="poster" src="'.$row['poster'].'" alt="'.$row['title'].'"><h3 class="title">'.$row['title'].'</h3><p class="post_info">'.$row['date_year'].'</p></div></a>';
            $count = $count + 1;
            $totalCount = $totalCount + 1;
            if($count == 6){
                $searchResults .= '</div>';
                $count = 0;
            }
        }

        if($totalCount == 0){
            $resultsTitle = "<h2>Não foram encontrados resultados";
        }

        if(($totalCount % 6) > 0){
            $searchResults .= '</div>';
        }
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
        <section id="search-section">
            <div class="search-section-inner">
                <h2>Pesquisar Filmes</h2>
                <form id="search-form" method="post" action="filmes.php">
                    <input type="text" placeholder="Pesquisa" id="searchBox" name="s">
                    <button class="button" onclick="searchMovies()">Pesquisar</button>
                </form>
            </div>
        </section>
        
        <section id="results" class="clearfix">
            <div class="wrapper">
                <header class="clearfix">
                    <?php if(isset($resultsTitle)){echo $resultsTitle;}?>
                </header>
                    <?php if(isset($searchResults)){echo $searchResults;}?>
            </div>
        </section>

        <?php require_once("import/footer.php");?>
    </body>
</html>