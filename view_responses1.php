<?php
session_start();

if(!($_SESSION["user_name"]))
{
header("Location:index.php");
exit();
}

require "database_connection.php";
$user_name=$_SESSION['user_name'];
$form_name=$_REQUEST['form'];

$select=" SELECT * FROM forms where form_name='{$form_name}';";
$result=mysqli_query($con,$select);
$row=mysqli_fetch_row($result);
$questions=$row[3];


$select1=" SELECT * FROM responses where form_name='{$form_name}';";
$result1=mysqli_query($con,$select1);

$i=1;
while($row=mysqli_fetch_row($result1))
{	
	
	$select2="SELECT * FROM questions where form_name='{$form_name}' and question_no={$i};";
	$result2=mysqli_query($con,$select2);
	
	$row2=mysqli_fetch_row($result2);
	echo $row2[4]."<br/>";
	
		if($row2[1]=='image')
		{
			$file_system_path=$row[3];
			 $web_path=str_replace($_SERVER['DOCUMENT_ROOT'].'/FormBuilder/', './', $file_system_path);
			 echo "<img src='{$web_path}' width='100' height='100' /><br/>";
			 
		}
		
		else if($row2[1]=='file')
		{
			$file_system_path=$row[3];
			 $web_path=str_replace($_SERVER['DOCUMENT_ROOT'].'/FormBuilder/', './', $file_system_path);
			 echo "<embed src='{$web_path}' width='200' height='200'/><br/>";
		}
		else
		echo $row[3]."</br>";
	
	
$i++;	
if($i>$questions)
	{
	$i=1;
	echo"<hr>";
	}
}

?>