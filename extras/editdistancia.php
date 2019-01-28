<?php 
require('../includes/config2.php'); 
$ref=$_POST["id"];

?>    
<div class="uk-modal-dialog uk-margin-auto-vertical" style="width:70%;">
        <button class="uk-modal-close-default" onclick="closeEdit3()" type="button" uk-close></button>
        <div class="uk-modal-header">
			<div class="uk-grid">
				<div class="uk-width-1-1">
			<h5 class="uk-modal-title "><span uk-icon="icon:tag;ratio:1;" class="icon-margin"></span> Crear nueva distancia/entorno</h5>
				</div>
				
			</div>
        </div>
        <div class="uk-modal-body">
		<form class="uk-form-stacked" id="distanciaform">	
			<?php $stmt22 = $db->prepare("SELECT * FROM distancias_properties where id='$ref'");
$stmt22->setFetchMode(PDO::FETCH_ASSOC);
$stmt22->execute();
while ($row22 = $stmt22->fetch()){	
$tipoprop=explode(',',$row22['distanciaTipoProp']);	

			?>
			<input type="text" hidden name="id" value="<?php echo $ref?>">
		<input type="text" hidden name="accion" value="edit">
		<div class="uk-grid uk-grid-medium">
        <div class="uk-width-1-3" style="margin-top:10px">
        <label class="uk-form-label" for="form-stacked-text">Nombre </label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder=""  name="distanciaNombre"  value="<?php echo $row22['distanciaNombre']?>">
        </div>
		</div>
			
			<div class="uk-width-1-3" style="margin-top:10px">
        <label class="uk-form-label" for="form-stacked-text"><img src="<?php echo DIR;?>images/uk-flag.png">&nbsp; Nombre inglés </label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder=""  name="distanciaNombreEN" value="<?php echo $row22['distanciaNombreEN']?>">
        </div>
		</div>
			<div class="uk-width-1-3" style="margin-top:10px">
        <label class="uk-form-label" for="form-stacked-text"><img src="<?php echo DIR;?>images/deustche-flag.png">&nbsp; Nombre alemán </label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder=""  name="distanciaNombreDE"  value="<?php echo $row22['distanciaNombreDE']?>">
        </div>
		</div>
	<div class="uk-width-1-1" style="margin-top:10px">
				<h5><strong>¿A qué tipo de propiedad pertenece?</strong></h5>
					<div class=" uk-grid-medium uk-child-width-auto uk-grid">	
            <label style="cursor:pointer"><input class="uk-checkbox" name="distanciaTipoProp[]" type="checkbox" <?php if (($tipoprop[0]=="Venta") or ($tipoprop[1]=="Venta") or ($tipoprop[2]=="Venta") or ($tipoprop[3]=="Venta")){ echo "checked";}?> value="Venta">&nbsp; Venta</label>
			 <label style="cursor:pointer"><input class="uk-checkbox" name="distanciaTipoProp[]" type="checkbox" <?php if (($tipoprop[0]=="Vacacional") or ($tipoprop[1]=="Vacacional") or ($tipoprop[2]=="Vacacional") or ($tipoprop[3]=="Vacacional")){ echo "checked";}?> value="Vacacional">&nbsp; Alquiler vacacional</label>
			 <label style="cursor:pointer"><input class="uk-checkbox" name="distanciaTipoProp[]" type="checkbox" <?php if (($tipoprop[0]=="Anual") or ($tipoprop[1]=="Anual") or ($tipoprop[2]=="Anual") or ($tipoprop[3]=="Anual")){ echo "checked";}?> value="Anual">&nbsp; Alquiler anual</label>
			 <label style="cursor:pointer;"><input class="uk-checkbox" name="distanciaTipoProp[]" type="checkbox" <?php if (($tipoprop[0]=="Temporal") or ($tipoprop[1]=="Temporal") or ($tipoprop[2]=="Temporal") or ($tipoprop[3]=="Temporal")){ echo "checked";}?> value="Temporal">&nbsp; Alquiler temporal</label>

        </div>
				</div>
		
		<div class="uk-width-1-1 uk-margin-top">
		<div class="uk-grid">
		
		
		<div class="uk-width-1-1 uk-margin-top">
		<hr class="uk-article-divider">
					<div class=" uk-grid-medium uk-child-width-auto uk-grid ">
            <label style="cursor:pointer"><input class="uk-checkbox" name="distanciaActivo" type="checkbox" <?php if ($row22['distanciaActivo']=="si"){ echo "checked";}?> value="si">&nbsp; ¿Activar distancia/entorno?</label>
			</div>	
			</div>   
	
        </div>
				</div>
			
    </div>
	
        </div>
        <div class="uk-modal-footer uk-text-right">
			
            <button onclick="closeEdit3()" class="uk-button uk-button-default" type="button">Cancelar</button>
            <button onclick="saveData3('1')" class="uk-button uk-button-primary" type="button"><strong>Guardar distancia <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
        </div>
			<?php }?>
			</form>
    </div>
<script type="text/javascript">
function saveData3(param) {
	if (confirm("¿Confirma que desea guardar la nueva distancia/entorno?")) {
             
            
			$.ajax({
                url: '<?php echo DIR;?>extras/managezona', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'json', // data type
                data : $("#distanciaform").serialize(), // post data || get data
                success : function(result) {
                   UIkit.modal.dialog(result['messageERROR']);
				   reloadDistancias();
					
                 
                },
                error: function(xhr, resp, text,result) {
                   UIkit.modal.dialog(result['messageERROR']);
					
                } 
				
			});
} else {}}
function closeEdit3() {
	if (confirm("¿Quiere cerrar sin guardar? Se perderán todos los cambios.")) {
		UIkit.modal("#editdistancias").hide();
} else {

}}	
        $(document).ready(function () {
			$('.simple').SumoSelect();
        });
    </script>

<script type="text/javascript">
        $(document).ready(function () {
        
			$('.simple').SumoSelect();
        });
	
    </script>
