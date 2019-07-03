<?php
// define variables and set to empty values
require "signup.php";
$flag=0;

$nameErr = $passErr =$firstErr=$lastErr=$emailErr= "";
$filled_name= $filled_pass= $filled_first= $filled_last=$filled_email= $filled_phone="";


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$flag=0;
		  if (empty($_POST["user_name"]))
		  {
			$nameErr = "Name is required";
			$flag=-1;
		  }
		  else 
		  {
			  $filled_name=$_POST["user_name"];
			
		  }
		  
		   if (empty($_POST["pass_word"]))
		  {
			$passErr = "Password is required";
			$flag=-1;
		  }
		  else 
		  {
			
			$filled_pass=$_POST["pass_word"];
		  }
		  
		  
		   if (empty($_POST["first_name"]))
		  {
			$firstErr = "firstname is required";
			$flag=-1;
		  }
		  else 
		  {
			
			$filled_first=$_POST["first_name"];
		  }
		  
		   if (empty($_POST["last_name"]))
		  {
			$lastErr = "lastname is required";
			$flag=-1;
		  }
		  else 
		  {
			
			$filled_last=$_POST["last_name"];
		  }
		  
		  if (empty($_POST["email"]))
		  {
			$emailErr = "Email is required";
			$flag=-1;
		  }
		   
		  else 
		  {
			
			$filled_email=$_POST["email"];
		  }
  
  $filled_phone=$_POST["phone_no"];
  
  if($flag==0)
	  insert();
}
  


?>
<html>
<head>
<Title>Sign Up</Title>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function checkAvailability() 
{
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'user_name='+$("#user_name").val(),
type: "POST",
success:function(data)
{
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}


</script>
</head>

<body>
<h1>New User Enter your details</h1>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >

<fieldset>
<label for ="user_name">User name:</label>
<input type="text" name="user_name" id="user_name"size="20" value="<?php echo $filled_name?>"onBlur="checkAvailability()"/>
<span id="user-availability-status"></span>
<span class="error">* <?php echo $nameErr;?></span>

<p><img src="LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>
<br/><br/>

<label for ="pass_word">Password :</label>
<input type="password" name="pass_word" size="20" value="<?php echo $filled_pass?>"/>
<span class="error">* <?php echo $passErr;?></span><br/></br>


<label for ="first_name">First name:</label>
<input type="text" name="first_name" size="10"value="<?php echo $filled_first?>"/>
<span class="error">* <?php echo $firstErr;?></span><br/><br/>

<label for ="last_name">Last name:</label>
<input type="text" name="last_name" size="10" value="<?php echo $filled_last?>"/>
<span class="error">* <?php echo $lastErr;?></span><br/><br/>

<label for ="email">Email ID:</label>
<input type="text" name="email" size="20" value="<?php echo $filled_email?>"/>
<span class="error">* <?php echo $emailErr;?></span><br/><br/>

<label for ="phone_no">PhoneNo:</label>
<input type="text" name="phone_no" size="10" value="<?php echo $filled_phone?>"/><br/><br/>


</fieldset>

<input type="submit" value="SignUp" />
 <input type="reset" value="Clear " />
</form>




</body>
</html>