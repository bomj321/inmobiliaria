<?php

//include config
require_once('includes/config.php');

//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: principal'); exit(); }

//process login form if submitted
if(isset($_POST['submit'])){

	if (!isset($_POST['username'])) $error[] = "Por favor, introduzca su nombre de usuario";
	if (!isset($_POST['password'])) $error[] = "Por favor, introduzca su contraseña";
 
	$username = $_POST['username'];
	if ( $user->isValidUsername($username)){
		if (!isset($_POST['password'])){
			$error[] = 'Por favor, introduzca su contraseña';
		}
		$password = $_POST['password'];

		if($user->login($username,$password)){
			$_SESSION['username'] = $username;
			header('Location: principal');
			exit;

		} else {
			$error[] = 'El nombre de usuario o la contraseña no es válida.';
		}
	}else{
		$error[] = 'El nombre de usuario es obligatorio y solo debe contener letras y números.';
	}
}//end if submit

//define page title
$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';
$accion="";
$accion=$_GET['action'];
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
							case 'joined':
							echo "<div class='uk-alert-success uk-animation-fade' uk-alert style='position:absolute; top:150px;'>
    <a class='uk-alert-close' uk-close></a>
    <p>Registro completado. Revise el correo asignado para activar la cuenta.</p></div> ";
							break;
					}

				}?>	
	
	<form action="" method="post" class="uk-width-1-6 " autocomplete="off" >
		
<div class="uk-text-center">
<img src="images/villas-planet-logo.png"   >
		</div>

<hr class="uk-article-divider">
		<?php if(isset($error)){
					foreach($error as $error){
						echo '<p class="uk-alert uk-alert-danger uk-text-center uk-animation-fade" uk-alert>
					<a class="uk-alert-close" uk-close></a	
					<span uk-icon="icon:warning"></span> '.$error.'</p>';
					}
				}?>
		
    <div class="uk-margin ">
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input name="username" class="uk-input uk-width-1-1" placeholder="Nombre de usuario" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" type="text">
        </div>
    </div>

    <div class="uk-margin">
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon" uk-icon="icon: lock"></span>
            <input name="password" placeholder="Contraseña" class="uk-input uk-width-1-1" type="password">
        </div>
    </div>
		
<div class="uk-margin">

<div class="uk-inline uk-width-1-1 " >
	
	    <input type="hidden" name="inicio" value="si">
        <button  id="loader" type="submit" name="submit" value="Login" class="uk-button uk-button-default uk-width-1-1"> Acceder </button>
    </div>
		</div>
<div class="uk-margin">
        <div class="uk-inline uk-width-1-1 uk-text-center">
			<a href='reset' class="uk-link-white"><span uk-icon="icon:question"></span> ¿Ha olvidado su contraseña?</a>
			
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