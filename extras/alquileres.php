<?php require('../includes/config2.php'); 



if(!$user->is_logged_in()){
 header('Location: ../login'); exit();
  } 
$data = date('Y-m-d');;
$hora =  date('H:i:s');
$IPPROXY = $_SERVER['REMOTE_ADDR'];
$IP = getIP();
$Nav = $_SERVER['HTTP_USER_AGENT'];
$accio="Login";
$observacions="Conectado";
$loging = "INSERT INTO logs (data, hora, usuari, ip_conexio, ip_proxy, navegador, accio, observacions) VALUES ('".$data."','".$hora."','".$_SESSION['username']."','".$IPPROXY."', '".$IP."', '".$Nav."','".$accio."','".$observacions."')";
//$db->exec($loging);
$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';
$activo="clientes";
$activo2="";
require('../layout/header.php');
?>
<?php 
include('../layout/menu.php'); 
?>

<div class="container-fluid">


	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
			<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">
			<a href="<?php echo DIR;?>extras/add_alquileres">
				<button  class="uk-button button-direct " style="background-color:#F9B233;color:#fff"><span uk-icon="icon:plus;"></span> Añadir Extra</button>
			</a>
			</h5>

		</div>
	</div>


	<div class="row" style="margin-top: 50px; background-color: white;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 30px;">
			 <table id="alquileres" class="table table-hover bulk_action dt-responsive nowrap table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                	<th>ID</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Descripción en Español</th>                                    
                                    <th>Acciones</th> 
                                </tr>
                            </thead>
                            <tbody>
                          <!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<?php 
$stmt = $db->prepare("SELECT id_extra ,name_es, activacion, des_es FROM  extras_alquileres ORDER BY id_extra DESC");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while ($row = $stmt->fetch()){// WHILE 1
 ?>                            	
<!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->   
<!--CUERPO DE LA PAGINA-->
<tr>
						                <td>
						                 	<?php echo $row['id_extra']?>
						                </td>

										<td>
											<?php echo $row['name_es']?>
										</td>

										<td>
											<?php 
													if ($row['activacion']==0) {
														$activacion='No,solo para uso interno';
													}else{
														$activacion='Sí, solicitar para activación';
													}
											 ?>
											<?php echo $activacion?>
										</td>

										<td >
											<?php echo $row['des_es']?>
												
										</td>										

										<td>
											<div class="uk-grid uk-grid-small">			
												<!--<a style='color: black;'  onclick="previewModal('<?php //echo $row['ID']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>-->
												<a style='color: black;' href="<?php echo DIR;?>extras/edit_alquileres?idextra=<?php echo $row['id_extra']?>"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
												<a style='color: black;' onclick="deletedata(<?php echo $row['id_extra']?>)" ><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
											</div>
										</td>
										
</tr>
<!--CUERPO DE LA PAGINA-->
<?php

}// WHILE 1
?>                             
                            </tbody>
                        </table>      
		</div>
	</div>

<div id="preview-modal"></div>

</div>

<?php 
//include header template
require('../layout/footer.php'); 
?>

<script type="text/javascript">
function previewModal(param) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>clientes/previewreserva",
	data: param,			 
	success: function(data){
		$("#preview-modal").html(data);
		
		
	}
	});   
        }

function deletedata($id) {
	var id = $id;
	UIkit.modal.confirm('¿Confirma que desea eliminar el extra?', { center:true, labels: { ok: 'Ok', cancel: 'Volver a Extras' } }).then(function() {
  
			$.ajax({
                url: '<?php echo DIR;?>extras/deleteextra_alquiler?idextra=' + id, // url where to submit the request               
                success : function(result) {
                   location.reload();
                   
                },
                error: function(xhr, resp, text,error) {
                     UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> <strong>Ha habido un error al eliminar. Inténtelo de nuevo.</strong>', status: 'danger', timeout:2000})
					alert(error);
                } 
				
			});
}, function () {
   
});
	
}             
</script>

