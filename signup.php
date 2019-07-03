<?php

function insert()
{
require "database_connection.php";

$user_name=trim($_REQUEST["user_name"]);
$pass_word=trim($_REQUEST["pass_word"]);
$hash = password_hash($pass_word, PASSWORD_DEFAULT);
$first_name=trim($_REQUEST["first_name"]);
$last_name=trim($_REQUEST["last_name"]);
$email=trim($_REQUEST["user_name"]);
$phone_no=trim($_REQUEST["phone_no"]);


$insert=$mysqli->prepare("INSERT INTO users1 (user_name, pass_word, first_name, last_name, email, phone_no)".
			"VALUES (?,?,?,?,?,?)");
$insert->bind_param("ssssss",$user_name,$hash,$first_name,$last_name,$email,$phone_no);
$insert->execute();
$insert->close();

header("Location:index.php");
}
?>