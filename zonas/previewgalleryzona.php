<?php 
require('../includes/config2.php'); 
$ref=$_POST["ref"];
$mostrar=$_POST["mostrar"];
?>
	<script type="text/javascript">
             $(document).ready(function(){

            $("#multiFiles").change(function(e){
				console.log('changed!');
                    var form_data = new FormData();
                    var ins = document.getElementById('multiFiles').files.length;
                    for (var x = 0; x < ins; x++) {
                        form_data.append("files[]", document.getElementById('multiFiles').files[x]);
						
                    }
				     form_data.append('ref2', '<?php echo $ref?>');
                    $.ajax({
                        url: '<?php echo DIR;?>zonas/uploads.php', 
                        dataType: 'text', 
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
						beforeSend: function(){
   $('.loader').show();
  },
                        success: function (response) {
							$('.loader').hide();
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
			<h5 class="uk-modal-title "><span uk-icon="icon:image;ratio:1.2;" class="icon-margin"></span> Editar galería de imagenes de la zona: <strong class="yellow"><?php 
				$stmt2 = $db->prepare("SELECT Town FROM sys_towns WHERE ID='$ref'");
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
				
				
				echo $row2['Town'];?></strong></h5>
				</div>
				
			</div>
        </div>
<?php $stmt6 = $db->prepare("SELECT * FROM image_zonas where ref='$ref' order by orden asc");
$stmt6->setFetchMode(PDO::FETCH_ASSOC);
$stmt6->execute();?>
        <div class="uk-modal-body">
		<form id="captionform" method="post">
           <ul id="sortable1" class="uk-grid-small uk-child-width-1-2 uk-child-width-1-9@s uk-text-center uk-sortable uk-grid" uk-sortable="handle: .uk-card" uk-grid="">
<?php 

while ($row6 = $stmt6->fetch()){?>
<?php $ordenar=$row6['orden']?>
   <li id="<?php echo $row6['orden']?>" value="<?php echo $row6['id'];?>">

		<div class="image uk-card"><div class="uk-inline-clip uk-transition-toggle uk-light covergallery" tabindex="0"><img src="<?php echo $row6['small']?>"><div class="uk-position-top-right" style="top:10px !important; right:10px !important">
                <span class="uk-transition-slide-top-small delete" uk-icon="icon: trash;" onclick="deleteimg(<?php echo $ordenar?>)" ></span>
            </div></div> <input type="text" class="uk-input uk-text-center" placeholder="Titulo de imagen" name="<?php echo $row6['id'];?>" <?php if ($row6['caption']!="") {?> value="<?php echo $row6['caption'];?>"<?php }?></div>
		
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
function deleteimg(orden2) {
    var ref1='<?php echo $ref?>';
	 var img='imagen';
	if (confirm("¿Quiere eliminar esta imagen?")) {
	
    $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>zonas/deleteimg.php",
	data:'orden='+orden2 +'&ref='+ref1 +'&tipo='+img,
			 beforeSend: function(){
             $("#loading-indicator").show();
  },
	success: function(data){
		$("#loading-indicator").fadeOut("slow");
	    previewGallery(ref1);
		<?php if ($mostrar=="si") {?> reloadGallery(ref1);<?php }?>
	}
	});      
    } else {
        
    }
  
        }
function manageGallery(param3) {
	var orden1='<?php echo $lastorden?>';
	var ref='<?php echo $ref;?>';
	if (confirm("¿Quiere cerrar sin guardar? Se perderán todos los cambios.")) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>zonas/managegallery.php",
	data:'orden1='+orden1 +'&ref='+ref +'&tipo='+param3,
	beforeSend: function(){
  
  },
	success: function(data){
	<?php if ($mostrar=="si") {?> reloadGallery(ref);<?php }?>	
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
	var ref='<?php echo $ref;?>';
	var ordengallery =document.getElementById('output').value;
	var ordenid =document.getElementById('output2').value;
	if (confirm("¿Guardar la galería con todos los cambios realizados? ")) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>zonas/managegallery.php",
	data:'orden1='+orden1 +'&ref='+ref +'&tipo='+param3 +'&ordengallery='+ordengallery +'&ordenid='+ordenid +'&ordenselect='+ordenselect +'&captionselect='+captionselect,
	beforeSend: function(){
  
  },
	success: function(data){
		
		UIkit.modal("#previewgalleryzona").hide();
		<?php if ($mostrar=="si") {?> reloadGallery(ref);<?php }?>
		//UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> <strong>Galería guardada con éxito</strong>', status: 'success', timeout:2000})
		
	}
	}); 
	
	
	} else {
        
    }
  
        }

</script>

<script type="text/javascript">
        $(document).ready(function () {
			$('.select-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultados para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
});</script>


<!--script para cargar delete option-->

