<?php

// require('../includes/config2.php');
 require('../includes/config_reservas.php');



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
$loging = "INSERT INTO Logging (data, hora, usuari, ip_conexio, ip_proxy, navegador, accio, observacions) VALUES ('".$data."','".$hora."','".$_SESSION['username']."','".$IPPROXY."', '".$IP."', '".$Nav."','".$accio."','".$observacions."')";
$db->exec($loging);


$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';
$activo="reservas";
$activo2="";
require('../layout/header.php');
?>
<?php
include('../layout/menu.php');
?>

<!--SCRIPT DE RESERVAS SI SE COLOCA EN FOOTER ENTRA EN CONFLICTO LOS BUSCADORES-->



<div class="container-fluid">
	<style>
		#reservas td {
    max-width: 200px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

	#reservas_filter .input-sm
	{
	  width: 500px !important;
	  height: 40px !important;
	}

	#reservas_filter label
	{
	  font-weight: bold;
	}
	</style>



	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
			<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">
			<a href="<?php echo DIR;?>reservas/addreservas">
				<button  class="uk-button button-direct " style="background-color:#F9B233;color:#fff"><span uk-icon="icon:plus;"></span> Añadir Reversa</button>
			</a>
			</h5>

		</div>
	</div>

<!----------------LISTADO DE COLORES-->

	<div class="row">


		<div class="col-lg-1 col-md-1 col-sm-3 col-xs-4" style="background-color:#ffebcc; margin-left: 10px;">
			<a href="<?php echo DIR;?>reservas/index.php?filtro=Pre-Reserva" style="color: black; font-size: 10px; font-weight: bold;">
				<center style='padding-top:15px;' ><p>Pre-Reserva</p></center>
			</a>

		</div>



		<div class="col-lg-1 col-md-1 col-sm-3 col-xs-4" style="background-color:#f5ccff; margin-left: 10px;">
			<a href="<?php echo DIR;?>reservas/index.php?filtro=Bajo_Peticion" style="color: black; font-size: 10px; font-weight: bold;">
				<center style='padding-top:15px;' ><p>Bajo Petición</p></center>
		</a>

		</div>



		<div class="col-lg-1 col-md-1 col-sm-3 col-xs-4" style="background-color:#ccccff; margin-left: 10px;">
			<a href="<?php echo DIR;?>reservas/index.php?filtro=De_Propietario" style="color: black; font-size: 10px; font-weight: bold;">
				<center style='padding-top:15px;' ><p>De Propietario</p></center>
		</a>



		</div>



		<div class="col-lg-1 col-md-1 col-sm-3 col-xs-4" style="background-color:#ffffcc; margin-left: 10px;">
			<a href="<?php echo DIR;?>reservas/index.php?filtro=Confirmada" style="color: black; font-size: 10px; font-weight: bold;">
				<center style='padding-top:15px;' ><p>Confirmada</p></center>
		</a>

		</div>



		<div class="col-lg-1 col-md-1 col-sm-3 col-xs-4" style="background-color:#d6f5d6; margin-left: 10px;">
			<a href="<?php echo DIR;?>reservas/index.php?filtro=Pagada" style="color: black; font-size: 10px; font-weight: bold;">
				<center style='padding-top:15px;' ><p>Pagada</p></center>
		</a>
		</div>



		<div class="col-lg-1 col-md-1 col-sm-3 col-xs-4" style="background-color:#ffccdd; margin-left: 10px;">
			<a href="<?php echo DIR;?>reservas/index.php?filtro=Pendiente_del_Pago" style="color: black; font-size: 10px; font-weight: bold;">
				<center style='padding-top:15px;' ><p>Pendiente Pago</p></center>
		</a>
		</div>



		<div class="col-lg-1 col-md-1 col-sm-3 col-xs-4" style="background-color:#bf8040; margin-left: 10px;">
			<a href="<?php echo DIR;?>reservas/index.php?filtro=Pagado_Deposito" style="color: black; font-size: 10px; font-weight: bold;">
				<center style='padding-top:15px;' ><p>Pagado Deposito</p></center>
		</a>
		</div>



		<div class="col-lg-1 col-md-1 col-sm-3 col-xs-4" style="background-color:#ff3300; margin-left: 10px;">
			<a href="<?php echo DIR;?>reservas/index.php?filtro=Pago_Error" style="color: black; font-size: 10px; font-weight: bold;">
				<center style='padding-top:15px;' ><p>Pago Error</p></center>
		</a>
		</div>



		<div class="col-lg-1 col-md-1 col-sm-3 col-xs-4" style="background-color:#cccccc; margin-left: 10px;">
			<a href="<?php echo DIR;?>reservas/index.php?filtro=Cierre_de_Ventas" style="color: black; font-size: 10px; font-weight: bold;">
				<center style='padding-top:15px;' ><p>Cierre de Ventas</p></center>
		</a>
		</div>



		<div class="col-lg-1 col-md-1 col-sm-3 col-xs-4" style="background-color:#e6e6e6; margin-left: 10px;">
			<a href="<?php echo DIR;?>reservas/index.php?filtro=Bloqueado" style="color: black; font-size: 10px; font-weight: bold;">
				<center style='padding-top:15px;' ><p>Bloqueado</p></center>
		</a>
		</div>



		<div class="col-lg-1 col-md-1 col-sm-3 col-xs-4" style="background-color:#ffd9cc; margin-left: 10px;">
			<a href="<?php echo DIR;?>reservas/index.php?filtro=Cancelada" style="color: black; font-size: 10px; font-weight: bold;">
				<center style='padding-top:15px;' ><p>Cancelada</p></center>
		</a>
		</div>


	</div>

<!----------------LISTADO DE COLORES-->




	<div class="row" style="margin-top: 10px; background-color: white;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 20px;">
			<div class="row" style="margin-bottom: 10px;">

				<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4" style="margin-right: -3.5rem;">
			 			 <h5 style="font-weight: bold;">Fecha de Entrada:</h5>
			 		</div>

			 		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
			 			<div class="input-group">
							  <span class="input-group-addon glyphicon glyphicon-calendar"></span>
							  <input name="min" id="min" class='form-control datepicker' type="text" aria-describedby="min" data-date-format="dd/mm/yyyy">
						</div>
			 		</div>

			 		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
			 			<center><h2>-</h2></center>
			 		</div>

			 		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
			 			<div class="input-group">
							  <span class="input-group-addon glyphicon glyphicon-calendar"></span>
							  <input name="max" id="max" class='form-control datepicker' type="text" aria-describedby="max" data-date-format="dd/mm/yyyy">
						</div>
			 		</div>

			 		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			 			<a href="<?php echo DIR;?>reservas/" type="button" class="btn btn-success">Refrescar Registros</a>
			 		</div>

			 	</div>

			 	<div class="row" style="margin-bottom: 10px;">

				<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4" style="margin-right: -3.5rem;">
			 			<h5 style="font-weight: bold;">Fecha de Reserva:</h5>
			 		</div>

			 		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
			 			<div class="input-group">
							  <span class="input-group-addon glyphicon glyphicon-calendar"></span>
							  <input name="min_res" id="min_res" class='form-control datepicker' type="text" aria-describedby="min_res" data-date-format="dd/mm/yyyy">
						</div>
			 		</div>

			 		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
			 			<center><h2>-</h2></center>
			 		</div>

			 		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
			 			<div class="input-group">
							  <span class="input-group-addon glyphicon glyphicon-calendar"></span>
							  <input name="max_res" id="max_res" class='form-control datepicker' type="text" aria-describedby="max_res" data-date-format="dd/mm/yyyy">
						</div>
			 		</div>
			 	</div>
			 <table id="reservas" class="table table-hover bulk_action dt-responsive nowrap"  cellspacing="0" width="100%" style="max-width: 100%;">

                            <thead>
                                <tr>
                                	<th class="all">ID</th>
                                	<th class="all">Fecha de la Reserva</th>
                                	<th class="all">Propiedad</th>
                                    <th class="all">Cliente</th>                                    
                                    <th class="none">Tipo Propiedad</th>
                                    <th class="all">Fecha de Entrada</th>
                                    <th class="all">Fecha de Salida</th>
                                    <th class="all">Tipo de Reserva</th>
                                    <th class="all">Precio</th>
                                    <th class="all">Owner</th>
                                    <th class="all">Charges</th>
                                    <th class="all">Discount</th>
                                    <th class="none">Direcci&oacute;n</th>                                   
                                    <th class="none">Precio</th>
                                    <th class="none">Adultos</th>
                                    <th class="none">Ni&ntilde;os</th>
                                    <th class="none">Edades</th>
                                    <th class="none">Comentarios</th>
                                    <th class="all">Profit</th>
                                    <th class="all">Acciones</th>                                    
                                </tr>
                            </thead>
                            <tbody >
                          <!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<?php

if (isset($_GET['filtro']) AND !empty($_GET['filtro'])) {

	$filtro =$_GET['filtro'];
$stmt = $db->prepare("SELECT rental_enquiries.*,rentals.propNameES as NameES,rentals.propType as Type,rentals.propAddress as Address,clients.ClientName as nombrecliente FROM rental_enquiries LEFT JOIN rentals ON rental_enquiries.PropID = rentals.ID LEFT JOIN clients ON rental_enquiries.ClientID = clients.ID WHERE rental_enquiries.tipo_reserva = '$filtro' ORDER BY rental_enquiries.ID DESC limit 700");

}else{


$stmt = $db->prepare("SELECT rental_enquiries.*,rentals.propNameES as NameES,rentals.propType as Type,rentals.propAddress as Address,clients.ClientName as nombrecliente FROM rental_enquiries LEFT JOIN rentals ON rental_enquiries.PropID = rentals.ID LEFT JOIN clients ON rental_enquiries.ClientID = clients.ID  ORDER BY rental_enquiries.ID DESC limit 700");


}

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

while ($row = $stmt->fetch()){
 ?>
<!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<!--CUERPO DE LA PAGINA-->
<!--CONDICIONALES PARA LOS COLORES-->

			<tr>

<!--CONDICIONALES PARA LOS COLORES-->
						                <td>
						                	<?php echo $row['ID'] ?>
						                </td>

						                <td style="max-width: 30px;">
											<?php $date_reserva = date_create($row['dateAdded']); ?>
											<?php echo date_format($date_reserva, 'd-m-Y'); ?>
										</td>

										<td style="max-width: 20px;">
											<?php echo $row['NameES'] ?>
										</td>

										<td style="max-width: 30px;">
											<?php echo $row['nombrecliente'] ?>
										</td>
										

										<td>
											<?php echo $row['Type'] ?>
										</td>

										<td >
											<?php $date_entrada = date_create($row['enquiryStart']); ?>
											<?php echo date_format($date_entrada, 'd-m-Y'); ?>
										</td>

										<td>
											<?php $date_salida = date_create($row['enquiryEnd']); ?>
											<?php echo date_format($date_salida, 'd-m-Y'); ?>
										</td>
										

										<td>
											<?php
												$tipo_de_reserva=str_replace('_', ' ',$row['bookingNotes']);
											 ?>

													<!--<button onclick='cambiarestado(<?php echo $row['ID'] ?>,"<?php echo $row['tipo_reserva'] ?>")' style='width: 100%;' class="btn btn-default"><?php echo $tipo_de_reserva; ?></button>-->

												<!------------------------CONSULTA PARA EL BOTON---------------------->
												 <?php if ($row['bookingNotes'] == 'Pre-Reserva'): ?>

																<button style='width: 100%; background-color: #ffebcc;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Bajo Petición'): ?>

																<button style='width: 100%; background-color: #f5ccff;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'De Propietario'): ?>

																<button style='width: 100%; background-color: #ccccff;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Confirmada'): ?>

																<button style='width: 100%; background-color: #ffffcc;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Pagada'): ?>

																<button style='width: 100%; background-color: #d6f5d6;' class="btn"><?php echo $tipo_de_reserva; ?></button>
														<?php elseif($row['bookingNotes'] == 'Pendiente de Pago'): ?>

																<button style='width: 100%; background-color: #ffccdd;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Pagado Deposito'): ?>

																<button style='width: 100%; background-color: #bf8040;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Pago Error'): ?>

																<button style='width: 100%; background-color: #ff3300;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Cierre de Ventas'): ?>

																<button style='width: 100%; background-color: #cccccc;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Bloqueado'): ?>

																<button style='width: 100%; background-color: #e6e6e6;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Cancelada'): ?>

															<button style='width: 100%; background-color: #ffd9cc;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'DESCONOCIDO'): ?>

															<button style='width: 100%; background-color: #ffffcc;' class="btn">RESERVA VP.COM</button>	

														<?php else: ?>
															<button class="btn btn-default btn-block">Sin Asignar</button>

													<?php endif ?>






												<!------------------------CONSULTA PARA EL BOTON---------------------->



										</td>

										<td><?php echo $row['bookingComm'] ?></td>
										<td><?php echo $row['bookingOwnerFee'] ?></td>
										<td><?php echo $row['bookingCharges'] ?></td>
										<td><?php echo $row['bookingFeeType'] ?></td>

										<td>
											<?php echo $row['Address'] ?>
										</td>										

										<td>
											<?php echo $row['bookingComm'] ?>
										</td>

										<td>
											<?php echo $row['bookingAdults'] ?>
										</td>

										<td>
											<?php echo $row['bookingChildren'] ?>
										</td>

										<td>
											<?php echo $row['bookingChildAges'] ?>
										</td>

										<td>
											<?php echo $row['bookingNotesPrivate'] ?>
										</td>

										<td>
											<!--FORMATEO DE LOS DATOS-->
											<?php 
													/*if (empty($row['bookingComm'])) {
														$row['bookingComm'] = 0 ;
													}*/

													if (empty($row['bookingOwnerFee'])) {
														$row['bookingOwnerFee'] = 0 ;
													}

													if (empty($row['bookingCharges'])) {
														$row['bookingCharges'] = 0 ;
													}
													if (empty($row['bookingFeeType'])) {
														$row['bookingFeeType'] = 0 ;
													}

													/*if (empty($row['bookingDeposit'])) {
														$row['bookingDeposit'] = 0 ;
													}*/

													if (!empty($row['bookingComm']) AND $row['bookingComm'] != '0.00') {
														$total = $row['bookingComm'];

													}elseif(!empty($row['bookingDeposit']) AND $row['bookingDeposit'] != '0.00'){
														$total = $row['bookingDeposit'];
													}else{
														$total = 0;
													}
											 ?>

											<!--FORMATEO DE LOS DATOS-->

											<?php echo ($total) - ($row['bookingOwnerFee'] + $row['bookingCharges']+$row['bookingFeeType']) ?> Euros</td>

										<td>
											<div class="uk-grid uk-grid-small">
												<!--<a style='color: black;' onclick="previewModal('<?php// echo $row['ID']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>-->
												<a style='color: black;' href="<?php echo DIR;?>reservas/editarreserva?idreserva=<?php echo $row['ID']?>"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
												<a style='color: black;' onclick="deletedata(<?php echo $row['ID']?>)"><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
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
require('../layout/footer.php');

 ?>

 <script>
	/****************************RESERVAS*********************/
        /***********************PROGRAMACION DE RANGO DE FECHAS***********************/
      $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {

                    var min = $('#min').datepicker("getDate");
                    var max = $('#max').datepicker("getDate");

                    // need to change str order before making  date obect since it uses a new Date("mm/dd/yyyy") format for short date.
                    var d = data[7].split("-");
                    var startDate = new Date(d[1]+ "/" +  d[0] +"/" + d[2]);

                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );


       $("#min").datepicker({ onSelect: function () { reservas.draw(); }, changeMonth: true, changeYear: true , dateFormat:"dd/mm/yy"});
       $("#max").datepicker({ onSelect: function () { reservas.draw(); }, changeMonth: true, changeYear: true,  dateFormat:"dd/mm/yy" });




       $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {

                    var min_res = $('#min_res').datepicker("getDate");
                    var max_res = $('#max_res').datepicker("getDate");

                    // need to change str order before making  date obect since it uses a new Date("mm/dd/yyyy") format for short date.
                    var d = data[4].split("-");
                    var startDate_res = new Date(d[1]+ "/" +  d[0] +"/" + d[2]);

                    if (min_res == null && max_res == null) { return true; }
                    if (min_res == null && startDate_res <= max_res) { return true;}
                    if(max_res == null && startDate_res >= min_res) {return true;}
                    if (startDate_res <= max_res && startDate_res >= min_res) { return true; }
                    return false;
                }
            );


       $("#min_res").datepicker({ onSelect: function () { reservas.draw(); }, changeMonth: true, changeYear: true , dateFormat:"dd/mm/yy"});
       $("#max_res").datepicker({ onSelect: function () { reservas.draw(); }, changeMonth: true, changeYear: true,  dateFormat:"dd/mm/yy" });
/***********************PROGRAMACION DE RANGO DE FECHAS***********************/

        var reservas = $("#reservas").DataTable({
                  "iDisplayLength": 25,
                  'responsive': true,
                   language: {
                      "sProcessing":     "Procesando...",
                      "sLengthMenu":     "Mostrar _MENU_ registros",
                      "sZeroRecords":    "No se encontraron resultados",
                      "sEmptyTable":     "Ningún dato disponible en esta tabla",
                      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                      "sInfoPostFix":    "",
                      "sSearch":         "Buscar:",
                      "sUrl":            "",
                      "sInfoThousands":  ",",
                      "sLoadingRecords": "Cargando...",
                      "oPaginate": {
                          "sFirst":    "Primero",
                          "sLast":     "Último",
                          "sNext":     "Siguiente",
                          "sPrevious": "Anterior"
                  },
                  "oAria": {
                      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                  }
              },
              "aaSorting": [[ 0, "desc" ]],
          });



      /* var reservas = $('#reservas').DataTable({
           responsive: true,
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "bSort": false,




          });*/

/*CODIGO QUE ACTUALIZA LA TABLA*/
       $('#min, #max').change(function () {
                reservas.draw();
            });

       $('#min_res, #max_res').change(function () {
                reservas.draw();
            });
/*CODIGO QUE ACTUALIZA LA TABLA*/
 /****************************RESERVAS*********************/

</script>

<!--SCRIPT DE RESERVAS SI SE COLOCA EN FOOTER ENTRA EN CONFLICTO LOS BUSCADORES-->
<script type="text/javascript">
function previewModal(param) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>reservas/previewreserva",
	data: param,
	success: function(data){
		$("#preview-modal").html(data);


	}
	});
        }

function deletedata($id) {
					var id = $id;
					UIkit.modal.confirm('¿Confirma que desea eliminar la Reserva?', { center:true, labels: { ok: 'Ok', cancel: 'Volver a Reservas' } }).then(function() {

							$.ajax({
								type: "GET",
            					cache: false,
				                url: '<?php echo DIR;?>reservas/deletereserva?idreserva=' + id, // url where to submit the request
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




/*function refrescar(){
	location.reload();
} */







</script>
