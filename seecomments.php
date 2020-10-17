<?php

    session_start();
    
require_once('dbconnect.php');

 /* get the post */
 $postid=$_GET['postid'];
 $r=$db->tweets->findOne(
    array(
        '_id'=>new MongoDB\BSON\ObjectID("$postid")
    )
  );
  

  function get_post_comments($db,$postid)
  {
      $res=$db->comments->find(
      array(
           'postid'=>new MongoDB\BSON\ObjectID("$postid")       
        )
      );
      
      $com = iterator_to_array($res);
      
    return $com;  
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>See Comments</title>
    <link rel="stylesheet" 
       href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
       <link rel="stylesheet" 
       href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 
</head>
<body>
    <?php
    include('header.php');
        //echo $_GET['postid'];
    ?>
    
    
    <div class="row">
        
        <div class="col">
           <a href="home.php" class="btn btn-info">Go Back To Home</a>
        </div>
        
        
        <div class="col-9">
        
             <div class="card">
              <div class="card-header">
                <h5>The Post</h5>
              </div>
              <div class="card-body"  style="height:20px">
                <?php 
                  echo '
                <img 
             src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" 
                    class="rounded-circle"  
                    width="60" height="60">
                    <b style="color:black">
            <a style="color:black" href="profile.php?id='.$r['authorId']  . '"><b>' . $r['authorName'] .'</b></a>
                    </b>
                    <small style="margin-left:390px"> Time : ' . $r['created'] .  '</small>
              </div><br>
              <div class="card-body">' . $r['body'].'<br>
             <hr>
             ';?>
             <div class="card-header">
                  <h6><b><u>Comments On This Post:</u></b></h6>
                  </div>
                  <?php
                  
         $comments=get_post_comments($db,$_GET['postid']);
                  
                  foreach($comments as $c)
                  {
                      echo '
                      <div style="padding-left:150px">
                      <img 
 src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" 
        class="rounded-circle"  
        width="60" height="60">
        <b style="color:black">
<a style="color:black" href="profile.php?id='.$c['userid']  . '"><b>' . $c['username'] .'</b></a>
        </b>
        <small style="margin-left:390px"> Time : ' . $c['created'] .  '</small>
  </div>
  <div style="padding-left:230px" class="card-body">' . $c['comment'].'<br>
 
                     </div> <hr>';
                  }
                  
                  
                  ?>
              </div>
            </div>
       
        </div>
        
        
        <div class="col">
           
        </div>
        
    </div>
    
</body>
</html>