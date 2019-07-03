<?php

$flag=0;
session_start();

require "database_connection.php";

$user_name=trim($_REQUEST["username"]);
$pass_word=trim($_REQUEST["password"]);


$select=$mysqli->prepare("SELECT * from users1 where user_name =?");
$select->bind_param("s",$user_name);
$select->execute();



$result=$select->get_result();


$row=$result->fetch_assoc();

$correct_password=$row["pass_word"];
$correct_user_id=$row["user_id"];
$select->close();
if($flag==0)
{
	if(password_verify($pass_word,$correct_password))
	{	
		$flag=1;
		
		$_SESSION["user_name"]=$user_name;
		$_SESSION["user_id"]=$correct_user_id;
		header("Location:dashboard.php");
		exit();
	}
	
	else 
	{
		echo "Password incorrect";
	}
	
}

?>

