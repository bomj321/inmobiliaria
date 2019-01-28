 <?php
 	$id=$_POST['divid'];
 
  ?>
 <div class="form-group">
	    <label for="temporadasnot">¿En qué temporadas?</label>
	    <select onchange="temporadas_formulario_ajax_add_not(<?php echo $id ?>)" class="form-control" id="temporadasnot<?php echo $id ?>" required="true" name="temporadasnot<?php echo $id ?>">
	      <option value="0">Todo el Año</option>
	      <option value="1">Temporadas Específicas</option>			    
	    </select>
 </div>

  <!--RESPUESTA AJAX-->
		 <div id='temporada_formulario_not<?php echo $id ?>'></div>
 <!--RESPUESTA AJAX-->

 <div class="form-group">
	    <label for="cantidadnot">¿Se puede elegir más de uno?</label>
	    <select onchange="cantidad_formulario_ajax_add_not(<?php echo $id ?>)" class="form-control" id="cantidadnot<?php echo $id ?>" required="true" name="cantidadnot<?php echo $id ?>">
	      <option value="0">No</option>
	      <option value="1">Sí</option>		  			    
	    </select>
 </div>

  <!--RESPUESTA AJAX-->
		<div id='cantidad_formulario_not<?php echo $id ?>'></div>
<!--RESPUESTA AJAX-->
