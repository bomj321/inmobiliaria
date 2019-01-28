<script type="text/javascript" src="../ckeditor/ckeditor.js"> </script>
<?php require('../includes/config2.php'); 




if(!$user->is_logged_in()){ header('Location: ../login'); exit(); } 

$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';
$activo="clientes";
$activo2="";
require('../layout/header.php');
?>

<?php 
include('../layout/menu.php'); 
?>

<!--CAPTAR ID DEL EXTRA-->
<!--SECCION DEL SQL-->
<?php
$id=$_GET['idextra'];
$stmt = $db->prepare("SELECT * FROM extras_alquileres WHERE id_extra='$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
?>
<!--SECCION DEL SQL-->
<!--CAPTAR ID DEL EXTRA-->

<!-----------------------------------------CUERPO DE LA PAGINA-->
<div class="container-fluid col-md-6 col-md-offset-3" style="background-color: white; margin-top: 50px;">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
			<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Edición de Extra</h5>
		</div>
	</div>

	<form id="editextra" style="margin-top: 30px;">
<!--ID DEL EXTRA-->
<input value="<?php echo $row['id_extra'] ?>" type="hidden" class="form-control" id="id_extra" name="id_extra">
<!--ID DEL EXTRA-->		
<!--------------------------PANEL DE EXTRAS-->		
		<div class="panel panel-default">
		  <div class="panel-heading">INFORMACIÓN GENERAL DEL EXTRA</div>
		  <div class="panel-body"><!--CUERPO DEL PANEL-->
		    		<div class="row">
			<div class="col-md-4 col-xs-12">
				<div class="form-group">
				    <label for="name_es">Nombre en Espa&ntilde;ol <span style="color: red;">*</span></label>
				    <input value="<?php echo $row['name_es'] ?>" type="text" class="form-control" id="name_es" placeholder="Ingrese nombre en Español" name="name_es">
  			   </div>
			</div>

			<div class="col-md-4 col-xs-12">
				<div class="form-group">
				    <label for="name_es">Nombre en Ingles<span style="color: red;">*</span></label>
				    <input value="<?php echo $row['name_en'] ?>" type="text" class="form-control" id="name_en" placeholder="Ingrese nombre en Ingles" name="name_en">
  			   </div>
			</div>

			<div class="col-md-4 col-xs-12">
				<div class="form-group">
				    <label for="name_es">Nombre en Alem&aacute;n<span style="color: red;">*</span></label>
				    <input value="<?php echo $row['name_de'] ?>" type="text" class="form-control" id="name_de" placeholder="Ingrese nombre en Alem&aacute;n" name="name_de">
  			   </div>
			</div>
			 

		</div>


		<div class="row">
			<div class="col-md-4 col-xs-12">
				<div class="form-group">
					    <label for="des_es">Descripci&oacute;n en Espa&ntilde;ol<span style="color: red;">*</span></label>
					    <textarea name="des_es" id="des_es" class="form-control" placeholder="Ingrese Descripción en Español"><?php echo $row['des_es'] ?></textarea>
 		        </div>
			</div>

			<div class="col-md-4 col-xs-12">
				<div class="form-group">
					    <label for="des_en">Descripci&oacute;n en Ingles<span style="color: red;">*</span></label>
					    <textarea name="des_en" id="des_en" class="form-control" placeholder="Ingrese Descripción en Ingles"><?php echo $row['des_en'] ?></textarea>
 		        </div>
			</div>

			<div class="col-md-4 col-xs-12">
				<div class="form-group">
					    <label for="des_de">Descripci&oacute;n en Alem&aacute;n<span style="color: red;">*</span></label>
					    <textarea name="des_de" id="des_de" class="form-control" placeholder="Ingrese Descripción en Alem&aacute;n"><?php echo $row['des_de'] ?></textarea>
 		        </div>
			</div>

		</div>

		    <div class="form-group">
					    <label for="activacion">¿Solicitar activación en web/portales?<span style="color: red;">*</span></label>
					    <select class="form-control" id="activacion" required="true" name="activacion">
					      <option <?php echo $row['activacion'] == '0' ? 'selected' : '' ?> value="0">No,solo para uso interno</option>
					      <option <?php echo $row['activacion'] == '1' ? 'selected' : '' ?> value="1">Sí, solicitar para activación</option>			    
					    </select>
 		   </div>
		  </div><!--CUERPO DEL PANEL-->
		</div>
<!--------------------------PANEL DE EXTRAS-->
		<div class="panel panel-default">
  				<div class="panel-heading">CONDICIONES DE APLICACIÓN DEL SERVICIO</div>
				<div class="panel-body">
				    	<div class="form-group">
				  			  <label for="aplica">¿Cuándo se aplica?<span style="color: red;">*</span></label>
						    <select onchange="tipo_formulario_ajax()" class="form-control" id="aplica" required="true" name="aplica">
						      <option <?php echo $row['aplica'] == '0' ? 'selected' : '' ?> value="0">No se aplica nunca (no disponible)</option>
						      <option <?php echo $row['aplica'] == '1' ? 'selected' : '' ?> value="1">Se aplica si lo elije el turista</option>	
						      <option <?php echo $row['aplica'] == '2' ? 'selected' : '' ?> value="2">Se aplica siempre</option>
						      <option <?php echo $row['aplica'] == '3' ? 'selected' : '' ?> value="3">Se aplica según el número de ocupantes</option>	
						      <option <?php echo $row['aplica'] == '4' ? 'selected' : '' ?> value="4">Se aplica según el número de noches de reserva</option>
						      <option <?php echo $row['aplica'] == '5' ? 'selected' : '' ?> value="5">Se aplica según el número de noches previas a reservas</option>			    
						    </select>
		 				 </div>
		 				 <!--RESPUESTA AJAX INICIO-->
		 			        <div id='tipo_formulario_parte_1'>
								<?php if ($row['aplica'] != '0'): ?>									
								
		 			        			<div class="form-inline form-group">
											 <div class="form-group" style='margin-right: 3rem;'>
										    	<label >¿N&uacute;mero?</label>
										   	</div>

											<?php if ($row['cantidad_ocupantes'] != '-'): ?><!--PARTE DE LA CANTIDAD DE OCUPANTES-->
												<?php  $separado_aplica = explode("-", $row['cantidad_ocupantes']); ?>
														 <div class="form-group">
														 	 <select style='margin-right: 3rem;' class="form-control" id="cantidad_ocupantes_1" required="true" name="cantidad_ocupantes_1">
																		      <option <?php echo $separado_aplica[0] == '0' ? 'selected' : '' ?> value="0">menor a</option>
																		      <option <?php echo $separado_aplica[0] == '1' ? 'selected' : '' ?> value="1">igual a</option>
																		      <option <?php echo $separado_aplica[0] == '2' ? 'selected' : '' ?> value="2">mayor a</option>					      	    
																</select>
														  	    <input value="<?php echo $separado_aplica[1] ?>" type="text" class="form-control" id="cantidad_ocupantes_2" placeholder="Cantidad" name="cantidad_ocupantes_2">
														 </div>
											<?php endif ?>	<!--PARTE DE LA CANTIDAD DE OCUPANTES-->		 



										</div>


										 <div class="form-group">
											    <label for="temporadas">¿En qué temporadas?</label>
											    <select onchange="temporadas_formulario_ajax()" class="form-control" id="temporadas" required="true" name="temporadas">
											      <option <?php echo $row['temporadas'] == '0' ? 'selected' : '' ?> value="0">Todo el Año</option>
											      <option <?php echo $row['temporadas'] == '1' ? 'selected' : '' ?> value="1">Temporadas Específicas</option>			    
											    </select>
										 </div>


										  <!--RESPUESTA AJAX TEMPORADAS-->
												 <div id='temporada_formulario'>
													<?php if ($row['temporadas'] != null): ?><!--PARTE DE LA TEMPORADA-->	
														 	<div class="form-inline form-group">
																 <div class="form-group " style='margin-right: 5rem;'>
															    	<label >Temporadas</label>
															   	</div>
																 <div class="form-group">
																  	    <input value='<?php echo $row['start_temporada'] ?>' style='margin-right: 3rem;' type="date" class="form-control" id="start_temporada" name="start_temporada">
																  	    <input value='<?php echo $row['end_temporada'] ?>' type="date" class="form-control" id="end_temporada" name="end_temporada">	  	   
																 </div>
														    </div>
													<?php endif ?>	<!--PARTE DE LA TEMPORADA-->
												 </div>
										 <!--RESPUESTA AJAX TEMPORADAS-->

										 <div class="form-group">
											    <label for="cantidad">¿Se puede elegir más de uno?</label>
											    <select onchange="cantidad_formulario_ajax()" class="form-control" id="cantidad" required="true" name="cantidad">
											      <option <?php echo $row['cantidad'] == '0' ? 'selected' : '' ?> value="0">No</option>
											      <option <?php echo $row['cantidad'] == '1' ? 'selected' : '' ?> value="1">Sí</option>			    
											    </select>
										 </div>

										    <!--RESPUESTA AJAX CANTIDAD FORMULARIO-->
												<div id='cantidad_formulario'>
													<?php if ($row['max_cantidad'] != null): ?><!--PARTE DE LA TEMPORADA-->

														<div class="form-group">
														    <label for="max_cantidad">¿Máximo de unidades?</label>
														    <select class="form-control" id="max_cantidad" required="true" name="max_cantidad">
														    	<?php for ($i = 1; $i <=150 ; $i++) {?>
														     		 <option <?php echo $row['max_cantidad'] == $i ? 'selected' : '' ?> value="<?php echo $i ?>"><?php echo $i ?></option>	     	
														        <?php }  ?>		    
														    </select>
	 													</div>
	 												<?php endif ?>	<!--PARTE DE LA TEMPORADA-->
												</div>
									    	<!--RESPUESTA AJAX CANTIDAD FORMULARIO-->
									<?php endif ?>
		 			        </div>
		 			    <!--RESPUESTA AJAX INICIO-->
	 
				</div>

				
		</div>
			 	

 <!--RESPUESTA AJAX INICIO 2-->		 
 				<div id='tipo_formulario_parte_2'>
 					<?php if ($row['aplica'] != '0'): ?>
 							<div class="panel panel-default">
								<div class="panel-heading">TARIFAS DEL SERVICIO</div>
								<div class="panel-body">
								    	 <div class="form-group">
							   				 <label for="precio_incluido">¿Está incluido en el precio?</label>
										     <select onchange="precio_formulario_ajax()" class="form-control" id="precio_incluido" required="true" name="precio_incluido">
											      <option <?php echo $row['precio_incluido'] == '0' ? 'selected' : '' ?> value="0">No</option>
											      <option <?php echo $row['precio_incluido'] == '1' ? 'selected' : '' ?> value="1">Si</option>			    
										     </select>
						 				</div>
						<!--RESPUESTA AJAX PRECIO-->
						 				<div id='precio_formulario_parte_1'>
											<?php if ($row['a_que_precio'] != '-'): ?>
												<?php  $separado_precio = explode("-", $row['a_que_precio']); ?>

							 						<div class="form-inline form-group">
														 <div class="form-group " style='margin-right: 3rem;'>
													    	<label >¿A qué precio?</label>
													   	</div>
														 <div class="form-group">
														  	    <input value="<?php echo $separado_precio[0]?>" style='margin-right: 3rem;' type="text" class="form-control" id="a_que_precio_1" placeholder="Precio" name="a_que_precio_1">
														  	    <select class="form-control" id="a_que_precio_2" required="true" name="a_que_precio_2">
																		      <option <?php echo $separado_precio[1] == '0' ? 'selected' : '' ?>value="0">€ por reserva</option>
																		      <option <?php echo $separado_precio[1] == '1' ? 'selected' : '' ?>value="1">€ por día</option>
																		      <option <?php echo $separado_precio[1] == '2' ? 'selected' : '' ?>value="2">€ por persona</option>
																		      <option <?php echo $separado_precio[1] == '3' ? 'selected' : '' ?>value="3">€ por persona y día</option>
																		      <option <?php echo $separado_precio[1] == '4' ? 'selected' : '' ?>value="4">€ por hora</option>
																		      <option <?php echo $separado_precio[1] == '5' ? 'selected' : '' ?>value="5">€ por Kw</option>
																		      <option <?php echo $separado_precio[1] == '6' ? 'selected' : '' ?>value="6">% del precio de la reserva</option>
																		      <option <?php echo $separado_precio[1] == '7' ? 'selected' : '' ?>value="7">€ por litro</option>
																		      <option <?php echo $separado_precio[1] == '8' ? 'selected' : '' ?>value="8">€ por metro cúbico</option>			    
																</select>
														 </div>
													</div>
											<?php endif ?>
						 				</div>
						<!--RESPUESTA AJAX PRECIO-->

						 				<div class="form-group">
							   				 <label for="iva">IVA aplicado</label>
										     <select class="form-control" id="iva" required="true" name="iva">
											      <option <?php echo $row['iva'] == '0' ? 'selected' : '' ?> value="0">Exento(0 %)</option>
											      <option <?php echo $row['iva'] == '1' ? 'selected' : '' ?> value="1">Exento ventas intracomunitarias (0 %)</option>
											      <option <?php echo $row['iva'] == '2' ? 'selected' : '' ?> value="2">Exento ventas internacionales no intracomunitarias (0 %)</option>
											      <option <?php echo $row['iva'] == '3' ? 'selected' : '' ?> value="3">No sujeto (0 %)</option>
											      <option <?php echo $row['iva'] == '4' ? 'selected' : '' ?> value="4">Superreducido (4 %)</option>
											      <option <?php echo $row['iva'] == '5' ? 'selected' : '' ?> value="5">IGIC (7 %)</option>
											      <option <?php echo $row['iva'] == '6' ? 'selected' : '' ?> value="6">Reducido (10 %)</option>
											      <option <?php echo $row['iva'] == '7' ? 'selected' : '' ?> value="7">General (21 %)</option>			    
										     </select>
						 				</div>
								</div>				
							</div>

							<!--RESPUESTA AJAX PRECIO PARTE 2-->
							 				<div id='precio_formulario_parte_2'>
							 					<?php if ($row['precio_incluido'] == '1'): ?>
								 						<div class="panel panel-default">
											  				<div class="panel-heading">PAGO DEL SERVICIO</div>
															<div class="panel-body">
															    	<div class="form-group">
																    	<label for="cuando_se_paga">¿Cuándo se paga?</label>
																	    <select class="form-control" id="cuando_se_paga" required="true" name="cuando_se_paga">
																	      <option <?php echo $row['cuando_se_paga'] == '0' ? 'selected' : '' ?> value="0">Al realizar la reserva</option>
																	      <option <?php echo $row['cuando_se_paga'] == '1' ? 'selected' : '' ?> value="1">A pagar en destino</option>	
																	      <option <?php echo $row['cuando_se_paga'] == '2' ? 'selected' : '' ?> value="2">A pagar con el último pago antes de la llegada</option>			    
																	    </select>
											 						</div>
												 
															</div>				
														</div>
												<?php endif ?>		
							 				</div>
							<!--RESPUESTA AJAX PRECIO PARTE 2-->


							<div class="panel panel-default">
									<div class="panel-heading">DÍAS DE ASIGNACIÓN POR DEFECTO EN LA RESERVA</div>
									<div class="panel-body">
											<div class="form-inline">
												   <label style="margin-right: 50px;">¿En qué día se aplica?</label>

											    	 <label class="radio-inline">
													  <input <?php echo $row['que_dia_aplica'] == '0' ? 'checked' : '' ?> type="radio" name="que_dia_aplica" id="inlineRadio1" value="0"> En la fecha de entrada
													</label>


													<label class="radio-inline">
													  <input <?php echo $row['que_dia_aplica'] == '1' ? 'checked' : '' ?> type="radio" name="que_dia_aplica" id="inlineRadio2" value="1"> En la fecha de salida
													</label>

											</div>		

									</div>				
							</div>

							<div class="panel panel-default">
									<div class="panel-heading">PROVEEDOR</div>
									<div class="panel-body">
										<div class="form-group">
								   				 <label for="proveedores">Proveedor</label>
											     <select class="form-control" id="proveedores" required="true" name="proveedores">
												      <option <?php echo $row['proveedores'] == '0' ? 'selected' : '' ?> value="0">Sin Datos</option>
												      <option <?php echo $row['proveedores'] == '1' ? 'selected' : '' ?> value="1">Endesa-Gesa</option>
												      <option <?php echo $row['proveedores'] == '2' ? 'selected' : '' ?> value="2">Fotovoltáico-Propietario</option>
												      <option <?php echo $row['proveedores'] == '3' ? 'selected' : '' ?> value="3">IBred</option>	
												      <option <?php echo $row['proveedores'] == '4' ? 'selected' : '' ?> value="4">Mallorca Wifi</option>
												      <option <?php echo $row['proveedores'] == '5' ? 'selected' : '' ?> value="5">Movistar Telefonica</option>	
												      <option <?php echo $row['proveedores'] == '6' ? 'selected' : '' ?> value="6">Propietario</option>
												      <option <?php echo $row['proveedores'] == '7' ? 'selected' : '' ?> value="7">Villas Planet SL</option>	
												      <option <?php echo $row['proveedores'] == '8' ? 'selected' : '' ?> value="8">WifiBaleares</option>
											     </select>
							 				</div>
									    	
									</div>				
							</div>
					<?php endif ?>		
 				</div>
					
<!--RESPUESTA AJAX INICIO 2-->

 		   <button  onclick="editarData()" type="button" class="btn btn-primary">Editar Extra</button>


	</form>	

</div>

	<div style="height:1800px"></div>



<!-----------------------------------------CUERPO DE LA PAGINA-->


<?php 
//include header template
require('../layout/footer.php'); 
?>


<script type="text/javascript" >
function editarData() {
var name_es = document.getElementById('name_es').value;
var name_en = document.getElementById('name_en').value;
var name_de = document.getElementById('name_de').value;


var des_es = document.getElementById('des_es').value;
var des_en = document.getElementById('des_en').value;
var des_de = document.getElementById('des_de').value;


if (name_es=='' || name_en=='' || name_de=='' || des_es=='' || des_en=='' || des_de=='') {
 alert('Hay campos Obligatiorios Vacios')
 return false;
}

	UIkit.modal.confirm('¿Confirma que desea editar el extra?', { center:true, labels: { ok: 'Ok', cancel: 'Volver a Edición de extras' } }).then(function() {
   for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
			$.ajax({
                url: '<?php echo DIR;?>extras/updateextra', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'text', // data type
                data : $("#editextra").serialize(), // post data || get data
                success : function(result) {
                   window.location.replace("<?php echo DIR;?>extras/alquileres");
                   
                },
                error: function(xhr, resp, text,error) {
                     UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> <strong>Ha habido un error al agregar. Inténtelo de nuevo.</strong>', status: 'danger', timeout:2000})
					alert(error);
                } 
				
			});
}, function () {
   
});
	
}     
 </script>