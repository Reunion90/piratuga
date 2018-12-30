<?php
    $username = $_POST['username']; //Set UserName
    $password = $_POST['password']; //Set Password
    $msg ='';
    if(isset($username, $password)) {
        ob_start();
        include('config.php'); //Initiate the MySQL connection
        // To protect MySQL injection (more detail about MySQL injection)
        $myusername = stripslashes($username);
        $mypassword = stripslashes($password);
        $myusername = mysqli_real_escape_string($dbC, $myusername);
        $mypassword = mysqli_real_escape_string($dbC, $mypassword);
        $sql="SELECT * FROM users WHERE username='$myusername'";
        $result=mysqli_query($dbC, $sql);
        while($row = mysqli_fetch_assoc($result)){
            header("location:../register.php?msg=Esse nome de utilizador já existe");
            ob_end_flush();
            exit();
        }
        $query = mysqli_query($dbC, "INSERT INTO users (username, user_pass, token, isAdmin) VALUES ('".$myusername."', SHA('".$mypassword."'), 0, 0)") or die(mysqli_error($connection));
        $msg = "A conta foi criada! Por favor inicia sessão.";
        header("location: ../login.php?msg=$msg");
        ob_end_flush();
    }
    else {
        header("location: ../register.php?msg=Por favor introduz o um username e password.");
    }
?>