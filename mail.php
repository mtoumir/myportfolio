<?php
	
	/*
		The Send Mail php Script for Contact Form
		Server-side data validation is also added for good data validation.
	*/
	
	$data['error'] = false;
	$data['success'] = 'Thank you for your message! We will get back to you soon.';

	
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
	$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
	
	if( empty($name) ){
		$data['error'] = 'Please enter your name.';
	}else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
		$data['error'] = 'Please enter a valid email address.';
	}else if( empty($subject) ){
		$data['error'] = 'Please enter your subject.';
	}else if( empty($message) ){
		$data['error'] = 'The message field is required!';
	}else{
		
		$formcontent="From: $name\nSubject: $subject\nEmail: $email\nMessage: $message";
		
		
		//Place your Email Here
		$recipient = "mtoumir@gmail.com";
		
		$mailheader = "From: $email \r\n";
		
		if (mail($recipient, $subject, $formcontent, $mailheader) === false) {
			$error = error_get_last();
			$data['error'] = 'Sorry, an error occurred while sending the email: ' . $error['message'];
		} else {
			$data['error'] = false;
		}
	
	}
	
	echo json_encode($data);
	
?>