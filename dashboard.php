<?php

session_start();

if(!($_SESSION["user_name"]))
{
header("Location:index.php");
exit();
}
$_SESSION['number']="";
$_SESSION['form_name']="";
$_SESSION['type']="";

?>
<html>

<h1>Welcome to Dashboard,  <?php echo "{$_SESSION["user_name"]}</h1>"?>

<br/><br/>
<a href="create_form.php">New Form</a><br/><br/>
<a href="view_responses.php">See Responses</a><br/><br/>


<br/>

<br/>
<br/>
<br/>
<br/>
<br/><br/>
<br/>
<a href="index.php">Logout</a>

</html>