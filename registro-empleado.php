<?php require('includes/config.php');
if(!$user->is_logged_in()){ header('Location: login'); exit(); } 
//if form has been submitted process it
if(isset($_POST['submit'])){

    if (!isset($_POST['username'])) $error[] = "Por favor, rellene su nombre de usuario.";
    if (!isset($_POST['email'])) $error[] = "Por favor, rellene su correo electrónico.";
    if (!isset($_POST['password'])) $error[] = "Por favor, rellene su contraseña.";

	$username = $_POST['username'];

	//very basic validation
	if(!$user->isValidUsername($username)){
		$error[] = 'Su nombre de usuario debe contener un mínimo de 3 carácteres';
	} else {
		$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		$stmt->execute(array(':username' => $username));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['username'])){
			$error[] = 'El nombre de usuario ya existe.';
		}

	}
   
	if(strlen($_POST['password']) < 3){
		$error[] = 'Contraseña muy corta.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Contraseña de confirmación muy corta.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Las contraseñas no coinciden.';
	}

	//email validation
	$email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Por favor, introduzca un e-mail válido.';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $email));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['email'])){
			$error[] = 'El e-mail proporcionado ya está en uso.';
		}

	}


	//if no errors have been created carry on
	if(!isset($error)){

		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		//create the activasion code
		$activasion = md5(uniqid(rand(),true));
		$nivel=$_POST['nivel'];

		try {

			//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO members (username,password,email,active,nivel) VALUES (:username, :password, :email, :active,:nivel)');
			$stmt->execute(array(
				':username' => $username,
				':password' => $hashedpassword,
				':email' => $email,
				':active' => $activasion,
				':nivel' => $nivel
			));
			$id = $db->lastInsertId('memberID');

			//send email
			$to = $_POST['email'];
			$subject = "Confirmación de registro de nuevo empleado";
			$body = "<p>Se ha registrado un nuevo empleado desde villas planet.</p>
			<p>Para activarlo, debe hacer click en el siguiente enlace: <a href='".DIR."activate.php?x=$id&y=$activasion'>".DIR."activate.php?x=$id&y=$activasion</a></p>
			";

			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->CharSet = 'UTF-8';
			$mail->send();

			//redirect to index page
			header('Location: registro-empleado.php?action=joined');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}

//define page title
$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';

//include header template
require('layout/header.php');
?>
<?php 
include('layout/menu.php'); 
?>

<!-- <div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="" autocomplete="off">
				
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				//if action is joined show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo "<h2 class='bg-success'>Registration successful, please check your email to activate your account.</h2>";
				}
				?>

				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" tabindex="1">
				</div>
				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['email'], ENT_QUOTES); } ?>" tabindex="2">
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="text" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="text" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="4">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<label>¿Es administrador?</label>
							<input type="checkbox" name="nivel" id="nivel" class="form-control input-lg" placeholder="Confirm Password" tabindex="4" value="1">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
		</div>
	</div>

</div>-->

<?php
//include header template
require('layout/footer.php');
?>
</body>
</html>