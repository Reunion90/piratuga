<?php
    session_start();
    if(isset($_SESSION['success'])){
        header('location: index.php');
    }
?>

<!DOCTYPE html>
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>PIRATUGA | Filmes, Séries e Anime</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/login/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/login/style.css" />
		<link rel="stylesheet" type="text/css" href="css/login/animate-custom.css" />
    </head>
    <body>
        <div class="container">
            <header>
                <h1>Desfruta de todos os beneficios do PIRA<span>TUGA</span>
                <?php if (isset($_GET['msg'])){
                    ?><br><span class="error"><?php echo $_GET['msg']?></span><?php
                }?></h1>
            </header>
            <section>				
                <div id="container_demo" >
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form action="login/checklogin.php" method="POST" autocomplete="on"> 
                                <h1>ENTRAR</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > O teu email/username </label>
                                    <input id="username" name="username" required="required" type="text" placeholder="Email/Username"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p">A tua password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="Password" /> 
                                </p>
                                <p class="keeplogin"> 
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
									<label for="loginkeeping">Manter-me conetado</label>
								</p>
                                <p class="login button"> 
                                    <input type="submit" value="ENTRAR" /> 
								</p>
                                <p class="change_link">
									Ainda não és um de nós?
									<a href="#toregister" class="to_register">Regista-te</a>
								</p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form action="login/checkregister.php" method="POST" autocomplete="on"> 
                                <h1> REGISTAR-SE </h1> 
                                <p> 
                                    <label for="usernamesignup" class="uname" data-icon="u">O teu novo username</label>
                                    <input id="usernamesignup" name="username" required="required" type="text" placeholder="Username" />
                                </p>
                                <p> 
                                    <label for="emailsignup" class="youmail" data-icon="e" > O teu email </label>
                                    <input id="emailsignup" name="email" required="required" type="email" placeholder="Password"/> 
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p"> A tua password super-secreta </label>
                                    <input id="passwordsignup" name="password_1" required="required" type="password" placeholder="Password"/>
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p"> Confirma-a... </label>
                                    <input id="passwordsignup_confirm" name="password_2" required="required" type="password" placeholder="Password"/>
                                </p>
                                <p class="signin button"> 
									<input type="submit" value="REGISTAR-SE"/> 
								</p>
                                <p class="change_link">  
									Já és um membro ?
									<a href="#tologin" class="to_register"> Então entra já! </a>
								</p>
                            </form>
                        </div>
						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>