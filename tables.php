<?php
require "database_connection.php";

$users1="CREATE TABLE IF NOT EXISTS users1(
		user_id int AUTO_INCREMENT PRIMARY KEY,
		user_name varchar(20) NOT  NULL,
		pass_word varchar(80) NOT  NULL,
		first_name varchar(10) NOT  NULL,
		last_name varchar(10) NOT  NULL,
		email varchar(20) NOT  NULL,
		phone_no varchar(10) NOT  NULL
    	
		);"

$forms="CREATE TABLE IF NOT EXISTS forms(
		
		
		user_name varchar(20) NOT NULL,
		form_name varchar(20) NOT NULL,
		form_description varchar(100) NOT NULL,
		questions int NOT NULL
		
);";

$questions="CREATE TABLE IF NOT EXISTS questions(
	form_name varchar(20) NOT NULL,
	type varchar(20) NOT NULL,
	required varchar (5) NOT NULL,
	
	question_no int NOT NULL,
	question varchar(30) NOT NULL,
	option_a varchar(10) NOT NULL,
	option_b varchar(10) NOT NULL,
	option_c varchar(10) NOT NULL,
	option_d varchar(10) NOT NULL
	
);";

$responses="CREATE TABLE IF NOT EXISTS responses(
	
	user_name varchar(20) NOT NULL,
	form_name varchar(20) NOT NULL,
	
	answer_no int NOT NULL,
	answer varchar(100) NOT NULL
	

);";

mysqli_query($con,$users1);or die(mysqli_error($con));

mysqli_query($con,$forms);or die(mysqli_error($con));

mysqli_query($con,$questions);or die(mysqli_error($con));

mysqli_query($con,$responses);or die(mysqli_error($con));
?>