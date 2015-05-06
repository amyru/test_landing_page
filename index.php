<?php
	ob_start();
	// error_reporting(E_ALL | E_STRICT); ini_set("display_errors", 1);
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$name = trim($_POST["name"]);
		$email = trim($_POST["email"]);
		$message = trim($_POST["message"]);
	
		if($name =="" OR $email =="" OR $message == ""){
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

		require_once 'inc/phpmailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;

		if (!$mail->ValidateAddress($email)){
      echo "You must specify a valid email address.";
      exit;
  	}

		// email content
		$email_body ="";
		$email_body = $email_body . "Name: " . $name . "<br>";
		$email_body = $email_body . "Email: " . $email . "<br>";
		$email_body = $email_body . "Message: " . $message;

		// smtp email server
		$mail->isSMTP();
    $mail->Host = "mailtrap.io";
    $mail->SMTPAuth = true;
    $mail->Username = "34643166919e4b26e";
    $mail->Password = "ac40e27c66e078";
    $mail->SMTPSecure = 'tls';
    $mail->Port = 2525;

    $mail->setFrom($email, $name);
    $mail->Subject = "A Transactional Email From Web App |" . $name;
    $mail->isHTML(true);
    $mail->Body    = $email_body;
    $mail->addAddress("app36563384@heroku.com", "amy");

		// send the message, check for errors
		if (!$mail->send()) {
		    echo "Mailer Error: " . $mail->ErrorInfo;
		    exit;
		}
		header("Location:index.php?status=thanks");
		exit;
	}?><?php include("inc/header.php"); ?>
<div class="paralax-background">
<div class="wrapper">
	<?php if (isset($_GET["status"]) AND $_GET["status"] == "thanks") { ?>
		<div class="panel">
      <p>Thanks for the email! We will be in touch shortly!</p>
    </div>
  <?php } else { ?>
		<form method="post" action="index.php">
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
	<?php } ?>
</div>
</div>
<div class="paralax-content">
<div class="section">
	<h1>Lorem ipsum dolor sit amet</h1>
	<div class="row">
	  <div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	      <img src="skin-care.jpg" class="img-circle">
	      <div class="caption">
	        <h3>Hydrating</h3>
	        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean finibus efficitur metus sed dictum. Sed enim sem, aliquam a est at, luctus pellentesque augue. Praesent mollis faucibus tortor ut egestas. Vivamus posuere erat eu elementum eleifend. Duis elementum enim sit amet ipsum faucibus mattis. Pellentesque eleifend hendrerit augue sit amet porttitor. Proin ex lectus, luctus sit amet risus vitae, suscipit vulputate elit. In ligula felis, aliquam sit amet lectus id, tincidunt accumsan nulla. Nam non tincidunt justo, non fermentum justo. Donec ante lorem, consectetur eget est ac, aliquam vestibulum lectus.</p>
	      </div>
	    </div>
	  </div>
	  <div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	      <img src="cells.jpg" class="img-circle">
	      <div class="caption">
	        <h3>Repairing</h3>
	        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean finibus efficitur metus sed dictum. Sed enim sem, aliquam a est at, luctus pellentesque augue. Praesent mollis faucibus tortor ut egestas. Vivamus posuere erat eu elementum eleifend. Duis elementum enim sit amet ipsum faucibus mattis. Pellentesque eleifend hendrerit augue sit amet porttitor. Proin ex lectus, luctus sit amet risus vitae, suscipit vulputate elit. In ligula felis, aliquam sit amet lectus id, tincidunt accumsan nulla. Nam non tincidunt justo, non fermentum justo. Donec ante lorem, consectetur eget est ac, aliquam vestibulum lectus.</p>
	      </div>
	    </div>
	  </div>
	  <div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	      <img src="products_borage.jpg" class="img-circle">
	      <div class="caption">
	        <h3>Brightening</h3>
	        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean finibus efficitur metus sed dictum. Sed enim sem, aliquam a est at, luctus pellentesque augue. Praesent mollis faucibus tortor ut egestas. Vivamus posuere erat eu elementum eleifend. Duis elementum enim sit amet ipsum faucibus mattis. Pellentesque eleifend hendrerit augue sit amet porttitor. Proin ex lectus, luctus sit amet risus vitae, suscipit vulputate elit. In ligula felis, aliquam sit amet lectus id, tincidunt accumsan nulla. Nam non tincidunt justo, non fermentum justo. Donec ante lorem, consectetur eget est ac, aliquam vestibulum lectus.</p>
	      </div>
	    </div>
	  </div>
	</div>
</div>
<?php include("inc/footer.php"); ?>