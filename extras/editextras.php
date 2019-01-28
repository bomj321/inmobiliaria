<?php 
require('../includes/config2.php'); 
$ref=$_POST["id"];

?>

    <div class="uk-modal-dialog uk-margin-auto-vertical" style="width:70%;">
        <button onclick="closeEdit()" class="uk-modal-close-defaul" type="button" uk-close></button>
        <div class="uk-modal-header">
			<div class="uk-grid">
				<div class="uk-width-1-1">
			<h5 class="uk-modal-title "><span uk-icon="icon:tag;ratio:1;" class="icon-margin"></span> Editar extra/equipamiento</h5>
				</div>
				
			</div>
        </div>
        <div class="uk-modal-body">
		<form class="uk-form-stacked" id="extraform">	
		<?php $stmt2 = $db->prepare("SELECT * FROM extras_properties where id='$ref'");
$stmt2->setFetchMode(PDO::FETCH_ASSOC);
$stmt2->execute();
while ($row2 = $stmt2->fetch()){	
$tipoprop=explode(',',$row2['extraTipoProp']);	
$especialES=explode(',',$row2['extraOptions']);
$especialEN=explode(',',$row2['extraOptionsEN']);
$especialDE=explode(',',$row2['extraOptionsDE']);
$categoria=$row2['extraCat'];

			?>
		<input type="text" hidden name="id" value="<?php echo $ref?>">
		<input type="text" hidden name="accion" value="edit">
		<div class="uk-grid uk-grid-medium">
        <div class="uk-width-1-3" style="margin-top:10px">
        <label class="uk-form-label" for="form-stacked-text">Nombre </label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="-No asignado-" name="extraNombre" value="<?php echo $row2['extraNombre']?>">
        </div>
		</div>
			
			<div class="uk-width-1-3" style="margin-top:10px">
        <label class="uk-form-label" for="form-stacked-text"><img src="<?php echo DIR;?>images/uk-flag.png">&nbsp; Nombre inglés </label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="-No asignado-" name="extraNombreEN" value="<?php echo $row2['extraNombreEN']?>">
        </div>
		</div>
			<div class="uk-width-1-3" style="margin-top:10px">
        <label class="uk-form-label" for="form-stacked-text"><img src="<?php echo DIR;?>images/deustche-flag.png">&nbsp; Nombre alemán </label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="-No asignado-" name="extraNombreDE" value="<?php echo $row2['extraNombreDE']?>">
        </div>
		</div>
		
			<div class="uk-width-1-1" style="margin-top:10px">
				<h5><strong>Características especiales </strong> <span style="font-size:14px">( *Seleccionables al crear/editar propiedad )</span></h5>
		<div class="uk-grid">
		 <div class="uk-width-1-3" >
        <label class="uk-form-label" for="form-stacked-text" style="margin-bottom:-5px"> Nombre</label>
        <div class="uk-form-controls">
			<?php foreach ($especialES as $optES) {?>
            <input class="uk-input" type="text" placeholder="-No asignado-" name="extraOptions[]" value="<?php echo $optES?>" style="margin-top:10px">
			<?php }?>
			<span class="newAssign1"></span>
        </div>
				  
		</div>
			 <div class="uk-width-1-3" >
        <label class="uk-form-label" for="form-stacked-text" style="margin-bottom:-5px"><img src="<?php echo DIR;?>images/uk-flag.png">&nbsp; Nombre inglés </label>
        <div class="uk-form-controls">
           <?php foreach ($especialEN as $optEN) {?>
            <input class="uk-input" type="text" placeholder="-No asignado-" name="extraOptionsEN[]" value="<?php echo $optEN?>" style="margin-top:10px">
			<?php }?>
			<span class="newAssign2"></span>
        </div>
				 
		</div>
				 <div class="uk-width-1-3" >
        <label class="uk-form-label" for="form-stacked-text" style="margin-bottom:-5px"><img src="<?php echo DIR;?>images/deustche-flag.png">&nbsp; Nombre alemán </label>
        <div class="uk-form-controls">
           <?php foreach ($especialDE as $optDE) {?>
            <input class="uk-input" type="text" placeholder="-No asignado-" name="extraOptionsDE[]" value="<?php echo $optDE?>" style="margin-top:10px">
			<?php }?>
			<span class="newAssign3"></span>
        </div>
				 
		</div>
				</div>
				
				<button type="button" class="uk-button uk-button-small uk-margin-top" id="addNew"><span uk-icon="icon:plus; ratio:0.9"></span> Añadir</button></div>
			<div class="uk-width-1-1" style="margin-top:20px">
				<h5><strong>¿A qué tipo de propiedad pertenece?</strong></h5>
					<div class=" uk-grid-medium uk-child-width-auto uk-grid">	
            <label style="cursor:pointer"><input class="uk-checkbox" name="extraTipoProp[]" type="checkbox" <?php if (($tipoprop[0]=="Venta") or ($tipoprop[1]=="Venta") or ($tipoprop[2]=="Venta") or ($tipoprop[3]=="Venta")){ echo "checked";}?> value="Venta">&nbsp; Venta</label>
			 <label style="cursor:pointer"><input class="uk-checkbox" name="extraTipoProp[]" type="checkbox" <?php if (($tipoprop[0]=="Vacacional") or ($tipoprop[1]=="Vacacional") or ($tipoprop[2]=="Vacacional") or ($tipoprop[3]=="Vacacional")){ echo "checked";}?> value="Vacacional">&nbsp; Alquiler vacacional</label>
			 <label style="cursor:pointer"><input class="uk-checkbox" name="extraTipoProp[]" type="checkbox" <?php if (($tipoprop[0]=="Anual") or ($tipoprop[1]=="Anual") or ($tipoprop[2]=="Anual") or ($tipoprop[3]=="Anual")){ echo "checked";}?> value="Anual">&nbsp; Alquiler anual</label>
			 <label style="cursor:pointer;"><input class="uk-checkbox" name="extraTipoProp[]" type="checkbox" <?php if (($tipoprop[0]=="Temporal") or ($tipoprop[1]=="Temporal") or ($tipoprop[2]=="Temporal") or ($tipoprop[3]=="Temporal")){ echo "checked";}?> value="Temporal">&nbsp; Alquiler temporal</label>

        </div>
				</div>
		<div class="uk-width-1-1 uk-margin-top" >	
		<hr class="uk-article-divider">
		</div>
		<div class="uk-width-1-1 uk-margin-top">
		<div class="uk-grid">
		<div class="uk-width-1-2">
		<div class="uk-width-1-1 uk-margin-bottom">
	
            <label style="display:block;margin-bottom:15px;"> ¿Quieres editar la <strong>categoría</strong>? </label>
						<select placeholder="-Seleccionar-" class="simple " name="category">
					    <option  value="otros" <?php if ($categoria=="otros") { echo "selected";}?>>Características adicionales</option>
						<option  value="distribucion" <?php if ($categoria=="distribucion") { echo "selected";}?> >Distribución</option>
						<option  value="banos" <?php if ($categoria=="banos") { echo "selected";}?>>Baños</option>	
						<option  value="equipamiento" <?php if ($categoria=="equipamiento") { echo "selected";}?> >Accesorios/equipamiento</option>
						<option  value="jardin" <?php if ($categoria=="jardin") { echo "selected";}?>>Jardín/Exterior</option>
								
			</select>
			
			</div> 
		<div class="uk-width-1-1">
		
					<div class=" uk-grid-medium uk-child-width-auto uk-grid uk-margin-bottom ">
            <label style="cursor:pointer"><input class="uk-checkbox" value="si" name="extraActivo" type="checkbox" <?php if ($row2['extraActivo']=="si"){ echo "checked";}?> >&nbsp; ¿Activar extra/equipamiento?</label>
			</div>	
			</div>   
	
        </div>
				</div>
			
    </div>
	
        </div>
        <div class="uk-modal-footer uk-text-right">
			
            <button onclick="closeEdit()" class="uk-button uk-button-default" type="button">Cancelar</button>
            <button onclick="saveData('1')" class="uk-button uk-button-primary" type="button"><strong>Guardar extra <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
        </div>
			</form>
		<?php }?>
    </div>
</div>
<script type="text/javascript">
$('#addNew').click(function(){
        $(".newAssign1").append('<input class="uk-input " type="text" placeholder="-No asignado-" name="extraOptions[]" style="margin-top:10px;">');
		 $(".newAssign2").append('<input class="uk-input" type="text" placeholder="-No asignado-" name="extraOptionsEN[]" style="margin-top:10px;">');
		 $(".newAssign3").append('<input class="uk-input" type="text" placeholder="-No asignado-" name="extraOptionsDE[]" style="margin-top:10px;">');
    });
</script>	
<script type="text/javascript">
function saveData(param) {
	if (confirm("¿Confirma que desea guardar el extra/equipamiento?")) {
             
            
			$.ajax({
                url: '<?php echo DIR;?>extras/manageextra', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'json', // data type
                data : $("#extraform").serialize(), // post data || get data
                success : function(result) {
                   UIkit.modal.dialog(result['messageERROR']);
				   reloadExtras();
					
                 
                },
                error: function(xhr, resp, text,result) {
                   UIkit.modal.dialog(result['messageERROR']);
					
                } 
				
			});
} else {}}
function closeEdit() {
	if (confirm("¿Quiere cerrar sin guardar? Se perderán todos los cambios.")) {
		UIkit.modal("#editextras").hide();
} else {}}	
        $(document).ready(function () {
			$('.simple').SumoSelect();
        });
    </script>
