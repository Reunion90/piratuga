<?php
    require_once("import/connection.php");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Erro ao conectar com a base de dados: " . mysqli_connect_error();
    }

    // escape variables for security
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);

    $sql="INSERT INTO newsletter (email, username)
    VALUES ('$email', '$name')";

    if (!mysqli_query($connection,$sql)) {
        if(mysqli_errno($connection) == 1062) {
            die("<p style='font-family:Arial; color: red;'> Este email já está registado. (".$_POST['email'].")</p>");
        } else {
            die(mysqli_error($connection));
        }
    }
    echo "<p style='font-family:Arial; color: green;'>Foste adicionado com sucesso, ".$_POST['name'].".</p>";
    mysqli_close($connection);
    header( "refresh:3;url=index.php" );
?> 