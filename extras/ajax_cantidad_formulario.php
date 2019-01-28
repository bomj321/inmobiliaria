<div class="form-group">
	    <label for="max_cantidad">¿Máximo de unidades?</label>
	    <select class="form-control" id="max_cantidad" required="true" name="max_cantidad">
	    	<?php for ($i = 1; $i <=150 ; $i++) {?>
	     		 <option value="<?php echo $i ?>"><?php echo $i ?></option>	     	
	        <?php }  ?>		    
	    </select>
 </div>