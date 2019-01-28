 <?php 
 	$id=$_POST['divid'];
 
  ?>
<div class="form-inline form-group">
	 <div class="form-group " style='margin-right: 5rem;'>
    	<label >Temporadas</label>
   	</div>
	 <div class="form-group">
	  	    <input style='margin-right: 3rem;' type="date" class="form-control" id="start_temporadanot<?php echo $id ?>" name="start_temporadanot<?php echo $id ?>">
	  	    <input type="date" class="form-control" id="end_temporadanot<?php echo $id ?>" name="end_temporadanot<?php echo $id ?>">	  	   
	 </div>
</div>