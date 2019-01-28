<?php require('../includes/config2.php'); 



if(!$user->is_logged_in()){
 header('Location: ../login'); exit();
  } 
$data = date('Y-m-d');;
$hora =  date('H:i:s');
$IPPROXY = $_SERVER['REMOTE_ADDR'];
$IP = getIP();
$Nav = $_SERVER['HTTP_USER_AGENT'];
$accio="Login";
$observacions="Conectado";
$loging = "INSERT INTO logs (data, hora, usuari, ip_conexio, ip_proxy, navegador, accio, observacions) VALUES ('".$data."','".$hora."','".$_SESSION['username']."','".$IPPROXY."', '".$IP."', '".$Nav."','".$accio."','".$observacions."')";
//$db->exec($loging);
$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';
$activo="propiedades";
$activo2="";
require('../layout/header.php');
?>
<?php 
include('../layout/menu.php'); 
?>

<div class="container-fluid">	

<!-----------------------------------------------------------------TABS-->
	<div style="margin-top: 40px;">
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a style='color: black;' href="#activadas" aria-controls="activadas" role="tab" data-toggle="tab">Activadas</a></li>
		    <li role="presentation" ><a style='color: black;' href="#todas" aria-controls="todas" role="tab" data-toggle="tab">Todas</a></li>
		    <li role="presentation"><a style='color: black;' href="#desactivadas" aria-controls="desactivadas" role="tab" data-toggle="tab">Desactivadas</a></li>

		    <a href="<?php echo DIR;?>propiedades/propiedad" style='margin-left: 50px;'>
				<button  class="uk-button button-direct " style="background-color:#F9B233;color:#fff"><span uk-icon="icon:plus;"></span> Añadir propiedad</button>
			</a>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">

<!--------------------------------------------------------CASAS ACTIVADAS---------------->
		<div role="tabpanel" class="tab-pane active" id="activadas">


	<div class="row" style="margin-top: 10px; background-color: white;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 30px;">
			 <table id="example2" class="table table-hover bulk_action dt-responsive nowrap table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                	<th>Imagen</th>
                                    <th>Publicado</th>
                                    <th>Referencia</th>
                                    <th>Estado</th> 
                                    <th>Titulo / Nombre</th>
                                    <th>Tipo</th>
                                    <th>Propietario / Cliente</th>
                                    <th>Población</th>
                                    <th>Precio</th> 
                                    <th>Acciones</th>                                 
                                </tr>
                            </thead>
                            <tbody>
                          <!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<?php 
$stmt = $db->prepare("SELECT distinct properties.yourRef,properties.sellerID,properties.propTown,properties.propLocation,properties.propNameES,properties.propType,properties.propPrice,properties.ID,properties.active,image_properties.full as imagengrande,image_properties.small as imagenpequena,owners.sellerName1 as nombrevendedor FROM properties  LEFT JOIN owners ON properties.sellerID = owners.ID LEFT JOIN image_properties ON (image_properties.ref = properties.ID AND image_properties.orden = 1) WHERE properties.active = 1  ORDER BY ID desc limit 100 ");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while ($row = $stmt->fetch())
{// WHILE 1
$ref=$row['yourRef'];
$tipo = explode('|',$row['propType']);
$localizaciones = explode(':',$row['propLocation']);
$town=$row['propTown'];
$title2 = limpia($row['propNameES']);	
$location=$localizaciones;	
if (($location=="0") or ($location=" ")) {
	$location=strtolower($localizaciones[0]);
} else {
	$location=$location;

}

$location=ucwords($location);

$titulo_prop=strtolower($row['propNameES']);

if ($location=="0") {
	$location="<span style='font-style:italic'>-No asignado-</span>";
}

$precio = number_format((float)$row['propPrice'], 0, ',', '.');

if ($precio!="0") {
	$precio=$precio."€";
} else {
	$precio="<i>-No asignado-</i>";
}
 ?>                            	
<!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->   
<!--CUERPO DE LA PAGINA-->

<!--CODIGO PARA LOS COLORES-->
<tr >
<!--CODIGO PARA LOS COLORES-->


						            <td>
										<div uk-lightbox style="width:50px;height:50px; ">
													<a style='color: black;' <?php if ($row['imagengrande']=="") 
													{

														?> href="<?php echo DIR;?>images/nofoto.jpg"<?php

														 }else if ($row['imagengrande']!="")
														 {
														 	?> href="<?php echo $row['imagengrande']?>"
														 <?php 
														}?>
														data-caption="<button onclick=previewGallery('<?php echo $row['ID']?>') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
														<?php if ($row['imagenpequena']=="") 
														{
															?>
															<div style="background:url(<?php echo DIR;?>images/nofotosmall.jpg) no-repeat 50% 50%;height:100%; border-radius:50px"></div>
														<?php
														 }else if ($row['imagenpequena']!="")
														 {
														 	?>
														 	<div style="background:url(<?php echo $row['imagenpequena']?>) no-repeat 50% 50%;height:100%; border-radius:50px"></div>
														 <?php
														  }

																?>

														</a>
														<?php if($row['imagengrande']!="") {
														
															?>	
														<a href="<?php echo $row['imagengrande']?>" data-caption="<button onclick=previewGallery('<?php echo $row['ID']?>') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>"></a>
															
														<?php 
													
												}
												?>
													
											</div>

										</td>
										<td>
											<center>
												<?php if ($row['active']=='1'): ?>

														<a onclick="estado('<?php echo $row['ID']?>','<?php echo $row['active']?>')"><span uk-icon="icon:check;ratio: 2" class="black"></a></span>

													<?php else: ?>

														<a onclick="estado('<?php echo $row['ID']?>','<?php echo $row['active']?>')"><span uk-icon="icon:close;ratio: 2" class="black"></a></span>

												<?php endif ?>
											</center>
										</td>
										<td><a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" ><span style="font-weight:600"><?php echo $row['ID'] .'V'?></span></a></td>
										<td>Venta</td>
										<td><a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" class="uk-text-truncate"><?php echo $row['propNameES']?></a></td>
										<td>

											<?php 
												$tipo_de_casa=str_replace('_', ' ',$row['propType']);
											 ?>

											<a style='color: black;' href="" ><?php echo ucfirst($tipo_de_casa);?></a>

										</td>
										<td><a style='color: black;' href="" ><?php echo $row['nombrevendedor']?></a></td>
										<td><a style='color: black;'  href="" ><?php echo $location?></a></td>
										<td><?php echo $precio?></td>
										<td>
											<div class="uk-grid uk-grid-small">
													<a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>

													<a style='color: black;' href="<?php echo DIR;?>propiedades/editar?idventa=<?php echo $row['ID']?>"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>

													<a style='color: black;' onclick="previewGallery('<?php echo $row['ID']?>')"><span uk-icon="icon:image;ratio:1" uk-tooltip="Galería"></span></a>

													<a style='color: black;' href="http://www.villasplanet.com/es/venta-<?php echo $title2?>-ref-<?php echo $row['ID']?>" target="new" ><span uk-icon="icon:link;ratio:1" uk-tooltip="Ficha web"></span></a>

													<a style='color: black;' onclick="deletedata(<?php echo $row['ID']?>)"><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
											</div>
										</td>	
</tr>
<!--CUERPO DE LA PAGINA-->
<?php

}// WHILE 1
?>                             
                            </tbody>
                        </table>      
		</div>
	</div>

		    	



		    </div>

<!--------------------------------------------------------CASAS ACTIVADAS---------------->


<!----------------------------------------------------------------TODAS LAS CASAS---------------->
		    <div role="tabpanel" class="tab-pane" id="todas">
				<!--TABLA  TODAS-->

	<div class="row" style="margin-top: 10px; background-color: white;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 30px;">
			 <table id="example1" class="table table-hover bulk_action dt-responsive nowrap table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                	<th>Imagen</th>
                                    <th>Publicado</th>
                                    <th>Referencia</th>
                                    <th>Estado</th> 
                                    <th>Titulo / Nombre</th>
                                    <th>Tipo</th>
                                    <th>Propietario / Cliente</th>
                                    <th>Población</th>
                                    <th>Precio</th> 
                                    <th>Acciones</th>                                 
                                </tr>
                            </thead>
                            <tbody>
                          <!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<?php 
$stmt = $db->prepare("SELECT properties.yourRef,properties.sellerID,properties.propTown,properties.propLocation,properties.propNameES,properties.propType,properties.propPrice,properties.ID,properties.active,image_properties.full as imagengrande,image_properties.small as imagenpequena,owners.sellerName1 as nombrevendedor FROM properties  LEFT  JOIN owners ON properties.sellerID = owners.ID LEFT JOIN image_properties ON (image_properties.ref = properties.ID AND image_properties.orden = 1) /*WHERE properties.active = 1 */ ORDER BY ID desc limit 100 ");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while ($row = $stmt->fetch())
{// WHILE 1
$ref=$row['yourRef'];
$tipo = explode('|',$row['propType']);
$localizaciones = explode(':',$row['propLocation']);
$town=$row['propTown'];
$title2 = limpia($row['propNameES']);	
$location=$localizaciones;	
if (($location=="0") or ($location=" ")) {
	$location=strtolower($localizaciones[0]);
} else {
	$location=$location;

}

$location=ucwords($location);

$titulo_prop=strtolower($row['propNameES']);

if ($location=="0") {
	$location="<span style='font-style:italic'>-No asignado-</span>";
}

$precio = number_format((float)$row['propPrice'], 0, ',', '.');

if ($precio!="0") {
	$precio=$precio."€";
} else {
	$precio="<i>-No asignado-</i>";
}
 ?>                            	
<!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->   
<!--CUERPO DE LA PAGINA-->

<!--CODIGO PARA LOS COLORES-->
<tr>

<!--CODIGO PARA LOS COLORES-->


						            <td>
										<div uk-lightbox style="width:50px;height:50px; ">
													<a style='color: black;' <?php if ($row['imagengrande']=="") 
													{

														?> href="<?php echo DIR;?>images/nofoto.jpg"<?php

														 }else if ($row['imagengrande']!="")
														 {
														 	?> href="<?php echo $row['imagengrande']?>"
														 <?php 
														}?>
														data-caption="<button onclick=previewGallery('<?php echo $row['ID']?>') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
														<?php if ($row['imagenpequena']=="") 
														{
															?>
															<div style="background:url(<?php echo DIR;?>images/nofotosmall.jpg) no-repeat 50% 50%;height:100%; border-radius:50px"></div>
														<?php
														 }else if ($row['imagenpequena']!="")
														 {
														 	?>
														 	<div style="background:url(<?php echo $row['imagenpequena']?>) no-repeat 50% 50%;height:100%; border-radius:50px"></div>
														 <?php
														  }

																?>

														</a>
														<?php if($row['imagengrande']!="") {
														
															?>	
														<a href="<?php echo $row['imagengrande']?>" data-caption="<button onclick=previewGallery('<?php echo $row['ID']?>') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>"></a>
															
														<?php 
													
												}
												?>
													
											</div>

										</td>
										<td>
											<center>
												<?php if ($row['active']=='1'): ?>

														<a onclick="estado('<?php echo $row['ID']?>','<?php echo $row['active']?>')"><span uk-icon="icon:check;ratio: 2" class="black"></a></span>

													<?php else: ?>

														<a onclick="estado('<?php echo $row['ID']?>','<?php echo $row['active']?>')"><span uk-icon="icon:close;ratio: 2" class="black"></a></span>

												<?php endif ?>
											</center>
										</td>
										<td><a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" ><span style="font-weight:600"><?php echo $row['ID'] .'V'?></span></a></td>
										<td>Venta</td>
										<td><a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" class="uk-text-truncate"><?php echo $row['propNameES']?></a></td>
										<td>
											<?php 
												$tipo_de_casa=str_replace('_', ' ',$row['propType']);
											 ?>

											<a style='color: black;' href="" ><?php echo ucfirst($tipo_de_casa);?></a>
										</td>
										<td><a style='color: black;' href="" ><?php echo $row['nombrevendedor']?></a></td>
										<td><a style='color: black;'  href="" ><?php echo $location?></a></td>
										<td><?php echo $precio?></td>
										<td>
											<div class="uk-grid uk-grid-small">
													<a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>

													<a style='color: black;' href="<?php echo DIR;?>propiedades/editar?idventa=<?php echo $row['ID']?>"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>

													<a style='color: black;' onclick="previewGallery('<?php echo $row['ID']?>')"><span uk-icon="icon:image;ratio:1" uk-tooltip="Galería"></span></a>

													<a style='color: black;' href="http://www.villasplanet.com/es/venta-<?php echo $title2?>-ref-<?php echo $row['ID']?>" target="new" ><span uk-icon="icon:link;ratio:1" uk-tooltip="Ficha web"></span></a>

													<a style='color: black;' onclick="deletedata(<?php echo $row['ID']?>)"><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
											</div>
										</td>	
</tr>
<!--CUERPO DE LA PAGINA-->
<?php

}// WHILE 1
?>                             
                            </tbody>
                        </table>      
		</div>
	</div>

<!--TABLA  TODAS-->
			</div>
<!----------------------------------------------------------------TODAS LAS CASAS---------------->


<!--------------------------------------------------------CASAS DESACTIVADAS---------------->
		    <div role="tabpanel" class="tab-pane" id="desactivadas">


	<div class="row" style="margin-top: 10px; background-color: white;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 30px;">
			 <table id="example3" class="table table-hover bulk_action dt-responsive nowrap " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                	<th>Imagen</th>
                                    <th>Publicado</th>
                                    <th>Referencia</th>
                                    <th>Estado</th> 
                                    <th>Titulo / Nombre</th>
                                    <th>Tipo</th>
                                    <th>Propietario / Cliente</th>
                                    <th>Población</th>
                                    <th>Precio</th> 
                                    <th>Acciones</th>                                 
                                </tr>
                            </thead>
                            <tbody>
                          <!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<?php 
$stmt = $db->prepare("SELECT properties.yourRef,properties.sellerID,properties.propTown,properties.propLocation,properties.propNameES,properties.propType,properties.propPrice,properties.ID,properties.active,image_properties.full as imagengrande,image_properties.small as imagenpequena,owners.sellerName1 as nombrevendedor FROM properties  LEFT  JOIN owners ON properties.sellerID = owners.ID LEFT  JOIN image_properties ON (image_properties.ref = properties.ID AND image_properties.orden = 1) WHERE properties.active = 0  ORDER BY ID desc limit 100 ");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while ($row = $stmt->fetch())
{// WHILE 1
$ref=$row['yourRef'];
$tipo = explode('|',$row['propType']);
$localizaciones = explode(':',$row['propLocation']);
$town=$row['propTown'];
$title2 = limpia($row['propNameES']);	
$location=$localizaciones;	
if (($location=="0") or ($location=" ")) {
	$location=strtolower($localizaciones[0]);
} else {
	$location=$location;

}

$location=ucwords($location);

$titulo_prop=strtolower($row['propNameES']);

if ($location=="0") {
	$location="<span style='font-style:italic'>-No asignado-</span>";
}

$precio = number_format((float)$row['propPrice'], 0, ',', '.');

if ($precio!="0") {
	$precio=$precio."€";
} else {
	$precio="<i>-No asignado-</i>";
}
 ?>                            	
<!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->   
<!--CUERPO DE LA PAGINA-->

<!--CODIGO PARA LOS COLORES-->
<tr style="background-color: #ffb3b3;">

<!--CODIGO PARA LOS COLORES-->


						            <td>
										<div uk-lightbox style="width:50px;height:50px; ">
													<a style='color: black;' <?php if ($row['imagengrande']=="") 
													{

														?> href="<?php echo DIR;?>images/nofoto.jpg"<?php

														 }else if ($row['imagengrande']!="")
														 {
														 	?> href="<?php echo $row['imagengrande']?>"
														 <?php 
														}?>
														data-caption="<button onclick=previewGallery_nuevo('<?php echo $row['ID']?>') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
														<?php if ($row['imagenpequena']=="") 
														{
															?>
															<div style="background:url(<?php echo DIR;?>images/nofotosmall.jpg) no-repeat 50% 50%;height:100%; border-radius:50px"></div>
														<?php
														 }else if ($row['imagenpequena']!="")
														 {
														 	?>
														 	<div style="background:url(<?php echo $row['imagenpequena']?>) no-repeat 50% 50%;height:100%; border-radius:50px"></div>
														 <?php
														  }

																?>

														</a>
														<?php if($row['imagengrande']!="") {
														
															?>	
														<a href="<?php echo $row['imagengrande']?>" data-caption="<button onclick=previewGallery_nuevo('<?php echo $row['ID']?>') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>"></a>
															
														<?php 
													
												}
												?>
													
											</div>

										</td>
										<td>
											<center>
												<?php if ($row['active']=='1'): ?>

														<a onclick="estado('<?php echo $row['ID']?>','<?php echo $row['active']?>')"><span uk-icon="icon:check;ratio: 2" class="black"></a></span>

													<?php else: ?>

														<a onclick="estado('<?php echo $row['ID']?>','<?php echo $row['active']?>')"><span uk-icon="icon:close;ratio: 2" class="black"></a></span>

												<?php endif ?>
											</center>
										</td>
										<td><a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" ><span style="font-weight:600"><?php echo $row['ID'] .'V'?></span></a></td>
										<td>Venta</td>
										<td><a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" class="uk-text-truncate"><?php echo $row['propNameES']?></a></td>
										<td>
											<?php 
												$tipo_de_casa=str_replace('_', ' ',$row['propType']);
											 ?>

											<a style='color: black;' href="" ><?php echo ucfirst($tipo_de_casa);?></a>
										</td>
										<td><a style='color: black;' href="" ><?php echo $row['nombrevendedor']?></a></td>
										<td><a style='color: black;'  href="" ><?php echo $location?></a></td>
										<td><?php echo $precio?></td>
										<td>
											<div class="uk-grid uk-grid-small">
													<a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>

													<a style='color: black;' href="<?php echo DIR;?>propiedades/editar?idventa=<?php echo $row['ID']?>"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>

													<a style='color: black;' onclick="previewGallery('<?php echo $row['ID']?>')"><span uk-icon="icon:image;ratio:1" uk-tooltip="Galería"></span></a>

													<a style='color: black;' href="http://www.villasplanet.com/es/venta-<?php echo $title2?>-ref-<?php echo $row['ID']?>" target="new" ><span uk-icon="icon:link;ratio:1" uk-tooltip="Ficha web"></span></a>

													<a style='color: black;' onclick="deletedata(<?php echo $row['ID']?>)"><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
											</div>
										</td>	
</tr>
<!--CUERPO DE LA PAGINA-->
<?php

}// WHILE 1
?>                             
                            </tbody>
                        </table>      
		</div>
	</div>

	

		    </div>
<!--------------------------------------------------------CASAS DESACTIVADAS---------------->

		  </div>
	</div>
<!-----------------------------------------------------------------TABS-->


</div>

<div id="preview-modal"></div>

<?php 
//include header template
require('../layout/footer.php'); 
?>
<?php include ("../layout/galeria-listados.php");?>
<script type="text/javascript">
function previewModal(param) {
		         $.ajax({
			type: "POST",
			url: "<?php echo DIR;?>propiedades/preview",
			data:'ref='+param,
					 beforeSend: function(){
		   $(".loader").show();
		  },
			success: function(data){
				$(".loader").fadeOut("slow");
				$("#preview-modal").html(data);
				
				
			}
			});   
        }
function previewGallery(param) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>propiedades/previewgallery",
	data:'refid='+param,
			 beforeSend: function(){
   $(".loader").show();
  },
	success: function(data){
		$(".loader").fadeOut("slow");
		UIkit.modal("#previewgallery").show();
		$("#previewgallery").html(data);
		$("select.select-gallery")[0].sumo.reload();
		
	}
	});   
        }
	
</script>
<script type="text/javascript">
        $(document).ready(function () {
          $('.search-box').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:true,noMatch: 'No hay resultados para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			$('.select-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultados para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			$('.simple').SumoSelect();
        });
	$(document).ready(function() {
	var s = $(".filters");
	var pos = s.position();					   
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		if (windowpos >= pos.top & windowpos >170) {
			s.addClass("stickbottom");
			s.addClass("uk-animation-slide-bottom-small");
			s.removelass("uk-animation-slide-top-small");
		} else {
			s.removeClass("stickbottom");
			s.removeClass("uk-animation-slide-bottom-small");
			s.addClass("uk-animation-slide-top-small");
		}
	});
});


 UIkit.upload('.js-upload');



	function deletedata($id) {
	var id = $id;
	UIkit.modal.confirm('¿Confirma que desea eliminar la venta?', { center:true, labels: { ok: 'Ok', cancel: 'Volver a Ventas' } }).then(function() {
  
			$.ajax({
                url: '<?php echo DIR;?>propiedades/deleteventa?idventa=' + id, // url where to submit the request               
                success : function(result) {
                   location.reload();
                   
                },
                error: function(xhr, resp, text,error) {
                     UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> <strong>Ha habido un error al eliminar. Inténtelo de nuevo.</strong>', status: 'danger', timeout:2000})
					alert(error);
                } 
				
			});
}, function () {
   
});
	
}  

function estado($id,$active)
{	
	var id = $id;
	var active = Number($active);
	if (active==1) {
		var activacion = 0;
	}else{
		var activacion = 1;
	}

	  $.ajax({
			url: "<?php echo DIR;?>propiedades/activar?idventa=" + id + "&active=" + activacion,
				beforeSend: function(){
		  				 $(".loader").show();
		 		 },
			success: function(data){
				location.reload();
				$(".loader").fadeOut("slow");			
				
			}
			});   
}
	
   
	
    </script>

</body>
</html>