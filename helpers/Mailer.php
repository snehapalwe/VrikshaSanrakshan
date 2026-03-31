<?php
class Mailer
{
	protected $smtp_username = SMTP_USERNAME;
	protected $smtp_password = SMTP_PASSWORD;
	protected $smtp_host = SMTP_HOST;
	protected $smtp_port = SMTP_PORT;
	protected $smtp_secure = 'tls';  // can be ssl or tls


	protected $sender_email = DEFAULT_EMAIL;
	protected $sender_name = DEFAULT_EMAIL_ACCOUNT_NAME;


	public function __construct()
	{
		if (empty($this->smtp_port)) {
			$this->smtp_port = 465;
		}
	}

	public function send_mail($receipient_emails, $subject, $msg)
	{
		require_once(LIBS_DIR . 'PHPMailer/PHPMailerAutoload.php');
		$mail = new PHPMailer; 
			$mail->SMTPDebug = 0;                               // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = "smtp.office365.com";  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = "support@dssworld.in";                 // SMTP username
			$mail->Password = "Dmapass@578";                           // SMTP password
			$mail->SMTPSecure = $this->smtp_secure;                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to
	 
    $mail->CharSet = 'UTF-8';

		$mail->From = "support@dssworld.in";
		$mail->FromName = "Support Dssworld";

		if (is_array($receipient_emails)) {
			foreach ($receipient_emails as $email) {
				$mail->addAddress($email); // Add a recipient
			}
		} else {
			$mail->addAddress($receipient_emails); // Add a recipient
		}

		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		$mail->AltBody = strip_tags($msg);
		if ($mail->send()) { 
			return true;
		} else {
			return  $mail->ErrorInfo;
		}
	}
}
