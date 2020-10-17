<?php

 session_start();

require_once('dbconnect.php');
 
 if(!isset($_SESSION['user']))
 {
     header('Location : index.php');
     
 }
 
 $userData = $db->users->findOne(array( '_id' => $_SESSION['user']));
 

 function get_user_list($db){
     $result = $db->users->find();
     
     $users=iterator_to_array($result);
     
     return $users;
 }


  function get_recent_tweets($db)
  {
      $result = $db->following->find(
      array('follower' =>$_SESSION['user'],
            
           
           ));
      
      $result=iterator_to_array($result);
      
      $users_following = array();
      
      foreach($result as $entry){
          $users_following[] = $entry['user'];
      }
      
      array_push($users_following , $_SESSION['user']);
      
      
      /* and get the id of user who follow me and push them to the array*/
      /*Another query*/
      
      
      $options = ['sort' => ['created' => -1]];
      
      $result = $db->tweets->find(array(
           'authorId' => array(
            '$in' => $users_following
           )
      ) , $options );//.sort({'created': asc});
      
      $recent_tweets = iterator_to_array($result);
      
      return $recent_tweets;
      
  }

  function get_number_of_likes($bd,$postid)
  {
   
       $result_likes = $bd->likes->find(
       array(
            'postid'=>$postid
        )
       );
     
       $c=iterator_count($result_likes);
      
	  return $c;
  }


 function get_number_followers($db,$userid)
 {
     $result_following = $db->following->find(
     
     array(
        'follower'=>$userid
     )
     );
     
     $c1=iterator_count($result_following);
      
	  return $c1;
     
 }


 function get_number_following($db,$userid)
 {
      $result_follower = $db->following->find(
     
     array(
        'user'=>$userid
     )
     );
     
     $c2=iterator_count($result_follower);
      
	  return $c2;
 }

    
  function get_followig_users($db,$userid)
 {  
       $r = $db->following->find(
      array('follower' =>$userid));
      
      $r=iterator_to_array($r);
      
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


 function get_follower_users($db,$userid)
 {  
       $r = $db->following->find(
      array('user' =>$userid));
      
      $r=iterator_to_array($r);
      
      $users_follower_list = array();
      
      foreach($r as $entry){
          $users_follower_list[] = $entry['follower'];
      }
      
      
      $r= $db->users->find(
      array(
        '_id'=>array(
            '$in' => $users_follower_list
        )
      )
      );

      $follower_users= iterator_to_array($r);
      
      return $follower_users;
 }

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HomePage</title>
       <link rel="stylesheet" 
       href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
       <link rel="stylesheet" 
       href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
 
.comment__input:focus{
  border: 1px solid #1670BE;
    box-shadow: 0 0 3px #1670BE;
    outline-offset: 0px;
    outline: none;
  }
.fa {
  font-size: 20px;
  cursor: pointer;
  user-select: none;
}

.fa:hover {
  color: darkblue;
}
</style>
<script src="https://use.fontawesome.com/133addc2f9.js"></script>
</head>
<body>

   <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Open following
  </button>
   
   
   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">
    Open follower
  </button>-->
   
   
   
    <?php
    include('header.php');
    ?>
    
   
    
    
    <div class="row">
    <div class="col">
     <div class="card">
  <div class="card-header">
    <h5>Profile</h5>
  </div>
  <div class="card-body"  style="height:400px">
    
        <img align="center" 
 src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" 
        class="rounded-circle"  
        width="100" height="100">
        
        <br>
        Name: <b><?php echo $userData['firstname'].' ';echo $userData['lastname']; ?></b><br>
        
        
        UserName:  <b>@<?php echo $userData['username']; ?> </b><br>
        
        Date Of Birthday:  <b><?php echo $userData['dob']; ?> </b><br>
        
    <?php echo "<b>" . get_number_followers($db,$_SESSION['user']) . "</b>"; ?> 
      <button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModal">
     following
  </button>   
      &nbsp;
      
    <?php echo "<b>" . get_number_following($db,$_SESSION['user']) . "</b>";?> 
    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModal2">
     followers
  </button>   <br><br>
    
    <input 
    onclick="location.href = 'mytweets.php?id=<?php echo $_SESSION['user']; ?>';"
    class="btn-primary" style=" padding: 9px 16px;
    background-color: rgba(0,136, 169, 1) ;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3 ease 0s;" type="submit" value="My Tweets">
    <a class="btn-secondary" style=" padding: 9px 16px;
    border: none;
    border-radius: 50px;
    cursor: pointer;
                                    transition: all 0.3 ease 0s;" href="update_my_profile.php"> Update My Profile</a>
  
  </div>
</div>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <div class="col-6">
     <div class="card">
  <div class="card-header">
    <h5>Make Your Post</h5>
  </div>
  <div class="card-body"  style="height:220px">
    
  <form method="post" action="create_tweet.php">
  <div class="form-group">
  <textarea class="form-control" name="body" 
  id="exampleFormControlTextarea1" rows="3" 
  placeholder="your post or caption" ></textarea>
  </div>
  <input class="btn-primary" style=" padding: 9px 25px;
    background-color: rgba(0,136, 169, 1) ;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3 ease 0s;" type="submit" value="Post / Tweet">
  </form>
  
  </div>
</div>
   <hr>
   
     
     <div>
         
         
         
         <p style="text-align: center;" ><b>Recent tweets from people you're following</b></p>
         <?php
         
         /*
         location.href="likepost.php?userid='
                 <?php echo $_SESSION['user'];?>
                 ',postid='<?php echo $tweet['_id'];?>'"
         */
          $recent_tweets=get_recent_tweets($db);
         
         foreach($recent_tweets as $tweet)
         {
             echo '
                <div class="card"  ;
                  >
 <div >
 <img 
 src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" 
        class="rounded-circle"  
        width="60" height="60">
        <b style="color:black">
<a style="color:black" href="profile.php?id='.$tweet['authorId']  . '"><b>' . $tweet['authorName'] .'</b></a>
        </b>
        <small style="margin-left:390px"> Time : ' . $tweet['created'] .  '</small>
  </div>
  <div class="card-body">' . $tweet['body'].'<br>
 <hr>
  <form method="post" >';

             $result2=$db->likes->findOne(array('userid'=>$_SESSION['user'] , 'postid'=>$tweet['_id']));
     //echo $tweet['_id'];
            
             
             
            
             //echo"<br>";
    if(!$result2)
    {         
      echo"<i 
       onclick=\"window.location.href='likepost.php?userid=$_SESSION[user]&postid=$tweet[_id]'\"
      class=\"fa fa-thumbs-up\"></i> &nbsp;";
    }
             
             
    else
        
    {
        
        echo "
        <i style=\"color:blue\" class=\"fa fa-thumbs-up\" >(liked)</i> &nbsp;
        ";
    }    
             
              /*Get numbersof likes*/
             
               $result_likes = $db->likes->find(
                   array(
                        'postid'=>new MongoDB\BSON\ObjectID($tweet['_id'])
                    )
                   );

                   $c=iterator_count($result_likes);
             echo " $c likes ";
             
             echo"</form>";
  echo "
  <form methode=\"get\" action=\"addcomments.php\">
  
  
  <input  name=\"comment\" class=\"comment__input\" style=\"margin-left:11px ;border:none; width:450px;\" type=\"text\" placeholder=\"Your Comment...\"/>
   
   <input type=\"hidden\" id=\"postid\" name=\"postid\" value=\"$tweet[_id]\">
    
  <input  class=\"btn-primary\" 
    style=\"padding: 9px 20px;
            background-
            color: rgba(0,136, 169, 1) ;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3 ease 0s;\"

    type=\"submit\" value=\"Submit\">
   
   <a href=\"seecomments.php?postid=$tweet[_id]\"
    class=\"btn-primary\" style=\" padding: 9px 16px;
    background-color: rgba(0,136, 169, 1) ;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3 ease 0s;\">Comments</a>
     </form>";
     
     echo '

    
  
</div>

</div>
             ';
             echo"<br>";
         }
         
         ?>
    </div>
    </div>
    <div class="col">
        
        <h5>Pepole You May Know</h5>
        <?php
    
       $user_list=get_user_list($db);
        foreach($user_list as $user)
        { echo '
        
 <img style="margin-left: 30px ;margin-right:10px; margin-top:20px" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" 
        class="rounded-circle"  width="60" height="60">';
            echo '<b style="font-size:18px">' . $user['firstname'] . ' ' . $user['lastname'] . '</b>';
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
      ?>
        
    </div>
  </div>
    
    
    <br>
    
    
    
    
    <!-- The following  Modal -->
  <div class="modal"  id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">
          <?php echo $userData['username']; ?> following users
           </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <?php
            
            $userlist=get_followig_users($db,$_SESSION['user']);
            
            foreach( $userlist as $user)
            {
                echo '
        
 <img style="margin-left: 30px ;margin-right:10px; margin-top:20px" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" 
        class="rounded-circle"  width="60" height="60">';
            echo '<b style="font-size:18px">' . $user['username'] . '</b>';
            echo '  <a class="btn btn-secondary" style=" margin-left:50px; padding:7px;font-size:16px" href="profile.php?id=' . $user['_id'] . '">Visit Profile</a>';
            
         
            $result2=$db->following->findOne(array('user'=>$user['_id'] , 'follower'=>$_SESSION['user']));
            
        /* if(!$result2)
         {
              echo ' <a  class="btn btn-info" style="padding:7px; font-size:16px" href="follow.php?id=' . $user['_id'] . '"> Follow </a>';
         }
         else
         {
              echo ' <a  class="btn" style="padding:7px; font-size:16px" href="follow.php?id=' . $user['_id'] . '"> Following </a>';
         }
         */
           
            
            echo '<hr>';
         
            }
            ?>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div> 
   
   
   
    
    
    
    
    <!-- The follower  Modal -->
  <div class="modal"  id="myModal2">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">
          <?php echo $userData['username']; ?> follower users
           </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <?php
            
            $userlist=get_follower_users($db,$_SESSION['user']);
            
            foreach( $userlist as $user)
            {
                echo '
        
 <img style="margin-left: 30px ;margin-right:10px; margin-top:20px" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" 
        class="rounded-circle"  width="60" height="60">';
            echo '<b>' . $user['username'] . '</b><br>';
            echo '  <a class="btn btn-secondary" style=" margin-left:320px; padding:7px;font-size:16px" href="profile.php?id=' . $user['_id'] . '">Visit Profile</a>';
            
         
            $result2=$db->following->findOne(array('user'=>$user['_id'] , 'follower'=>$_SESSION['user']));
            
        /* if(!$result2)
         {
              echo ' <a  class="btn btn-info" style="padding:7px; font-size:16px" href="follow.php?id=' . $user['_id'] . '"> Follow </a>';
         }
         else
         {
              echo ' <a  class="btn" style="padding:7px; font-size:16px" href="follow.php?id=' . $user['_id'] . '"> Following </a>';
         }
         */
           
            
            echo '<hr>';
         
            }
            ?>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
</body>
</html>