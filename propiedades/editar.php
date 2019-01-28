<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<?php
require('../includes/config2.php');




if (!$user->is_logged_in()) {
    header('Location: ../login');
    exit();
}

/* $data = date('Y-m-d');;
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
  $activo2=""; */
$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';

require('../layout/header.php');
?>
<!--SECCION PARA AGREGAR EDICION-->
<?php
$id = $_GET['yourRef'];
$id2 = str_replace('V', '', $id);
$id2 = $id2 - 1000;

$stmt = $db->prepare("SELECT * FROM properties WHERE yourRef='$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
?>
<!--SECCION PARA AGREGAR EDICION-->

<?php
include('../layout/menu.php');
?>


<!-----------------------------------------CUERPO DE LA PAGINA-->
 

<div class="container" style="background-color: white; margin-top: 50px;">
    <button onclick="saveData('1')" class="uk-button uk-button-primary flotante" type="button">
    <strong>Editar y Publicar <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong>
</button>

    <form id="property">
        <!--ID DE LA VENTA -->
        <input type="hidden" name="id_venta" value="<?php echo $row['ID']; ?>"><!--ID DE LA VENTA -->
        <div class="row">
            <h3 class="yellow" style="font-weight:600; margin-top: 30px; margin-left: 30px;">
                <span uk-icon="icon:plus-circle" class="icon-margin3"></span> Editar propiedad : <?php echo $row['propNameES'] ?>             
            </h3>
        </div>
        <div class="row">
               <a style="margin-left: 30px;" type='button' class="btn btn-success" onclick="previewGallery('<?php echo $row['ID']?>','<?php echo "activadas".'1' ?>')">Gal. Fotos</a>
                <a type='button' class="btn btn-primary" data-toggle="modal" data-target="#cliente_modal" onclick="datoscliente(<?php echo $row['SellerID']?>)">Datos del Propietario</a>
                <a type='button' href='imprimir_casas_ventas.php?id=<?php echo $id ?>' target='_blank' class="btn btn-warning">v. Imprimir</a>
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
                <select placeholder="-Seleccionar-" name="propietario" class="form-control box-gallery" >			
                    <option>-Seleccionar-</option>
                    <?php
                    $clientes = $db->prepare("SELECT distinct(sellerName1),ID FROM owners /*where active='1'*/ order by sellerName1 Asc");
                    $clientes->setFetchMode(PDO::FETCH_ASSOC);
                    $clientes->execute();
                    while ($row2 = $clientes->fetch()) {
                        ?>
                        <option <?php echo $row['SellerID'] == $row2['ID'] ? 'selected' : '' ?> value="<?php echo $row2['ID'] ?>"><?php echo $row2['sellerName1']; ?></option>
<?php } ?>			
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
                    <input type="text" class="form-control" id="map-address" type="text" name="direccion"  value="<?php echo $row['propAddress'] == null ? 'Sin Direccion' : $row["propAddress"] ?>" placeholder="Introduzca la dirección  para completar los campos automáticamente...">
                </div>			    

                <!-------------------------------SEPARAR LATITUD Y LONGITUD y OTROS-->
                <?php
                $valores = $row['propLinkMap'];
                $valor = explode(",", $valores);

                $zonas = $row['propLocation'];
                $zona = explode(":", $zonas);
                ?>
                <!-------------------------------SEPARAR LATITUD Y LONGITUD y OTROS-->


                <div class="form-group">
                    <label for="map-city">Población</label>
                    <select placeholder="-Seleccionar población-" class="form-control box-gallery-poblaciones1" id="map-city" name="poblacion">
<?php if ($zona[0] != null): ?>
                            <option value="<?php echo $zona[0] ?>"><?php echo $zona[0] ?></option>
<?php endif; ?>
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
<?php if ($zona[1] != null): ?>
                            <option value="<?php echo $zona[1] ?>"><?php echo $zona[1] ?></option>
<?php endif; ?>
                    </select>
                </div>  

                <div class="form-group form-check">
                    <input class="form-check-input" <?php echo $row['mostrarDireccion'] == 'si' ? 'checked' : '' ?> name="mostrarDireccion" value="si" type="checkbox" id='mostrarDireccion'  style="cursor:pointer">
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
                    <label for="refVenta">Referencia venta</label>
                    <input type="text" class="form-control" disabled value='<?php echo $row['yourRef'] ?>'>

                    <label for="precioVenta">Precio de Venta o Alquiler</label>
                    <input value='<?php echo $row['propPrice'] ?>' id="precioVenta" class="form-control" name="precioVenta" type="text">
                </div>

                <div class="form-group">                          

                    <label for="clasifEnergia">"ClasifEnergia"</label>
                    <input value='<?php echo $row['clasifEnergia'] ?>' id="clasifEnergia" class="form-control" name="clasifEnergia" type="text">
                </div>
            </div>

            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <p style="margin-top: 20px;"><strong><i uk-icon="icon:warning;"></i> La asignación de precios de la propiedad en alquiler vacacional se realizará una vez guardada la propiedad</strong></p>
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
                            CKEDITOR.replace('editor1', {
                                filebrowserBrowseUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl: '../filemanager/dialog.php?type=1&editor=ckeditor&fldr='});
                        </script>
                    </li>


                    <li>
                        <div class="uk-width-1-1 uk-margin-bottom">
                            <p class="grey3" style="margin:5px 0 10px 0;"> <strong>Título inglés</strong></p>
                            <input id="tituloEN" class="uk-input "value="<?php echo $row['propNameEN'] ?>"  name="tituloEN" type="text">
                        </div>
                        <p class="grey3 uk-margin-bottom" style="margin:5px 0 10px 0;"> <strong>Descripción inglés</strong></p>
                        <textarea  id="editor2"  name="descripEN"  class="uk-width-1-1"><?php echo $row['propDescripEN'] ?></textarea>
                        <script>
                            CKEDITOR.replace('editor2', {
                                filebrowserBrowseUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl: '../filemanager/dialog.php?type=1&editor=ckeditor&fldr='});
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
                            CKEDITOR.replace('editor3', {
                                filebrowserBrowseUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl: '../filemanager/dialog.php?type=1&editor=ckeditor&fldr='});
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
                        <label for="útil">M2 Totales construidos</label>
                        <input class="form-control"  value="<?php echo $row['propHouseM2'] ?>" name="supUtil" type="text">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label for="terraza">Superficie total terrazas</label>
                        <input  class="form-control" value="<?php echo $row['propTerraceM2'] ?> "name="supTerraza" type="text">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label for="terreno">Superficie terreno</label>
                        <input  class="form-control" value="<?php echo $row['propLandM2'] ?>" name="supTerreno" type="text">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label for="total">M2 útiles</label>
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
                        <label for="útil">Nº de habitaciones individuales</label>
                        <input class="form-control"  value="<?php echo $row['propBedSingle'] ?>" name="habSimple" type="text">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label for="terraza">Nº de habitaciones dobles</label>
                        <input  class="form-control" value="<?php echo $row['propBedDouble'] ?>" name="habDoble" type="text">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label for="terreno">Nº de baños</label>
                        <input  class="form-control" value="<?php echo $row['propBathroom'] ?>" name="propBathroom" type="text">
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

                    <li id="pillShow" style="display:none">
                        <a href="#"><p class="grey3" style="margin:5px 0 5px 0;"><i uk-icon="icon:tag; ratio:0.9" class="icon-margin3"></i>&nbsp; Precios servicios</p></a>
                    </li>
                </ul>

                <ul class="uk-switcher uk-margin"> <!--PARTE DEL EXTRAS CARACTERISTICAS-->
                    <li> 
                        <div class="uk-width-1-1 uk-margin-bottom">
                            <!--Distribución-->			
                            <p class="grey-titles"><strong>Distribución</strong></p>
                            <div class=" uk-grid-medium uk-child-width-auto uk-grid "><!--EXTRAS REVISAR TABLA-->
                                <?php
                                $distribucion_numero = 0;
                                $extras = $db->prepare("SELECT DISTINCT id, extraNombre, extraOptions,extraCat FROM extras_properties where extraActivo='si' and extraCat='distribucion' order by extraNombre Asc");
                                $extras->setFetchMode(PDO::FETCH_ASSOC);
                                $extras->execute();
                                while ($extras1 = $extras->fetch()) {
                                    $options = explode(',', $extras1['extraOptions']);

                                    /*                                     * *******************CODIGO PARA SELECCIONA POR**************** */
                                    $id_extra = $extras1['id'];
                                    $stmt_extra = $db->prepare("SELECT * FROM extras_assign WHERE idExtra='$id_extra' AND idCasa='$id2'");
                                    $stmt_extra->setFetchMode(PDO::FETCH_ASSOC);
                                    $stmt_extra->execute();
                                    $row_extra = $stmt_extra->fetch();

                                    /*                                     * *******************CODIGO PARA SELECCIONA POR**************** */
                                    ?>

    <?php
    if ($extras1['extraOptions'] == "") {
        ?> 
                                        <label style="cursor:pointer; margin-top:5px;" >
                                            <input id='input_distribucion_<?php echo $distribucion_numero ?>' <?php echo $row_extra['idExtra'] == $extras1['id'] ? 'checked' : '' ?> onclick="habilitar(<?php echo $distribucion_numero ?>, 'distribucion')" class="uk-checkbox" name="extra1[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                        </label>
                                        <input type="hidden" name="extra1Cat[]" value="no">
        <?php
        if ($extras1['extraCat'] == "") {
            ?> 
                                            <input id='input_distribucion_<?php echo $distribucion_numero ?>' <?php echo $row_extra['idExtra'] == $extras1['id'] ? 'checked' : '' ?> onclick="habilitar(<?php echo $distribucion_numero ?>, 'distribucion')" class="uk-checkbox" name="extra1[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                            <select <?php echo empty($row_extra['idExtra']) ? 'disabled' : '' ?> id='select_distribucion_<?php echo $distribucion_numero ?>' class="form-control" placeholder="-Seleccionar-" name="extra1Cat[]">		
                                                <option>€/día  </option>
                                                <option>€/total</option>
                                                <option>€/kWh</option>
                                                <option>€/litro gasoil</option>			
                                            </select>
                                        </div>
                                    <?php } ?>
        <?php
    } else {
        ?>

                                    <label style="cursor:pointer; margin-top:5px;" >
                                        <input id='input_distribucion_<?php echo $distribucion_numero ?>' <?php echo $row_extra['idExtra'] == $extras1['id'] ? 'checked' : '' ?> onclick="habilitar(<?php echo $distribucion_numero ?>, 'distribucion')" class="uk-checkbox" name="extra1[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                    </label>
                                    <div style="min-width:210px; display:inline-block; margin-left:-20px;" class="width_opt">

                                        <select <?php echo empty($row_extra['idExtra']) ? 'disabled' : '' ?> id='select_distribucion_<?php echo $distribucion_numero ?>' class="form-control" placeholder="-Seleccionar-" name="extra1Cat[]">			     
                                            <?php
                                            $w = 0;
                                            foreach ($options as $value) {
                                                $subExtra = explode(',', $row_extra['extraCat']);
                                                $subExtra2 = $subExtra[0];
                                                ?> 	
                                                <option  <?php echo $subExtra2 == $value ? 'selected' : '' ?> value="<?php echo $value ?>,<?php echo $w ?>"><?php echo $value ?> </option>						     
            <?php $w++;
        }
        ?>
                                        </select>
                                    </div>

                                <?php } ?>
                                <?php
                                $distribucion_numero++;
                            }
                            ?>	 

                        </div>
                        <!--Distribución-->			

                        <!--BAÑOS-->        
                        <p class="grey-titles"><strong>Baños</strong></p>
                        <div class=" uk-grid-medium uk-child-width-auto uk-grid ">
                            <?php
                            $banos_numero = 0;
                            $extras = $db->prepare("SELECT DISTINCT id, extraNombre, extraOptions,extraCat FROM extras_properties where extraActivo='si' and extraCat='banos' order by extraNombre Asc");
                            $extras->setFetchMode(PDO::FETCH_ASSOC);
                            $extras->execute();
                            while ($extras1 = $extras->fetch()) {

                                /*                                 * *******************CODIGO PARA SELECCIONA POR**************** */
                                $id_extra = $extras1['id'];
                                $stmt_extra = $db->prepare("SELECT * FROM extras_assign WHERE idExtra='$id_extra' AND idCasa='$id2'");
                                $stmt_extra->setFetchMode(PDO::FETCH_ASSOC);
                                $stmt_extra->execute();
                                $row_extra = $stmt_extra->fetch();

                                /*                                 * *******************CODIGO PARA SELECCIONA POR**************** */
                                ?>
                                <?php $options = explode(',', $extras1['extraOptions']); ?>
                                <?php
                                if ($extras1['extraOptions'] == "") {
                                    ?> 
                                    <label style="cursor:pointer; margin-top:5px;" >
                                        <input id='input_banos_<?php echo $banos_numero ?>' <?php echo $row_extra['idExtra'] == $extras1['id'] ? 'checked' : '' ?> onclick="habilitar(<?php echo $banos_numero ?>, 'banos')" class="uk-checkbox" name="extra2[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                    </label>
                                    <input type="hidden" name="extra2Cat[]" value="no"> 
                                    <?php
                                    if ($extras1['extraCat'] == "") {
                                        ?> 
                                        <input id='input_banos_<?php echo $banos_numero ?>' <?php echo $row_extra['idExtra'] == $extras1['id'] ? 'checked' : '' ?> onclick="habilitar(<?php echo $banos_numero ?>, 'banos')" class="uk-checkbox" name="extra2[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                        <select <?php echo empty($row_extra['idExtra']) ? 'disabled' : '' ?> id='select_banos_<?php echo $banos_numero ?>' class="form-control" placeholder="-Seleccionar-" name="extra2Cat[]">		
                                            <option>€/día  </option>
                                            <option>€/total</option>
                                            <option>€/kWh</option>
                                            <option>€/litro gasoil</option>			
                                        </select>
                                    </div>
            <?php }
        ?>
                                <?php
                            } else {
                                ?>
                                <label style="cursor:pointer; margin-top:5px;" >
                                    <input id='input_banos_<?php echo $banos_numero ?>' <?php echo $row_extra['idExtra'] == $extras1['id'] ? 'checked' : '' ?> onclick="habilitar(<?php echo $banos_numero ?>, 'banos')" class="uk-checkbox" name="extra2[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                </label>
                                <div style="min-width:210px; display:inline-block; margin-left:-20px;" class="width_opt"> 
                                    <select <?php echo empty($row_extra['idExtra']) ? 'disabled' : '' ?> id='select_banos_<?php echo $banos_numero ?>' class="form-control" placeholder="-Seleccionar-" name="extra2Cat[]">			     
        <?php
        $w = 0;
        foreach ($options as $value) {
            $subExtra = explode(',', $row_extra['extraCat']);
            $subExtra2 = $subExtra[0];
            ?> 	
                                            <option  <?php echo $subExtra2 == $value ? 'selected' : '' ?> value="<?php echo $value ?>,<?php echo $w ?>"><?php echo $value ?> </option>				     
                                            <?php $w++;
                                        }
                                        ?>
                                    </select>
                                </div>				 
        <?php
    }
    ?>
                            <?php
                            $banos_numero++;
                        }
                        ?>	 

                        </div>
                        <!--BAÑOS-->	

                        <!--Accesorios/Equipamiento-->		
                        <p class="grey-titles"><strong>Accesorios/Equipamiento</strong></p>
                        <div class=" uk-grid-medium uk-child-width-auto uk-grid ">
                            <?php
                            $accesorio_numero = 0;
                            $extras = $db->prepare("SELECT DISTINCT id, extraNombre, extraOptions,extraCat FROM extras_properties where extraActivo='si' and extraCat='equipamiento' order by extraNombre Asc");
                            $extras->setFetchMode(PDO::FETCH_ASSOC);
                            $extras->execute();
                            while ($extras1 = $extras->fetch()) {
                                /*                                 * *******************CODIGO PARA SELECCIONA POR**************** */
                                $id_extra = $extras1['id'];
                                $stmt_extra = $db->prepare("SELECT * FROM extras_assign WHERE idExtra='$id_extra' AND idCasa='$id2'");
                                $stmt_extra->setFetchMode(PDO::FETCH_ASSOC);
                                $stmt_extra->execute();
                                $row_extra = $stmt_extra->fetch();

                                /*                                 * *******************CODIGO PARA SELECCIONA POR**************** */
                                ?>
                                <?php $options = explode(',', $extras1['extraOptions']); ?>
                                <?php
                                if ($extras1['extraOptions'] == "") {
                                    ?> 
                                    <label style="cursor:pointer; margin-top:5px;" >
                                        <input id='input_accesorio_<?php echo $accesorio_numero ?>' <?php echo $row_extra['idExtra'] == $extras1['id'] ? 'checked' : '' ?> onclick="habilitar(<?php echo $accesorio_numero ?>, 'accesorio')" class="uk-checkbox" name="extra3[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                    </label>
                                    <input type="hidden" name="extra3Cat[]" value="no"> 
        <?php
        if ($extras1['extraCat'] == "") {
            ?> 
                                        <input class="uk-input superficie" type="text" style="width: 65px; margin-left: 15px !important; padding: 10px;">
                                        <div style="width:135px; display:inline-block; margin-left:-31px; vertical-align:middle" class="width_opt">
                                            <select <?php echo empty($row_extra['idExtra']) ? 'disabled' : '' ?> id='select_accesorio_<?php echo $accesorio_numero ?>'  class="form-control" placeholder="-Seleccionar-" name="extra3Cat[]">	
                                                <option>€/día  </option>
                                                <option>€/total</option>
                                                <option>€/kWh</option>
                                                <option>€/litro gasoil</option>			
                                            </select>
                                        </div>
            <?php
        }
        ?>
                                    <?php
                                } else {
                                    ?>
                                    <label style="cursor:pointer; margin-top:5px;" >
                                        <input id='input_accesorio_<?php echo $accesorio_numero ?>' <?php echo $row_extra['idExtra'] == $extras1['id'] ? 'checked' : '' ?> onclick="habilitar(<?php echo $accesorio_numero ?>, 'accesorio')" class="uk-checkbox" name="extra3[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                    </label>
                                    <div style="min-width:210px; display:inline-block; margin-left:-20px;" class="width_opt"> 
                                        <select <?php echo empty($row_extra['idExtra']) ? 'disabled' : '' ?> id='select_accesorio_<?php echo $accesorio_numero ?>'  class="form-control" placeholder="-Seleccionar-" name="extra3Cat[]">						     
        <?php
        $w = 0;
        foreach ($options as $value) {
            $subExtra = explode(',', $row_extra['extraCat']);
            $subExtra2 = $subExtra[0];
            ?> 	
                                                <option  <?php echo $subExtra2 == $value ? 'selected' : '' ?> value="<?php echo $value ?>,<?php echo $w ?>"><?php echo $value ?> </option>						     
                                                <?php
                                                $w++;
                                            }
                                            ?>
                                        </select>
                                    </div>							 
                                            <?php
                                        }
                                        ?>
                                <?php
                                $accesorio_numero++;
                            }
                            ?>	 

                        </div>

                        <!--Accesorios/Equipamiento-->	

                        <p class="grey-titles"><strong>Jardín/Exterior</strong></p>
                        <div class=" uk-grid-medium uk-child-width-auto uk-grid ">
<?php
$jardin_numero = 0;
$extras = $db->prepare("SELECT DISTINCT id, extraNombre, extraOptions,extraCat FROM extras_properties where extraActivo='si' and extraCat='jardin' order by extraNombre Asc");
$extras->setFetchMode(PDO::FETCH_ASSOC);
$extras->execute();
while ($extras1 = $extras->fetch()) {
    /*     * *******************CODIGO PARA SELECCIONA POR**************** */
    $id_extra = $extras1['id'];
    $stmt_extra = $db->prepare("SELECT * FROM extras_assign WHERE idExtra='$id_extra' AND idCasa='$id2'");
    $stmt_extra->setFetchMode(PDO::FETCH_ASSOC);
    $stmt_extra->execute();
    $row_extra = $stmt_extra->fetch();

    /*     * *******************CODIGO PARA SELECCIONA POR**************** */
    ?>
                                <?php $options = explode(',', $extras1['extraOptions']); ?>
                                <?php
                                if ($extras1['extraOptions'] == "") {
                                    ?> 
                                    <label style="cursor:pointer; margin-top:5px;">
                                        <input id='input_jardin_<?php echo $jardin_numero ?>' <?php echo $row_extra['idExtra'] == $extras1['id'] ? 'checked' : '' ?> onclick="habilitar(<?php echo $jardin_numero ?>, 'jardin')" class="uk-checkbox" name="extra4[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                    </label>
                                    <input type="hidden" name="extra4Cat[]" value="no">
                                    <?php
                                    if ($extras1['extraCat'] == "") {
                                        ?>
                                        <input class="uk-input superficie" type="text" style="width: 65px;margin-left: 15px !important;padding: 10px;">
                                        <div style="width:135px; display:inline-block; margin-left:-31px; vertical-align:middle" class="width_opt"> 
                                            <select <?php echo empty($row_extra['idExtra']) ? 'disabled' : '' ?> id='select_jardin_<?php echo $jardin_numero ?>' class="form-control" placeholder="-Seleccionar-" name="extra4Cat[]">
                                                <option>€/día  </option>
                                                <option>€/total</option>
                                                <option>€/kWh</option>
                                                <option>€/litro gasoil</option>						
                                            </select>
                                        </div>
            <?php
        }
        ?>
        <?php
    } else {
        ?>
                                    <label style="cursor:pointer; margin-top:5px;" >
                                        <input id='input_jardin_<?php echo $jardin_numero ?>' <?php echo $row_extra['idExtra'] == $extras1['id'] ? 'checked' : '' ?> onclick="habilitar(<?php echo $jardin_numero ?>, 'jardin')" class="uk-checkbox" name="extra4[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                    </label>
                                    <div style="min-width:210px; display:inline-block; margin-left:-20px;" class="width_opt"> 
                                        <select <?php echo empty($row_extra['idExtra']) ? 'disabled' : '' ?> id='select_jardin_<?php echo $jardin_numero ?>' class="form-control" placeholder="-Seleccionar-" name="extra4Cat[]">					     
                                    <?php
                                    $w = 0;
                                    foreach ($options as $value) {
                                        $subExtra = explode(',', $row_extra['extraCat']);
                                        $subExtra2 = $subExtra[0];
                                        ?> 	
                                                <option  <?php echo $subExtra2 == $value ? 'selected' : '' ?> value="<?php echo $value ?>,<?php echo $w ?>"><?php echo $value ?> </option>							     
                                                <?php
                                                $w++;
                                            }
                                            ?>
                                        </select>
                                    </div>							 
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        $jardin_numero++;
                                    }
                                    ?>	 

                        </div>

                        <!---------------------------PARTE DE LOS OTROS-->
                        <p class="grey-titles"><strong>Otros</strong></p>
                        <div class=" uk-grid-medium uk-child-width-auto uk-grid ">
<?php
$otros_numero = 0;
$extras = $db->prepare("SELECT DISTINCT id, extraNombre, extraOptions,extraCat FROM extras_properties where extraActivo='si' and extraCat='otros' order by extraNombre Asc");
$extras->setFetchMode(PDO::FETCH_ASSOC);
$extras->execute();
while ($extras1 = $extras->fetch()) {
    /*     * *******************CODIGO PARA SELECCIONA POR**************** */
    $id_extra = $extras1['id'];
    $stmt_extra = $db->prepare("SELECT * FROM extras_assign WHERE idExtra='$id_extra' AND idCasa='$id2'");
    $stmt_extra->setFetchMode(PDO::FETCH_ASSOC);
    $stmt_extra->execute();
    $row_extra = $stmt_extra->fetch();

    /*     * *******************CODIGO PARA SELECCIONA POR**************** */
    ?>
                                <?php $options = explode(',', $extras1['extraOptions']); ?>
                                <?php
                                if ($extras1['extraOptions'] == "") {
                                    ?> 
                                    <label style="cursor:pointer; margin-top:5px;">
                                        <input <?php echo $row_extra['idExtra'] == $extras1['id'] ? 'checked' : '' ?> class="uk-checkbox" name="extra5[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                    </label>
                                    <input type="hidden" name="extra5Cat[]" value="no">
                                    <?php
                                    if ($extras1['extraCat'] == "") {
                                        ?> 
                                        <input class="uk-input superficie" type="text" style="width: 65px; margin-left: 15px !important;padding: 10px;">
                                        <div style="width:135px; display:inline-block; margin-left:-31px; vertical-align:middle" class="width_opt">
                                            <select <?php echo empty($row_extra['idExtra']) ? 'disabled' : '' ?> class="form-control" >
                                                <option>€/día  </option>
                                                <option>€/total</option>
                                                <option>€/kWh</option>
                                                <option>€/litro gasoil</option>				
                                            </select>					
                                        </div>
            <?php }
        ?>
        <?php
    } else {
        ?>
                                    <div class='col-md-6' style='margin-top:30px;'>					
                                        <label style="cursor:pointer; margin-top:5px; margin-right:40px;" >
                                            <input id='input_otros_<?php echo $otros_numero ?>' <?php echo $row_extra['idExtra'] == $extras1['id'] ? 'checked' : '' ?> onclick="habilitar(<?php echo $otros_numero ?>, 'otros')" class="uk-checkbox" name="extra5[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                        </label>
                                        <div style="min-width:210px; display:inline-block; margin-left:-20px;" class="width_opt"> 
                                            <select <?php echo empty($row_extra['idExtra']) ? 'disabled' : '' ?> id='select_otros_<?php echo $otros_numero ?>' class='form-control' placeholder="-Seleccionar-" name="extra5Cat[]">
                                    <?php
                                    $w = 0;
                                    foreach ($options as $value) {
                                        $subExtra = explode(',', $row_extra['extraCat']);
                                        $subExtra2 = $subExtra[0];
                                        ?> 	
                                                    <option  <?php echo $subExtra2 == $value ? 'selected' : '' ?> value="<?php echo $value ?>,<?php echo $w ?>"><?php echo $value ?> </option>				     
                                                    <?php $w++;
                                                } ?>
                                            </select>
                                        </div>
                                    </div>					


                                                <?php
                                            }
                                            ?>
    <?php
    $otros_numero++;
}
?>
                        </div>
                        <!---------------------------PARTE DE LOS OTROS-->			
                        </div>
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
$a = 0;
while ($distancias1 = $distancias->fetch()) {
    /*     * *******************CODIGO PARA SELECCIONA POR**************** */
    $id_casa_editar =$row['ID'];
    $id_extra = $distancias1['id'];
    $stmt_extra = $db->prepare("SELECT * FROM distancias_assign WHERE idExtra='$id_extra' AND idCasa='$id_casa_editar'");
    $stmt_extra->setFetchMode(PDO::FETCH_ASSOC);
    $stmt_extra->execute();
    $row_extra = $stmt_extra->fetch();
    /* PEQUEÑO CODIGO SI ESTA VACIO */
    if (!$row_extra) {
        $datos = ' nada';
    } else {

        $datos = $row_extra['extraDist'];
    }
    $row_datos = explode(" ", $datos);
    /* PEQUEÑO CODIGO SI ESTA VACIO */
    

    /*     * *******************CODIGO PARA SELECCIONA POR**************** */
    ?>   
                                            <label style="cursor:pointer; margin-top:5px;" >                                                 
                                                <p class="grey3 " style="margin:5px 0 10px 0;">Distancia <?php echo $distancias1['distanciaNombre'] ?></p>
                                                <input type="hidden" name="idDist[]" value="<?php echo $distancias1['id'] ?>">
                                                <input value="<?php echo $row_datos[0] ?>" class="uk-input superficie" name="distancia[]" type="text" style="width:74%;">
                                                <div style="width:24%; display:inline-block; vertical-align:middle" class="width_opt"> 
                                                    <select class="form-control" name="unidad[]">
                                                        <option <?php echo $row_datos[1] == 'km' ? 'selected' : '' ?> value="km">Km (Kilómetros) </option>
                                                        <option <?php echo $row_datos[1] == 'm' ? 'selected' : '' ?> value="m">m (Metros)</option>										
                                                    </select>
                                                </div>
                                            </label>

    <?php
    $a++;
}
?>
                                        <input type="hidden" name="controlDist" value="<?php echo $a ?>">	 
                                    </div>


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
                <textarea  id="editor4" name="notas"  class="uk-width-1-1"><?php echo $row['propNotesPrivate'] ?></textarea>
                <script>
                    CKEDITOR.replace('editor4', {
                        filebrowserBrowseUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl: 'filemanager/dialog.php?type=1&editor=ckeditor&fldr='});
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

<div id="preview-modal"></div>


<!-----------------------------------------CUERPO DE LA PAGINA-->


<?php
//include header template
require('modal_clientes.php');
require('../layout/footer.php');
include('../layout/nuevo-cliente.php');
include('../layout/nueva-caracteristica.php');
include('../layout/nueva-distancia.php');


?>
<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyAlD35Pnso2gahg3OiljQnNPyYF6OsLiPo&sensor=false&libraries=places'></script>
<script src="../js/locationpicker.jquery.min.js"></script>
<script>
                             function updateControls(addressComponents) {


                                 $('#map-zip').val(addressComponents.postalCode);

                                 $.ajax({
                                     type: "POST",
                                     url: "<?php echo DIR; ?>layout/zonas",
                                     data: 'poblacion_id=' + addressComponents.postalCode,
                                     success: function (data) {
                                         $("#load-poblaciones").html(data);
                                         $('select.box-gallery-poblaciones')[0].sumo.reload();
                                         $('select.box-gallery-poblaciones')[0].sumo.enable();

                                     }
                                 });
                                 $.ajax({
                                     type: "POST",
                                     url: "<?php echo DIR; ?>layout/poblaciones",
                                     data: 'ciudad_id=' + addressComponents.postalCode,
                                     success: function (data) {
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

                                 zoom: 15,
                                 mapTypeId: google.maps.MapTypeId.HYBRID,
                                 addressFormat: 'street_number',
                                 markerIcon: '<?php echo DIR; ?>images/map-marker.png',
                                 inputBinding: {
                                     latitudeInput: $('#map-lat'),
                                     longitudeInput: $('#map-lon'),
                                     radiusInput: $('#map-radius'),
                                     locationNameInput: $('#map-address')
                                 },
                                 enableAutocomplete: true,
                                 enableAutocompleteBlur: true,
                                 onchanged: function (component) {
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
<script type="text/javascript">

    $(document).ready(function (e) {

        $("#multiFiles").change(function () {
            var form_data = new FormData();
            var ins = document.getElementById('multiFiles').files.length;
            for (var x = 0; x < ins; x++) {
                form_data.append("files[]", document.getElementById('multiFiles').files[x]);
            }
            $('#gallery').show();
            $.ajax({
                url: 'uploads',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                beforeSend: function () {
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
<script type="text/javascript">


    function reloadOwner() {
        var reload = 'si';
        $.ajax({
            type: "POST",
            url: "<?php echo DIR; ?>propiedades/newownerficha",
            data: 'reload=' + reload,
            beforeSend: function () {
                //$(".loader").show();

            },
            success: function (data) {
                //$(".loader").fadeOut("slow");
                $("#loadowner").html(data).fadeIn('slow');
                $("select.box-gallery")[0].sumo.reload();
            }
        });
    }
    function previewGalleryProp(param) {
        var edicion = 'si';
        $.ajax({
            type: "POST",
            url: "<?php echo DIR; ?>zonas/previewgallerygallery",
            data: 'ref=' + param + '&mostrar=' + edicion,
            beforeSend: function () {
                $(".loader").show();
            },
            success: function (data) {
                $(".loader").fadeOut("slow");
                UIkit.modal("#previewgallerypropiedad").show();
                $("#previewgalleryzona").html(data);
                $("select.select-gallery")[0].sumo.reload();

            }
        });
    }
    $(document).on("change", ".superficie", function () {
        var sum = 0;
        $(".superficie").each(function () {
            sum += +$(this).val();
        });
        $(".suptotal").val(sum);
    });
</script>
<!--<script type="text/javascript" language="javascript">
              $(window).bind('beforeunload', function(){
  return "Do you want to exit this page?";
});
    </script>
<script>
        $(window).load(function(){
          $('body').backDetect(function(){
                          var result = window.confirm('This page is asking you to confirm that you want to leave - data you have entered may not be saved');
                          if (result == false) {
              backDetect();
            };
          });
                        
        });
        
    </script>-->
<script type="text/javascript" >
    /*     $(document).ready(function () {*/
    $('.box-gallery-poblaciones').SumoSelect({search: false, searchText: 'Escribir aquí...', selectAll: false, noMatch: 'No hay resultados para "{0}"', captionFormat: '{0} Seleccionados',
        captionFormatAllSelected: '{0} todos seleccionados', locale: ['OK', 'Cancelar', 'Seleccionar todo']});
    $('.car-options').SumoSelect({search: false, searchText: 'Escribir aquí...', selectAll: false, noMatch: 'No hay resultados para "{0}"', captionFormat: '{0} Seleccionados',
        captionFormatAllSelected: '{0} todos seleccionados', locale: ['OK', 'Cancelar', 'Seleccionar todo']});

//$('select.box-gallery-poblaciones')[0].sumo.disable();


    $('.box-gallery-poblaciones1').SumoSelect({search: false, searchText: 'Escribir aquí...', selectAll: false, noMatch: 'No hay resultados para "{0}"', captionFormat: '{0} Seleccionados',
        captionFormatAllSelected: '{0} todos seleccionados', locale: ['OK', 'Cancelar', 'Seleccionar todo']});
    //$('select.box-gallery-poblaciones1')[0].sumo.disable();




    /*});*/

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.box-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...', selectAll: false, noMatch: 'No hay resultadao para "{0}"', captionFormat: '{0} Seleccionados',
            captionFormatAllSelected: '{0} todos seleccionados', locale: ['OK', 'Cancelar', 'Seleccionar todo']});

    });
    $('#property').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    $(document).ready(function () {
        $("#ofertaPrecio").change(function () {
            if ($('#ofertaPrecio').is(':checked')) {
                $('#showPrecioOferta').fadeIn('slow');
            } else {
                $('#showPrecioOferta').fadeOut('slow');}

        });
    });
    $(document).ready(function () {
        $("#ofertaPrecio2").change(function () {
            if ($('#ofertaPrecio2').is(':checked')) {
                $('#showPrecioOferta2').fadeIn('slow');
            } else {
                $('#showPrecioOferta2').fadeOut('slow');
            }

        });
    });
    $(document).ready(function () {
        $("input:radio").change(function () {
            if ($('#precioShow').is(':checked')) {
                $('#pillShow').fadeIn('slow');
                $('#showVacacional').fadeIn('slow');
            } else {
                $('#showVacacional').fadeOut('slow');
            }

        });
    });
    $(document).ready(function () {
        $("input:radio").change(function () {
            if (($('#tipopropiedad3').is(':checked')) || ($('#tipopropiedad4').is(':checked'))) {

                $('#showAlquiler').fadeIn('slow');
            } else {
                $('#showAlquiler').fadeOut('slow');
            }

        });
    });
    $(document).ready(function () {
        $("input:radio").change(function () {
            if ($('#tipopropiedad1').is(':checked')) {
                $('#showVenta').fadeIn('slow');
                $.ajax({
                    type: "POST",
                    url: "<?php echo DIR; ?>layout/generar-ref",
                    data: 'accionref=' + 'venta',
                    success: function (data) {
                        $("#ref-venta").val(data);
                        $("#ref-venta").attr('disabled', false);

                    }
                });
            } else {
                $("#ref-venta").val('');
                $("#ref-venta").attr('disabled', true);
                $('#showVenta').fadeOut('slow');
            }

        });
    });
    $(document).ready(function () {
        $("input:radio").change(function () {
            if (($('#precioShow').is(':checked')) || ($('#tipopropiedad3').is(':checked')) || ($('#tipopropiedad4').is(':checked'))) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo DIR; ?>layout/generar-ref",
                    data: 'accionref=' + 'alquiler',
                    success: function (data) {
                        $("#ref-alquiler").val(data);
                        $("#ref-alquiler").attr('disabled', false);

                    }
                });
            } else {
                $("#ref-alquiler").val('');
                $("#ref-alquiler").attr('disabled', true);
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

        if (tituloES == '' || tituloEN == '' || tituloDE == '') {
            alert('Los Titulos en los 3 idiomas, no debe estar vacio');
            return false;
        }

        if (editor1 == '' || editor2 == '' || editor3 == '') {
            alert('Las descripciones en los 3 idiomas, no debe estar vacio');
            return false;
        }

        if (tituloES_tolowercase == tituloEN_tolowercase || tituloEN_tolowercase == tituloDE_tolowercase || tituloES_tolowercase == tituloDE_tolowercase) {
            alert('Los titulos no deben ser iguales');
            return false;
        }

        var string_es = String(tituloES_tolowercase);

        if (tituloEN_tolowercase.indexOf(string_es) != -1 || tituloDE_tolowercase.indexOf(string_es) != -1) {
            alert('Los titulos no deben ser Similares');
            return false;
        }
        $("#activar").val(param);
        UIkit.modal.confirm('¿Confirma que desea Editar la propiedad?', {center: true, labels: {ok: 'Ok', cancel: 'Volver a edición'}}).then(function () {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
                url: '<?php echo DIR; ?>propiedades/updatepropiedad', // url where to submit the request
                type: "POST", // type of action POST || GET
                dataType: 'text', // data type
                data: $("#property").serialize(), // post data || get data
                success: function (result) {
                    //UIkit.modal.dialog(result);
                    window.location.replace("<?php echo DIR; ?>propiedades/venta");

                },
                error: function (xhr, resp, text, error) {
                    UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> <strong>Ha habido un error al editar. Inténtelo de nuevo.</strong>', status: 'danger', timeout: 2000})
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

    $(window).load(function () {
        $('body').backDetect(function () {
            var result = window.confirm('Estas seguro que desea abandonar esta Página?, Sus datos no se guardaran.');
            if (result == false) {
                backDetect();
            }
            ;
        });

    });
</script>

<!--CODIGO DE ALERTA CUANDO SE SALE DE LA PAGINA-->

<!--HABILITAR OTROS-->
<script>
    function habilitar($otro_numero, $tipo)
    {
        var otro_numero = $otro_numero;
        var tipo = $tipo;
        var input = 'input_' + tipo + '_' + otro_numero;
        var select = 'select_' + tipo + '_' + otro_numero;
        //var checked = $("#"+input).attr('checked');
        var disabled = document.getElementById(select).getAttribute("disabled");

        if (disabled == null) {
            $("#" + select).attr("disabled", true);
        } else {

            $("#" + select).removeAttr("disabled");
        }

        //var cantidad_existente_input = 'carrito_cantidad_existente_'+id_ropa_tienda;
        //var cantidad_articulo        = document.getElementById(id_elemento).value;
        //var cantidad_existente       = document.getElementById(cantidad_existente_input).value;


    }

</script>
<!--HABILITAR OTROS-->

<!--CODIGO DE VENTAS PARA LOS MODALES Y DEMAS-->
<div id="preview-modal"></div>

<?php
//include header template
require('modal_clientes.php');
require('../layout/footer-venta.php');

?>
<?php include ("../layout/galeria-listados.php");?>

<!--JAVASCRIPT PARA TODO-->
<script type="text/javascript">
    function previewModal(param,divid) {
                 $.ajax({
            type: "POST",
            url: "<?php echo DIR;?>propiedades/preview",
            data:{ ref: param, divid: divid },
                     beforeSend: function(){
           $(".loader").show();
          },
            success: function(data){
                $(".loader").fadeOut("slow");
                $("#preview-modal").html(data);


            }
            });
        }



function previewGallery(param,divid) {
         $.ajax({
    type: "POST",
    url: "<?php echo DIR;?>propiedades/previewgallery",
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
            type: "GET",
            cache: false,
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


/*JAVASCRIPT PARA EL MODAL*/
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


/*JAVASCRIPT PARA EL MODAL*/

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
<!--JAVASCRIPT PARA TODO-->
<!--CODIGO DE VENTAS PARA LOS MODALES Y DEMAS-->

