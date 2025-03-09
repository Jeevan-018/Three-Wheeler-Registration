<?php
session_start();
include('assects/config.php');
// accessing login data from admin table 


if (isset($_POST['login']))
{
    $un = test_input($_POST['username']);
    $pswd = test_input($_POST['password']);
    $sql="select * from login_table where user_name = '$un' and password = '$pswd'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0)
    {
        while($row= mysqli_fetch_array($result))
        {
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $password = $row['password'];
        }
        if($un == $user_name && $pswd == $password)
        {
            $_SESSION['user_id']=$user_id;
            $_SESSION['user_name']=$user_name;
            echo"<script>document.location ='admin/admin_dashboard.php';alert('admin loged-in sucessfully');</script>";
            exit;
        }
        else{
            echo"<script type='text/javascript'> alert('invalid username or password');</script>";
        }
    }
    else{
        echo"<script type='text/javascript'> alert('invalid username or password');</script>";
    }
   
}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
  }
?>


<html>
<head>
    <title>Three Wheeler Registration</title>
    <link rel="stylesheet" href="css\style.css">
</head>

<body>
    <!-- headder -->
    <?php include('C:\xampp\htdocs\project1\assects\header.php');?>
    <center>   
    <div class="wrapper">
       
        <form name="login_form" action="" method="POST">  
        <h1>ADMIN</h1>

            <!-- username and password input -->
            <div class="inputbox">
                <input type="text" placeholder="username" name="username" id="" required>
                <box-icon name='user'></box-icon>
            </div>
            
            <div class="inputbox">
                <input type="password" placeholder="password" name="password" id="" required>
                <box-icon name='lock' ></box-icon>
            </div>

             <!-- button for login submition -->
             <button type="submit" name="login" class="btn" >Login</button> <br> <br> <br>

            <!-- remember and forgot -->
            <div class="remember-forgot">
                <a href="#">Forgot Password</a>
            </div>
            
            <!-- regester link -->
            <div class="register-link">
                <p>Don't have an account ? <a href="#">Register</a></p>
            </div>
        </form>
    </div>
    <!-- </center>  -->
    <body>
    <br>
    <br>
    <?php include('assects/footer1.php'); ?>
</body>
