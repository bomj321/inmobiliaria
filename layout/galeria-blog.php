<script type="text/javascript">
		
             $(document).ready(function(e){

            $("#multiFiles").change(function(){
                    var form_data = new FormData();
                    var ins = document.getElementById('multiFiles').files.length;
                    for (var x = 0; x < ins; x++) {
                        form_data.append("files[]", document.getElementById('multiFiles').files[x]);
                    }
				
                    $.ajax({
                        url: '<?php echo DIR;?>blog/uploads-blog.php', 
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
                            $('#gallery').append(response); 
							
                        },
                        error: function (response) {
                            $('#gallery').html(response); 
                        }
                    });
                });
            });
        </script>
<div id="galeria-listado" class="uk-modal-container" uk-modal="stack:true;" style="z-index:100000">
    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
			<div class="uk-grid">
				<div class="uk-width-1-1">
			<h5 class="uk-modal-title "><span uk-icon="icon:image;ratio:1.2;" class="icon-margin"></span> Editar galería de imagenes de la noticia: <strong class="yellow"></strong></h5>
				</div>
				
			</div>
        </div>
        <div class="uk-modal-body">
           <ul id="gallery" class="uk-grid-medium uk-child-width-1-2 uk-child-width-1-9@s uk-text-center" uk-sortable="handle: .image" uk-grid>
   <li>

		<div class="image"><div class="uk-inline-clip uk-transition-toggle uk-light covergallery" tabindex="0"><img src="<?php echo DIR;?>images/nofoto.jpg"><div class="uk-position-top-right" style="top:10px !important; right:10px !important">
                <span class="uk-transition-slide-top-small delete" uk-icon="icon: trash;" ></span>
            </div></div> <input type="text" class="uk-input" placeholder="Titulo de imagen"></div>
		
			   </li>
			     
   
</ul>
			<div class="uk-width-1-1 uk-text-center">
	<div uk-spinner="ratio: 2" id="loading-indicator" class="loading" style="display:none"></div>	
			</div>
				<div class="js-upload uk-placeholder uk-text-center">
   
    
    <div uk-form-custom>
        <input id="multiFiles" name="files[]" type="file" multiple="multiple">
        <button class="uk-button uk-link uk-margin-left uk-margin-small-top"> <span uk-icon="icon: cloud-upload; ratio:1.3"></span> Añadir imágenes</button>
    </div>
</div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <button class="uk-button uk-button-primary" type="button"><strong>Guardar galería <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
        </div>
    </div>
</div>
<!--script para cargar delete option-->
