<?php 
require('../includes/config2.php'); 
//$ref=$_POST["id"];
//$zonas = $db->prepare("SELECT * FROM Blog where CodiProp='$ref'");
//$zonas->setFetchMode(PDO::FETCH_ASSOC);
//$zonas->execute();
//while ($row3 = $zonas->fetch()){
//$originalDate = $row3['fecha'];
//$fecha = date("d-m-Y", strtotime($originalDate));
//$id=$row3['CodiProp'];
//$titlepost=$row3['Titulo'];
//$title=$row3['Texto_destacado'];
//$foto=$row3['Imagen_destacada'];
//$active=$row3['Activo'];
//$cat=$row3['Codeti_Codi'];
//$descripcion=$row3['Descripcion'];
//if ($active=="Si") {$active="<span uk-icon='icon:check;' class='green'></span>";} else {$active="<span uk-icon='icon:ban;' class='red'></span>";}
//if ($title!="") {$title=$title;} else {$title="-No asignado-";}
//if ($descripcion!="") {$descripcion=$descripcion;} else {$descripcion="-No asignado-";}	
//$stmt2 = $db->prepare("SELECT Nombre FROM Etiquetas where Cod_equip='$cat'");
//$stmt2->execute();
//$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
?>

<script type="text/javascript">
UIkit.modal("#previewajax").show();
</script>
<div id="previewajax" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
        <div class="uk-grid-collapse uk-child-width-1-3@s uk-flex-top" uk-grid>
            <div class="uk-background-cover uk-width-1-3" style="background-image: url('<?php echo DIR;?>images/boat-rental.jpg');" uk-height-viewport></div>
            <div class="uk-padding-large uk-width-2-3">
				<div class="uk-grid">
					<div class="uk-width-1-3">
                   
					</div>
					<div class="uk-width-2-3">
                <div class="uk-grid uk-grid-medium" style="float:right;margin-top:4px; margin-right:10px;">
		<div class="uk-text-right"><button class="uk-button button-direct"><span uk-icon="icon:pencil; ratio:0.9" class="icon-margin"></span> Editar noticia</button></div>
		<div class=" uk-text-right"><button uk-toggle="target: #galeria-listado" class="uk-button button-direct"><span uk-icon="icon:image; ratio:0.9" class="icon-margin"></span> Editar galería</button></div>		
	</div>
					</div>
				</div>
				<h3 class="uk-margin-small-bottom orange uk-margin-top">Alquiler de barcos</h3>
				
				<h5 class="uk-margin-small-top uk-margin-small-bottom"> <?php if ($row3['active']!="0"){?> <span class="green"><span uk-icon="icon:check; ratio:0.9"></span> Publicado</span> <?php }else{?> <span class="uk-icon-button uk-margin-small-right" uk-icon="ban"></span> No publicado <?php }?> </h5>	
				<hr class="uk-article-divider uk-margin-small-bottom">
				<div class=" uk-grid-medium uk-child-width-auto uk-grid ">
					 <h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Ref:</span> <?php echo $id;?> </h5>	
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Fecha de publicación:</span> <?php echo $fecha;?> </h5>	
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Categorías:</span> <?php echo $row2['Nombre'];?> </h5>	
					</div>
				<h5 class="grey-titles uk-margin-top uk-margin-small-bottom"><strong><span uk-icon="icon:list; ratio:0.9" class="icon-margin"></span> Texto destacado</strong></h5> 
				<p class="uk-text-justify" style="line-height:1.7"><?php echo $title?></p>
					<h5 class="grey-titles uk-margin-top uk-margin-small-bottom"><strong><span uk-icon="icon:list; ratio:0.9" class="icon-margin"></span> Contenido</strong></h5> 
				<p class="uk-text-justify" style="line-height:1.7"><?php echo $descripcion?></p>
				
				

            </div>
        </div>
    </div>
</div>
<?php //U}
?>