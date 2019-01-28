<?php 
  	$id=$_POST['divid'];

  ?>
<div class="panel panel-default">
  				<div class="panel-heading">PAGO DEL SERVICIO</div>
				<div class="panel-body">
				    	<div class="form-group">
					    	<label for="cuando_se_paga">¿Cuándo se paga?</label>
						    <select class="form-control" id="cuando_se_paga<?php echo $id ?>" required="true" name="cuando_se_paga<?php echo $id ?>">
						      <option value="0">Al realizar la reserva</option>
						      <option value="1">A pagar en destino</option>	
						      <option value="2">A pagar con el último pago antes de la llegada</option>			    
						    </select>
 						</div>
	 
				</div>

				
		</div>