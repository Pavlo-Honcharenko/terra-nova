<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('es', 'phpmailer/language/');
	$mail->IsHTML(true);


	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'mail.terranovalc.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'mailer@terranovalc.com';                     //SMTP username
	$mail->Password   = 'sendmail12345';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                 
	

	//Від кого лист
	$mail->setFrom($_POST['form-email'], $_POST['form-nombre']); // Вказати потрібний E-mail
	//Кому відправити
	$mail->addAddress('terranovalangcenter@gmail.com'); // Вказати потрібний E-mail
	//Тема листа
	$mail->Subject = 'Сorreo electrónico de ' . $_POST['form-nombre'];

	//Тіло листа
	$body = '<p>';
	$body .= $_POST['form-nombre'];
	if(trim(!empty($_POST['form-pais']))){
		$body .= ', ';
		$body .= $_POST['form-pais'];
	}	
	$body .= ':</p>';
	$body .= '<p>'. $_POST['form-message'] . '</p>';


	$mail->Body = $body;

	//Відправляємо
	if (!$mail->send()) {
		$message = 'Error';
	} else {
		$message = 'OK!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	header('refresh:0;url=/index.html#form-message');
?>