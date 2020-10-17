<?php

session_start();
require_once('dbconnect.php');

if(!isset($_POST['body']))
{
    exit;
    
}

 $user_id=$_SESSION['user'];

 $body=$_POST['body'];

 $userData=$db->users->findOne(array(
  '_id' => $user_id
 ));

  $date=date('Y-M-D H:i:s');

  $db->tweets->insertOne( array(
   'authorId'=>$user_id,
   'authorName'=>$userData['username'],
   'body'=>$body,
   'created'=>$date  
      
      
  ));
  
 header('Location: home.php');

?>