<!--Roxanne Low -->
<!--COM 214 Final Project  -->
<!--Spring 2017-->

<?php
    session_start();
    $message = "";
    if( !empty($_POST["username"]) ){
        $db_conn = mysqli_connect("localhost", "root", "");
        mysqli_select_db($db_conn, "newlondonDB");
      
        $user = mysqli_real_escape_string($db_conn, $_POST['username']);
        $pass = mysqli_real_escape_string($db_conn, $_POST['password']);

        $cmd = "SELECT id FROM users WHERE username='$user' AND password='$pass'";
        $result = mysqli_query($db_conn, $cmd);
        $row = mysqli_fetch_array($result);
        if($row != null && mysqli_num_rows($result)==1){
            $_SESSION['active'] = $user;
            header("location: profile.php");
        }
        else
            $message = "Username or Password is invalid";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <a href="index.php"> <img src="logo.png" style="width: 250px; height:250px;margin:auto; display:block"></a>
    <title>LOGIN</title>
   
</head>

<body style="text-align:center; margin:75px;background-color: floralwhite;"">
    <div>
        <br><br>
        <h1>User Login </h1>
        <form action="login.php" method="post">
            <input type="text" id="username" name="username" placeholder="Username" />
            <input type="password" id="password" name="password" placeholder="Password" />
            <button type="submit">Login</button>
        </form>
        <?php echo "<br>" . $message; ?>
        <br><br>
        <a href="adduser.html">Register if you do not already have an account</a>
    </div>
</body>
</html>
