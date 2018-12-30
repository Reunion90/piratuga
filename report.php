<?php
    require_once("import/connection.php");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "<p style='font-family:Arial; color: red;'>Erro ao conectar com a base de dados: " . mysqli_connect_error() . "</p>";
    }

    // escape variables for security
    $report = mysqli_real_escape_string($connection, $_POST['report']);
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $sql="INSERT INTO reports (id, report)
    VALUES ('$id', '$report')";

    if(mail("pessoal.dbarbosa@gmail.com", "Novo Report de ".$_POST['id'], $_POST['report'])){
        mysqli_query($connection,$sql);
        echo "<p style='font-family:Arial; color: green;'>Report enviado com sucesso.</p>";
        mysqli_close($connection);
        header( "refresh:3;url=index.php" );
    } else {
        echo "Ocorreu um erro";
    }
?> 