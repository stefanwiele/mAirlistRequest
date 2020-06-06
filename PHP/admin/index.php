<?php
    session_start();

    if (!isset($_SESSION['loggedin']) && !$_SESSION['loggedin']) {
        header('Location: ./login.php');
    }

    ?>

<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../js/admin.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/default.css">
        <link rel="stylesheet" type="text/css" href="../css/admin.css">

        <script>
           
        </script>
</head>
<body>
<ul id='menu'> 
  <li class='home'>Home</li>
  <li class='requests'>Requests</li>
  <li class='settings'>Settings</li>
  <li class='uploadcsv'><a href='./uploadcsv.php'>Upload CSV</a></li>
  <li class='about'>About</li>
  <li class='user'><a href='./logout.php'><?php echo $_SESSION['username']; ?></a></li>
</lu>

</ul>    
    <div id='results' class='results'></div>
    <div id='about' class='results' hidden='true'>Created by: Stefan van der Wiele<br><br>Source: <a href='https://github.com/stefanwiele/mairlistrequest' target='_blank'>https://github.com/stefanwiele/mairlistrequest</a></div>
</body>
</html>