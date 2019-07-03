<?php
session_start();
if(isset($_SESSION["user_name"]) ||isset($_SESSION["user_id"]))
{
session_unset();
session_destroy();
}
$_SESSION["user_name"]=false;
$_SESSION["user_id"]=false;


?>
<html>

<head>
<Title>Homepage</Title>
</head>

<body>
<h1>Welcome to FormBuilder</h1>

<a href="login.html">Login</a><br/><br/><br/>
<a href="signup8.php">Sign Up</a>
</body>

</html>