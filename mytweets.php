<?php

 session_start();
 
 require_once('dbconnect.php');

 if(!isset($_SESSION['user']))
 {
     header('Location: index.php');
     
 }
 
if(!isset($_GET['id']))
{
    header('Location: index.php');
}

 $userData = $db->users->findOne(array(
 
      '_id' => $_SESSION['user']
 ));

 $profile_id=$_GET['id'];
 
 $profileData= $db->users->findOne(array(
  '_id'=>new MongoDB\BSON\ObjectID("$profile_id")
 ));

 
function get_recent_tweets($db)
{
    $id = $_GET['id'];
    
    $result = $db->tweets->find( array(
    'authorId'=>new MongoDB\BSON\ObjectID("$id")
    ));
    
    $recent_tweets=iterator_to_array($result);
    
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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://use.fontawesome.com/133addc2f9.js"></script>
</head>
<body>
    <?php include('header.php');?>

    
    <h2 align="center" >All My Tweets</h2>
    
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
    
  
  </div>
</div>
            
        </div>
        
        <div class="col-6">
            <div>
        
        <?php
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
        //echo "sadsadsa";
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
        <hr>
    </div>
        </div>
        
        <div class="col">
            
        </div>
    </div>
    
    
</body>
</html>