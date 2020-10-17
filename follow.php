<?php
 
 session_start();
require_once('dbconnect.php');

 if(!isset($_GET['id']))
 {
     exit;
 }
 
$user_id = $_GET['id'];
$follower_id = $_SESSION['user'];

$db->following->insertOne(array(
 
     'user'=>new MongoDB\BSON\ObjectID("$user_id"),
     'follower' =>new MongoDB\BSON\ObjectID("$follower_id")
));

header('Location: home.php');

?>