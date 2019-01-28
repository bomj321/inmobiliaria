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
			<a href="<?php echo DIR;?>clientes/addclientes?tipocliente=renta">
				<button  class="uk-button button-direct " style="background-color:#F9B233;color:#fff"><span uk-icon="icon:plus;"></span> Añadir Cliente</button>
			</a>
			</h5>

		</div>
	</div>


	<div class="row" style="margin-top: 50px; background-color: white;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 30px;">
			 <table id="example1" class="table table-hover bulk_action dt-responsive nowrap table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                	<th>ID</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Telefono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                          <!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<?php
$stmt = $db->prepare("SELECT ID ,clientType, dateAdded, clientName, clientEmail,clientTel1 FROM clients WHERE clientType = 'renta' ORDER BY ID DESC limit 400");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while ($row = $stmt->fetch()){// WHILE 1
 ?>
<!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<!--CUERPO DE LA PAGINA-->
<tr>
						                <td>
						                	<a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" ><?php echo $row['ID']?></a>
						                </td>

										<td>
											<a style='color: black;' href="" class="green"><strong><?php echo $row['clientType']?></strong></a>
										</td>

										<td>
											<a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" class="uk-text-truncate"><?php echo $row['dateAdded']?> / <?php echo $row['dateAdded']?></a>
										</td>

                    <td onclick="datoscliente('<?php echo $row['ID']?>')" style="cursor:pointer;" data-toggle="modal" data-target="#cliente_modal">
											<?php echo $row['clientName']?>

										</td>

										<td>
											<a style='color: black;' href="" > <?php echo $row['clientEmail']?> </a>
										</td>

										<td>
											<?php echo $row['clientTel1']?>

										</td>

										<td>
											<div class="uk-grid uk-grid-small">
												<!--<a style='color: black;'  onclick="previewModal('<?php //echo $row['ID']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>-->
												<a style='color: black;' href="<?php echo DIR;?>clientes/editarcliente.php?idcliente=<?php echo $row['ID']?>&tipocliente=renta"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
												<a style='color: black;' onclick="deletedata(<?php echo $row['ID']?>)" ><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
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
require_once('modal_cliente.php');
require('../layout/footer.php');
?>

<script type="text/javascript">
function previewModal(param) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>clientes/previewreserva.php",
	data: param,
	success: function(data){
		$("#preview-modal").html(data);


	}
	});
        }

function deletedata($id) {
	var id = $id;
	UIkit.modal.confirm('¿Confirma que desea eliminar el cliente?', { center:true, labels: { ok: 'Ok', cancel: 'Volver a clientes' } }).then(function() {

			$.ajax({
                url: '<?php echo DIR;?>clientes/deletecliente.php?idcliente=' + id, // url where to submit the request
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

<!--JAVASCRIPT PARA EL MODAL-->

<script type="text/javascript">

	function datoscliente($id_cliente){
        var id = $id_cliente;
        $.ajax({
            url: "<?php echo DIR;?>clientes/respuesta_modal.php?idcliente=" + id,
            type:"GET",
	          beforeSend: function(){
			  		$("#cliente_modal .modal-body").html(
			  				 "<center ><img src='../images/ajax-loader.gif'/></center>"
			  		);
		 		 },
            success:function(resp){
                $("#cliente_modal .modal-body").html(resp);
                $("#cliente_modal .modal-title").html('Información del Cliente');
                //alert(resp);
            }

        });
}
</script>

<script type="text/javascript">

function updatecliente() {
    if (confirm("¿Confirma que desea editar el propietario?")) {
            $.ajax({
                url: '<?php echo DIR;?>clientes/update_cliente.php', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'json', // data type
                data : $("#client-form").serialize(), // post data || get data
            });
            $('#cliente_modal').modal('hide');
} }
</script>

<!--JAVASCRIPT PARA EL MODAL-->
