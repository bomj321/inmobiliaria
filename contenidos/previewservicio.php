<?php 
require('../includes/config2.php'); 
//$ref=$_POST["id"];
$idservice=$_POST['id'];
$stmt = $db->prepare("SELECT distinct services.id_services,services.tit_es,services.seo_es,services.des_es,services.published,services.date_published,image_services.full as imagengrande,image_services.small as imagenpequena FROM services LEFT JOIN image_services ON (image_services.ref = services.id_services AND image_services.orden = 1) WHERE services.id_services = $idservice");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
?>

<script type="text/javascript">
UIkit.modal("#previewajax").show();
</script>
<div id="previewajax" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
        <div class="uk-grid-collapse uk-child-width-1-3@s uk-flex-top" uk-grid>
            <img style='height: 800px; border-radius: 50px;' src="../../services/<?php echo $row['imagengrande']; ?>" alt="">
            <div class="uk-padding-large uk-width-2-3">
				<div class="uk-grid">
					<div class="uk-width-1-3">
                   
					</div>
					
				</div>
				<h3 class="uk-margin-small-bottom orange uk-margin-top">Alquiler de barcos</h3>
				
				<h5 class="uk-margin-small-top uk-margin-small-bottom"> <?php if ($row['date_published']!="0"){?> <span class="green"><span uk-icon="icon:check; ratio:0.9"></span> Publicado</span> <?php }else{?> <span class="uk-icon-button uk-margin-small-right" uk-icon="ban"></span> No publicado <?php }?> </h5>	
				<hr class="uk-article-divider uk-margin-small-bottom">
				<div class=" uk-grid-medium uk-child-width-auto uk-grid ">
					 <h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Ref:</span> <?php echo $row['id_services'];?> </h5>	
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Fecha de publicación:</span> <?php echo $row['date_published']?> </h5>	
					</div>
				<h5 class="grey-titles uk-margin-top uk-margin-small-bottom"><strong><span uk-icon="icon:list; ratio:0.9" class="icon-margin"></span> Texto destacado</strong></h5> 
				<p class="uk-text-justify" style="line-height:1.7"><?php echo $row['tit_es']?></p>
					<h5 class="grey-titles uk-margin-top uk-margin-small-bottom"><strong><span uk-icon="icon:list; ratio:0.9" class="icon-margin"></span> Contenido</strong></h5> 
				<p class="uk-text-justify" style="line-height:1.7"><?php echo $row['des_es']?></p>
				
				

            </div>
        </div>
    </div>
</div>
<?php //U}
?>