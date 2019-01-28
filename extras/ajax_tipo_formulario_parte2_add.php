<?php 
  	$id=$_POST['divid'];

  ?>
<div class="panel panel-default">
		<div class="panel-heading">TARIFAS DEL SERVICIO</div>
		<div class="panel-body">
		    	 <div class="form-group">
	   				 <label for="precio_incluido">¿Está incluido en el precio?</label>
				     <select onchange="precio_formulario_ajax_add(<?php echo $id ?>)" class="form-control" id="precio_incluido<?php echo $id ?>" required="true" name="precio_incluido<?php echo $id ?>">
					      <option value="1">Si</option>
					      <option value="0">No</option>		    
				     </select>
 				</div>
<!--RESPUESTA AJAX-->
 				<div id='precio_formulario_parte_1<?php echo $id ?>'></div>
<!--RESPUESTA AJAX-->

 				<div class="form-group">
	   				 <label for="iva">IVA aplicado</label>
				     <select class="form-control" id="iva<?php echo $id ?>" required="true" name="iva<?php echo $id ?>">
					      <option value="0">Exento(0 %)</option>
					      <option value="1">Exento ventas intracomunitarias (0 %)</option>
					      <option value="2">Exento ventas internacionales no intracomunitarias (0 %)</option>
					      <option value="3">No sujeto (0 %)</option>
					      <option value="4">Superreducido (4 %)</option>
					      <option value="5">IGIC (7 %)</option>
					      <option value="6">Reducido (10 %)</option>
					      <option value="7">General (21 %)</option>			    
				     </select>
 				</div>
		</div>				
</div>

<!--RESPUESTA AJAX-->
 				<div id='precio_formulario_parte_2<?php echo $id ?>'></div>
<!--RESPUESTA AJAX-->


<div class="panel panel-default">
		<div class="panel-heading">DÍAS DE ASIGNACIÓN POR DEFECTO EN LA RESERVA</div>
		<div class="panel-body">
				<div class="form-inline">
					   <label style="margin-right: 50px;">¿En qué día se aplica?</label>

				    	 <label class="radio-inline">
						  <input type="radio" name="que_dia_aplica<?php echo $id ?>" id="inlineRadio1" value="0"> En la fecha de entrada
						</label>


						<label class="radio-inline">
						  <input type="radio" name="que_dia_aplica<?php echo $id ?>" id="inlineRadio2" value="1"> En la fecha de salida
						</label>

				</div>		

		</div>				
</div>

<div class="panel panel-default">
		<div class="panel-heading">PROVEEDOR</div>
		<div class="panel-body">
			<div class="form-group">
	   				 <label for="proveedores">Proveedor</label>
				     <select class="form-control" id="proveedores<?php echo $id ?>" required="true" name="proveedores<?php echo $id ?>">
					      <option value="0">Sin Datos</option>
					      <option value="1">Endesa-Gesa</option>
					      <option value="2">Fotovoltáico-Propietario</option>
					      <option value="3">IBred</option>	
					      <option value="4">Mallorca Wifi</option>
					      <option value="5">Movistar Telefonica</option>	
					      <option value="6">Propietario</option>
					      <option value="7">Villas Planet SL</option>	
					      <option value="8">WifiBaleares</option>
				     </select>
 				</div>
		    	
		</div>				
</div>