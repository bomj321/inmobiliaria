<div id="nueva-caracteristica" uk-modal>
    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
			<div class="uk-grid">
				<div class="uk-width-1-1">
			<h5 class="uk-modal-title "><span uk-icon="icon:cog;ratio:1;" class="icon-margin"></span> Creación rápida de nueva característica/equipamiento</h5>
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
		
    </div>
	
        </div>
        <div class="uk-modal-footer uk-text-right">
			<p class="uk-text-center" style="font-size:0.85rem" clas="icon-margin"><span uk-icon="icon:warning;"></span> No olvides completar los datos de la nueva característica al finalizar la gestión de la propiedad</p>
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <button class="uk-button uk-button-primary" type="button"><strong>Guardar característica <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
        </div>
			</form>
    </div>
</div>