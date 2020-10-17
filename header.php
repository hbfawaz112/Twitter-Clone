<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
     <link rel="stylesheet" href="header.css">
</head>
<body>
   <header>
        <img class="logo" src="1280px-Twitter_logo.svg.png" alt="logo">
       <!-- <h4 style="color:white;">  <?php echo $userData['username']; ?> </h4><br>-->
        <nav>
            <ul class="nav__links">
               
                <li><a href="home.php">Home</a> </li>
                <li><a href="mytweets.php?id=<?php echo $_SESSION['user']; ?>">My Tweets</a> </li>
                <li><a href="userlist.php">View Users List</a> </li>
             </ul>
        </nav>
        <a class="cta" href="logout.php"><button>Log out</button></a>
    </header>
</body>
</html>
  
   <!--
   <div>
    <span>Welcome, <?php echo $userData['username']; ?> !</span><br>
[ <a href="home.php">Home</a> ]
    [ <a href="profile.php?id=<?php echo $_SESSION['user']; ?>">View Profile</a> ]
[ <a href="userlist.php">View Users List</a>]   
[ <a href="logout.php">Log out</a>]     
</div>-->