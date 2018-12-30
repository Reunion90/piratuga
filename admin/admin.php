<?php
    session_start(); //Start the session
    $ADMIN = $_SESSION["username"]; //Get the user name from the previously registered super global variable
    if(!isset($_SESSION["admin"])){ //If session not registered
        header("location:../index.php"); // Redirect to login.php page
    }
    else{
        if($_SESSION['admin'] = "thisisadmin"){
            header( 'Content-Type: text/html; charset=utf-8' );
        } else {
            header("location:../index.php");
        }
        
    } //Continue to current page
        

    if(isset($_GET['msg'])){
        echo $_GET['msg'];
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>ADMIN PAGE</title>
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="../icon.ico" sizes="16x16"> 
        <link href="css/simple-sidebar.css" rel="stylesheet">
    </head>
    <body>
        <div id="wrapper" class="toggled">

            <!-- Sidebar -->
            <div id="sidebar-wrapper" style="overflow-x: hidden;">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="admin.php">
                            Painel de Administração
                        </a>
                    </li>
                    <li style="padding-top: 20px">
                        <strong>Filmes</strong>
                    </li>
                    <li>
                        <a href="admin.php?p=featured_movie">Filme em destaque</a>
                    </li>
                    <li>
                        <a href="admin.php?p=add_movie">Adicionar Filme</a>
                    </li>
                    <li>
                        <a href="admin.php?p=add_movie_server"><em>Adicionar Filme Sv.</em></a>
                    </li>
                    <li style="padding-top: 20px">
                        <strong>Séries</strong>
                    </li>
                    <li>
                        <a href="admin.php?p=add_tv_show">Adicionar Série</a>
                    </li>
                    <li>
                        <a href="admin.php?p=add_episode">Adicionar Episódio</a>
                    </li>
                    <li>
                        <a href="admin.php?p=add_episode_manually"><em>Adicionar Ep. Manualmente</em></a>
                    </li>
                    <li>
                        <a href="admin.php?p=add_episode_server"><em>Adicionar Ep. Servidor</em></a>
                    </li>
                    <li style="padding-top: 20px">
                        <strong>Animes</strong>
                    </li>
                    <li>
                        <a href="admin.php?p=add_anime">Adicionar Anime</a>
                    </li>
                    <li>
                        <a href="admin.php?p=add_epanime">Adicionar Episódio de Anime</a>
                    </li>
                    <li style="padding-top: 20px">
                        <strong>Administração</strong>
                    </li>
                    <li>
                        <a href="admin.php?p=edit_msg">Editar Mensagem Inicial</a>
                    </li>
                    <li>
                        <a href="admin.php?p=notifications">Notificações</a>
                    </li>
                    <li style="padding-top: 20px">
                        <strong>Equipas</strong>
                    </li>
                    <li>
                        <a href="admin.php?p=supp_team">Equipa de Suporte</a>
                    </li>
                    <li>
                        -------------------------
                    </li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->



            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <?php if(!isset($_GET['p'])){
                        ?><h1>Bem-vindo à administração, <strong> <?php echo $ADMIN ?> </strong></h1><br>
                        <h3>Updates Recentes:</h3><br>
                        <h5> - Design Tweak</h5>
                        <h5> - Adicionada a secção para a Equipa de Suporte. Lá poderão ver os <strong>PEDIDOS</strong> e os <strong>ERROR REPORTS</strong></h5>
                        <h5><strong>VERYYYY HOOOT!!!</strong> - Secção "Notificações". Para já, é possível adicionar e apagar notificações gerais.</h5><br>
                        <?php
                    } else if($_GET['p'] == "featured_movie"){
                        ?>
                        <h1>Filme em destaque</h1>
                        <form name="featured_movie" id="featured_movie" method="POST" action="../update_db/update_featured.php">
                            <select name="featured">
                                <?php 
                                    require_once("../import/connection.php");
                                    $sql = mysqli_query($connection, "SELECT id, title FROM movies ORDER BY order_id DESC");
                                    while ($row = mysqli_fetch_assoc($sql)){
                                        echo "<option value=\"{$row['id']}\">{$row['title']}</option>";
                                    }
                                ?>
                            </select>
                            <input type="submit" name="submit" id="submit" value="APLICAR"/>
                        </form>
                        
                        <?php
                    } else if($_GET['p'] == "add_movie"){
                        ?>
                        <h1>Adicionar Filme</h1>
                        <form name="add_movie" id="add_movie" method="POST" enctype='multipart/form-data' action="../update_db/add_movie.php">
                            <label for="id">ID do IMDB  </label><input type="text" name="id" id="id"/><br>
                            <label for="translated">Título em Português  </label><input type="text" name="translated" id="translated"/><br>
                            <label for="banner">Banner </label><input type="file" name="banner" id="banner"><br>
                            <label for="sv1">Servidor Openload  </label><input type="text" name="sv1" id="sv1"/><br>
                            <label for="sv2">Servidor Rapidvideo  </label><input type="text" name="sv2" id="sv2"/><br>
                            <label for="sv3">Servidor Vidoza  </label><input type="text" name="sv3" id="sv3"/><br>
                            <input type="submit" name="submit" id="submit" value="APLICAR"/>
                        </form>
                        <?php
                    } else if($_GET['p'] == "add_tv_show"){
                        ?>
                        <h1>Adicionar Série</h1>
                        <form name="add_tv_show" id="add_tv_show" method="POST" enctype='multipart/form-data' action="../update_db/add_tv_show.php">
                            <label for="id">ID do IMDB  </label><input type="text" name="id" id="id"/><br>
                            <label for="translated">Título em Português  </label><input type="text" name="translated" id="translated"/><br>
                            <label for="banner">Banner </label><input type="file" name="banner" id="banner"><br>
                            <input type="submit" name="submit" id="submit" value="APLICAR"/>
                        </form>
                        <?php
                    } else if($_GET['p'] == "add_episode"){
                        ?>
                        <h1>Adicionar Episódio</h1>
                        <form name="add_episode" id="add_episode" method="POST" enctype='multipart/form-data' action="../update_db/add_episode.php">
                            <label for="id">ID do IMDB  </label><input type="text" name="id" id="id"/><br>
                            <label for="sv1">Servidor Openload  </label><input type="text" name="sv1" id="sv1"/><br>
                            <label for="sv2">Servidor Rapidvideo  </label><input type="text" name="sv2" id="sv2"/><br>
                            <label for="sv3">Servidor Vidoza  </label><input type="text" name="sv3" id="sv3"/><br>
                            <input style="margin-top:8px" type="checkbox" id="notify" name="notify" />
                            <label for="rememberme">Notificar Subscritos</label><br>
                            <input type="submit" name="submit" id="submit" value="APLICAR"/>
                        </form>
                        <?php
                    } else if($_GET['p'] == "add_episode_server"){
                        ?>
                        <h1>Adicionar Episódio</h1>
                        <form name="add_episode_server" id="add_episode_server" method="POST" enctype='multipart/form-data' action="../update_db/add_episode_server.php">
                            <label for="id">ID do IMDB  </label><input type="text" name="id" id="id"/><br>
                            <label for="sv1">Servidor Openload  </label><input type="text" name="sv1" id="sv1"/><br>
                            <label for="sv2">Servidor Rapidvideo  </label><input type="text" name="sv2" id="sv2"/><br>
                            <label for="sv3">Servidor Vidoza  </label><input type="text" name="sv3" id="sv3"/><br>
                            <label for="subtitle">Legenda </label><input type="file" name="subtitle" id="subtitle"><br>
                            <input type="submit" name="submit" id="submit" value="APLICAR"/>
                        </form>
                        <?php
                    } else if($_GET['p'] == "add_movie_server"){
                        ?>
                        <h1>Adicionar Filme</h1>
                        <form name="add_movie_server" id="add_movie_server" method="POST" enctype='multipart/form-data' action="../update_db/add_movie_server.php">
                            <label for="id">ID do IMDB  </label><input type="text" name="id" id="id"/><br>
                            <label for="translated">Título em Português  </label><input type="text" name="translated" id="translated"/><br>
                            <label for="banner">Banner </label><input type="file" name="banner" id="banner"><br>
                            <label for="sv1">Servidor Openload  </label><input type="text" name="sv1" id="sv1"/><br>
                            <label for="sv2">Servidor Rapidvideo  </label><input type="text" name="sv2" id="sv2"/><br>
                            <label for="sv3">Servidor Vidoza  </label><input type="text" name="sv3" id="sv3"/><br>
                            <label for="subtitle">Legenda </label><input type="file" name="subtitle" id="subtitle"><br>
                            <input type="submit" name="submit" id="submit" value="APLICAR"/>
                        </form>
                        <?php
                    } else if($_GET['p'] == "add_episode_manually"){
                        ?>
                        <h1>Adicionar Episódio Manualmente</h1>
                        <form name="add_episode_manually" id="add_episode_manually" method="POST" enctype='multipart/form-data' action="../update_db/add_episode_manually.php">
                            <br><h3>Escolha primeiro a série</h3>
                            <select name="tv_show">
                                <?php 
                                    require_once("../import/connection.php");
                                    $sql = mysqli_query($connection, "SELECT id, title FROM tv_shows ORDER BY order_id DESC");
                                    while ($row = mysqli_fetch_assoc($sql)){
                                        echo "<option value=\"{$row['id']}\">{$row['title']}</option>";
                                    }
                                ?>
                            </select><br><br>
                            <label for="id">ID do IMDB  </label><input type="text" name="id" id="id"/><br>
                            <label for="season">Temporada  </label><input type="text" name="season" id="season"/><br>
                            <label for="num">Número  </label><input type="text" name="num" id="num"/><br>
                            <label for="title">Título  </label><input type="text" name="title" id="title"/><br>
                            <label for="poster">Poster  </label><input type="text" name="poster" id="poster"/><br>
                            <label for="stars">Estrelas  </label><input type="text" name="stars" id="postarsster"/><br>
                            <label for="synopsis">Sinopse  </label><input type="text" name="synopsis" id="synopsis"/><br>
                            <label for="release_date">Data de Lançamento (AAAA-MM-DD)  </label><input type="text" name="release_date" id="release_date"/><br>
                            <label for="sv1">Servidor Openload  </label><input type="text" name="sv1" id="sv1"/><br>
                            <label for="sv2">Servidor Rapidvideo  </label><input type="text" name="sv2" id="sv2"/><br>
                            <label for="sv3">Servidor Vidoza  </label><input type="text" name="sv3" id="sv3"/><br>
                            <input type="submit" name="submit" id="submit" value="APLICAR"/>
                        </form>
                        <?php
                    } else if($_GET['p'] == "add_anime"){
                        ?>
                        <h1>Adicionar Anime</h1>
                        <form name="add_anime" id="add_anime" method="POST" enctype='multipart/form-data' action="../update_db/add_anime.php">
                            <label for="id">ID do IMDB  </label><input type="text" name="id" id="id"/><br>
                            <label for="translated">Título Alternativo</label><input type="text" name="alternative" id="alternative"/><br>
                            <label for="banner">Banner </label><input type="file" name="banner" id="banner"><br>
                            <input type="submit" name="submit" id="submit" value="APLICAR"/>
                        </form>
                        <?php
                    } else if($_GET['p'] == "add_epanime"){
                        ?>
                        <h1>Adicionar Episódio de Anime</h1>
                        <form name="add_epanime" id="add_epanime" method="POST" enctype='multipart/form-data' action="../update_db/add_epanime.php">
                            <br><h3>Escolha primeiro o anime</h3>
                            <select name="anime">
                                <?php 
                                    require_once("../import/connection.php");
                                    $sql = mysqli_query($connection, "SELECT id, title FROM animes ORDER BY order_id DESC");
                                    while ($row = mysqli_fetch_assoc($sql)){
                                        echo "<option value=\"{$row['id']}\">{$row['title']}</option>";
                                    }
                                ?>
                            </select><br><br>
                            <label for="id">ID do IMDB  </label><input type="text" name="id" id="id"/><br>
                            <label for="sv1">Servidor  </label><input type="text" name="sv" id="sv"/><br>
                            <input type="submit" name="submit" id="submit" value="APLICAR"/>
                        </form>
                        <?php
                    } else if($_GET['p'] == "supp_team"){
                        ?>
                        <h1>Equipa de Suporte</h1>
                        <h3>Error Reports</h3>
                        <table style="width: 50%" class="table table-striped table-bordered table-hover">
                            <tr>
                                <th>Número</th>
                                <th>ID do Vídeo</th>
                                <th>Report</th>
                            </tr>
                            <?php
                                require_once("../import/connection.php");
                                $sql = mysqli_query($connection, "SELECT * FROM reports");
                                while ($row = mysqli_fetch_assoc($sql)){
                                    echo "<tr><td>".$row['num']."</td><td>".$row['id']."</td><td>".$row['report']."</td><td><a href='deletes/delete_report.php?num=".$row['num']."'>X</a></td></tr>";
                                }
                            ?>
                        </table><br>
                        <br>
                        <h3>Pedidos</h3>
                        <table style="width: 50%" class="table table-striped table-bordered table-hover">
                            <tr>
                                <th>Número</th>
                                <th>Username</th>
                                <th>Pedido</th>
                            </tr>
                            <?php
                                require_once("../import/connection.php");
                                $sql = mysqli_query($connection, "SELECT * FROM requests");
                                while ($row = mysqli_fetch_assoc($sql)){
                                    echo "<tr><td>".$row['num']."</td><td>".$row['username']."</td><td>".$row['request']."</td><td><a href='deletes/delete_request.php?num=".$row['num']."'>X</a></td></tr>";
                                }
                            ?>
                        </table>
                        <?php
                    } else if($_GET['p'] == "notifications"){
                        ?>
                        <h3>Notificações Gerais</h3>
                        <table style="width: 50%" class="table table-striped table-bordered table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Assunto</th>
                            </tr>
                            <?php
                                require_once("../import/connection.php");
                                $sql = mysqli_query($connection, "SELECT * FROM notifications WHERE notification_user='_general'");
                                while ($row = mysqli_fetch_assoc($sql)){
                                    echo "<tr><td>".$row['notification_id']."</td><td>".$row['notification_subject']."</td><td>".$row['notification_text']."</td><td><a href='deletes/delete_notification.php?num=".$row['notification_id']."'>X</a></td></tr>";
                                }
                            ?>
                        </table>
                        <form action="../update_db/add_general_notification.php" method="post" id="msgform">
                            <label for="subject">Assunto</label><input type="text" id="subject" name="subject"/><br>
                            <textarea name="msg" required>Mensagem</textarea>
                            <label for="link">Link</label><input type="text" id="link" name="link"/><br>
                            <input type="submit" value="Adicionar">
                        </form>
                        <br>
                        <h3>Notificador Manual Série</h3>
                        <form action="notifier.php" method="post" id="msgform">
                            <label for="tvshow">ID da série</label><input type="text" id="tvshow" name="tvshow"/><br>
                            <label for="episode">ID do episódio</label><input type="text" id="episode" name="episode"/><br>
                            <input type="submit" value="Enviar">
                        </form>
                        <br>
                        <h3>Notificador Manual Pedido</h3>
                        <form action="notifier_request.php" method="post" id="msgform">
                            <label for="username">Username</label><input type="text" id="username" name="username"/><br>
                            <label for="request">Pedido</label><input type="text" id="request" name="request"/><br>
                            <label for="link">Link</label><input type="text" id="link" name="link"/><br>
                            <input type="submit" value="Enviar">
                        </form>
                        <br>
                        <a href="deletes/clean_notifications.php">Limpar notificações (>15 dias)</a><br>
                        <?php
                    } else if($_GET['p'] == "edit_msg"){
                        ?>
                        <h1>Editar Mensagem Inicial</h1>
                        <h3>Para limpar envia um espaço</h3>
                        <form action="../update_db/msg.php" method="post" id="msgform">
                            <textarea name="msg" required></textarea>
                            <select name="color">
                                <option value="red">VERMELHO</option>
                                <option value="yellow">AMARELO</option>
                                <option value="green">VERDE</option>
                            <input type="submit" value="Enviar">
                        </form>
                        <?php
                    } else {
                        ?><h1>Bem-vindo à administração, <?php echo $ADMIN ?> </h1><br>
                        <h3>Updates Recentes:</h3><br>
                        <h5> - Adicionado o menu "Editar mensagem inicial" para mostrar announcements no header do website. Experimentem!</h5><br>
                        <h5> - Agora não vão haver mais problemas com os nomes das imagens. Um nome de 12 caracteres random é gerado para cada imagem. </h5><br>
                        <?php
                    }?>
                </div>
            </div>
            <!-- /#page-content-wrapper -->    
        </div>
        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>