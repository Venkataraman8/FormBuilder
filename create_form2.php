
<?php
//add questions and options to database
//generate dynamic url
session_start();

if(!($_SESSION["user_name"]))
{
header("Location:index.php");
exit();
}

require "database_connection.php";

$user_name=trim($_SESSION["user_name"]);
$number= trim($_REQUEST['questions']);
$form_name= trim($_SESSION['form_name']);

$types=trim($_REQUEST['types']);
$type=array();
$type=explode(' ', $types);

	
$update=$mysqli->prepare("UPDATE forms SET questions=? where form_name=?");
$update->bind_param("is",$number,$form_name);
$update->execute();
$update->close();

	
for($i=1;$i<=$number;$i++)
{
	$question=trim($_REQUEST["question{$i}"]);
	$req=trim($_REQUEST["reqtxt{$i}"]);
	if($req=='Not Req')
	{
		$reqd='no';
				if($type[$i-1]=='mcq' || $type[$i-1]=='maq')
				{
					$option_a=trim($_REQUEST["option_a{$i}"]);
					$option_b=trim($_REQUEST["option_b{$i}"]);
					$option_c=trim($_REQUEST["option_c{$i}"]);
					$option_d=trim($_REQUEST["option_d{$i}"]);
					$insert=$mysqli->prepare("INSERT INTO questions VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
					$insert->bind_param("sssisssss",$form_name,$type[$i-1],$reqd,$i,$question,$option_a,$option_b,$option_c,$option_d);
					$insert->execute();
					$insert->close();

				}
				
				else 
					
				{
						$insert=$mysqli->prepare("INSERT INTO questions(form_name,type,required,question_no,question) VALUES(?, ?, ?, ?, ?)");
					$insert->bind_param("sssis",$form_name,$type[$i-1],$reqd,$i,$question);
					$insert->execute();
					$insert->close();
				}
	}
	
	else if($req=='Req')
	{	$reqd='yes';
		
				if($type[$i-1]=='mcq' || $type[$i-1]=='maq')
				{
					$option_a=trim($_REQUEST["option_a{$i}"]);
					$option_b=trim($_REQUEST["option_b{$i}"]);
					$option_c=trim($_REQUEST["option_c{$i}"]);
					$option_d=trim($_REQUEST["option_d{$i}"]);
					$insert=$mysqli->prepare("INSERT INTO questions VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
					$insert->bind_param("sssisssss",$form_name,$type[$i-1],$reqd,$i,$question,$option_a,$option_b,$option_c,$option_d);
					$insert->execute();
					$insert->close();
				}
				
				else 
				{
					$insert=$mysqli->prepare("INSERT INTO questions(form_name,type,required,question_no,question) VALUES(?, ?, ?, ?, ?)");
					$insert->bind_param("sssis",$form_name,$type[$i-1],$reqd,$i,$question);
					$insert->execute();
					$insert->close();
				}
					
	}



}

echo "<label for='dynamic_url' >Your Form's url</label>";
echo "<input type='text' name='dynamic_url' size='80' value='http://localhost/FormBuilder/fill_form.php?form_name={$form_name}'  /><br/><br/>";

echo"<a href='dashboard.php'>Go back to Dashboard</a>";
?>
<html>

</html>
