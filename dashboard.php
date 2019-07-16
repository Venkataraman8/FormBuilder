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
require "database_connection.php";

$user_name=trim($_SESSION["user_name"]);

echo"<html>

<h1>Welcome to Dashboard,  {$_SESSION["user_name"]}</h1>

<br/><br/>
<a href='create_form.php'>New Form</a><br/><br/>
<a href='view_responses.php'>See Responses</a><br/><br/>
<h3>Your Forms</h3>";

$select=$mysqli->prepare("SELECT * FROM forms where user_name=?");
$select->bind_param("s",$user_name);
$select->execute();
$result=$select->get_result();

while($row=$result->fetch_assoc())
{
	echo $row['form_name'].":  ";
echo"<input type='text' name='dynamic_url' size='80' value='http://localhost/FormBuilder/fill_form.php?form_name=".$row['form_name'] ." ' readonly/><br/><br/>";
}


echo"<br/><br/><br/><br/><br/><br/><br/><br/>
<a href='index.php'>Logout</a>

</html>";
?>