<?php include("inc/header.php"); ?>

<div class="wrapper">
	<div class="jumbotron">
	  <h1>Hello, world!</h1>
	  <p>...</p>
	  <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
	</div>

	<?php
		if ($_SERVER["REQUEST METHOD"] == "POST") {
			// trim all input to delete whitespace
			$name = trim($_POST["name"]);
			$email = trim($_POST["email"]);
			$message = trim($_POST["message"]);
		
			if($name OR $email OR $message == ""){
				echo "Please fill out contact form.";
				exit;
			}

			// prevent botnet email header injections
			foreach($_POST as $value){
				if (stripos($value, "Content-Type:") !== FALSE){
					echo "there was a problem with the information you entered";
					exit;
				}
			}

			// exit form if hidden field is filled out
			if($_POST["address"] != ""){
				echo "There was an error with the input";
				exit;
			}

			require_once("inc/class.phpmailer.php");
			$mail = new PHPMailer;

			// email content
			$email_body ="";
			$email_body = $email_body . "Name: " . $name . "<br>";
			$email_body = $email_body . "Email: " . $email . "<br>";
			$email_body = $email_body . "Message: " . $message;

			// // Set PHPMailer to use the sendmail transport
			// $mail->isSendmail();
			// //Set who the message is to be sent from
			// $mail->setFrom($email, $name);
			
			// //Set who the message is to be sent to
			// $mail->addAddress('amy.rudolph@live.co.uk', 'Amy Rudolph');
			// //Set the subject line
			// $mail->Subject = 'Contact form | '. $name;
			// //Read an HTML message body from an external file, convert referenced images to embedded,
			// //convert HTML into a basic plain-text alternative body
			// $mail->msgHTML($email_body);
			
			// //Attach an image file
			// // $mail->addAttachment('images/phpmailer_mini.png');

			// //send the message, check for errors
			// if (!$mail->send()) {
			//     echo "Mailer Error: " . $mail->ErrorInfo;
			// } else {
			//     echo "Message sent!";
			// }

			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = "mailtrap.io";
			$mail->Port = 25;
			$mail->Username = "amy.rudolph@live.co.uk";
			$mail->Password = "elizabeth1987";
			$mail->SetFrom($email, $name);
			$mail->Subject = "A Transactional Email From Web App |" . $name;
			$mail->MsgHTML($email_body);
			$mail->AddAddress("amy.rudolph@live.co.uk", "amy");

			//send the message, check for errors
			if (!$mail->send()) {
			    echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			    echo "Message sent!";
			}
		}

	?>

	<form method="post" action="contact.php">
		<h1>Contact us for a Consultation.</h1>
		<table>
			<tr>
				<th>
					<label for="name"></label>
				</th>
				<td>
					<input type="text" name="name" id="name" placeholder=" Name">
				</td>
			</tr>
			<tr>
				<th>
					<label for="email"></label>
				</th>
				<td>
					<input type="text" name="email" id="email" placeholder=" Email">
				</td>
			</tr>
			<tr>
				<th>
					<label for="message"></label>
				</th>
				<td>
					<textarea name="message" id="message" placeholder=" Message"></textarea>
				</td>
			</tr>
			<tr style="display: none;">
				<th>
					<label for="address"></label>
				</th>
				<td>
					<input type="text" name="address" id="address" placeholder=" Address">
					<p>Humans: please leave this field blank.</p>
				</td>
			</tr>
		</table>
		<input type="submit" value="Send">
	</form>
</div>


<?php include("inc/footer.php"); ?>