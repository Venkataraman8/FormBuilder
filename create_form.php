

<?php
//title, description, no of questions
session_start();

if(!($_SESSION["user_name"]))
{
header("Location:index.php");
exit();
}

require "database_connection.php";

?>

<html>
<head>
<title>Form Blueprint</title>
</head>
<body>

<form action="create_form8.php" method="POST">
<fieldset>
<center><label for='title' >Title</label>
<input type='text' name='title' size='20' /></br></br>

<label for='description' >Description</label>
<textarea rows='3' cols='50' name='description' ></textarea></br></br>


</center>
</fieldset>
<input type="submit" value="Blueprint"/>
<input type="reset" value="Reset"/>
</form>


</body>
</html>
