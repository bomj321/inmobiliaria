<?php

require '../includes/config2.php';
include '../includes/ImageResize.php';
$exists = array();
$ref2=$_POST["ref2"];
$stmt7 = $db->prepare("SELECT MAX(orden) as maxorden FROM image_zonas where ref='$ref2'");
$stmt7->execute();
$row7 = $stmt7->fetch(PDO::FETCH_ASSOC);
$orden=$row7['maxorden'];
if (empty($orden)) {$orden=0;}
if (isset($_FILES['files']) && !empty($_FILES['files'])) {
    $no_files = count($_FILES["files"]['name']);
    for ($i = 0; $i < $no_files; $i++) {
        if ($_FILES["files"]["error"][$i] > 0) {
            
        } else {
            if (file_exists('../uploads-zonas/' . $_FILES["files"]["name"][$i])) {
                array_push($exists, $_FILES["files"]["name"][$i]);
            } else {
				$filename = $_FILES['files']['name'][$i];
				$filename = limpiaimagen($filename);
				$location = "../uploads-zonas/".$filename;
                move_uploaded_file($_FILES["files"]["tmp_name"][$i], '../uploads-zonas/' . $filename);
//Generar thumbnails
$thumb1 = new \Gumlet\ImageResize($location);
$thumb1->resizeToWidth(300);
$thumb1->save("../uploads-zonas/th_$filename");
$thumb2 = new \Gumlet\ImageResize($location);
$thumb2->resizeToWidth(800);
$thumb2->save("../uploads-zonas/m_$filename");
$thumb3 = new \Gumlet\ImageResize($location);
$thumb3->resizeToWidth(1920);
$thumb3->save("../uploads-zonas/lg_$filename");
$original=DIR."uploads-zonas/".$filename;
$full=DIR."uploads-zonas/lg_".$filename;
$medium=DIR."uploads-zonas/m_".$filename;
$small=DIR."uploads-zonas/th_".$filename;
$alt=$ref2."-".date('d-m-y');
$caption="";
$orden=$orden+1;
?>
<?php 
$imginsert = "INSERT INTO image_zonas (ref,original,full,medium,small,alt,orden,caption) VALUES ('".$ref2."','".$filename."','".$full."','".$medium."','".$small."','".$alt."','".$orden."','".$caption."')";
$db->exec($imginsert);	
$stmt77 = $db->prepare("SELECT id FROM image_zonas where orden='$orden' and ref='$ref2'");
$stmt77->execute();
$row77 = $stmt77->fetch(PDO::FETCH_ASSOC);
?>
<li id="<?php echo $orden?>" value="<?php echo $row77['id'];?>">

		<div class="image uk-card"><div class="uk-inline-clip uk-transition-toggle uk-light covergallery" tabindex="0"><?php echo '<img src="../uploads-zonas/' . $filename . '">';?><div class="uk-position-top-right" style="top:10px !important; right:10px !important">
            <span class="uk-transition-slide-top-small delete" uk-icon="icon: trash;" onclick="deleteimg(<?php echo $orden?>)" ></span>
            </div></div> <input type="text" class="uk-input uk-text-center" placeholder="Titulo de imagen" name="<?php echo $row77['id'];?>"></div>
		
    </li>
                
            <?php }
        }
    } 

if(count($exists) > 0){?>
<script type="text/javascript">UIkit.modal('#error').show();</script>
<div id="error" class="uk-flex-top" uk-modal="stack:true" style="z-index:1000001">
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
		<div uk-alert class="uk-alert-danger uk-margin-top">
			<h5>Los siguientes archivos no se han subido porque ya existen:</h5>
</div>
<div class="uk-grid uk-grid-small">

		<?php
	foreach($exists as $pos=>$foto)
   {
        echo "<div class='uk-width-1-3'><strong>$foto</strong></div>"; }
?>
		</div>
    </div>
</div>

<?php	
}else{
	
}

?>

<script type="text/javascript">
        $(document).ready(function () {
			$('.select-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultados para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
});</script>
<?php
} else {
    
}?>    
