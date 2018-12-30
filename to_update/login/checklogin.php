<?php 

function rememberme($user) {
    $token = bin2hex(random_bytes(78)); // generate a token, should be 128 - 256 bit
    storeTokenForUser($user, $token);
    $cookie = $user . ':' . $token;
    $mac = hash_hmac('sha256', $cookie, "2305PT");
    $cookie .= ':' . $mac;
    setcookie('rememberme', $cookie);
}


session_start();
$db = mysqli_connect("localhost", "admin", "piratuga", "piratuga_db") or die('Error Connecting to MySQL DataBase');;
$username = mysqli_real_escape_string($db, $_POST['username']);
$password = mysqli_real_escape_string($db, $_POST['password']);
$password = md5($password);
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$results = mysqli_query($db, $query);
if (mysqli_num_rows($results) == 1) {
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "Estás logado";
    if(isset($_POST['loginkeeping'])){
        rememberme($username);
    }
    header('location: ../index.php');
} else {
    header('location: ../login.php?msg=PASSWORD/USERNAME ERRADOS');
}
?>