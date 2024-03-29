<?php

if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit a form.
	echo "error; you need to submit the form!";
}

$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];

//Validate first
if(empty($name)||empty($visitor_email))
{
	echo "Name and email are mandatory!";
	exit;
}

$email_from = 'mogakio@gmail.com'; //<== Your email goes here
$email_subject = "New Form submission";
$email_body = "You have received a new message from the user $name.\n".
	"email address: $visitor_email\n".
	"Here is the message:\n $message".

$to = "mogakio@gmail.com";//<== Your email goes here
$headers .= "From: $email_from \r\n";	
mail($to,$email_subject,$email_body,$headers);

function IsInjected($str)
{
	$injections = array('(\n+)','(\r+)','(\t+)','(\0A+)','(\0D+)','(\08+)','(\09+)');
	$inject = join('|',$injections);
	$inject = "/$inject/i";
	
	if(preg_match($inject, $str))
	{
		return true;
	}
	else
	{
		return false;
	}
}

if(IsInjected($visitor_email))
{
	echo "Bad email value!";
	exit;
}
//done.
?>
