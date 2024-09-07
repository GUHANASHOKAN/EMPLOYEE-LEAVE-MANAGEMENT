<?php
session_start();
$connection = mysqli_connect("localhost","root","");

$db = mysqli_select_db($connection,"manager");



if(isset($_POST['save']))
{
    extract($_POST);
    $username=$_POST['un'];
    $password=$_POST['ps'];
    $sql=mysqli_query($connection,"SELECT * FROM employees where name='$username' and contact='$password'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        $_SESSION["name"] = $row['name'];
        $_SESSION["contact"] = $row['contact'];
        $ans=$_SESSION['name']; 
        header("Location: home.php"); 
        
    }
    else
    {
        echo '<script>alert("invalid password")</script>';
    }
}
   ?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body >
    <div class="back">
        <div class="circle" >
            <img src="https://www.jing.fm/clipimg/full/44-440310_blue-calendar-icon-png.png">
        </div>
    </div>
    

    <div class="login">
        <form method="POST">
        <h1>EMPLOYEE LOGIN</h1>
        <label>USER ID</label>
        <input type="text" name="un" placeholder="USER NAME" required>
        <label>PASSWORD</label>
        <input type="password" name="ps" placeholder="PASSWORD" required>
        <input  type="submit"   name="save" value="login">
    </form>
    
    </div>
    
    
</body>
</html>