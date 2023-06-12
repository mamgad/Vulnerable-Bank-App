

<?php

require('banking.php');


function send_verification_email($to)
{
	global $con;
	$ch = curl_init();

	$token=get_token();
	$to= get_email($_SESSION['username']);
	$url="http://localhost/verify.php?token=$token";
	
	curl_setopt($ch, CURLOPT_URL, 'https://api.brevo.com/v3/smtp/email');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"sender\":{  \n      \"name\":\"Support\",\n      \"email\":\"senderalex@exampleCTF.com\"\n   },\n   \"to\":[  \n      {  \n         \"email\":\"$to\",\n         \"name\":\"John Doe\"\n      }\n   ],\n   \"subject\":\"Hello \",\n   \"htmlContent\":\"<html><head></head><body><p>Hello,</p>Kindly find your reset link <br> $url</p></body></html>\"\n}");
	
	$headers = array();
	$headers[] = 'Accept: application/json';
	$headers[] = 'Api-Key: ';
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
	$con->close();
}

function send_pin_by_email($pin)
{	
	global $con;
	$ch = curl_init();

	$to= get_email($_SESSION['username']);

	
	curl_setopt($ch, CURLOPT_URL, 'https://api.brevo.com/v3/smtp/email');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"sender\":{  \n      \"name\":\"Support\",\n      \"email\":\"senderalex@exampleCTF.com\"\n   },\n   \"to\":[  \n      {  \n         \"email\":\"$to\",\n         \"name\":\"John Doe\"\n      }\n   ],\n   \"subject\":\"Hello \",\n   \"htmlContent\":\"<html><head></head><body><p>Hello,</p>Kindly find your pin  for ".$_SESSION['username']."<br> $pin</p></body></html>\"\n}");
	
	$headers = array();
	$headers[] = 'Accept: application/json';
	$headers[] = 'Api-Key: ';
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
	echo("Sent");
	$con->close();
}



?>



