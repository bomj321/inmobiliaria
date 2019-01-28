<?php require('includes/config.php');

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); exit(); }

//if form has been submitted process it
if(isset($_POST['submit'])){

	//Make sure all POSTS are declared
	if (!isset($_POST['email'])) $error[] = "Por favor rellene todos los campos";


	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Introduzca un correo electrónico válido';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(empty($row['email'])){
			$error[] = 'El e-mail introducido no pertenece a ningún usuario.';
		}

	}

	//if no errors have been created carry on
	if(!isset($error)){

		//create the activation code
		$stmt = $db->prepare('SELECT password, email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$token = hash_hmac('SHA256', $user->generate_entropy(8), $row['password']);//Hash and Key the random data
        $storedToken = hash('SHA256', ($token));//Hash the key stored in the database, the normal value is sent to the user

		try {

			$stmt = $db->prepare("UPDATE members SET resetToken = :token, resetComplete='No' WHERE email = :email");
			$stmt->execute(array(
				':email' => $row['email'],
				':token' => $storedToken
			));

			//send email
			$to = $row['email'];
			$subject = "Restablecer contraseña desde gestor villas planet";
			$body = "<p>Se ha solicitado el restablecimiento de la contraseña para el gestor de facturación de www.procuradoresdebaleares.com</p>
			<p>Si ha sido por error, ignore este mensaje y no habrá ningún cambio.</p>
			<p>Para restablecer la contraseña haga click en el siguiente enlace: <a href='".DIR."resetPassword.php?key=$token'>".DIR."resetPassword.php?key=$token</a></p>";

			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->CharSet = 'UTF-8';
			$mail->send();

			//redirect to index page
			header('Location: login.php?action=reset');
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
<div class="uk-flex uk-flex-middle uk-flex-center uk-height-viewport uk-background-primary">
	<?php if(isset($_GET['action'])){

					//check the action
					switch ($_GET['action']) {
						case 'active':
							echo "<div class='uk-alert-success uk-animation-fade' uk-alert style='position:absolute; top:150px;'>
    <a class='uk-alert-close' uk-close></a>
    <p>Su cuenta está activada. Ya puede acceder al sistema con sus datos de acceso.</p></div> ";
							break;
						case 'reset':
							echo "<div class='uk-alert-success uk-animation-fade' uk-alert style='position:absolute; top:150px;'>
    <a class='uk-alert-close' uk-close></a>
    <p>Compruebe su correo electrónico para cambiar su contraseña</p></div> ";
							
							break;
						case 'resetAccount':
							echo "<div class='uk-alert-success uk-animation-fade' uk-alert style='position:absolute; top:150px;'>
    <a class='uk-alert-close' uk-close></a>
    <p>Su contraseña ha sido modificada con éxito. Ya puede acceder al sistema con sus datos de acceso.</p></div> ";
							
							break;
					}

				}?>
	<form action="" method="post" class="uk-width-1-6 " autocomplete="off" >
<div class="uk-text-center">
<img src="images/villas-planet-logo.png" >
		</div>
<hr class="uk-article-divider">
		<?php if(isset($error)){
					foreach($error as $error){
						echo '<p class="uk-alert uk-alert-danger uk-text-center uk-animation-fade" uk-alert>
					<a class="uk-alert-close" uk-close></a	
					<span uk-icon="icon:warning"></span> '.$error.'</p>';
					}
				}?>
<?php
				//check for any errors
				
				
                         
				if(isset($_GET['action'])){

					//check the action
					switch ($_GET['action']) {
						case 'active':
							echo "<h2 class='bg-success'>Su cuenta está activada. Ya puede acceder al gestor.</h2>";
							break;
						case 'reset':
							echo "<h2 class='bg-success'>Por favor revise su correo para restablecer su contraseña.</h2>";
							break;
						
					}

				}
					

				
				?>	
		
    <div class="uk-margin">
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon" uk-icon="icon: mail"></span>
            <input type="email" name="email"  placeholder="Correo electrónico" value="" class="uk-input uk-width-1-1" type="email">
        </div>
    </div>
		
<div class="uk-margin">

<div class="uk-inline uk-width-1-1 " >
	    <input type="hidden" name="inicio" value="si">
        <button  id="loader" type="submit" name="submit" value="Login" class="uk-button uk-button-default uk-width-1-1"> Restablecer contraseña </button>
    </div>
		</div>
<div class="uk-margin">
        <div class="uk-inline uk-width-1-1 uk-text-center">
			<a href='login' class="uk-link-white"><span uk-icon="icon: arrow-left"></span> Volver a la página de acceso</a>
			</div>
		</div>
</form>
</div>


<?php
//include header template
require('layout/footer.php');
?>
</body>
</html>