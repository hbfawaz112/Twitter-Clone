<?php


    session_start();
  require_once('dbconnect.php');
$userData = $db->users->findOne(array( '_id' =>             $_SESSION['user']));
 
 $comment=$_GET['comment'];
 $postid=$_GET['postid'];
 /*Insert these data to commnet collection in db*/
       $date=date('Y-M-D H:i:s');

  $db->comments->insertOne(
  array(
        'postid'=>new MongoDB\BSON\ObjectID($postid),
        'userid'=>$_SESSION['user'],
        'username'=>$userData['username'],
        'comment'=>$comment,
        'created'=>$date
    )
  );

  header('Location: home.php');
?>