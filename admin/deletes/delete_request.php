<?php
require_once("../../import/connection.php");
$sql = mysqli_query($connection, "DELETE FROM requests WHERE num = '".$_GET['num']."'");
mysqli_fetch_assoc($connection, $sql);
header("location:../admin.php?p=supp_team");

//1	djgcs99@gmail.com	The Great Seducer Reign Suits American Crime Story Riverdale Gossip Girl Queer As Folk Morangos Com Açúcar Once Upon a Time Stranger Things Versailles Two Moons Together With Me Scream Queens 13 Reasons Why The Crown Skam Teen Wolf Pr
?>

