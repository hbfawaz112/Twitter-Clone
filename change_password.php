<?php
        
    session_start();

    require_once('dbconnect.php');

  $res=$db->users->findOne(
        array(
            '_id'=>$_SESSION['user']
        )
  );


  if(isset($_POST['oldpass'])){
      
      $old=$_POST['oldpass'];
      $new=$_POST['newpass'];
      $confirm=$_POST['confirmpass'];
  
      
            if(strcmp($new,$confirm))
      {
          echo '
          <div class="alert alert-danger" role="alert">
  Confirm your passwrod correctlyy!!
</div>
          ';
      }
      
     else if(strcmp($res['password'] , $old))
      {
          echo '
          <div class="alert alert-danger" role="alert">
  Check your old passwrod !!
</div>
          ';
      }
      
      else{
        $db->users->updateOne(
        array(
            
            "_id"=>$_SESSION['user']
             ),
            
        array(
            '$set'=>array(
                    "password"=>$confirm
                )
             )    
        
        );
          header('Location: logout.php');
      }
  }
            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
          <link rel="stylesheet" 
       href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
       <link rel="stylesheet" 
       href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
    <?php  include('header.php'); ?>
    
    <div class="row">
        
        <div class="col">
             <a  style="padding-left:30px; padding-right:30px;" href="update_my_profile.php" class="btn btn-info ">    Go 
           <br> Back</a>
        </div>
        
        <div class="col-6">
            <div class="card-header">
                <h4>Change your password</h4>
            </div><br>
              <div class="alert alert-warning" role="alert">
                  <b>Note :</b>
  You will be logout from your acount when changing your password  
</div>
            <form action="change_password.php" method="post">
                <label for="oldpass"><b>Old Password</b></label>
                <input type="password" name="oldpass" class="form-control">
                <br>
                
                <label for="oldpass"><b>New Password</b></label>
                <input type="password" name="newpass" class="form-control">
                <br>
                
                <label for="oldpass"><b>Confirm Password</b></label>
                <input type="password" name="confirmpass" class="form-control">
                <br>
                 <input  type="submit" value="Change Password" class="btn btn-info">
                       
            </form>
            
            </div>
        
        <div class="col">
            
            
        </div>
    </div>
</body>
</html>