 <?php
 	$id=$_POST['divid'];
 
  ?>
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
