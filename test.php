<?php
	require_once('dbconnect.php');
 /* $result = $db->likes->find();
     
     $c=iterator_count($result);
 
  /*function get_number_of_likes($bd)
  {
        //require_once('dbconnect.php');
   
	$result = $bd->likes->find();
     
     $c=iterator_count($result);
      
	  return $c;
  }*/
  function get_followig_users($db,$userid)
 {  
       $r = $db->following->find(
      array('follower' =>$_SESSION['user']));
      
      $r=iterator_to_array($result);
      
      $users_following_list = array();
      
      foreach($r as $entry){
          $users_following_list[] = $entry['user'];
      }
      
      
      $r= $db->users->find(
      array(
        '_id'=>array(
            '$in' => $users_following_list
        )
      )
      );

      $followinbg_users= iterator_to_array($r);
      
      return $followinbg_users;
 }
 
 $user_list=get_user_list($db);
        foreach($user_list as $user)
        { echo '
        
 <img style="margin-left: 30px ;margin-right:10px; margin-top:20px" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" 
        class="rounded-circle"  width="60" height="60">';
            echo '<b style="font-size:18px">' . $user['username'] . '</b>';
            echo '  <a class="btn btn-secondary" style=" margin-left:150px; padding:7px;font-size:16px" href="profile.php?id=' . $user['_id'] . '">Visit Profile</a>';
            
         
            $result2=$db->following->findOne(array('user'=>$user['_id'] , 'follower'=>$_SESSION['user']));
            
         if(!$result2)
         {
              echo ' <a  class="btn btn-info" style="padding:7px; font-size:16px" href="follow.php?id=' . $user['_id'] . '"> Follow </a>';
         }
         else
         {
              echo ' <a  class="btn" style="padding:7px; font-size:16px" href="follow.php?id=' . $user['_id'] . '"> Following </a>';
         }
         
           
            
            echo '<hr>';
              
        }
/*
 echo get_number_of_likes($db)*/
/* $idd="5f7e05c4c90500001e003b34";
 	$result = $db->likes->find(
	array(
	 'postid'=>new MongoDB\BSON\ObjectID("$idd")
	));
     
     $c=iterator_to_array($result);
      
	  echo $c;
 
 
*/
session_start();

  $result = $db->following->find(
      array('follower' =>$_SESSION['user']));
      
      $result=iterator_to_array($result);
      
      $users_following = array();
      
      foreach($result as $entry){
          $users_following[] = $entry['user'];
      }
	  
	  print_r ($users_following);
?>