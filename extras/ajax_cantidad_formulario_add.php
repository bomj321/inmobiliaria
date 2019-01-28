 <?php 
 	$id=$_POST['divid'];
 
  ?>
  
<div class="form-group">
	    <label for="max_cantidad">¿Máximo de unidades?</label>
	    <select class="form-control" id="max_cantidad<?php echo $id ?>" required="true" name="max_cantidad<?php echo $id ?>">
	    	<?php for ($i = 1; $i <=150 ; $i++) {?>
	     		 <option value="<?php echo $i ?>"><?php echo $i ?></option>	     	
	        <?php }  ?>		    
	    </select>
 </div>