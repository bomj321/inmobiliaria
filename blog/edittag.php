<?php 
require('../includes/config2.php'); 
$ref=$_POST["id"];
$zonas = $db->prepare("SELECT * FROM Etiquetas where Cod_equip='$ref'");
$zonas->setFetchMode(PDO::FETCH_ASSOC);
$zonas->execute();
while ($row3 = $zonas->fetch()){
$originalDate = $row3['fecha'];
$fecha = date("d-m-Y", strtotime($originalDate));
$id=$row3['CodiProp'];
$catES=$row3['Nombre'];
$title=$row3['Texto_destacado'];
$foto=$row3['Imagen_destacada'];
$active=$row3['Activo'];
$active2=$row3['Activo'];
$cat=$row3['Codeti_Codi'];
$cat2=$row3['Cod_equip'];
$descripcion=$row3['Descripcion'];
if ($active=="Si") {$active="<span uk-icon='icon:check;' class='green'></span>";} else {$active="<span uk-icon='icon:ban;' class='red'></span>";}
if ($title!="") {$title=$title;} else {$title="-No asignado-";}
if ($descripcion!="") {$descripcion=$descripcion;} else {$descripcion="-No asignado-";}	
$stmt8 = $db->prepare("SELECT Nombre FROM Etiquetas_idioma where Cod_equip='$cat2' and Codid='1'");
$stmt8->execute();
$row8 = $stmt8->fetch(PDO::FETCH_ASSOC);
$stmt7 = $db->prepare("SELECT Nombre FROM Etiquetas_idioma where Cod_equip='$cat2' and Codid='2'");
$stmt7->execute();
$row7 = $stmt7->fetch(PDO::FETCH_ASSOC);	
?>

<script type="text/javascript">
UIkit.modal("#edit-categoria").show();
</script>
<div id="edit-categoria" uk-modal>

    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
			<div class="uk-grid">
				<div class="uk-width-1-1">
			<h5 class="uk-modal-title "><span uk-icon="icon:tag;ratio:1;" class="icon-margin"></span> Editar categoría blog</h5>
				</div>
				
			</div>
        </div>
        <div class="uk-modal-body">
		<form class="uk-form-stacked"  action="">	
		<div class="uk-grid uk-grid-medium">
        <div class="uk-width-1-1">
        <label class="uk-form-label" for="form-stacked-text">Nombre </label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="" value="<?php echo $catES?>">
        </div>
		</div>
			
			<div class="uk-width-1-2" style="margin-top:10px">
        <label class="uk-form-label" for="form-stacked-text"><img src="<?php echo DIR;?>images/uk-flag.png">&nbsp; Nombre inglés </label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="" value="<?php echo $row8['Nombre']?>">
        </div>
		</div>
			<div class="uk-width-1-2" style="margin-top:10px">
        <label class="uk-form-label" for="form-stacked-text"><img src="<?php echo DIR;?>images/deustche-flag.png">&nbsp; Nombre alemán </label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="" value="<?php echo $row7['Nombre']?>">
        </div>
		</div>
		<div class="uk-width-1-2" style="margin-top:10px">
					<div class=" uk-grid-medium uk-child-width-auto uk-grid margin-forms">
            <label style="cursor:pointer"><input class="uk-checkbox" type="checkbox" <?php if ($active2=="Si"){ echo "checked";}?>>&nbsp; ¿Activar categoría?</label>
			
            
	
        </div>
				</div>
    </div>
	
        </div>
        <div class="uk-modal-footer uk-text-right">
			
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <button class="uk-button uk-button-primary" type="button"><strong>Guardar categoría <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
        </div>
			</form>
    </div>
</div>
<?php }
?>