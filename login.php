<?php 
session_start();
require 'functions.php';

if(isset($_COOKIE['id']) && isset($_COOKIE['username'])){
    $id=$_COOKIE['id'];
    $key=$_COOKIE['key'];

    $result=mysqli_query($conn,"SELECT * FROM user WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    if($key === hash('sha256',$row['username'])){
        $_SESSION['login']=true;
    }
}

if(isset($_COOKIE['login'])){
    if($_COOKIE['login']=='true'){
        $_SESSION['login']=true;
    }
}

if(isset($_SESSION["login"])){
    header("Location:index.php");
    exit;
}

/*if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username'");

    if(mysqli_num_rows($result)===1){
        $row=mysqli_fetch_assoc($result);
        if(password_verify($password,$row["password"])){
            $_SESSION["login"]=true;

            if(isset($_POST['remember'])){
                setcookie('id',$row['id'],time()+60);
                setcookie('key',hash(sha256, $row['username']),time()+60);
            }

            header("Location:index.php");
            exit;
        }
    }*/
    $error= true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Halaman Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Halaman login</h1>

    <?php 
        if(isset($error)):?>
            <p style="color:red;font-style=bold">
            Username dan Password salah</p>
    <?php endif?>

    <form action="" method="post">
        <ul>
            <li>    
                <label for="username">username</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">password</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>
</body>
</html>
