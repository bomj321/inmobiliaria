<script type="text/javascript" src="../ckeditor/ckeditor.js"> </script>
<?php require('../includes/config2.php'); 




if(!$user->is_logged_in()){ header('Location: ../login'); exit(); } 

/*$data = date('Y-m-d');;
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
$activo2="";*/
$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';

require('../layout/header.php');
?>
<!--SECCION PARA AGREGAR EDICION-->
<?php
$id=trim($_GET['yourRef']);
$stmt = $db->prepare("SELECT * FROM rentals WHERE yourRef='$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
?>
<!--SECCION PARA AGREGAR EDICION-->

<?php 
include('../layout/menu.php'); 
?>

<!-----------------------------------------CUERPO DE LA PAGINA-->
<button onclick="saveData('1')" class="uk-button uk-button-primary flotante" type="button">
    <strong>Editar y Publicar <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong>
</button>

<div class="container" style="background-color: white; margin-top: 50px;">
<form id="property">
	<!--ID DE LA VENTA -->
	<input type="hidden" name="id_venta" value="<?php echo $row['ID']; ?>"><!--ID DE LA VENTA -->
	<div class="row">
	<h3 class="yellow" style="font-weight:600; margin-top: 30px; margin-left: 30px;">
		<span uk-icon="icon:plus-circle" class="icon-margin3"></span> Editar Alquileres : <?php echo $row['propNameES'] ?>	
	</h3>
	</div>

	 <div class="row">
                <a style="margin-left: 30px;" type='button' class="btn btn-success" onclick="previewGallery('<?php echo $row['ID']?>','<?php echo "short".'1' ?>')">Gal. Fotos</a>
		        <a type='button' class="btn btn-primary" data-toggle="modal" data-target="#cliente_modal" onclick="datoscliente(<?php echo $row['SellerID']?>)">Datos del Propietario</a>
		        <a type='button' class="btn btn-danger" onclick="vercalendario(<?php echo $row['ID']?>)">Calendario</a>
		        <a type='button' class="btn btn-info" onclick="verperiodos(<?php echo $row['ID']?>)">Periodos</a>
		        <a type='button' href='imprimir_casas_alquileres.php?id=<?php echo $id ?>' target='_blank' class="btn btn-warning">v. Imprimir</a>
        </div>
<hr>
	<div class="row">

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Seleccionar tipo de inmueble</h5>
			<select placeholder="-Seleccionar-" name="tipoProp2" class="form-control">
				   <option >-Seleccionar-</option>

				   <option <?php echo $row['propType'] == 'Apartment' ? 'selected' : '' ?> value="Apartment">Pisos y apartamentos</option>

				   <option <?php echo $row['propType'] == 'Villa' ? 'selected' : '' ?>       value="Villa">Chalet y villas</option>

				   <option <?php echo $row['propType'] == 'Country house' ? 'selected' : '' ?>     value="Country house">Casas y fincas rústicas</option>

				   <option <?php echo $row['propType'] == 'Townhouse' ? 'selected' : '' ?> value="Townhouse">Casas de pueblo</option>

				   <option <?php echo $row['propType'] == 'Plot' ? 'selected' : '' ?>     value="Plot">Solares y parcelas</option>			   

	    </select>
		</div>


		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Estado del inmueble</h5>

			 <label style="cursor:pointer"><input name="active" class="uk-radio" type="checkbox"  <?php echo $row['active'] == 1 ? 'checked' : '' ?> value="1">&nbsp; Activo</label>

	            <label style="cursor:pointer"><input name="estado1" class="uk-radio" type="checkbox" <?php echo $row['propStatus'] == 'vendido' ? 'checked' : '' ?> value="vendido">&nbsp; Vendido</label>

				<label style="cursor:pointer"><input name="estado1" class="uk-radio" type="checkbox" <?php echo $row['propStatus'] == 'reservado' ? 'checked' : '' ?> value="reservado">&nbsp; Reservado </label>

				<label style="cursor:pointer"><input name="estado1" class="uk-radio" type="checkbox" <?php echo $row['propStatus'] == 'alquilado' ? 'checked' : '' ?> value="alquilado">&nbsp; Alquilado </label>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
			<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Propietario/Cliente</h5>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="loadowner">
			<select placeholder="-Seleccionar-" name="propietario" class="form-control box-gallery">			
				    <option>-Seleccionar-</option>
				   <?php 	
				   $clientes = $db->prepare("SELECT distinct(sellerName1),ID FROM owners /*where active='1'*/ order by sellerName1 Asc");
				   $clientes->setFetchMode(PDO::FETCH_ASSOC);
						$clientes->execute();
				while ($row2 = $clientes->fetch()){?>
					   <option <?php echo $row['SellerID'] == $row2['ID'] ? 'selected' : '' ?> value="<?php echo $row2['ID']?>"><?php echo $row2['sellerName1'];?></option>
					<?php  }?>			
          </select>
		</div>

		 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<button class="uk-button button-plus" uk-toggle="target: #nuevo-cliente"><span uk-icon="icon:plus; ratio:0.7;" class="icon-margin3"></span> Nuevo propietario</button>
			
  
		</div>

	</div>
<!-----------------------SECCION DEL MAPA-->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
			<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Localización del inmueble</h5>
		</div>
	</div>

	<div class="row">		
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-top: 20px;">		
			    <div class="form-group">
				      <label for="Población">Dirección/Población/Ciudad</label>
				      <input type="text" class="form-control"id="map-address" type="text" name="direccion"  value="<?php echo $row['propAddress'] == null ? 'Sin Direccion' : $row["propAddress"] ?>" placeholder="Introduzca la dirección  para completar los campos automáticamente...">
			    </div>			    

  			 <!-------------------------------SEPARAR LATITUD Y LONGITUD y OTROS-->
	<?php 
		$valores = $row['propLinkMap'];
	    $valor = explode(",", $valores);

	    $zonas =  $row['propLocation'];
	    $zona = explode(":", $zonas);
	 ?>
	<!-------------------------------SEPARAR LATITUD Y LONGITUD y OTROS-->


  			<div class="form-group">
		   	    <label for="map-city">Población</label>
			    <select placeholder="-Seleccionar población-" class="form-control box-gallery-poblaciones1" id="map-city" name="poblacion">
			      	<?php if($zona[0]!=null):?>
						<option value="<?php echo $zona[0] ?>"><?php echo $zona[0] ?></option>
           		    <?php endif;?>
			    </select>
  			</div>


  			<div class="form-row">
			    <div class="col">
			     <label for="Latitud">Latitud</label>
			      <input type="text" class="form-control"  value="<?php echo $valor[0] ?>" name="latitud" id="map-lat" placeholder="Latitud">
			    </div>
			    <div class="col">
			      <label for="Longitud">Longitud</label>
			      <input  value="<?php echo $valor[1] ?>" name="longitud" id="map-lon" type="text" class="form-control" placeholder="Longitud">
			    </div>
  			</div>


		    <div class="form-group">
		   	    <label for="load-poblaciones">Elegir zona (se utiliza para indicar el barrio, área exacta...) </label>
			    <select class="form-control box-gallery-poblaciones" name="zona" id="load-poblaciones">
			      	<?php if($zona[1]!=null):?>
						<option value="<?php echo $zona[1]?>"><?php echo $zona[1]?></option>
           		    <?php endif;?>
			    </select>
  			</div>  

  			<div class="form-group form-check">
						  <input class="form-check-input" <?php echo $row['mostrarDireccion'] == 'si' ? 'checked' : ''?> name="mostrarDireccion" value="si" type="checkbox" id='mostrarDireccion'  style="cursor:pointer">
						  <label class="form-check-label" for="mostrarDireccion" style="cursor:pointer">
						   ¿Mostrar la dirección exacta?
						  </label>
			</div>  

		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-top: 20px;">
			<div id="map" style="width: 100%; height: 290px;"></div>
			<p><span uk-icon="icon:info; ratio:0.9;" class="icon-margin3"></span> Puedes mover el marcador para seleccionar el punto concreto</p>
		</div>		
	</div>
<!-----------------------SECCION DEL MAPA-->
<!------------------------------SECCION DE DETALLES GENERALES-->	
<hr>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
			<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Datos generales de la propiedad</h5>
		</div>

	</div>

	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<div class="form-group">

			      <label for="refAlquiler">Referencia alquiler</label>
			      <input class="form-control" disabled type="text" value='<?php echo $row['yourRef']?>' >

			      <label for="precioVenta">Precio de Venta o Alquiler</label>
			      <input value='<?php echo $row['propPrice'] ?>' id="precioVenta" class="form-control" name="precioVenta" type="text">
  			</div>
		</div>

		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<p style="margin-top: 20px;"><strong><i uk-icon="icon:warning;"></i> La asignación de precios de la propiedad en alquiler vacacional se realizará una vez guardada la propiedad</strong></p>
		</div>
	</div>

<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="form-group">
						 <label for="rentalType">Tipo de Renta:</label>
						 <label id="rentalType" style="cursor:pointer"><input <?php echo $row['rentalType'] == 'short' ? 'checked' : '' ?> name="rentalType" class="uk-radio" type="radio" value="short">&nbsp; Corta</label>
				         <label id="rentalType" style="cursor:pointer"><input <?php echo $row['rentalType'] == 'long' ? 'checked' : '' ?> name="rentalType" class="uk-radio" type="radio" value="long">&nbsp; Larga</label>

 				</div>
				<div class="form-group">
					    <label for="propSleepsFrom">Dormir desde</label>
					    <input value='<?php echo $row['propSleepsFrom'] ?>' type="text" class="form-control" id="propSleepsFrom" name='propSleepsFrom' placeholder="Dormir desde...">
	 			 </div>

			    <div class="form-group">
				    <label for="propSleepsTo">Dormir hasta</label>
				    <input value='<?php echo $row['propSleepsTo'] ?>' type="text" class="form-control" id="propSleepsTo" name='propSleepsTo' placeholder="Dormir hasta...">
			    </div>	

			    <div class="form-group">
				    <label for="propETV ">ETV</label>
				    <select class="form-control" id="propETV" name="propETV">
					      <option <?php echo $row['propETV'] == 'Si' ? 'selected' : '' ?> value="Si">Si</option>
					      <option <?php echo $row['propETV'] == 'No' ? 'selected' : '' ?> value="No">No</option>
				    </select>
  				</div>

  				 <div class="form-group">
				    <label for="propETVnum">N&uacute;mero ETV</label>
				    <input value='<?php echo $row['propETVnum'] ?>' type="text" class="form-control" id="propETVnum" name='propETVnum' placeholder="N&uacute;mero ETV">
			    </div>	

			     <div class="form-group">
				    <label for="avantio">Avantio</label>
				    <input value='<?php echo $row['avantio'] ?>' type="text" class="form-control" id="avantio" name='avantio' placeholder="Avantio">
			    </div>			    
		</div>
	</div>	
<!------------------------------SECCION DE DETALLES GENERALES-->	
<hr>

<!----------------SECCION EDITOR ARREGLAR-->
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		 <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-fade">
			    <li>
			    	<a href="#"> <p class="grey3" style="margin:5px 0 5px 0;"><img src="../images/castellano-flag.png">&nbsp; Información general castellano</p></a>
			    </li>
			    <li>
			    	<a href="#"><p class="grey3" style="margin:5px 0 5px 0;"><img src="../images/uk-flag.png">&nbsp; Información general Inglés</p></a>
			    </li>
			    <li>
			    	<a href="#"><p class="grey3" style="margin:5px 0 5px 0;"><img src="../images/deustche-flag.png">&nbsp; Información general Alemán</p></a>
			    </li>
		</ul>

		<ul class="uk-switcher uk-margin">
			    <li> 
					<div class="uk-width-1-1 uk-margin-bottom">
					    <p class="grey3" style="margin:5px 0 10px 0;"> <strong>Título castellano</strong></p>
					    <input id="tituloES" class="uk-input" value="<?php echo $row['propNameES'] ?>" name="tituloES" type="text">
				    </div>
					 <p class="grey3 uk-margin-bottom" style="margin:5px 0 10px 0;"> <strong>Descripción castellano</strong></p>
					<textarea  id="editor1"  name="descripES" class="uk-width-1-1"><?php echo $row['propDescripES'] ?></textarea>
			            <script>		
			              CKEDITOR.replace( 'editor1', {
			   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });
			         </script>
			</li>


			    <li>
					<div class="uk-width-1-1 uk-margin-bottom">
						<p class="grey3" style="margin:5px 0 10px 0;"> <strong>Título inglés</strong></p>
						<input id="tituloEN" class="uk-input "value="<?php echo $row['propNameEN'] ?>"  name="tituloEN" type="text">
					</div>
					 <p class="grey3 uk-margin-bottom" style="margin:5px 0 10px 0;"> <strong>Descripción inglés</strong></p>
					<textarea id="editor2"  name="descripEN"  class="uk-width-1-1"><?php echo $row['propDescripEN'] ?></textarea>
					<script>		
				              CKEDITOR.replace( 'editor2', {
				   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });
		     	</script>

			    </li>

			    <li>
					<div class="uk-width-1-1 uk-margin-bottom">
						<p class="grey3" style="margin:5px 0 10px 0;"> <strong>Título alemán</strong></p>
						<input id="tituloDE" class="uk-input " value="<?php echo $row['propNameDE'] ?>" name="tituloDE" type="text">
					</div>
					 <p class="grey3 uk-margin-bottom" style="margin:5px 0 10px 0;"> <strong>Descripción alemán</strong></p>
					<textarea  id="editor3"  name="descripDE" class="uk-width-1-1"><?php echo $row['propDescripDE'] ?></textarea>

					<script>		
				              CKEDITOR.replace( 'editor3', {
				   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });
			      </script>
			     </li>
		</ul>
	</div>	
</div>
<!----------------SECCION EDITOR ARREGLAR-->

<!--------------------SECCION DETALLES NUEVO-->
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Medidas inmueble</h5>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-row">
			    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			     <label for="útil">Superficie útil</label>
			      <input class="form-control"  value="<?php echo $row['propHouseM2'] ?>" name="supUtil" type="text">
			    </div>
			    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			      <label for="terraza">Superficie terraza</label>
			      <input  class="form-control" value="<?php echo $row['propTerraceM2'] ?> "name="supTerraza" type="text">
			    </div>
			    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			      <label for="terreno">Superficie terreno</label>
			      <input  class="form-control" value="<?php echo $row['propLandM2'] ?>" name="supTerreno" type="text">
			    </div>
			    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			      <label for="total">Superficie total</label>
			      <input class="form-control" value="<?php echo $row['propTotalM2'] ?>" name="supTotal" type="text">
			    </div>
  			</div>	
	</div>
</div>

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px; margin-top: 20px;">Distribución</h5>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-row">
			    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			     <label for="útil">Nº de habitaciones sencillas</label>
			      <input class="form-control"  value="<?php echo $row['propBedSingle'] ?>" name="habSimple" type="text">
			    </div>
			    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			      <label for="terraza">Nº de habitaciones dobles</label>
			      <input  class="form-control" value="<?php echo $row['propBedDouble'] ?>" name="habDoble" type="text">
			    </div>
			    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			      <label for="terreno">Nº de baños</label>
			      <input  class="form-control" value="<?php echo $row['propBathroom'] ?>" name="banos" type="text">
			    </div>
			    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			      <label for="total">Nº de aseos</label>
			      <input class="form-control" value="<?php echo $row['propToilet'] ?>" name="aseos" type="text">
			    </div>
  			</div>	
	</div>
</div>
<!--------------------SECCION DETALLES NUEVO-->	
<hr>
<!------------------------SECCION DE CHECKBOX-->
	<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<div class="form-group form-check">
							  <input class="form-check-input" <?php echo $row['propFeatured'] == 'si' ? 'checked' : '' ?> name="destacada" value="si" type="checkbox" style="cursor:pointer" id='destacada'>
							  <label class="form-check-label" for="destacada" style="cursor:pointer">
							    ¿Propiedad <strong>destacada en portada</strong>?
							  </label>
						</div>  

					</div>

					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<div class="form-group form-check">
						  <input class="form-check-input" <?php echo $row['esLujo'] == 'si' ? 'checked' : '' ?> name="lujo" value="si" type="checkbox" style="cursor:pointer" id='lujo'>
						  <label class="form-check-label" for="lujo" style="cursor:pointer">
						    ¿Es una propiedad considerada de <strong>lujo</strong>?
						  </label>
						</div>  
					</div>

					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<div class="form-group form-check" >
						  <input class="form-check-input" <?php echo $row['esNueva'] == 'si' ? 'checked' : '' ?> name="nueva" value="si" type="checkbox" id='nueva'  style="cursor:pointer">
						  <label class="form-check-label" for="nueva" style="cursor:pointer">
						    ¿Es una propiedad considerada de <strong>obra nueva</strong>?
						  </label>
						</div>  
					</div>

					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<div class="form-group form-check">
						  <input class="form-check-input" <?php echo $row['slider'] == 'si' ? 'checked' : '' ?> name="portada" value="si" type="checkbox" id='portada'  style="cursor:pointer">
						  <label class="form-check-label" for="portada" style="cursor:pointer">
						   ¿Propiedad en<strong> slider  de portada</strong>?
						  </label>
						</div>  
					</div>  
	</div>
<!---------------------------SECCION DE CHECKBOX-->
<!--SECCION DE DETALLES DE LA PROPIEDAD-->
<hr>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
			<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Detalles de la propiedad</h5>
		</div>

	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><!--DIV DE COL MD 12...RESPONSIVE-->
			 <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-fade">
				<li>
					<a href="#"> <p class="grey3" style="margin:5px 0 5px 0;"><i uk-icon="icon:cog; ratio:0.9" class="icon-margin3"></i>&nbsp;  Extras/Características</p></a>
				</li>

	   			 <li>
	   			 	<a href="#"><p class="grey3" style="margin:5px 0 5px 0;"><i uk-icon="icon:location; ratio:0.9" class="icon-margin3"></i>&nbsp; Distancias/Entorno</p></a>
	   			 </li>

	   			  <li id="pillShow">
	   			 	<a href="#"><p class="grey3" style="margin:5px 0 5px 0;"><i uk-icon="icon:tag; ratio:0.9" class="icon-margin3"></i>&nbsp; Equipamiento</p></a>
	   			 </li>
			</ul>

					<ul class="uk-switcher uk-margin"> <!--PARTE DEL EXTRAS CARACTERISTICAS-->
  			  <li> 
		<div class="uk-width-1-1 uk-margin-bottom">  <!---------------------------DIV DE INFORMACION GENERAL-->
			<?php $id_real_casa = $row["ID"]; ?>
					  	<?php 
      	$stmt = $db->prepare("SELECT * FROM extras_alquileres_rentals WHERE id_rentals='$id_real_casa' ORDER BY id_extra asc");
/*$stmt = $db->prepare("SELECT yourRef,sellerID,propTown,propLocation,propNameES,propType,propPrice,ID FROM rentals ORDER BY yourRef limit 50" );*/
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$n=0;
while ($row_si = $stmt->fetch())
{
?>

				<!--PARTE DEL COLLASE NUEVO PARA EXTRAS ALQUILERES-->
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					  <div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="heading<?php echo $n ?>" style="background: #e6ffe6; color: black">
					      <h4 class="panel-title">
					      	<div class="row">
					      		<div class="col-md-6">
					      			<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $n ?>" aria-expanded="true" aria-controls="collapse<?php echo $n ?>">
							        		<?php echo $row_si['name_es'] ?>		        		
							        </a>
					      		</div>
							</div>
					      		
						        
					      </h4>
					    </div>
					    <div id="collapse<?php echo $n ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $n ?>">
					      <div class="panel-body"><!--PANEL BODY-->
					     			<!--ID DEL EXTRA UNICO-->
<input value="<?php echo $row_si['id_extra_alquileres_rentals'] ?>" type="hidden" class="form-control" id="id_extra" name="id_extra[]">
<!--ID DEL EXTRA-->		
<!--------------------------PANEL DE EXTRAS-->		
		<input type="hidden" name='name_es<?php echo $n ?>' value="<?php echo $row_si['name_es']?>">
<!--------------------------PANEL DE EXTRAS-->
		<div class="panel panel-default">
  				<div class="panel-heading">CONDICIONES DE APLICACIÓN DEL SERVICIO</div>
				<div class="panel-body">
				    	<div class="form-group">
				  			  <label for="aplica">¿Cuándo se aplica?<span style="color: red;">*</span></label>
						    <select onchange="tipo_formulario_ajax_add(<?php echo $n ?>)" class="form-control" id="aplica<?php echo $n ?>" required="true" name="aplica<?php echo $n ?>">
						      <option <?php echo $row_si['aplica'] == '0' ? 'selected' : '' ?> value="0">No se aplica nunca (no disponible)</option>
						      <option <?php echo $row_si['aplica'] == '1' ? 'selected' : '' ?> value="1">Se aplica si lo elije el turista</option>	
						      <option <?php echo $row_si['aplica'] == '2' ? 'selected' : '' ?> value="2">Se aplica siempre</option>
						      <option <?php echo $row_si['aplica'] == '3' ? 'selected' : '' ?> value="3">Se aplica según el número de ocupantes</option>	
						      <option <?php echo $row_si['aplica'] == '4' ? 'selected' : '' ?> value="4">Se aplica según el número de noches de reserva</option>
						      <option <?php echo $row_si['aplica'] == '5' ? 'selected' : '' ?> value="5">Se aplica según el número de noches previas a reservas</option>			    
						    </select>
		 				 </div>
		 				 <!--RESPUESTA AJAX INICIO-->
		 			        <div id='tipo_formulario_exits_parte_1<?php echo $n ?>'>
								<?php if ($row_si['aplica'] != '0'): ?>									
								
		 			        			<div class="form-inline form-group">
											 <div class="form-group" style='margin-right: 3rem;'>
										    	<label >¿N&uacute;mero?</label>
										   	</div>

											<?php if ($row_si['cantidad_ocupantes'] != '-'): ?><!--PARTE DE LA CANTIDAD DE OCUPANTES-->
												<?php  $separado_aplica = explode("-", $row_si['cantidad_ocupantes']); ?>
														 <div class="form-group">
														 	 <select style='margin-right: 3rem;' class="form-control" id="cantidad_ocupantes_1<?php echo $n ?>" required="true" name="cantidad_ocupantes_1<?php echo $n ?>">
																		      <option <?php echo $separado_aplica[0] == '0' ? 'selected' : '' ?> value="0">menor a</option>
																		      <option <?php echo $separado_aplica[0] == '1' ? 'selected' : '' ?> value="1">igual a</option>
																		      <option <?php echo $separado_aplica[0] == '2' ? 'selected' : '' ?> value="2">mayor a</option>					      	    
																</select>
														  	    <input value="<?php echo $separado_aplica[1] ?>" type="text" class="form-control" id="cantidad_ocupantes_2<?php echo $n ?>" placeholder="Cantidad" name="cantidad_ocupantes_2<?php echo $n ?>">
														 </div>
											<?php endif ?>	<!--PARTE DE LA CANTIDAD DE OCUPANTES-->		 



										</div>


										 <div class="form-group">
											    <label for="temporadas">¿En qué temporadas?</label>
											    <select onchange="temporadas_formulario_ajax_add(<?php echo $n ?>)" class="form-control" id="temporadas<?php echo $n ?>" required="true" name="temporadas<?php echo $n ?>">
											      <option <?php echo $row_si['temporadas'] == '0' ? 'selected' : '' ?> value="0">Todo el Año</option>
											      <option <?php echo $row_si['temporadas'] == '1' ? 'selected' : '' ?> value="1">Temporadas Específicas</option>			    
											    </select>
										 </div>


										  <!--RESPUESTA AJAX TEMPORADAS-->
												 <div id='temporada_exits_formulario<?php echo $n ?>'>
													<?php if ($row_si['temporadas'] != null): ?><!--PARTE DE LA TEMPORADA-->	
														 	<div class="form-inline form-group">
																 <div class="form-group " style='margin-right: 5rem;'>
															    	<label >Temporadas</label>
															   	</div>
																 <div class="form-group">
																  	    <input value='<?php echo $row_si['start_temporada'] ?>' style='margin-right: 3rem;' type="date" class="form-control" id="start_temporada<?php echo $n ?>" name="start_temporada<?php echo $n ?>">
																  	    <input value='<?php echo $row_si['end_temporada'] ?>' type="date" class="form-control" id="end_temporada<?php echo $n ?>" name="end_temporada<?php echo $n ?>">	  	   
																 </div>
														    </div>
													<?php endif ?>	<!--PARTE DE LA TEMPORADA-->
												 </div>
										 <!--RESPUESTA AJAX TEMPORADAS-->

										 <div class="form-group">
											    <label for="cantidad">¿Se puede elegir más de uno?</label>
											    <select onchange="cantidad_formulario_ajax_add(<?php echo $n ?>)" class="form-control" id="cantidad<?php echo $n ?>" required="true" name="cantidad<?php echo $n ?>">
											      <option <?php echo $row_si['cantidad'] == '0' ? 'selected' : '' ?> value="0">No</option>
											      <option <?php echo $row_si['cantidad'] == '1' ? 'selected' : '' ?> value="1">Sí</option>			    
											    </select>
										 </div>

										    <!--RESPUESTA AJAX CANTIDAD FORMULARIO-->
												<div id='cantidad_exits_formulario<?php echo $n ?>'>
													<?php if ($row_si['max_cantidad'] != null): ?><!--PARTE DE LA TEMPORADA-->

														<div class="form-group">
														    <label for="max_cantidad">¿Máximo de unidades?</label>
														    <select class="form-control" id="max_cantidad<?php echo $n ?>" required="true" name="max_cantidad<?php echo $n ?>">
														    	<?php for ($i = 1; $i <=150 ; $i++) {?>
														     		 <option <?php echo $row_si['max_cantidad'] == $i ? 'selected' : '' ?> value="<?php echo $i ?>"><?php echo $i ?></option>	     	
														        <?php }  ?>		    
														    </select>
	 													</div>
	 												<?php endif ?>	<!--PARTE DE LA TEMPORADA-->
												</div>
									    	<!--RESPUESTA AJAX CANTIDAD FORMULARIO-->
									<?php endif ?>
		 			        </div>
		 			    <!--RESPUESTA AJAX INICIO-->
	 
				</div>

				
		</div>
			 	

 <!--RESPUESTA AJAX INICIO 2-->		 
 				<div id='tipo_formulario_exits_parte_2<?php echo $n ?>'>
 					<?php if ($row_si['aplica'] != '0'): ?>
 							<div class="panel panel-default">
								<div class="panel-heading">TARIFAS DEL SERVICIO</div>
								<div class="panel-body">
								    	 <div class="form-group">
							   				 <label for="precio_incluido">¿Está incluido en el precio?</label>
										     <select onchange="precio_formulario_ajax_add(<?php echo $n ?>)" class="form-control" id="precio_incluido<?php echo $n ?>" required="true" name="precio_incluido<?php echo $n ?>">
										     	  <option <?php echo $row_si['precio_incluido'] == '1' ? 'selected' : '' ?> value="1">Si</option>
											      <option <?php echo $row_si['precio_incluido'] == '0' ? 'selected' : '' ?> value="0">No</option>
										     </select>
						 				</div>
						<!--RESPUESTA AJAX PRECIO-->
						 				<div id='precio_exits_formulario_parte_1<?php echo $n ?>'>
											<?php if ($row_si['a_que_precio'] != '-'): ?>
												<?php  $separado_precio = explode("-", $row_si['a_que_precio']); ?>

							 						<div class="form-inline form-group">
														 <div class="form-group " style='margin-right: 3rem;'>
													    	<label >¿A qué precio?</label>
													   	</div>
														 <div class="form-group">
														  	    <input value="<?php echo $separado_precio[0]?>" style='margin-right: 3rem;' type="text" class="form-control" id="a_que_precio_1<?php echo $n ?>" placeholder="Precio" name="a_que_precio_1<?php echo $n ?>">
														  	    <select class="form-control" id="a_que_precio_2<?php echo $n ?>" required="true" name="a_que_precio_2<?php echo $n ?>">
																		      <option <?php echo $separado_precio[1] == '0' ? 'selected' : '' ?>value="0">€ por reserva</option>
																		      <option <?php echo $separado_precio[1] == '1' ? 'selected' : '' ?>value="1">€ por día</option>
																		      <option <?php echo $separado_precio[1] == '2' ? 'selected' : '' ?>value="2">€ por persona</option>
																		      <option <?php echo $separado_precio[1] == '3' ? 'selected' : '' ?>value="3">€ por persona y día</option>
																		      <option <?php echo $separado_precio[1] == '4' ? 'selected' : '' ?>value="4">€ por hora</option>
																		      <option <?php echo $separado_precio[1] == '5' ? 'selected' : '' ?>value="5">€ por Kw</option>
																		      <option <?php echo $separado_precio[1] == '6' ? 'selected' : '' ?>value="6">% del precio de la reserva</option>
																		      <option <?php echo $separado_precio[1] == '7' ? 'selected' : '' ?>value="7">€ por litro</option>
																		      <option <?php echo $separado_precio[1] == '8' ? 'selected' : '' ?>value="8">€ por metro cúbico</option>			    
																</select>
														 </div>
													</div>
											<?php endif ?>
						 				</div>
						<!--RESPUESTA AJAX PRECIO-->

						 				<div class="form-group">
							   				 <label for="iva">IVA aplicado</label>
										     <select class="form-control" id="iva<?php echo $n ?>" required="true" name="iva<?php echo $n ?>">
											      <option <?php echo $row_si['iva'] == '0' ? 'selected' : '' ?> value="0">Exento(0 %)</option>
											      <option <?php echo $row_si['iva'] == '1' ? 'selected' : '' ?> value="1">Exento ventas intracomunitarias (0 %)</option>
											      <option <?php echo $row_si['iva'] == '2' ? 'selected' : '' ?> value="2">Exento ventas internacionales no intracomunitarias (0 %)</option>
											      <option <?php echo $row_si['iva'] == '3' ? 'selected' : '' ?> value="3">No sujeto (0 %)</option>
											      <option <?php echo $row_si['iva'] == '4' ? 'selected' : '' ?> value="4">Superreducido (4 %)</option>
											      <option <?php echo $row_si['iva'] == '5' ? 'selected' : '' ?> value="5">IGIC (7 %)</option>
											      <option <?php echo $row_si['iva'] == '6' ? 'selected' : '' ?> value="6">Reducido (10 %)</option>
											      <option <?php echo $row_si['iva'] == '7' ? 'selected' : '' ?> value="7">General (21 %)</option>			    
										     </select>
						 				</div>
								</div>				
							</div>

							<!--RESPUESTA AJAX PRECIO PARTE 2-->
							 				<div id='precio_formulario_exits_parte_2<?php echo $n ?>'>
							 					<?php if ($row_si['precio_incluido'] == '1'): ?>
								 						<div class="panel panel-default">
											  				<div class="panel-heading">PAGO DEL SERVICIO</div>
															<div class="panel-body">
															    	<div class="form-group">
																    	<label for="cuando_se_paga">¿Cuándo se paga?</label>
																	    <select class="form-control" id="cuando_se_paga<?php echo $n ?>" required="true" name="cuando_se_paga<?php echo $n ?>">
																	      <option <?php echo $row_si['cuando_se_paga'] == '0' ? 'selected' : '' ?> value="0">Al realizar la reserva</option>
																	      <option <?php echo $row_si['cuando_se_paga'] == '1' ? 'selected' : '' ?> value="1">A pagar en destino</option>	
																	      <option <?php echo $row_si['cuando_se_paga'] == '2' ? 'selected' : '' ?> value="2">A pagar con el último pago antes de la llegada</option>			    
																	    </select>
											 						</div>
												 
															</div>				
														</div>
												<?php endif ?>		
							 				</div>
							<!--RESPUESTA AJAX PRECIO PARTE 2-->


							<div class="panel panel-default">
									<div class="panel-heading">DÍAS DE ASIGNACIÓN POR DEFECTO EN LA RESERVA</div>
									<div class="panel-body">
											<div class="form-inline">
												   <label style="margin-right: 50px;">¿En qué día se aplica?</label>

											    	 <label class="radio-inline">
													  <input <?php echo $row_si['que_dia_aplica'] == '0' ? 'checked' : '' ?> type="radio" name="que_dia_aplica<?php echo $n?>" id="inlineRadio1<?php echo $n ?>" value="0"> En la fecha de entrada
													</label>


													<label class="radio-inline">
													  <input <?php echo $row_si['que_dia_aplica'] == '1' ? 'checked' : '' ?> type="radio" name="que_dia_aplica<?php echo $n?>" id="inlineRadio2<?php echo $n ?>" value="1"> En la fecha de salida
													</label>

											</div>		

									</div>				
							</div>

							<div class="panel panel-default">
									<div class="panel-heading">PROVEEDOR</div>
									<div class="panel-body">
										<div class="form-group">
								   				 <label for="proveedores">Proveedor</label>
											     <select class="form-control" id="proveedores<?php echo $n ?>" required="true" name="proveedores<?php echo $n ?>">
												      <option <?php echo $row_si['proveedores'] == '0' ? 'selected' : '' ?> value="0">Sin Datos</option>
												      <option <?php echo $row_si['proveedores'] == '1' ? 'selected' : '' ?> value="1">Endesa-Gesa</option>
												      <option <?php echo $row_si['proveedores'] == '2' ? 'selected' : '' ?> value="2">Fotovoltáico-Propietario</option>
												      <option <?php echo $row_si['proveedores'] == '3' ? 'selected' : '' ?> value="3">IBred</option>	
												      <option <?php echo $row_si['proveedores'] == '4' ? 'selected' : '' ?> value="4">Mallorca Wifi</option>
												      <option <?php echo $row_si['proveedores'] == '5' ? 'selected' : '' ?> value="5">Movistar Telefonica</option>	
												      <option <?php echo $row_si['proveedores'] == '6' ? 'selected' : '' ?> value="6">Propietario</option>
												      <option <?php echo $row_si['proveedores'] == '7' ? 'selected' : '' ?> value="7">Villas Planet SL</option>	
												      <option <?php echo $row_si['proveedores'] == '8' ? 'selected' : '' ?> value="8">WifiBaleares</option>
											     </select>
							 				</div>
									    	
									</div>				
							</div>
					<?php endif ?>		
 				</div>
					
<!--RESPUESTA AJAX INICIO 2-->   	
					     </div><!--PANEL BODY-->
					  </div>					 
					 
					</div>
				</div> 	
				<!--PARTE DEL COLLASE NUEVO PARA EXTRAS ALQUILERES-->

<?php
	$n++;
	}	 
?>			
		
	</div><!---------------------------DIV DE INFORMACION GENERAL-->


<!-----------------------------------------------EXTRAS QUE NO EXISTEN EN LA CASA----------------------------------------------->
<div class="uk-width-1-1 uk-margin-bottom">  <!---------------------------DIV DE INFORMACION GENERAL QUE NO EXISTE-->
					  	<?php 
	      	$stmt = $db->prepare("SELECT * FROM extras_alquileres WHERE id_extra NOT IN (SELECT id_extra FROM extras_alquileres_rentals WHERE id_rentals = '$id_real_casa') ORDER BY id_extra asc");
	/*$stmt = $db->prepare("SELECT yourRef,sellerID,propTown,propLocation,propNameES,propType,propPrice,ID FROM rentals ORDER BY yourRef limit 50" );*/
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();
	$x=0;
	while ($row_no = $stmt->fetch())
	{
	?>

				<!--PARTE DEL COLLASE NUEVO PARA EXTRAS ALQUILERES-->
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					  <div class="panel panel-default" >
					    <div class="panel-heading" role="tab" id="heading<?php echo $x ?>" style="background: #ffe6e6; color: black">
					      <h4 class="panel-title">
					      	<div class="row">
					      		<div class="col-md-6">
					      			<a role="button" data-toggle="collapse" data-parent="#accordion" href="#extrasnot<?php echo $x ?>" aria-expanded="true" aria-controls="collapse<?php echo $x ?>" >
							        		<?php echo $row_no['name_es'] ?>		        		
							        </a>
					      		</div>
							</div>
					      		
						        
					      </h4>
					    </div>
					    <div id="extrasnot<?php echo $x ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $x ?>">
					      <div class="panel-body"><!--PANEL BODY-->
					     			<!--ID DEL EXTRA UNICO-->
										<input value="<?php echo $row_no['id_extra'] ?>" type="hidden" class="form-control" id="id_extranot" name="id_extranot[]">
									<!--ID DEL EXTRA-->		
								<!--------------------------PANEL DE EXTRAS-->		
										<input type="hidden" name='name_esnot<?php echo $x ?>' value="<?php echo $row_no['name_es']?>">
								<!--------------------------PANEL DE EXTRAS-->
										<div class="panel panel-default">
								  				<div class="panel-heading">CONDICIONES DE APLICACIÓN DEL SERVICIO</div>
												<div class="panel-body">
												    	<div class="form-group">
												  			  <label for="aplicanot<?php echo $x ?>">¿Cuándo se aplica?<span style="color: red;">*</span></label>
														    <select onchange="tipo_formulario_ajax_add_not(<?php echo $x ?>)" class="form-control" id="aplicanot<?php echo $x ?>" required="true" name="aplicanot<?php echo $x ?>">
														      <option value="0">No se aplica nunca (no disponible)</option>
														      <option value="1">Se aplica si lo elije el turista</option>	
														      <option value="2">Se aplica siempre</option>
														      <option value="3">Se aplica según el número de ocupantes</option>	
														      <option value="4">Se aplica según el número de noches de reserva</option>
														      <option value="5">Se aplica según el número de noches previas a reservas</option>			    
														    </select>
										 				 </div>
										 				 <!--RESPUESTA AJAX INICIO-->
										 			        <div id='tipo_formulario_parte_1_not<?php echo $x ?>'>
																
										 			        </div>
										 			    <!--RESPUESTA AJAX INICIO-->
									 
												</div>

												
										</div>
											 	

								 							<!--RESPUESTA AJAX INICIO 2-->		 
								 				<div id='tipo_formulario_parte_2_not<?php echo $x ?>'></div>
															<!--RESPUESTA AJAX PRECIO PARTE 2-->
			
 				          </div>
					
<!--RESPUESTA AJAX INICIO 2-->   	
					     </div><!--PANEL BODY-->
					  </div>					 
					 
					</div>
				<!--PARTE DEL COLLASE NUEVO PARA EXTRAS ALQUILERES-->

<?php
	$x++;
	}	 
?>			
		</div> <!---------------------------DIV DE INFORMACION GENERAL QUE NO EXISTE-->


<!-----------------------------------------------EXTRAS QUE NO EXISTEN EN LA CASA----------------------------------------------->

	</li>

 <li>  
		 	<!--PARTE DEL EXTRAS CARACTERISTICAS-->

<!--PARTE DE LAS DISTANCIAS-->
<!--HASTA AQUI LLEGA PRIMERA PARTE DEL SCRIPT-->		 	
		<div class="uk-width-1-1 uk-margin-bottom">
			<p class="grey-titles"><strong>Gestión de distancias y entorno de la propiedad</strong></p>
				<div class="uk-form-controls">
	         <div class="uk-grid">
					 <div class=" uk-grid-medium uk-child-width-auto uk-grid ">
				         <?php 
							   $distancias = $db->prepare("SELECT DISTINCT id, distanciaNombre  FROM distancias_properties where distanciaActivo='si' order by ID Asc");
							   $distancias->setFetchMode(PDO::FETCH_ASSOC);
				$distancias->execute();
				$a=0;				
				while ($distancias1 = $distancias->fetch())
				{
/*********************CODIGO PARA SELECCIONA POR*****************/
				   	$id_extra=$distancias1['id'];
					$stmt_extra = $db->prepare("SELECT * FROM distancias_assign_rentals WHERE idExtra='$id_extra' AND idCasa='$id_real_casa'");
					$stmt_extra->setFetchMode(PDO::FETCH_ASSOC);
					$stmt_extra->execute();
					$row_extra = $stmt_extra->fetch();
				/*PEQUEÑO CODIGO SI ESTA VACIO*/	
					if (!$row_extra) {
						$datos=' nada';
					}else{

						$datos=$row_extra['extraDist'];
					}
					$row_datos= explode(" ", $datos);									
				/*PEQUEÑO CODIGO SI ESTA VACIO*/		
/*********************CODIGO PARA SELECCIONA POR*****************/								
					?>   

							<label style="cursor:pointer; margin-top:5px;" > 
								<p class="grey3 " style="margin:5px 0 10px 0;">Distancia <?php echo $distancias1['distanciaNombre']?></p>
								 <input type="hidden" name="idDist[]" value="<?php echo $distancias1['id']?>">
								 <input value="<?php echo $row_datos[0] ?>" class="uk-input superficie" name="distancia[]" type="text" style="width:250px;">
								 <div style="width:120px; display:inline-block; vertical-align:middle" class="width_opt"> 
								 	<select class="car-options" name="unidad[]">
								 		<option <?php echo $row_datos[1] == 'km' ? 'selected' : '' ?> value="km">Km (Kilómetros) </option>
										<option <?php echo $row_datos[1] == 'm' ? 'selected' : '' ?> value="m">m (Metros)</option>										
									</select>
								</div>
							</label>
						
							<?php 
							$a++;}
							?>
							<input type="hidden" name="controlDist" value="<?php echo $a?>">	 
				    </div>
				
				
				</div>
			
			</div>
		</div>
	</li>	

	<!--NUEVA SECCION DE LOS EXTRAS-->

	<li>  
		 		 	
		<div class="uk-width-1-1 uk-margin-bottom">
			<p class="grey-titles"><strong>Gestión de Equipamiento</strong></p>
				<div class="uk-form-controls">
				         <?php 
							   $equipamiento = $db->prepare("SELECT DISTINCT id, extraNombre  FROM extras_properties where (extraTipoProp LIKE '%Vacacional%' OR extraTipoProp LIKE '%Anual%' OR extraTipoProp LIKE '%Temporal%') order by id Asc");
							   $equipamiento->setFetchMode(PDO::FETCH_ASSOC);
								$equipamiento->execute();
								$a=0;
							?>
		     <div class="row">
						<?php

						while ($equipamiento1 = $equipamiento->fetch())
						{

/********************SUBCONSULTA*****************/
				   	$id_extra=$equipamiento1['id'];
					$stmt_extra = $db->prepare("SELECT id_extra FROM extras_alquileres_equipamiento WHERE id_extra='$id_extra' AND id_rentals='$id_real_casa'");
					$stmt_extra->setFetchMode(PDO::FETCH_ASSOC);
					$stmt_extra->execute();
					$row_extra = $stmt_extra->fetch();													
				/*PEQUEÑO CODIGO SI ESTA VACIO*/					

/********************SUBCONSULTA*****************/		


							?>

								
										<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">	
												<label class="radio-inline">
													<input name='equipamiento[]' <?php echo $row_extra['id_extra'] == $equipamiento1['id'] ? 'checked' : '' ?> type="checkbox"  value="<?php echo $equipamiento1['id']?>"> <?php echo $equipamiento1['extraNombre']?>
												</label>
										</div>
													


							<?php 
							}
							?>
				</div>			
				
				
			
			</div>
		</div>
	</li>			


</ul>
</div>
	</div>

<!--PARTE DE LAS DISTANCIAS-->		 	



	<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
				<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Notas privadas/referencias</h5>
			</div>

		</div>

		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
				<textarea id="editor4" name="notas"  class="uk-width-1-1"><?php echo $row['propNotesPrivate'];?></textarea>
            <script>	
              CKEDITOR.replace( 'editor4', {
  					filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : 'filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });
			</script>
			</div>

		</div>

		<div class="row" style="margin-top: 40px; padding-bottom: 40px;">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				 <button onclick="saveData('1')" class="uk-button uk-button-primary" type="button"><strong>Editar y Publicar <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
			 <button onclick="saveData('0')" class="uk-button uk-button-default uk-modal-close" type="button">Editar sin publicar</button>

			<!--<button class="uk-button uk-button-primary" type="submit"><strong>Editar y Publicar <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
			 <button class="uk-button uk-button-default uk-modal-close" type="submit">Editar sin publicar</button>-->
		           
			</div>
		</div>
</form>	


</div>

	<div style="height:30px"></div>



<!-----------------------------------------CUERPO DE LA PAGINA-->


<?php require('modal_clientes.php');
 ?>
<div id="preview-modal"></div>
<div id="calendarioReservas" class="uk-modal-container" uk-modal>
<div id="periodosReservas" class="uk-modal-container" uk-modal>
<?php 
//include header template
require('../layout/footer.php'); 
include('../layout/nuevo-cliente.php');
include('../layout/nueva-caracteristica.php');
include('../layout/nueva-distancia.php');
include("../layout/galeria-listados.php");
?>

<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyAlD35Pnso2gahg3OiljQnNPyYF6OsLiPo&sensor=false&libraries=places'></script>
<script src="../js/locationpicker.jquery.min.js"></script>
<script>
	function updateControls(addressComponents) {
  
    
	$('#map-zip').val(addressComponents.postalCode);
		 
  $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>layout/zonas",
	data:'poblacion_id='+addressComponents.postalCode,
	success: function(data){
		$("#load-poblaciones").html(data);
		$('select.box-gallery-poblaciones')[0].sumo.reload();
		$('select.box-gallery-poblaciones')[0].sumo.enable();
		
	}
	});
		$.ajax({
	type: "POST",
	url: "<?php echo DIR;?>layout/poblaciones",
	data:'ciudad_id='+addressComponents.postalCode,
	success: function(data){
		$("#map-city").html(data);
		$('select.box-gallery-poblaciones1')[0].sumo.reload();
		$('select.box-gallery-poblaciones1')[0].sumo.enable();
		
	}
	});
   
}
            $('#map').locationpicker({
                location: {
                    latitude: document.getElementById('map-lat').value,
                    longitude: document.getElementById('map-lon').value,
                },
                radius: 0,
				fillColor: '#FF0000',
				
				zoom:15,
				mapTypeId: google.maps.MapTypeId.HYBRID,
				addressFormat: 'street_number',
				markerIcon: '<?php echo DIR;?>images/map-marker.png',
                inputBinding: {
                    latitudeInput: $('#map-lat'),
                    longitudeInput: $('#map-lon'),
                    radiusInput: $('#map-radius'),
                    locationNameInput: $('#map-address')
                },
                enableAutocomplete: true,
				enableAutocompleteBlur: true,
				onchanged : function (component) {
      $('#map-address').val('');
	  $('#map-lat').val('');
	  $('#map-lon').val('');				
   },
                onchanged: function (currentLocation, radius, isMarkerDropped) {
         var addressComponents = $(this).locationpicker('map').location.addressComponents;
        updateControls(addressComponents);
                }
			});</script>

<script>

    
    UIkit.upload('.js-upload');
</script>



<script type="text/javascript" >
        $(document).ready(function () {
			$('.box-gallery-poblaciones').SumoSelect({search: false, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultados para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			$('.car-options').SumoSelect({search: false, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultados para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});

//$('select.box-gallery-poblaciones')[0].sumo.disable();


				$('.box-gallery-poblaciones1').SumoSelect({search: false, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultados para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			//$('select.box-gallery-poblaciones1')[0].sumo.disable();
			

	

		});

 </script>
<script type="text/javascript">
        $(document).ready(function () {
			$('.box-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultadao para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			
		});$('#property').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});
      
$(document).ready(function(){
   $("#ofertaPrecio").change(function () {
       if($('#ofertaPrecio').is(':checked')) {
            $('#showPrecioOferta').fadeIn('slow');
	   }else{
            $('#showPrecioOferta').fadeOut('slow');}

    });
});
	$(document).ready(function(){
   $("#ofertaPrecio2").change(function () {
       if($('#ofertaPrecio2').is(':checked')) {
            $('#showPrecioOferta2').fadeIn('slow');
	   }else{
            $('#showPrecioOferta2').fadeOut('slow');}

    });
});
$(document).ready(function(){
   $("input:radio").change(function () {
       if($('#precioShow').is(':checked')) {
            $('#pillShow').fadeIn('slow');
		    $('#showVacacional').fadeIn('slow');
	   }else{
            $('#showVacacional').fadeOut('slow');}

    });
});
$(document).ready(function(){
   $("input:radio").change(function () {
       if(($('#tipopropiedad3').is(':checked')) || ($('#tipopropiedad4').is(':checked') )) {
           
		    $('#showAlquiler').fadeIn('slow');
	   }else{
            $('#showAlquiler').fadeOut('slow');}

    });
});
$(document).ready(function(){
   $("input:radio").change(function () {
       if($('#tipopropiedad1').is(':checked')) {
		  $('#showVenta').fadeIn('slow');
           $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>layout/generar-ref",
	data:'accionref='+'venta',	
	success: function(data){
		$("#ref-venta").val(data);
		$("#ref-venta").attr('disabled',false);
		
	}
	});
	   }else{
    $("#ref-venta").val('');
	$("#ref-venta").attr('disabled',true);
	$('#showVenta').fadeOut('slow');
	}

    });
});
	$(document).ready(function(){
   $("input:radio").change(function () {
       if(($('#precioShow').is(':checked')) || ($('#tipopropiedad3').is(':checked')) || ($('#tipopropiedad4').is(':checked') )) {
     $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>layout/generar-ref",
	data:'accionref='+'alquiler',
	success: function(data){
		$("#ref-alquiler").val(data);
		$("#ref-alquiler").attr('disabled',false);
		
	}
	});
	   }else{
    $("#ref-alquiler").val('');
	$("#ref-alquiler").attr('disabled',true);
	}

    });
});
</script>



<script type="text/javascript" >
function saveData(param) {
	var editor1 = CKEDITOR.instances.editor1.getData();
	var editor2 = CKEDITOR.instances.editor2.getData();
	var editor3 = CKEDITOR.instances.editor3.getData();

	var tituloES = document.getElementById('tituloES').value;
	var tituloEN = document.getElementById('tituloEN').value;
	var tituloDE = document.getElementById('tituloDE').value;

	var tituloES_tolowercase = tituloES.toLowerCase();
	var tituloEN_tolowercase = tituloEN.toLowerCase();
	var tituloDE_tolowercase = tituloDE.toLowerCase();

/*TITULO NO DEBEN ESTAR VACIOS*/
	if (tituloES=='' || tituloEN=='' || tituloDE=='') {
		alert('Los Titulos en los 3 idiomas, no debe estar vacio');
		return false;
	}
/*TITULO NO DEBEN ESTAR VACIOS*/

/*LAS DESCRIPCIONES NO DEBEN ESTAR VACIOS*/
		if (editor1=='' || editor2=='' || editor3=='') {
		alert('Las descripciones en los 3 idiomas, no debe estar vacio');
		return false;
	}

/*LAS DESCRIPCIONES NO DEBEN ESTAR VACIOS*/

/*TITULOS NO DEBE SER IGUALES*/
	if (tituloES_tolowercase == tituloEN_tolowercase || tituloEN_tolowercase == tituloDE_tolowercase || tituloES_tolowercase == tituloDE_tolowercase) {
		alert('Los titulos no deben ser iguales');
		return false;
	}
/*TITULOS NO DEBE SER IGUALES*/

/*TITULOS NO DEBE SER SIMILARES*/
	var string_es = String(tituloES_tolowercase);

	if (tituloEN_tolowercase.indexOf(string_es) != -1 || tituloDE_tolowercase.indexOf(string_es) != -1 ) {
	    alert('Los titulos no deben ser Similares');
		return false;
	}
/*TITULOS NO DEBE SER SIMILARES*/	

	$("#activar").val(param);
	UIkit.modal.confirm('¿Confirma que desea Editar la propiedad?', { center:true, labels: { ok: 'Ok', cancel: 'Volver a edición' } }).then(function() {
   for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
			$.ajax({
                url: '<?php echo DIR;?>propiedades/updatepropiedad_rentals.php', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'text', // data type
                data : $("#property").serialize(), // post data || get data
                success : function(result) {
                   //UIkit.modal.dialog(result);
					//console.log(result);
                   window.location.replace("<?php echo DIR;?>propiedades/alquileres");
                   
                },
                error: function(xhr, resp, text,error) {
                     UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> <strong>Ha habido un error al editar. Inténtelo de nuevo.</strong>', status: 'danger', timeout:2000})
					alert(error);
                } 
				
			});
}, function () {
   
});
	
}     
 </script>

  <!--CODIGO DE ALERTA CUANDO SE SALE DE LA PAGINA-->
<!--<script type="text/javascript" language="javascript">
         $(window).bind('beforeunload', function(){
  			return "Buscas salir de esa página?";
		});
 </script>-->

<script type="text/javascript">

	 $(window).load(function(){
          $('body').backDetect(function(){
			  var result = window.confirm('Estas seguro que desea abandonar esta Página?, Sus datos no se guardaran.');
			  if (result == false) {
              backDetect();
            };
          });
			
        });
</script>

<!--CODIGO DE ALERTA CUANDO SE SALE DE LA PAGINA-->
<!--JAVASCRIPT PARA TODO-->
<script type="text/javascript">
function previewGallery(param,divid) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>propiedades/previewgallery_rentals",
	data:{ refid: param, divid: divid },
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


function verperiodos($id) {
	var id = $id;

	$.ajax({
        url: '<?php echo DIR;?>propiedades/senciyaPeriodos?idrental=' + id, // url where to submit the request
        beforeSend: function(){
		  	$(".loader").show();
		},
        success : function(result) {
        	$(".loader").fadeOut("slow");
			$("#periodosReservas").html(result);
			UIkit.modal("#periodosReservas").show();
        }
    });
}
function vercalendario($id) {
	var id = $id;

	$.ajax({
        url: '<?php echo DIR;?>propiedades/senciyaCalendar?idrental=' + id, // url where to submit the request
        beforeSend: function(){
		  	$(".loader").show();
		},
        success : function(result) {
        	$(".loader").fadeOut("slow");
			$("#calendarioReservas").html(result);
			UIkit.modal("#calendarioReservas").show();
        }
    });
}

</script>
<!--JAVASCRIPT PARA EL MODAL CLIENTES-->

<script type="text/javascript">

function datoscliente($id_cliente){
        var id = $id_cliente;
        $.ajax({
            url: "<?php echo DIR;?>propiedades/respuesta_modal?idcliente=" + id,
            type:"GET",
	          beforeSend: function(){
			  		$("#cliente_modal .modal-body").html(
			  				 "<center ><img src='../images/ajax-loader.gif'/></center>"
			  		);
		 		 },
            success:function(resp){
                $("#cliente_modal .modal-body").html(resp);
                $("#cliente_modal .modal-title").html('Información del Cliente');
                //alert(resp);
            }

        });
}
</script>

<script type="text/javascript">

function updatecliente() {
    if (confirm("¿Confirma que desea editar el propietario?")) {
            $.ajax({
                url: '<?php echo DIR;?>propiedades/updatecliente', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'json', // data type
                data : $("#owner-form").serialize(), // post data || get data
            });
            $('#cliente_modal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
} }
</script>

<!--JAVASCRIPT PARA EL MODAL CLIENTES-->
<!--JAVASCRIPT PARA TODO-->

