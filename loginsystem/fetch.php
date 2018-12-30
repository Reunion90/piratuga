<?php

include('../import/connection.php');

if(isset($_POST['view'])){

  // $connection = mysqli_connect("localhost", "root", "", "notif");
  $username = $_POST['user'];
  if($_POST["view"] != '') {
    $update_query = "UPDATE notifications SET notification_status = 1 WHERE (notification_status=0 AND notification_user='$username')";
    mysqli_query($connection, $update_query);
  }
  
  $result = mysqli_query($connection, "SELECT * FROM notifications WHERE (notification_user='$username' OR notification_user='_general') ORDER BY notification_id DESC LIMIT 4");
  $output = '';
  if(mysqli_num_rows($result) > 0)
  {
    while($row = mysqli_fetch_assoc($result)){
      $output .= '
      <li>
      <a href="'.$row['notification_link'].'">
      <strong>'.$row["notification_subject"].'</strong><br />
      <small><em>'.$row["notification_text"].'</em></small>
      </a>
      </li>

      ';
    }
  }

  else{
      $output .= '<li><a href="#" class="text-bold text-italic">Sem notificações</a></li>';
  }

  $result_query = mysqli_query($connection, "SELECT * FROM notifications WHERE (notification_status=0 AND notification_user='$username')");
  $count = mysqli_num_rows($result_query);

  $data = array(
    'notification' => $output,
    'unseen_notification'  => $count
  );

  echo json_encode($data);
}
?>