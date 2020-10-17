<?php
  
  session_start();

   require_once('dbconnect.php');

   if(!isset($_SESSION['user']))
   {
       header('Location : index.php');
   }
 
  $userData = $db->users->findOne(array(
   
       '_id'=>$_SESSION['user']
  ));
 
 function get_user_list($db){
     $result = $db->users->find();
     
     $users=iterator_to_array($result);
     
     return $users;
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User List</title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">



</head>
<body>
    <?php
    include('header.php');
    ?><h5>List Of Users
    
    
    <form style="" class="form-inline my-2 my-lg-0" action="posts.php" method="post">
     Search for Users:

     <input class="form-control" style="width:230px ; height:30px"  name="usernamee" placeholder="Search" required>

    <input type="submit" class="btn btn-primary" style="font-size:16px" value="Search">
    </form>
    <hr>
    <div class="row">
        
        <div class="col">
            
        </div>
        
        <div class="col-6">
            <div>
    <?php
    
       $user_list=get_user_list($db);
        foreach($user_list as $user)
        { echo '
        
 <img style="margin-left: 30px ;margin-right:10px; margin-top:20px" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" 
        class="rounded-circle"  width="60" height="60">';
            echo '<b style="font-size:18px">' . $user['username'] . '</b><br>';
         
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
        
        <div class="col">
            
        </div>
    </div>
    </h5>
</body>
</html>