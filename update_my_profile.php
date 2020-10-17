<?php
    session_start();

    require_once('dbconnect.php');
    
$id=$_SESSION['user'];

    $res=$db->users->findOne(
        array(
                '_id'=>$id
        )
    );
   

    if(isset($_POST['fname']))
    {
        $fname=$_POST['fname'];
        $lastname=$_POST['lname'];
        $username=$_POST['username'];
        $dob=$_POST['dob'];
        $bio=$_POST['bio'];
        /*
        $collection->update(
        array( "title"=>"MongoDB"
        ), 
      array(
      '$set'=>array("title"=>"MongoDB Tutorial")
      
        )
      );
   echo "Document updated successfully";
        */
        
        $db->users->updateOne(
        array(
                "_id"=>$_SESSION['user']
            ),
        array(
         '$set'=>array
                (
                    "firstname"=>$fname,
                    "lastname"=>$lastname,
                    "username"=>$username,
                    "dob"=>$dob,
                    "bio"=>$bio
                    
                
                )
            )    
            
        
        );
        
        header('Location: update_my_profile.php');
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profile</title>
      <link rel="stylesheet" 
       href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
       <link rel="stylesheet" 
       href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
    
    
    <?php
        include('header.php');
    ?>
    
    <div class="row">
        
        
        <div class="col">
            
            <a  style="padding-left:30px; padding-right:30px;" href="home.php" class="btn btn-info ">    Go 
           <br> Back</a>
            
            <a   href="change_password.php" class="btn btn-info ">    Change Your 
           <br> Password</a>
            </div>
        
        <div class="col-6">
                
                <div>
                    <div class="card-header">
                    
                    <h2>Update Profile</h2>
                    </div><br>
                    
                    <form action="update_my_profile.php" method="post">
                        
                        <label for="FirstName"><h4>FirstName :</h4></label>
                        <input type="text" name="fname" class="form-control"
                        value="<?php echo $res['firstname'] ?>"
                        >
                        <br>
                        <label for="LastName"><h4>LastName :</h4></label>
                        <input type="text" name="lname" class="form-control"
                        value="<?php echo $res['lastname'] ?>"
                        >
                        <br>
                         <label for="Username"><h4>UserName :</h4></label>
                        <input type="text" name="username" class="form-control"
                        value="<?php echo $res['username'] ?>"
                        >
                        <br>
                        <label for="dob"><h4>Date Of Birth :</h4></label>
                        <input type="date" name="dob" class="form-control"
                        value="<?php echo $res['dob'] ?>"
                        >
                        <br>
                        <label for="bio"><h4>Bio:</h4></label>
                        <textarea type="text" name="bio" class="form-control"
                          
                                  >
                                       <?php echo $res['bio']; ?>
                        
                                      
                                  </textarea>
                        <br>
                        
                            
                        <input  type="submit" value="Save Your Information" class="btn btn-info">
                       
                        <br><br><hr>
                    </form>
                    
                </div>
            
        </div>
        
        <div class="col">
            
            
            
        </div>
    </div>
    
</body>
</html>