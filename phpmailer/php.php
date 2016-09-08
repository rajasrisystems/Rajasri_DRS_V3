 
<?php

include("class.phpmailer.php"); 
			
			$mail             = new PHPMailer();

			$mail->IsSMTP();
			$mail->IsMail();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
			$mail->Username   = "support@thedanceapp.com";  // GMAIL username
			$mail->Password   = "D@nceApp";            // GMAIL password

			$mail->AddReplyTo("support@thedanceapp.com","Dance App");

			$mail->From       = "support@thedanceapp.com";
			$mail->FromName   = "Dance App";
			$mail->Sender	  ="The Dance App";
			$mail->Subject    = "welcome";

			$mail->Body       = "<br>Sample test<br>";                      //HTML Body
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$mail->WordWrap   = 50; // set word wrap

			//$mail->MsgHTML($body)
			$ml = "";
			$ml = 'kishan.peddaboina@cytrion.com';
			$mail->AddAddress($ml);
			//print_r($mail);
			$mail->IsHTML(true); // send as HTML
			//$mail->Send();
			if(!$mail->Send()) {
				 echo "Mailer Error: " . $mail->ErrorInfo;
				 die;
				return false;
			}else {
				echo "Mail Sent successfully";
			}

//print_r(phpinfo());
?>
