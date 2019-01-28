<?php
require '../includes/config2.php';
include '../includes/ImageResize.php';
$exists = array();
if (isset($_FILES['files']) && !empty($_FILES['files'])) {
    $no_files = count($_FILES["files"]['name']);
    for ($i = 0; $i < $no_files; $i++) {
        if ($_FILES["files"]["error"][$i] > 0) {
            
        } else {
            if (file_exists('../uploads-blog/' . $_FILES["files"]["name"][$i])) {
                array_push($exists, $_FILES["files"]["name"][$i]);
            } else {
				$filename = $_FILES['files']['name'][$i];
				$location = "../uploads-blog/".$filename;
                move_uploaded_file($_FILES["files"]["tmp_name"][$i], '../uploads-blog/' . $_FILES["files"]["name"][$i]);
//Generar thumbnails
$thumb1 = new \Gumlet\ImageResize($location);
$thumb1->resizeToWidth(300);
$thumb1->save("../uploads-blog/th_$filename");
$thumb2 = new \Gumlet\ImageResize($location);
$thumb2->resizeToWidth(800);
$thumb2->save("../uploads-blog/m_$filename");
$thumb3 = new \Gumlet\ImageResize($location);
$thumb3->resizeToWidth(1000);
$thumb3->save("../uploads-blog/lg_$filename");
?>
<li>

		<div class="image"><div class="uk-inline-clip uk-transition-toggle uk-light covergallery" tabindex="0"><?php echo '<img src="../uploads-blog/' . $_FILES["files"]["name"][$i] . '">';?><div class="uk-position-top-right" style="top:10px !important; right:10px !important">
                <span class="uk-transition-slide-top-small delete" uk-icon="icon: trash;" ></span>
            </div></div> <input type="text" class="uk-input" placeholder="Titulo de imagen"></div></div>
		
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
			$('.select-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultadao para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
});</script>
<?php
} else {
    
}?>
    
