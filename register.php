<?php session_start();
    if(isset($_SESSION['username'])){
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>USER LOGIN - PIRATUGA</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="loginsystem/css/style.css">
    <script src="loginsystem/js/prefixfree.min.js"></script>
</head>
<body>
        <div class="body"></div>
        <div class="grad"></div>
        <?php if(isset($_GET['msg'])) echo '<p class="msg">'.$_GET['msg'].'</p>';?>
        <a href="index.php"><div class="header">
            <div>PIRA<span>TUGA</span></div>
        </div></a>
        <br>
		<form name="login" class="login" method="POST" action="loginsystem/check_register.php">
            <input type="text" placeholder="username" id="username" name="username" required><br>
            <input type="password" placeholder="password" id="password"  name="password" required><br>
            <input type="submit" name="submit" id="submit" value="Registar-se">
		</form>
        <p id="pp">Já tens uma conta de utilizador? <a href="login.php">Inicia sessão!</a></p>
        <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
    </body>
</html>