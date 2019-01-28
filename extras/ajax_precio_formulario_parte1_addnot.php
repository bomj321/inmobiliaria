<?php 
  	$id=$_POST['divid'];

  ?>
<div class="form-inline form-group">
	 <div class="form-group " style='margin-right: 3rem;'>
    	<label >¿A qué precio?</label>
   	</div>
	 <div class="form-group">
	  	    <input style='margin-right: 3rem;' type="text" class="form-control" id="a_que_precio_1not<?php echo $id ?>" placeholder="Precio" name="a_que_precio_1not<?php echo $id ?>">
	  	    <select class="form-control" id="a_que_precio_2not<?php echo $id ?>" required="true" name="a_que_precio_2not<?php echo $id ?>">
					      <option value="0">€ por reserva</option>
					      <option value="1">€ por día</option>
					      <option value="2">€ por persona</option>
					      <option value="3">€ por persona y día</option>
					      <option value="4">€ por hora</option>
					      <option value="5">€ por Kw</option>
					      <option value="6">% del precio de la reserva</option>
					      <option value="7">€ por litro</option>
					      <option value="8">€ por metro cúbico</option>			    
			</select>
	 </div>
</div>