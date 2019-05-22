<?php
	require_once(e_HANDLER."mail.php"); 

	$subject = $_POST['link_subject'];
	$message = "<strong>Your Name:</strong> ".$_POST['link_name']." <br/>"
				."<strong>Your EMail: </strong> ".$_POST['link_email']." <br/>"
				."<strong>Your Website: </strong> ".$_POST['link_website']." <br/>"
				."<strong>Message: </strong>".$_POST['link_message'];

	sendemail( ADMINEMAIL, $subject, $message);
	
	$form_text = "Your request has been sent. It contained the following information:<br />"
				."<strong>Subject: </strong>".$subject."<br />"
				.$message;
?>