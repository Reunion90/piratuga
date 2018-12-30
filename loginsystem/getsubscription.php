<?php
include('../import/connection.php');
$tvshow = $_POST['tvshow'];
$username = mysqli_real_escape_string($connection, $_POST['username']);

$query = mysqli_query($connection, "SELECT * FROM subscriptions WHERE (tvshow='$tvshow' AND username='$username')") or die ("Ocorreu um erro");
$count = mysqli_num_rows($query);
if($count > 0){
    $subscribed = true;
    $unsubscribed = false;
} else {
    $unsubscribed = true;
    $subscribed = false;
}

$data = array(
    'subscribed' => $subscribed,
    'unsubscribed'  => $unsubscribed
);

echo json_encode($data);

?>