<?php
session_start();

if(!($_SESSION["user_name"]))
{
header("Location:index.php");
exit();
}

require "database_connection.php";


$form_name=trim($_REQUEST["form_name"]);
//echo $form_name;
$_SESSION['form_name']=$form_name;

$select=$mysqli->prepare("SELECT * from forms where form_name=?");
$select->bind_param("s",$form_name);
$select->execute();
$result=$select->get_result();

$row=$result->fetch_row();

$form_description=$row[2];
$questions=$row[3];
$select->close();

$err=array();

for($i=1;$i<=$questions;$i++)
	$err[$i]="";

$flag=0;

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$flag=0;
	$select=$mysqli->prepare("SELECT * from questions where form_name=?");
	$select->bind_param("s",$form_name);
	$select->execute();
	$result=$select->get_result();

	$i=1;
	while($row=$result->fetch_row())
	{
		  if ($row[2]=='yes' )
		  {
			  if($row[1]=='image' || $row[1]=='file')
			  {
						if(!file_exists($_FILES["answer{$i}"]['tmp_name']) || !is_uploaded_file($_FILES["answer{$i}"]['tmp_name'])) 
						{
								$err[$i] = "Required";
								$flag=-1;
						}  
			  }
				  
			  else if(empty($_POST["answer{$i}"]))
			  {
			$err[$i] = "Required";
			$flag=-1;
			  }
		  }
	$i++;
	}	  
	$select->close();
	
	if($flag==0) 
{
	
$upload_dir = HOST_WWW_ROOT . "uploads/pictures/";
$upload_dir1 = HOST_WWW_ROOT . "uploads/files/";
$image_fieldname ;


//potential errors
$php_errors = array(1 => 'Maximum file size in php.ini exceeded',
							    2 => 'Maximum file size in HTML form exceeded',
							    3 => 'Only part of the file was uploaded',
							    4 => 'No file was selected to upload.');
 
 
$select=$mysqli->prepare("SELECT * from forms where form_name=?");
$select->bind_param("s",$form_name);
$select->execute();
$result=$select->get_result();

$row=$result->fetch_row();
$questions=$row[3];
$select->close();

$user_name=trim($_SESSION['user_name']);
$fl=0;

$sel=$mysqli->prepare("SELECT * FROM responses where user_name=? and form_name=? ");
$sel->bind_param("ss",$user_name,$form_name);
$sel->execute();
$res=$sel->get_result();
if($ro=$res->fetch_row())
{
	$fl=-1;
	echo"<script>";
	echo"if (confirm('Already filled!')) {
    window.location='http://localhost/FormBuilder/dashboard.php';
  }";
	echo"</script>";
	
}
$sel->close();
if($fl==0)
{
	
$select=$mysqli->prepare("SELECT * from questions where form_name=?");
	$select->bind_param("s",$form_name);
	$select->execute();
	$result=$select->get_result();

$i=1;
while($row=$result->fetch_row())
{   
	if($row[1]=='image' )
	{
		$image_fieldname="answer{$i}";
		// Make sure we didn't have an error uploading the image
	($_FILES[$image_fieldname]['error'] == 0)
	 or die("error uploading to server");
	 
		 // Is this file the result of a valid upload?
	is_uploaded_file($_FILES[$image_fieldname]['tmp_name'])
	 or die("Error naming file ");
	 
		 // Is this actually an image?
	getimagesize($_FILES[$image_fieldname]['tmp_name'])
	 or die("Not an image");

		// Name the file uniquely
	$now = time();
	while (file_exists($upload_filename = $upload_dir . $now .
	 '-' .
	 $_FILES[$image_fieldname]['name'])) 
	{
	 $now++;
	}
	
		// Finally, move the file to its permanent location
	move_uploaded_file($_FILES[$image_fieldname]['tmp_name'], $upload_filename)
	 or die("error saving file");
	 
	 //database
	 $answer=$upload_filename;
	
	$insert=$mysqli->prepare("INSERT INTO responses VALUES (?, ?, ?, ?)");
	$insert->bind_param("ssis",$user_name,$form_name,$i,$answer);
	$insert->execute();
	$insert->close();
	
	 
	}
	
	
	else if($row[1]=='file')
	{

		$file_fieldname="answer{$i}";
		// Make sure we didn't have an error uploading the file
	($_FILES[$file_fieldname]['error'] == 0)
	 or die("error uploading to server.");
	 
		 // Is this file the result of a valid upload?
	is_uploaded_file($_FILES[$file_fieldname]['tmp_name'])
	 or die("Error naming file ");
	 

		// Name the file uniquely
	$now = time();
	while (file_exists($upload_filename = $upload_dir1 . $now .
	 '-' .
	 $_FILES[$file_fieldname]['name'])) 
	{
	 $now++;
	}
	
		// Finally, move the file to its permanent location
	move_uploaded_file($_FILES[$file_fieldname]['tmp_name'], $upload_filename)
	 or die("error saving file");
	 
	 //database
	 $answer=$upload_filename;
	$insert=$mysqli->prepare("INSERT INTO responses VALUES (?, ?, ?, ?)");
	$insert->bind_param("ssis",$user_name,$form_name,$i,$answer);
	$insert->execute();
	$insert->close();
	 
	
	}
	else if($row[1]=='maq')
	{	$answer="";
		foreach($_POST["answer{$i}"] as $option)
		$answer.=" {$option}";
		$insert=$mysqli->prepare("INSERT INTO responses VALUES (?, ?, ?, ?)");
	$insert->bind_param("ssis",$user_name,$form_name,$i,$answer);
	$insert->execute();
	$insert->close();
	}
	else
	{
	$answer=trim($_REQUEST["answer{$i}"]);
	$insert=$mysqli->prepare("INSERT INTO responses VALUES (?, ?, ?, ?)");
	$insert->bind_param("ssis",$user_name,$form_name,$i,$answer);
	$insert->execute();
	$insert->close();
	}

$i++;
}
$select->close();
header("Location:dashboard.php");
}
}
}

echo"<center><h2>{$form_name}</h2>";
echo"<h3>{$form_description}</h3></center></br>";


$select=$mysqli->prepare("SELECT * from questions where form_name=?");
	$select->bind_param("s",$form_name);
	$select->execute();
	$result=$select->get_result();

echo"<form action=".htmlspecialchars($_SERVER['PHP_SELF']). "?form_name={$form_name} ".
" enctype='multipart/form-data' method='POST'>";
echo"<fieldset>";

$i=1;
while($row=$result->fetch_row())
{
	echo"<hr>";
	
	echo"<label for='answer{$i}'>{$row[4]}</label>";
	if($row[2]=='yes')
		echo"<span class='error'> &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;  ".
	"*{$err[$i]}</span><br/>";
	
	if($row[1]=='text')
		echo"<input type='text' name='answer{$i}' size='50'/>";

	else if($row[1]=='number')
		echo"<input type='text' name='answer{$i}' size='5'/>";

	else if($row[1]=='mcq')
	{
	echo"<input type='radio' name='answer{$i}' value='{$row[5]}'>A) {$row[5]} &nbsp; ";
	echo"<input type='radio' name='answer{$i}' value='{$row[6]}'>B) {$row[6]}  &nbsp; ";
	echo"<input type='radio' name='answer{$i}' value='{$row[7]}'>C) {$row[7]}  &nbsp; ";
	echo"<input type='radio' name='answer{$i}' value='{$row[8]}'>D) {$row[8]}  &nbsp; ";
	}
	
	else if($row[1]=='maq')
	{
	echo"<input type='checkbox' name='answer{$i}[]' value='{$row[5]}'>A) {$row[5]} &nbsp; ";
	echo"<input type='checkbox' name='answer{$i}[]' value='{$row[6]}'>B) {$row[6]}  &nbsp; ";
	echo"<input type='checkbox' name='answer{$i}[]' value='{$row[7]}'>C) {$row[7]}  &nbsp; ";
	echo"<input type='checkbox' name='answer{$i}[]' value='{$row[8]}'>D) {$row[8]}  &nbsp; ";
	}
	
	else if($row[1]=='image')
	{
		echo"<input type='hidden' name='MAX_FILE_SIZE' value='2000000' />";
		echo"<input type='file' name='answer{$i}' accept='image/*'>";
	}
	
	else if($row[1]=='file')
	{
		echo"<input type='hidden' name='MAX_FILE_SIZE' value='2000000' />";
		echo"<input type='file' name='answer{$i}' accept='.pdf'>";
	}
	
	
	echo"<br/><br/>";
	$i++;
}
$select->close();

echo"</fieldset>";
echo"</br><input type='submit' value='Submit'/>";
echo"<input type='reset' value='Reset'>";
echo"</form>";

?>
<html>
</html>
