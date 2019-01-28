<?php 
include('../includes/conexion_nueva_rental.php'); 
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
            <div class="uk-background-cover uk-width-1-3" style="background-image: url('<?php echo DIR;?>images/propiedad-slider.jpg');" uk-height-viewport></div>
            <div class="uk-padding-large uk-width-2-3">
				<div class="uk-grid">
					<div class="uk-width-1-3">
                   
					</div>
					<div class="uk-width-2-3">
                <div class="uk-grid uk-grid-medium" style="float:right;margin-top:4px; margin-right:10px;">
		<div class="uk-text-right"><button class="uk-button button-direct"><span uk-icon="icon:pencil; ratio:0.9" class="icon-margin"></span> Modificar reserva</button></div>
				
	</div>
					</div>
				</div>
				<h3 class="uk-margin-small-bottom orange uk-margin-top">Reserva generada: <strong>Ca Mado Pereta / 4413A</strong></h3>
				<div class=" uk-grid-medium uk-child-width-auto uk-grid ">
					<h5 class="uk-margin-small-top uk-margin-small-bottom"> <span class="orange">Estado:</span> <span class="green"><strong>Confirmada</strong></span></h5>	
				<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Fecha de reserva:</span> 22-06-2018</h5>
					<h5 class="uk-margin-small-top uk-margin-small-bottom"> <span class="orange">Tipo de reserva:</span> <span uk-icon="icon:world;ratio:0.95" class="icon-margin"></span> Reserva WEB</h5>	
				</div>
				
				
				<h5 class="grey-titles uk-margin-top uk-margin-small-bottom"><strong><span uk-icon="icon:info; ratio:0.9" class="icon-margin"></span> Datos de reserva</strong></h5> 
				<div class=" uk-grid-medium uk-child-width-auto uk-grid ">
					 <h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Localizador/ref:</span> 18210 </h5>	
					
					</div>
				<div class=" uk-grid-medium uk-child-width-auto uk-grid " style="margin-top:0">
					 <h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Fecha de entrada:</span> 28-08-2018</h5>	
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Fecha de salida:</span> 04-09-2018 </h5>
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Nº de noches:</span> 7 </h5></h5>	
					
					</div>
				<div class=" uk-grid-medium uk-child-width-auto uk-grid " style="margin-top:0">
					 <h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Nº adultos:</span> 1 </h5>	
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Nº niños:</span> - No asignado -</h5>	
					
					</div>
					<h5 class="grey-titles uk-margin-top uk-margin-small-bottom"><strong><span uk-icon="icon:user; ratio:0.9" class="icon-margin"></span> Datos cliente</strong></h5> 
				<div class=" uk-grid-medium uk-child-width-auto uk-grid ">
					 <h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Nombre:</span> Bernat Quetglas Jorda </h5>	
					 <h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">E-mail:</span> bernatxr@gmail.com</h5>	
					 <h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Télefono:</span> 610 530 250</h5>	
					</div>
				
				<h5 class="grey-titles uk-margin-top uk-margin-small-bottom"><strong><span uk-icon="icon:credit-card; ratio:0.9" class="icon-margin"></span> Información de precio y pagos</strong></h5> 
				<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Concepto</th>
            <th>Cantidad</th>
            <th>Precio total (IVA Incluido)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Alojamiento</td>
            <td>7 noches</td>
            <td>2.250 €</td>
        </tr>
		<tr>
            <td>Transporte</td>
            <td>2 días</td>
            <td>60€</td>
        </tr>
        
    </tbody>
</table>
<div class="uk-width-1-1">
<hr class="uk-article-divider">
</div>
					 <h3 class="uk-margin-small-top uk-margin-small-bottom"><strong><span class="orange">TOTAL:</span> 2.310 € </strong></h3>
					 <h4 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Pagado:</span> 1.150 € </h4>
			<h4 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Forma de pago:</span> Tarjeta de crédito</h4>
			        
					
					
            </div>
        </div>
    </div>
</div>
<?php //U}
?>