<?php include("inc/header.php"); ?>


<div class="jumbotron">
  <h1>Hello, world!</h1>
  <p>...</p>
  <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
</div>

<?php
	if ($_SERVER["REQUEST METHOD"] == "POST") {
		$name = trim($_POST["name"]);
		$email = trim($_POST["email"]);
		$message = trim($_POST["message"])
	}


?>

<form method="post" action="contact.php">
	<table>
		<tr>
			<th>
				<label for="name">Name</label>
			</th>
			<td>
				<input type="text" name="name" id="name">
			</td>
		</tr>
		<tr>
			<th>
				<label for="email">Email</label>
			</th>
			<td>
				<input type="text" name="email" id="email">
			</td>
		</tr>
		<tr>
			<th>
				<label for="message">Message</label>
			</th>
			<td>
				<textarea name="message" id="message"></textarea>
			</td>
		</tr>
		<tr style="display: none;">
			<th>
				<label for="address">Address</label>
			</th>
			<td>
				<input type="text" name="address" id="address">
				<p>Humans: please leave this field blank.</p>
			</td>
		</tr>
	</table>
	<input type="submit" value="Send">
</form>


<?php include("inc/footer.php"); ?>