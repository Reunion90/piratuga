<?php
    require_once("import/connection.php");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "<p style='font-family:Arial; color: red;'>Erro ao conectar com a base de dados: " . mysqli_connect_error() . "</p>";
    }

    // escape variables for security
    $request = mysqli_real_escape_string($connection, $_POST['request']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);

    $sql="INSERT INTO requests (username, request)
    VALUES ('$username', '$request')";
    mysqli_query($connection,$sql) or die("Ocorreu um erro");
    mysqli_close($connection);
    echo "<p style='font-family:Arial; color: green;'>Pedido enviado com sucesso.</p>";
    header( "refresh:1;url=index.php" );
?> 