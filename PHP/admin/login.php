<?php
    session_start();

    if(isset($_POST['submit'])) 
    { 
        $username = $_POST['name'];

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username; 
        
        header('Location: ./index.php');

    }
?>

<html>
<head>           
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>

<div id='login' class='login'>
    <h1>mAirlistRequest</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    
   <label>Username</label><input type="text" name="name"><br>
   <label>Password</label><input type="password" name="password"><br>
   <input type="submit" name="submit" value="Login"><br>

</form>
</div>
</body>
</html>