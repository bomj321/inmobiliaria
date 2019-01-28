<div id="nueva-distancia" uk-modal>
    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
			<div class="uk-grid">
				<div class="uk-width-1-1">
			<h5 class="uk-modal-title "><span uk-icon="icon:location;ratio:1;" class="icon-margin"></span> Creación rápida de nueva distancia</h5>
				</div>
				
			</div>
        </div>
        <div class="uk-modal-body">
		<form class="uk-form-stacked"  action="">	
		<div class="uk-grid uk-grid-medium">
        <div class="uk-width-1-1">
        <label class="uk-form-label" for="form-stacked-text">Nombre </label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="">
        </div>
		</div>
			
			<div class="uk-width-1-2" style="margin-top:10px">
        <label class="uk-form-label" for="form-stacked-text"><img src="<?php echo DIR;?>images/uk-flag.png">&nbsp; Nombre inglés </label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="">
        </div>
		</div>
			<div class="uk-width-1-2" style="margin-top:10px">
        <label class="uk-form-label" for="form-stacked-text"><img src="<?php echo DIR;?>images/deustche-flag.png">&nbsp; Nombre alemán </label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="">
        </div>
		</div>
		<div class="uk-width-1-1 uk-margin-top">
		<hr class="uk-article-divider">
	</div>
        <div class="uk-form-controls uk-margin-top">
         <div class="uk-grid">
			 <div class=" uk-grid-medium uk-child-width-auto uk-grid ">
            <label style="cursor:pointer; margin-top:5px;"><input class="uk-checkbox" type="checkbox">&nbsp; Agregar a <strong>venta</strong></label>
			<label style="cursor:pointer; margin-top:5px;"><input class="uk-checkbox" type="checkbox">&nbsp; Agregar a <strong>alquiler</strong></label>	
				<label style="cursor:pointer; margin-top:5px;"><input class="uk-checkbox" type="checkbox">&nbsp; Agregar a <strong>venta y alquiler</strong></label> 
			 </div></div></div>
    </div>
	
        </div>
        <div class="uk-modal-footer uk-text-right">
			<p class="uk-text-center" style="font-size:0.85rem" clas="icon-margin"><span uk-icon="icon:warning;"></span> No olvides completar los datos de la nueva distancia al finalizar la gestión de la propiedad</p>
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <button class="uk-button uk-button-primary" type="button"><strong>Guardar distancia <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
        </div>
			</form>
    </div>
</div>