<?php session_start();
if(isset($_SESSION['username'])){
    ?><script>var username = '<?php echo $_SESSION['username']?>';</script><?php
}?>
<header id="top_header">
    <div class="wrapper" id="topwrapper">
        <a href="index.php"><h1 class="logo"><span>PIRA</span>TU.GA</h1></a>
        <p <?php 
        require_once('import/connection.php');
        $result = mysqli_query($connection, "SELECT announcement, announcement_color FROM config") or die(mysqli_error($connection));
        while(($row = mysqli_fetch_assoc($result)) && ($count < 6)){
            if($row['announcement'] != ""){
                echo " style='color: ".$row['announcement_color']."'>".$row['announcement'];
            } else {
                ?>><?php
            }
        }
        ?></p>
        <a href="#" class="menu"><i class="fa fa-bars"></i></a>
        <nav id="main_nav">
            <a href="filmes.php">Filmes</a>
            <a href="series.php">Séries</a>
            <a href="animes.php">Animes</a>
            <a href="pedidos.php">Pedidos</a>
            <span>|</span>
            <?php
                require_once('import/connection.php');
                if(!isset($_SESSION['username'])){
                    if(isset($_COOKIE['usertoken'])){
                        $sql = mysqli_query($connection, "SELECT * FROM users WHERE token=".$_COOKIE['usertoken']);
                        $count = 0;
                        while($row = mysqli_fetch_assoc($sql)){
                            $count++;
                            if($row['isAdmin'] == 1){
                                $_SESSION['admin'] = "thisisadmin";
                            }
                            $myusername = $row['username'];
                            $_SESSION["username"] = $myusername;

                            $token = time();

                            $query = mysql_query($connection, "UPDATE users SET token='$token' WHERE username='$myusername'");
                            mysqli_fetch_assoc($query);
                            setcookie("usertoken", $token, time()+60*60*12);

                            header("location:../index.php");
                        }
                        if($count == 0){
                            echo "<a href='login.php'>Iniciar Sessão</a><a href='register.php'>Registar-se</a>";
                        } else {
                            if($_SESSION['admin'] == "thisisadmin"){
                                echo "<span>Bem-vindo, <a href='admin/admin.php'>".$_SESSION["username"]."</a></span>";
                                echo "<a style='float: right' href='loginsystem/logout.php'>Sair</a>";
                                ?>
                                <div style='float: right' id="notif-container">
                                    <div id="notif-counter"></div>
                                    <i class="fas fa-bell" id="notif-button"></i>
                                    <div id="notifications">
                                        <h3>Notificações</h3>
                                        <ul id="notif-content" style="height:250px">
                                        </ul>
                                    </div>
                                </div>
                                <?php
                            } else {
                                echo "<span>Bem-vindo, <a href='admin/admin.php'>".$_SESSION["username"]."</a></span>";
                                echo "<a style='float: right' href='loginsystem/logout.php'>Sair</a>";
                                ?>
                                <div style='float: right' id="notif-container">
                                    <div id="notif-counter"></div>
                                    <i class="fas fa-bell" id="notif-button"></i>
                                    <div id="notifications">
                                        <h3>Notificações</h3>
                                        <ul id="notif-content" style="height:250px">
                                        </ul>
                                    </div>
                                </div><?php
                            }
                        }
                    } else {
                        echo "<a href='login.php'>Iniciar Sessão</a><a href='register.php'>Registar-se</a>";
                    }
                } else {
                    if($_SESSION['admin'] == "thisisadmin"){
                        echo "<span>Bem-vindo, <a href='admin/admin.php'>".$_SESSION["username"]."</a></span>";
                        echo "<a style='float: right' href='loginsystem/logout.php'>Sair</a>";
                        ?>
                        <div style='float: right' id="notif-container">
                            <div id="notif-counter"></div>
                            <i class="fas fa-bell" id="notif-button"></i>
                            <div id="notifications">
                                        <h3>Notificações</h3>
                                        <ul id="notif-content" style="height:250px">
                                        </ul>
                                    </div>
                        </div>
                        <?php
                        
                    } else {
                        echo "<span>Bem-vindo, ".$_SESSION["username"]."</span>";
                        echo "<a style='float: right' href='loginsystem/logout.php'>Sair</a>";
                        ?>
                        <div style='float: right' id="notif-container">
                            <div id="notif-counter"></div>
                            <i class="far fa-bell" id="notif-button"></i>
                            <div id="notifications">
                                        <h3>Notificações</h3>
                                        <ul id="notif-content" style="height:250px">
                                        </ul>
                                    </div>
                        </div>
                        <?php
                        
                    }
                    
                }
                
                ?>
        </nav>
    </div>
</header>