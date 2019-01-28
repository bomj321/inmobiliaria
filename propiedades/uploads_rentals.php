<?php

require '../includes/config2.php';
include '../includes/ImageResize.php';
$exists = array();
$refid2=$_POST["refid"];
$stmt7 = $db->prepare("SELECT MAX(orden) as maxorden FROM image_properties_rentals where ref='$refid2'");
$stmt7->execute();
$row7 = $stmt7->fetch(PDO::FETCH_ASSOC);
$orden=$row7['maxorden'];
if (isset($_FILES['files']) && !empty($_FILES['files'])) {
    $no_files = count($_FILES["files"]['name']);
    for ($i = 0; $i < $no_files; $i++) {
        if ($_FILES["files"]["error"][$i] > 0) {
            
        } else {
            if (file_exists('../../uploads/' . $_FILES["files"]["name"][$i])) {
                array_push($exists, $_FILES["files"]["name"][$i]);
            } else {
                $filename = $_FILES['files']['name'][$i];
                $filename = limpiaimagen($filename);
                $location = "../../uploads/".$filename;
                move_uploaded_file($_FILES["files"]["tmp_name"][$i], '../../uploads/' . $filename);
//Generar thumbnails
$thumb1 = new \Gumlet\ImageResize($location);
$thumb1->resizeToWidth(300);
$thumb1->save("../../uploads/th_$filename");
$thumb2 = new \Gumlet\ImageResize($location);
$thumb2->resizeToWidth(800);
$thumb2->save("../../uploads/m_$filename");
$thumb3 = new \Gumlet\ImageResize($location);
$thumb3->resizeToWidth(1920);
$image18Plus = '../images/watermark.png';
$thumb3->addFilter(function ($imageDesc) use ($image18Plus) {
    $logo = imagecreatefrompng($image18Plus);
    $logo_width = imagesx($logo);
    $logo_height = imagesy($logo);
    $image_width = imagesx($imageDesc);
    $image_height = imagesy($imageDesc);
    $image_x = $image_width - $logo_width - 10;
    $image_y = $image_height - $logo_height - 10;
    imagecopy($imageDesc, $logo, $image_x, $image_y, 0, 0, $logo_width, $logo_height);
});             
$thumb3->save("../../uploads/lg_$filename");
$original="http://www.webstyledns.com/uploads/".$filename;
$full="http://www.webstyledns.com/uploads/lg_".$filename;
$medium="http://www.webstyledns.com/uploads/m_".$filename;
$small="http://www.webstyledns.com/uploads/th_".$filename;
$alt=$refid2."-".date('d-m-y');
$caption="";
$orden=$orden+1;
?>
<?php 
$imginsert = "INSERT INTO image_properties_rentals (ref,original,full,medium,small,alt,orden,caption) VALUES ('".$refid2."','".$filename."','".$full."','".$medium."','".$small."','".$alt."','".$orden."','".$caption."')";
$db->exec($imginsert);  
$stmt77 = $db->prepare("SELECT id FROM image_properties_rentals where orden='$orden' and ref='$refid2'");
$stmt77->execute();
$row77 = $stmt77->fetch(PDO::FETCH_ASSOC);
?>
<li id="<?php echo $orden?>" value="<?php echo $row77['id'];?>">

        <div class="image uk-card"><div class="uk-inline-clip uk-transition-toggle uk-light covergallery" tabindex="0"><?php echo '<img src="../../uploads/' . $filename . '">';?><div class="uk-position-top-right" style="top:10px !important; right:10px !important">
            <span class="uk-transition-slide-top-small delete" uk-icon="icon: trash;" onclick="deleteimg(<?php echo $orden?>,<?php echo $row77['id'];?>)" ></span>
            </div></div> <select placeholder="-Seleccionar-"  class="select-gallery" name="<?php echo $row77['id'];?>">
            <option  value="nocaption"><i>-No asignado -</i></option>
            <option  value="salon" <?php if (($row6['caption'])=="salon") {?>selected<?php }?>>Salón</option>
            <option  value="cocina" <?php if (($row6['caption'])=="cocina") {?>selected<?php }?>>Cocina</option>
            <option  value="habitacion" <?php if (($row6['caption'])=="habitacion") {?>selected<?php }?>>Habitación</option>
            <option  value="banos" <?php if (($row6['caption'])=="banos") {?>selected<?php }?>>Baños</option>
            <option  value="comedor" <?php if (($row6['caption'])=="comedor") {?>selected<?php }?>>Comedor</option>
            <option  value="terraza" <?php if (($row6['caption'])=="terraza") {?>selected<?php }?>>Terraza</option>
            <option  value="jardin" <?php if (($row6['caption'])=="jardin") {?>selected<?php }?>>Jardín</option>
            <option  value="piscina" <?php if (($row6['caption'])=="piscina") {?>selected<?php }?>>Piscina</option>
            <option  value="hall" <?php if (($row6['caption'])=="hall") {?>selected<?php }?>>Hall</option>
            <option  value="distribuidor" <?php if (($row6['caption'])=="distribuidor") {?>selected<?php }?>>Distribuidor</option>
            <option value="exteriores" <?php if (($row6['caption'])=="exteriores") {?>selected<?php }?>>Exteriores</option>
            <option  value="detalles" <?php if (($row6['caption'])=="detalles") {?>selected<?php }?>>Detalles</option>
            <option  value="vistas" <?php if (($row6['caption'])=="vistas") {?>selected<?php }?>>Vistas</option>
            <option  value="fachada" <?php if (($row6['caption'])=="fachada") {?>selected<?php }?>>Fachada</option>
            <option  value="lavanderia" <?php if (($row6['caption'])=="lavanderia") {?>selected<?php }?>>Lavandería</option>
            <option  value="plano" <?php if (($row6['caption'])=="plano") {?>selected<?php }?>>Plano</option>
    </select></div>
        
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
