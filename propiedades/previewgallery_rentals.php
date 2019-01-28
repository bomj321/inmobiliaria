<?php
require('../includes/config2.php');
$refid=$_POST["refid"];
$divid=$_POST["divid"];

/*SQL PARA SACAR EL yourRef*/
$stmt = $db->prepare("SELECT * FROM rentals WHERE ID='$refid'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
$ref_ok =  $row['yourRef'];

/*SQL PARA SACAR EL yourRef*/

?>
	<script type="text/javascript">
             $(document).ready(function(){

            $("#multiFiles").change(function(e){
                    var form_data = new FormData();
                    var ins = document.getElementById('multiFiles').files.length;
                    for (var x = 0; x < ins; x++) {
                        form_data.append("files[]", document.getElementById('multiFiles').files[x]);

                    }
				     form_data.append('refid', '<?php echo $refid?>');
                    $.ajax({
                        url: '<?php echo DIR;?>propiedades/uploads_rentals',
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
						beforeSend: function(){
   $('#loading-indicator').show();
  },
                        success: function (response) {
							$('#loading-indicator').hide();
                            $('#sortable1').append(response);

							 $('#modclose').html('<a onclick="manageGallery(\'cancelar\')"><button   class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button></a>');
							$('#modclose2').html('<a onclick="manageGallery(\'cancelar\')"><button class="uk-modal-close-default" type="button" uk-close></button></a>');


                        },
                        error: function (response) {
                            $('#sortable1').html(response);


                        }
                    });
                });
            });
        </script>
    <div class="uk-modal-dialog uk-margin-auto-vertical">
       <span id="modclose2"> <button class="uk-modal-close-default" type="button" uk-close></button></span>
        <div class="uk-modal-header">
			<div class="uk-grid">
				<div class="uk-width-1-1">
			<h5 class="uk-modal-title "><span uk-icon="icon:image;ratio:1.2;" class="icon-margin"></span> Editar galería de imagenes de la propiedad: <strong class="yellow"><?php echo $ref_ok?></strong></h5>
				</div>

			</div>
        </div>
<?php $stmt6 = $db->prepare("SELECT * FROM image_properties_rentals where ref='$refid' order by orden asc");
$stmt6->setFetchMode(PDO::FETCH_ASSOC);
$stmt6->execute();?>
        <div class="uk-modal-body">
		<form id="captionform" method="post">
           <ul id="sortable1" class="uk-grid-small uk-child-width-1-2 uk-child-width-1-9@s uk-text-center uk-sortable uk-grid" uk-sortable="handle: .uk-card" uk-grid="">
<?php

while ($row6 = $stmt6->fetch()){?>
<?php $ordenar=$row6['orden']?>
<?php $idimagen=$row6['id'] ?>

   <li id="<?php echo $row6['orden']?>" value="<?php echo $row6['id'];?>">

		<div class="image uk-card"><div class="uk-inline-clip uk-transition-toggle uk-light covergallery" tabindex="0"><img src="<?php echo $row6['small']?>"><div class="uk-position-top-right" style="top:10px !important; right:10px !important">
                <span class="uk-transition-slide-top-small delete" uk-icon="icon: trash;" onclick="deleteimg(<?php echo $ordenar?>,<?php echo $idimagen?>)" ></span>
            </div></div> <select placeholder="-Seleccionar-" onchange=""  class="select-gallery form-control" name="<?php echo $row6['id'];?>">

			<?php if ((($row6['caption'])=="nocaption") or (($row6['caption'])=="")) {?>
			<option  value="nocaption"><i>-No asignado -</i></option> <?php } ?>
			<option  value="otros" <?php if ((($row6['caption'])!="salon") or (($row6['caption'])!="salon-comedor") or (($row6['caption'])!="cocina") or (($row6['caption'])!="habitacion") or (($row6['caption'])!="banos") or (($row6['caption'])!="comedor") or (($row6['caption'])!="terraza") or (($row6['caption'])!="jardin") or (($row6['caption'])!="piscina") or (($row6['caption'])!="hall") or (($row6['caption'])!="distribuidor") or (($row6['caption'])!="exteriores") or (($row6['caption'])!="detalles") or (($row6['caption'])!="vistas") or (($row6['caption'])!="fachada") or (($row6['caption'])!="lavanderia") or (($row6['caption'])!="plano") or (($row6['caption'])!="dormitorios") or (($row6['caption'])!="terrazas")) {?>selected<?php }?>>Otros</option>
			<option  value="salon" <?php if (($row6['caption'])=="salon") {?>selected<?php }?>>Salón</option>
		     <option  value="salon" <?php if (($row6['caption'])=="salon-comedor") {?>selected<?php }?>>Salón comedor</option>
			<option  value="cocina" <?php if (($row6['caption'])=="cocina") {?>selected<?php }?>>Cocina</option>
			<option  value="habitacion" <?php if ((($row6['caption'])=="habitacion") or (($row6['caption'])=="dormitorios") ) {?>selected<?php }?>>Habitación</option>
			<option  value="banos" <?php if (($row6['caption'])=="banos") {?>selected<?php }?>>Baño</option>
			<option  value="comedor" <?php if (($row6['caption'])=="comedor") {?>selected<?php }?>>Comedor</option>
			<option  value="terraza" <?php if ((($row6['caption'])=="terraza")  or (($row6['caption'])=="terrazas") ) {?>selected<?php }?>>Terraza</option>
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
		<?php }?>

<?php $lastorden=$ordenar?>
</ul>
			</form>			<div class="uk-width-1-1 uk-text-center">
	<div uk-spinner="ratio: 2" id="loading-indicator" class="loading" style="display:none"></div>
			</div>


	<input id="output" class="uk-input" hidden type="text">
	<input id="output2" class="uk-input" hidden type="text">
	<p><tt id="results"></tt></p>


				<div class="js-upload uk-placeholder uk-text-center">
   <p id="demo"></p>
    <div uk-form-custom>
        <input id="multiFiles" name="files[]" type="file" multiple="multiple">
        <button class="uk-button uk-link uk-margin-left uk-margin-small-top"> <span uk-icon="icon: cloud-upload; ratio:1.3"></span> Añadir imágenes</button>
    </div>
</div>
        </div>
        <div class="uk-modal-footer uk-text-right">
			<span id="modclose">
            <button   class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button></span>
            <a onclick="manageGallery2('guardar')"><button class="uk-button uk-button-primary" type="button"><strong>Guardar galería <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button></a>
        </div>
    </div>
<script type="text/javascript">
$(document).ready(function() {

	UIkit.util.on('#sortable1', 'moved', function () {
		var children 	= this.children;
		var num  		= this.children.length;
		var order		= [ ];
		var reference		= [ ];

		for (var i = 0; i < num; i++) {
			order.push(children[i].id);
			reference.push(children[i].value);
		}
		document.getElementById('output').value = (order);
		document.getElementById('output2').value = (reference);


	});
});
 UIkit.upload('.js-upload');
function deleteimg(orden2,idimagen) {
    var ref1='<?php echo $refid?>';
    var divid='<?php echo $divid?>';
	 var img='imagen';
	if (confirm("¿Quiere eliminar esta imagen?")) {

    $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>propiedades/deleteimg_rentals",
	data:'orden='+orden2 +'&ref='+ref1 +'&tipo='+img+'&refid='+idimagen,
			 beforeSend: function(){
             $("#loading-indicator").show();
  },
	success: function(data){
		$("#loading-indicator").fadeOut("slow");
	    previewGallery(ref1,divid);
	    $( "#<?php echo $divid; ?>" ).load(" #<?php echo $divid; ?>");
	}
	});
    } else {

    }

        }
function manageGallery(param3) {
	var orden1='<?php echo $lastorden?>';
	var ref='<?php echo $refid;?>';
	if (confirm("¿Quiere cerrar sin guardar? Se perderán todos los cambios.")) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>propiedades/managegallery_rentals",
	data:'orden1='+orden1 +'&ref='+ref +'&tipo='+param3,
	beforeSend: function(){

  },
	success: function(data){

	}
	});  } else {

    }
        }
function manageGallery2(param3) {
	var x = $("form").serializeArray();
	var ordenselect		= [ ];
	var captionselect		= [ ];
        $.each(x, function(i, field){

			ordenselect.push(field.name);
			captionselect.push(field.value);
        });
	var orden1='<?php echo $lastorden?>';
	var ref='<?php echo $refid;?>';
	var ordengallery =document.getElementById('output').value;
	var ordenid =document.getElementById('output2').value;
	if (confirm("¿Guardar la galería con todos los cambios realizados? ")) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>propiedades/managegallery_rentals",
	data:'orden1='+orden1 +'&ref='+ref +'&tipo='+param3 +'&ordengallery='+ordengallery +'&ordenid='+ordenid +'&ordenselect='+ordenselect +'&captionselect='+captionselect,
	beforeSend: function(){

  },
	success: function(data){

		UIkit.modal("#previewgallery").hide();
	    $( "#<?php echo $divid; ?>" ).load(" #<?php echo $divid; ?>");
		UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> <strong>Galería guardada con éxito</strong>', status: 'success', timeout:2000})
	}
	});


	} else {

    }

        }
</script>

<!--<script type="text/javascript">
        $(document).ready(function () {
			$('.select-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultados para "{0}"',captionFormat:'{0} Seleccionados',
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
});</script>-->


<!--script para cargar delete option-->
