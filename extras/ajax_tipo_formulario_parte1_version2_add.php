 <?php 
  	$id=$_POST['divid'];

  ?>
<div class="form-inline form-group">
	 <div class="form-group" style='margin-right: 3rem;'>
    	<label >¿N&uacute;mero?</label>
   	</div>
	 <div class="form-group">
	 	 <select style='margin-right: 3rem;' class="form-control" id="cantidad_ocupantes_1<?php echo $id ?>" required="true" name="cantidad_ocupantes_1<?php echo $id ?>">
					      <option value="0">menor a</option>
					      <option value="1">igual a</option>
					      <option value="2">mayor a</option>					      	    
			</select>
	  	    <input type="text" class="form-control" id="cantidad_ocupantes_2<?php echo $id ?>" placeholder="Cantidad" name="cantidad_ocupantes_2<?php echo $id ?>">
	 </div>
</div>

 <div class="form-group">
	    <label for="temporadas">¿En qué temporadas?</label>
	    <select onchange="temporadas_formulario_ajax_add(<?php echo $id ?>)" class="form-control" id="temporadas<?php echo $id ?>" required="true" name="temporadas<?php echo $id ?>">
	      <option value="0">Todo el Año</option>
	      <option value="1">Temporadas Específicas</option>			    
	    </select>
 </div>

  <!--RESPUESTA AJAX-->
		 <div id='temporada_formulario<?php echo $id ?>'></div>
 <!--RESPUESTA AJAX-->

 <div class="form-group">
	    <label for="cantidad">¿Se puede elegir más de uno?</label>
	    <select onchange="cantidad_formulario_ajax_add(<?php echo $id ?>)" class="form-control" id="cantidad<?php echo $id ?>" required="true" name="cantidad<?php echo $id ?>">
	      <option value="0">No</option>
	      <option value="1">Sí</option>			    
	    </select>
 </div>

  <!--RESPUESTA AJAX-->
		<div id='cantidad_formulario<?php echo $id ?>'></div>
<!--RESPUESTA AJAX-->