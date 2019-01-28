<?php require('includes/config.php'); 

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: principal'); exit(); }

$resetToken = hash('SHA256', ($_GET['key']));

$stmt = $db->prepare('SELECT resetToken, resetComplete FROM members WHERE resetToken = :token');
$stmt->execute(array(':token' => $resetToken));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//if no token from db then kill the page
if(empty($row['resetToken'])){
	$stop = 'El código de validación enviado por e-mail no es correcto.';
} elseif($row['resetComplete'] == 'Yes') {
	$stop = 'Su contraseña ya ha sido modificada.';
}

//if form has been submitted process it
if(isset($_POST['submit'])){

	if (!isset($_POST['password']) || !isset($_POST['passwordConfirm']))
		$error[] = 'Ambos campos son obligatorios.';

	//basic validation
	if(strlen($_POST['password']) < 3){
		$error[] = 'Contraseña muy corta.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirmación de contraseña es muy corta.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Las contraseñas introducidas no son válidas.';
	}

	//if no errors have been created carry on
	if(!isset($error)){

		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		try {

			$stmt = $db->prepare("UPDATE members SET password = :hashedpassword, resetComplete = 'Yes'  WHERE resetToken = :token");
			$stmt->execute(array(
				':hashedpassword' => $hashedpassword,
				':token' => $row['resetToken']
			));

			//redirect to index page
			header('Location: login.php?action=resetAccount');
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
<form action="" method="post" class="uk-width-1-6 " autocomplete="off" >
<div class="uk-text-center">
<img src="images/villas-planet-logo.png"   >
		</div>
<hr class="uk-article-divider">
		<?php if(isset($stop)){
						echo '<p class="uk-alert uk-alert-danger uk-text-center uk-animation-fade" uk-alert>
					<a class="uk-alert-close" uk-close></a	
					<span uk-icon="icon:warning"></span> '.$stop.'</p>';
					
				} else {?>
		
    
    
    <div class="uk-margin">
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon" uk-icon="icon: lock"></span>
            <input type="password" name="password" id="password" placeholder="Contraseña" class="uk-input uk-width-1-1" >
        </div>
    </div>
	 <div class="uk-margin">
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon" uk-icon="icon: lock"></span>
           <input type="password" name="passwordConfirm" id="passwordConfirm" class="uk-input uk-width-1-1" placeholder="Confirmar contraseña" tabindex="1">
        </div>
    </div>
		
<div class="uk-margin">

<div class="uk-inline uk-width-1-1 " >
	
	    <input type="hidden" name="inicio" value="si">
        <button  id="loader" type="submit" name="submit" value="Change Password" class="uk-button uk-button-default uk-width-1-1"> Modificar contraseña </button>
    </div>
		</div><?php }?>
<div class="uk-margin">
        <div class="uk-inline uk-width-1-1 uk-text-center">
			<a href='reset' class="uk-link-white"><span uk-icon="icon:question"></span> Volver a solicitar código</a>
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