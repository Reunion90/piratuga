<?php
session_start();

// initializing variables
$username = "";
$email    = "";

// connect to the database
$db = mysqli_connect("localhost", "admin", "piratuga", "piratuga_db") or die('Error Connecting to MySQL DataBase');;

$username = mysqli_real_escape_string($db, $_POST['username']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

if ($password_1 != $password_2) {
  header('location: ../login.php?msg=As tuas passwords nao coincidem');
  exit();
}

$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) { // if user exists
  if ($user['username'] === $username) {
    header('location: ../login.php?msg=Esse username ja foi usado');
    exit();
  }

  if ($user['email'] === $email) {
    header('location: ../login.php?msg=Esse email ja foi usado');
    exit();
  }
}

  $password = md5($password_1);//encrypt the password before saving in the database

  $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
  mysqli_query($db, $query);
  $_SESSION['username'] = $username;
  $_SESSION['success'] = "Estás logado";
  header('location: ../index.php');
?>