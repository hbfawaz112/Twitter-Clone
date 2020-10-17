<?php
 
 session_start();
require_once('dbconnect.php');

 if(!isset($_GET['userid']))
 {
     exit;
 }
 
$user_id = $_GET['userid'];
$postidd = $_GET['postid'];

 $db->likes->insertOne(
 array(
  'userid'=>new MongoDB\BSON\ObjectID("$user_id"),
  'postid'=>new MongoDB\BSON\ObjectID("$postidd")
 ));

header('Location: home.php');

/*echo $user_id;
echo "   fsdf  ";
echo $postidd;/*
$db->following->insertOne(array(
 
     'user'=>new MongoDB\BSON\ObjectID("$user_id"),
     'follower' =>new MongoDB\BSON\ObjectID("$follower_id")
));

header('Location: home.php');
*/
?>