<?php
$connection = mysqli_connect("localhost","root","");

$db = mysqli_select_db($connection,"manager");


if(isset($_POST['save']))
{
    extract($_POST);
    $username=$_POST['un'];
    $password=$_POST['ps'];
    $sql=mysqli_query($connection,"SELECT * FROM log where name='$username' and Password='$password'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        $_SESSION["name"] = $row['name'];
        
        header("Location: manager.php"); 
    }
    else
    {
        echo "Invalid Email ID/Password";
    }
}
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login1.css">
</head>
<body >
    <div class="back">
        <div class="circle" >
            <img src="https://www.jing.fm/clipimg/full/44-440310_blue-calendar-icon-png.png">
        </div>
    </div>
    

    <div class="login">
        <form method="POST">
        <h1>MANAGER LOGIN</h1>
        <label>USER ID</label>
        <input type="text" name="un"  placeholder="USER NAME" required>
        <label>PASSWORD</label>
        <input type="password" name="ps" placeholder="PASSWORD" required>
        <button name="save">Login</button>
    </form>
    
    </div>
    
    
</body>
</html>