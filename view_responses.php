<?php
session_start();

if(!($_SESSION["user_name"]))
{
header("Location:index.php");
exit();
}

require "database_connection.php";
$user_name=trim($_SESSION['user_name']);

echo"<h3>Submissions of your forms</h3>";

echo"<form action='view_responses1.php' METHOD='POST'>";
$select1="SELECT * from forms where user_name='{$user_name}';";
$result1=mysqli_query($con,$select1);
 echo"  <select name='form'>";
		
		while($row=mysqli_fetch_row($result1))
		{
			
			$form_name=$row[1];
		echo"<option value ='{$form_name}'>{$form_name}</option>";
			
		}
		
		
 echo"  </select>";
 echo"<input type='submit' value='View' /><br/><br/>";
echo "</form>";


?>