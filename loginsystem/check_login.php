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
        $sql="SELECT * FROM users WHERE username='$myusername' and user_pass=SHA('$mypassword')";
        $result=mysqli_query($dbC, $sql);
        // If result matched $myusername and $mypassword, table row must be 1 row
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            $count++;
            session_start();
            if($row['isAdmin'] == 1){
                $_SESSION['admin'] = "thisisadmin";
            }
            $_SESSION["username"] = $myusername;
            if($_POST['rememberme']){
                $token = time();

                $query = mysqli_query($dbC, "UPDATE users SET token='".$token."' WHERE username='".$myusername."'");
                setcookie("usertoken", $token, time()+60*60*30);
            }
            header("location:../index.php");
        }
        if($count == 0) {
            $msg = "Password e/ou Username errados. Tenta denovo.";
            header("location: ../login.php?msg=$msg");
        }
        ob_end_flush();
    }
    else {
        header("location: ../login.php?msg=Por favor introduz o teu username e password.");
    }
?>