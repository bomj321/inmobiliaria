<div class="form-inline form-group">
	 <div class="form-group" style='margin-right: 3rem;'>
    	<label >¿N&uacute;mero?</label>
   	</div>
	 <div class="form-group">
	 	 <select style='margin-right: 3rem;' class="form-control" id="cantidad_ocupantes_1" required="true" name="cantidad_ocupantes_1">
					      <option value="0">menor a</option>
					      <option value="1">igual a</option>
					      <option value="2">mayor a</option>					      	    
			</select>
	  	    <input type="text" class="form-control" id="cantidad_ocupantes_2" placeholder="Cantidad" name="cantidad_ocupantes_2">
	 </div>
</div>

 <div class="form-group">
	    <label for="temporadas">¿En qué temporadas?</label>
	    <select onchange="temporadas_formulario_ajax()" class="form-control" id="temporadas" required="true" name="temporadas">
	      <option value="0">Todo el Año</option>
	      <option value="1">Temporadas Específicas</option>			    
	    </select>
 </div>

  <!--RESPUESTA AJAX-->
		 <div id='temporada_formulario'></div>
 <!--RESPUESTA AJAX-->

 <div class="form-group">
	    <label for="cantidad">¿Se puede elegir más de uno?</label>
	    <select onchange="cantidad_formulario_ajax()" class="form-control" id="cantidad" required="true" name="cantidad">
	      <option value="0">No</option>
	      <option value="1">Sí</option>			    
	    </select>
 </div>

  <!--RESPUESTA AJAX-->
		<div id='cantidad_formulario'></div>
<!--RESPUESTA AJAX-->