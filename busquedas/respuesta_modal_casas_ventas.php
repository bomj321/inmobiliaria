<?php
require('../includes/config2.php');
$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';

?>
<!--SECCION PARA AGREGAR EDICION-->
<?php
$id = $_POST['yourRef'];
$id2 = str_replace('V', '', $id);
$id2 = $id2 - 1000;

$stmt = $db->prepare("SELECT * FROM properties WHERE yourRef='$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
?>
<!--SECCION PARA AGREGAR EDICION-->

<!-----------------------------------------CUERPO DE LA PAGINA-->
 



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


<!-----------------------------------------CUERPO DE LA PAGINA-->


<?php
//include header template
require('modal_clientes.php');
?>


