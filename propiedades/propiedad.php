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

<?php
include('../layout/menu.php');
?>
<!-----------------------------------------CUERPO DE LA PAGINA-->
<div class="container" style="background-color: white; margin-top: 70px;">
    <form id="addproperty">
        <!--ID DE LA VENTA -->
        <div class="row">
            <h3 class="yellow" style="font-weight:600; margin-top: 30px; margin-left: 30px;"><span uk-icon="icon:plus-circle" class="icon-margin3"></span>


                <?php if (!empty($_GET['action']) AND $_GET['action'] == 'alquiler'): ?>
                    &Aacute;&ntilde;adir nuevo alquiler
                    <input class="uk-radio" type="hidden" value="alquiler" id='es_alquiler' >

                <?php else: ?>
                    &Aacute;&ntilde;adir nueva propiedad
                    <input class="uk-radio" type="hidden" value="no_alquiler" id='es_alquiler' >
                <?php endif ?>




                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Seleccionar tipo de operaci&oa&oacute;n</h5>
                        <?php if (!empty($_GET['action']) AND $_GET['action'] == 'alquiler'): ?>
                            <label style="cursor:pointer"><input name="tipoProp" class="uk-radio" type="radio" value="vacacional" >&nbsp; Alquiler vacacional</label>
                            <label style="cursor:pointer"><input name="tipoProp" class="uk-radio" type="radio" value="anual" >&nbsp; Alquiler anual</label>
                            <label style="cursor:pointer"><input name="tipoProp" class="uk-radio" type="radio" value="temporal" >&nbsp; Alquiler temporal</label>

                        <?php else: ?>
                            <label style="cursor:pointer"><input name="tipoProp" checked class="uk-radio" type="radio" value="venta" >&nbsp; Venta</label>
                        <?php endif ?>




                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Seleccionar tipo de inmueble</h5>
                        <select placeholder="-Seleccionar-" name="tipoProp2" class="form-control">
                            <option >-Seleccionar-</option>
                            <option value="Apartment">Pisos y apartamentos</option>
                            <option value="Villa">Chalet y villas</option>
                            <option value="Country house">Casas y fincas rústicas</option>
                            <option value="Townhouse">Casas de pueblo</option>
                            <option value="Plot">Solares y parcelas</option>


                        </select>
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Estado del inmueble</h5>

                        <label style="cursor:pointer"><input checked name="active" class="uk-radio" type="checkbox" value="1">&nbsp; Activo</label>

                        <label style="cursor:pointer"><input name="estado1" class="uk-radio" type="checkbox" value="vendido">&nbsp; Vendido</label>

                        <label style="cursor:pointer"><input name="estado1" class="uk-radio" type="checkbox" value="reservado">&nbsp; Reservado </label>

                        <label style="cursor:pointer"><input name="estado1" class="uk-radio" type="checkbox" value="alquilado">&nbsp; Alquilado </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                        <h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Propietario/Cliente</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id='loadowner'>

                        <select placeholder="-Seleccionar-" name="propietario" class="form-control box-gallery">
                            <option>-Seleccionar-</option>
                            <?php
                            $clientes = $db->prepare("SELECT distinct(sellerName1),ID FROM owners /*where active='1'*/ order by sellerName1 Asc");
                            $clientes->setFetchMode(PDO::FETCH_ASSOC);
                            $clientes->execute();
                            while ($row2 = $clientes->fetch()) {
                                ?>
                                <option value="<?php echo $row2['ID'] ?>"><?php echo $row2['sellerName1']; ?></option>
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
                        <h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Localizaci&oacute;n del inmueble</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-top: 20px;">
                        <div class="form-group">
                            <label for="map-address">Direcci&oacute;/Poblaci&oacute;n/Ciudad</label>
                            <input type="text" class="form-control" id="map-address" type="text" name="direccion" placeholder="Introduzca la direcci&oacute;n  para completar los campos autom&aacute;ticamente...">
                        </div>

                        <!-------------------------------SEPARAR LATITUD Y LONGITUD y OTROS-->

                        <!-------------------------------SEPARAR LATITUD Y LONGITUD y OTROS-->


                        <div class="form-group">
                            <label for="map-city">Poblaci&oacute;n</label>
                            <select placeholder="-Seleccionar poblaci&oacute;n-" class="form-control box-gallery-poblaciones1" id="map-city" name="poblacion">
                                <option ></option>
                            </select>
                        </div>


                        <div class="form-row">
                            <div class="col">
                                <label for="Latitud">Latitud</label>
                                <input type="text" class="form-control" name="latitud" id="map-lat" placeholder="Latitud">
                            </div>
                            <div class="col">
                                <label for="Longitud">Longitud</label>
                                <input name="longitud" id="map-lon" type="text" class="form-control" placeholder="Longitud">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="load-poblaciones">Elegir zona (se utiliza para indicar el barrio, &Aacute;rea exacta...) </label>
                            <select class="form-control box-gallery-poblaciones" name="zona" id="load-poblaciones">
                                <option></option>
                            </select>
                        </div>

                        <div class="form-group form-check">
                            <input class="form-check-input" name="mostrarDireccion" value="si" type="checkbox" id='mostrarDireccion'  style="cursor:pointer; margin-right: 100px;">
                            <label class="form-check-label" for="mostrarDireccion" style="cursor:pointer">
                                �Mostrar la direcci&oacute;n exacta?
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
                            <!-- <div class="col">
                              <label for="refVenta">Referencia venta</label>
                               <input type="text" class="form-control"  id="refVenta" name="refVenta" type="text" >
                             </div>
                             <div class="col">
                               <label for="refAlquiler">Referencia alquiler</label>
                               <input id=refAlquiler" class="form-control" name="refAlquiler" type="text" disabled>
                             </div>-->

                            <label for="precioVenta">Precio de Venta  o Alquiler</label>
                            <input id="precioVenta" class="form-control" name="precioVenta" type="text">
                        </div>

     <?php if (empty($_GET['action'])): ?>
                        <div class="form-group">

                            <label for="clasifEnergia">"ClasifEnergia"</label>
                            <input id="clasifEnergia" class="form-control" name="clasifEnergia" type="text">
                        </div>

              <?php endif?>
                    </div>


                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <p style="margin-top: 20px;"><strong><i uk-icon="icon:warning;"></i> La asignaci&oacute;n de precios de la propiedad en alquiler vacacional se realizar&aacute; una vez guardada la propiedad</strong></p>
                    </div>

                </div>
                <?php if (!empty($_GET['action']) AND $_GET['action'] == 'alquiler'): ?>
                    <!--ATRIBUTOS AGREGADOS DESPUES-->

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="rentalType">Tipo de Renta:</label>
                                <label id="rentalType" style="cursor:pointer"><input name="rentalType" class="uk-radio" type="radio" value="short">&nbsp; Corta</label>
                                <label id="rentalType" style="cursor:pointer"><input name="rentalType" class="uk-radio" type="radio" value="long">&nbsp; Larga</label>

                            </div>
                            <div class="form-group">
                                <label for="propSleepsFrom">Dormir desde</label>
                                <input type="text" class="form-control" id="propSleepsFrom" name='propSleepsFrom' placeholder="Dormir desde...">
                            </div>

                            <div class="form-group">
                                <label for="propSleepsTo">Dormir hasta</label>
                                <input type="text" class="form-control" id="propSleepsTo" name='propSleepsTo' placeholder="Dormir hasta...">
                            </div>

                            <div class="form-group">
                                <label for="propETV ">ETV</label>
                                <select class="form-control" id="propETV" name="propETV">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="propETVnum">N&uacute;mero ETV</label>
                                <input type="text" class="form-control" id="propETVnum" name='propETVnum' placeholder="N&uacute;mero ETV">
                            </div>

                            <div class="form-group">
                                <label for="avantio">Avantio</label>
                                <input type="text" class="form-control" id="avantio" name='avantio' placeholder="Avantio">
                            </div>
                        </div>
                    </div>
                <?php endif ?>

                <!--ATRIBUTOS AGREGADOS DESPUES-->

                <!------------------------------SECCION DE DETALLES GENERALES-->
                <hr>

                <!----------------SECCION EDITOR ARREGLAR-->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-fade">
                            <li>
                                <a href="#"> <p class="grey3" style="margin:5px 0 5px 0;"><img src="../images/castellano-flag.png">&nbsp; Informaci&oacute;n general castellano</p></a>
                            </li>
                            <li>
                                <a href="#"><p class="grey3" style="margin:5px 0 5px 0;"><img src="../images/uk-flag.png">&nbsp; Informaci&oacute;n general Ingl&eacute;s</p></a>
                            </li>
                            <li>
                                <a href="#"><p class="grey3" style="margin:5px 0 5px 0;"><img src="../images/deustche-flag.png">&nbsp; Información general Alem&&aacute;n</p></a>
                            </li>
                        </ul>

                        <ul class="uk-switcher uk-margin">
                            <li>
                                <div class="uk-width-1-1 uk-margin-bottom">
                                    <p class="grey3" style="margin:5px 0 10px 0;"> <strong>Título castellano</strong></p>
                                    <input id="tituloES" class="uk-input" name="tituloES" type="text">
                                </div>
                                <p class="grey3 uk-margin-bottom" style="margin:5px 0 10px 0;"> <strong>Descripción castellano</strong></p>
                                <textarea  id="editor1"  name="descripES" class="uk-width-1-1"></textarea>
                                <script>
                                    CKEDITOR.replace('editor1', {
                                        filebrowserBrowseUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl: '../filemanager/dialog.php?type=1&editor=ckeditor&fldr='});
                                </script>
                            </li>


                            <li>
                                <div class="uk-width-1-1 uk-margin-bottom">
                                    <p class="grey3" style="margin:5px 0 10px 0;"> <strong>Título inglés</strong></p>
                                    <input id="tituloEN" class="uk-input" name="tituloEN" type="text">
                                </div>
                                <p class="grey3 uk-margin-bottom" style="margin:5px 0 10px 0;"> <strong>Descripción inglés</strong></p>
                                <textarea  id="editor2"  name="descripEN"  class="uk-width-1-1"></textarea>
                                <script>
                                    CKEDITOR.replace('editor2', {
                                        filebrowserBrowseUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl: '../filemanager/dialog.php?type=1&editor=ckeditor&fldr='});
                                </script>

                            </li>

                            <li>
                                <div class="uk-width-1-1 uk-margin-bottom">
                                    <p class="grey3" style="margin:5px 0 10px 0;"> <strong>Título alemán</strong></p>
                                    <input id="tituloDE" class="uk-input" name="tituloDE" type="text">
                                </div>
                                <p class="grey3 uk-margin-bottom" style="margin:5px 0 10px 0;"> <strong>Descripción alemán</strong></p>
                                <textarea  id="editor3"  name="descripDE" class="uk-width-1-1"></textarea>

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
                                <label for="útil">Superficie &Uacute;til</label>
                                <input class="form-control" name="supUtil" type="text">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label for="terraza">Superficie terraza</label>
                                <input  class="form-control" name="supTerraza" type="text">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label for="terreno">Superficie terreno</label>
                                <input  class="form-control" name="supTerreno" type="text">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label for="total">Superficie total</label>
                                <input class="form-control" name="supTotal" type="text">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px; margin-top: 20px;">Distribuci&oacute;n</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label for="útil">N� de habitaciones sencillas</label>
                                <input class="form-control" name="habSimple" type="text">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label for="terraza">N� de habitaciones dobles</label>
                                <input  class="form-control" name="habDoble" type="text">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label for="terreno">N� de ba&ntilde;os</label>
                                <input  class="form-control" name="banos" type="text">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label for="total">N� de aseos</label>
                                <input class="form-control" name="aseos" type="text">
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
                            <input class="form-check-input" name="destacada" value="si" type="checkbox" style="cursor:pointer" id='destacada'>
                            <label class="form-check-label" for="destacada" style="cursor:pointer">
                                �Propiedad <strong>destacada en portada</strong>?
                            </label>
                        </div>

                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group form-check">
                            <input class="form-check-input" name="lujo" value="si" type="checkbox" style="cursor:pointer" id='lujo'>
                            <label class="form-check-label" for="lujo" style="cursor:pointer">
                                �Es una propiedad considerada de <strong>lujo</strong>?
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group form-check" >
                            <input class="form-check-input" name="nueva" value="si" type="checkbox" id='nueva'  style="cursor:pointer">
                            <label class="form-check-label" for="nueva" style="cursor:pointer">
                                �Es una propiedad considerada de <strong>obra nueva</strong>?
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group form-check">
                            <input class="form-check-input" name="portada" value="si" type="checkbox" id='portada'  style="cursor:pointer">
                            <label class="form-check-label" for="portada" style="cursor:pointer">
                                �Propiedad en<strong> slider  de portada</strong>?
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
                                <a href="#"> <p class="grey3" style="margin:5px 0 5px 0;"><i uk-icon="icon:cog; ratio:0.9" class="icon-margin3"></i>&nbsp;  Extras/Caracter&iacute;sticas</p></a>
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
                                <div class="uk-width-1-1 uk-margin-bottom"><!---------------------------DIV DE INFORMACION GENERAL-->
                                    <?php if (!isset($_GET['action']) AND empty($_GET['action'])): ?>
                                        <!--Distribución-->
                                        <p class="grey-titles"><strong>Distribuci&oacute;n</strong></p>
                                        <div class=" uk-grid-medium uk-child-width-auto uk-grid "><!--EXTRAS REVISAR TABLA-->
                                            <?php
                                            $distribucion_numero = 0;

                                            $extras = $db->prepare("SELECT DISTINCT id, extraNombre, extraOptions,extraCat FROM extras_properties where extraActivo='si' and extraCat='distribucion' order by extraNombre Asc");
                                            $extras->setFetchMode(PDO::FETCH_ASSOC);
                                            $extras->execute();
                                            while ($extras1 = $extras->fetch()) {
                                                ?>
                                                <?php $options = explode(',', $extras1['extraOptions']); ?>
                                                <?php
                                                if ($extras1['extraOptions'] == "") {
                                                    ?>
                                                    <label style="cursor:pointer; margin-top:5px;">
                                                        <input id='input_distribucion_<?php echo $distribucion_numero ?>' name="extra1[]" onclick="habilitar(<?php echo $distribucion_numero ?>, 'distribucion')" class="uk-checkbox" name="extra1[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                                    </label>
                                                    <?php
                                                    if ($extras1['extraCat'] == "") {
                                                        ?>
                                                        <input id='input_distribucion_<?php echo $distribucion_numero ?>' name="extra1[]" onclick="habilitar(<?php echo $distribucion_numero ?>, 'distribucion')" class="uk-input superficie" type="text" style="width: 65px; margin-left: 15px !important; padding: 10px;"><div style="width:135px; display:inline-block; margin-left:-31px; vertical-align:middle" class="width_opt">
                                                            <select disabled class="form-control">
                                                                <option>d&iacute;a</option>
                                                                <option>total</option>
                                                                <option>kWh</option>
                                                                <option>litro gasoil</option>
                                                            </select>
                                                        </div>
                                                    <?php } ?>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <label style="cursor:pointer; margin-top:5px;" >
                                                        <input id='input_distribucion_<?php echo $distribucion_numero ?>' class="uk-checkbox" name="extra1[]" onclick="habilitar(<?php echo $distribucion_numero ?>, 'distribucion')" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                                    </label><div style="min-width:210px; display:inline-block; margin-left:-20px;" class="width_opt">
                                                        <select disabled id='select_distribucion_<?php echo $distribucion_numero ?>' class="form-control" placeholder="-Seleccionar-" name="extra1Cat[]">
                                                            <?php
                                                            $w = 0;
                                                            foreach ($options as $value) {
                                                                ?>
                                                                <option value="<?php echo $value ?>,<?php echo $w ?>"><?php echo $value ?> </option>
                                                                <?php
                                                                $w++;
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
                                        <p class="grey-titles"><strong>Ba&ntilde;os</strong></p>
                                        <div class=" uk-grid-medium uk-child-width-auto uk-grid ">
                                            <?php
                                            $banos_numero = 0;
                                            $extras = $db->prepare("SELECT DISTINCT id, extraNombre, extraOptions,extraCat FROM extras_properties where extraActivo='si' and extraCat='banos' order by extraNombre Asc");
                                            $extras->setFetchMode(PDO::FETCH_ASSOC);
                                            $extras->execute();
                                            while ($extras1 = $extras->fetch()) {
                                                ?>
                                                <?php $options = explode(',', $extras1['extraOptions']); ?>
                                                <?php
                                                if ($extras1['extraOptions'] == "") {
                                                    ?>
                                                    <label style="cursor:pointer; margin-top:5px;">
                                                        <input id='input_banos_<?php echo $banos_numero ?>' onclick="habilitar(<?php echo $banos_numero ?>, 'banos')" class="uk-checkbox" name="extra2[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                                    </label><input type="hidden" name="extra2Cat[]" value="no">
                                                    <?php
                                                    if ($extras1['extraCat'] == "") {
                                                        ?>
                                                        <input class="uk-input superficie" type="text" style="width: 65px; margin-left: 15px !important; padding: 10px;">
                                                        <select disabled class="form-control">
                                                            <option>d&iacute;a</option>
                                                            <option>total</option>
                                                            <option>kWh</option>
                                                            <option>litro gasoil</option>
                                                        </select>
                                                    </div>
                                                <?php }
                                                ?>
                                                <?php
                                            } else {
                                                ?>
                                                <label style="cursor:pointer; margin-top:5px;" >
                                                    <input id='input_banos_<?php echo $banos_numero ?>' onclick="habilitar(<?php echo $banos_numero ?>, 'banos')" class="uk-checkbox" name="extra2[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                                </label>
                                                <div style="min-width:210px; display:inline-block; margin-left:-20px;" class="width_opt">
                                                    <select disabled id='select_banos_<?php echo $banos_numero ?>' class="form-control" placeholder="-Seleccionar-" name="extra2Cat[]">
                                                        <?php
                                                        $w = 0;
                                                        foreach ($options as $value) {
                                                            ?>
                                                            <option value="<?php echo $value ?>,<?php echo $w ?>"><?php echo $value ?> </option>
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
                                            ?>
                                            <?php $options = explode(',', $extras1['extraOptions']); ?>
                                            <?php
                                            if ($extras1['extraOptions'] == "") {
                                                ?>
                                                <label style="cursor:pointer; margin-top:5px;">
                                                    <input id='input_accesorio_<?php echo $accesorio_numero ?>' onclick="habilitar(<?php echo $accesorio_numero ?>, 'accesorio')" class="uk-checkbox" name="extra3[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                                    <?php
                                                    if ($extras1['extraCat'] == "") {
                                                        ?>
                                                        <input class="uk-input superficie" type="text" style="width: 65px; margin-left: 15px !important; padding: 10px;">
                                                        <div style="width:135px; display:inline-block; margin-left:-31px; vertical-align:middle" class="width_opt">
                                                            <select disabled class="form-control">
                                                                <option>d&iacute;a</option>
                                                                <option>total</option>
                                                                <option>�kWh</option>
                                                                <option>litro gasoil</option>
                                                            </select>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <label style="cursor:pointer; margin-top:5px;" >
                                                        <input id='input_accesorio_<?php echo $accesorio_numero ?>' onclick="habilitar(<?php echo $accesorio_numero ?>, 'accesorio')" class="uk-checkbox" name="extra3[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                                    </label>
                                                    <div style="min-width:210px; display:inline-block;" class="width_opt">
                                                        <select disabled id='select_accesorio_<?php echo $accesorio_numero ?>' class="form-control" placeholder="-Seleccionar-" name="extra3Cat[]">
                                                            <?php
                                                            $w = 0;
                                                            foreach ($options as $value) {
                                                                ?>
                                                                <option value="<?php echo $value ?>,<?php echo $w ?>"><?php echo $value ?> </option>
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
                                    <!--JARDIN EXterior-->

                                    <p class="grey-titles"><strong>Jard&iacute;/Exterior</strong></p>
                                    <div class=" uk-grid-medium uk-child-width-auto uk-grid ">
                                        <?php
                                        $jardin_numero = 0;
                                        $extras = $db->prepare("SELECT DISTINCT id, extraNombre, extraOptions,extraCat FROM extras_properties where extraActivo='si' and extraCat='jardin' order by extraNombre Asc");
                                        $extras->setFetchMode(PDO::FETCH_ASSOC);
                                        $extras->execute();
                                        while ($extras1 = $extras->fetch()) {
                                            ?>
                                            <?php $options = explode(',', $extras1['extraOptions']); ?>
                                            <?php
                                            if ($extras1['extraOptions'] == "") {
                                                ?>
                                                <label style="cursor:pointer; margin-top:5px;" >
                                                    <input id='input_jardin_<?php echo $jardin_numero ?>' onclick="habilitar(<?php echo $jardin_numero ?>, 'jardin')" class="uk-checkbox" name="extra4[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                                </label>
                                                <?php
                                                if ($extras1['extraCat'] == "") {
                                                    ?>
                                                    <input class="uk-input superficie" type="text" style="width: 65px;margin-left: 15px !important;padding: 10px;">
                                                    <div style="width:135px; display:inline-block; margin-left:-31px; vertical-align:middle" class="width_opt">
                                                        <select disabled class="form-control">
                                                            <option>d&iacute; </option>
                                                            <option>total</option>
                                                            <option>kWh</option>
                                                            <option>litro gasoil</option>
                                                        </select>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                            } else {
                                                ?>
                                                <label style="cursor:pointer; margin-top:5px;" >
                                                    <input id='input_jardin_<?php echo $jardin_numero ?>' onclick="habilitar(<?php echo $jardin_numero ?>, 'jardin')" class="uk-checkbox" name="extra4[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                                </label>
                                                <div style="min-width:210px; display:inline-block; margin-left:-20px;" class="width_opt">
                                                    <select disabled id='select_jardin_<?php echo $jardin_numero ?>' class="form-control" placeholder="-Seleccionar-" name="extra4Cat[]">
                                                        <?php
                                                        $w = 0;
                                                        foreach ($options as $value) {
                                                            ?>
                                                            <option value="<?php echo $value ?>,<?php echo $w ?>"><?php echo $value ?> </option>
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
                                    <!--JARDIN EXterior-->

                                    <!---------------------------PARTE DE LOS OTROS-->
                                    <p class="grey-titles"><strong>Otros</strong></p>
                                    <div class="row">
                                        <?php
                                        $otros_numero = 0;
                                        $extras = $db->prepare("SELECT DISTINCT id, extraNombre, extraOptions,extraCat FROM extras_properties where extraActivo='si' and extraCat='otros' order by extraNombre Asc");
                                        $extras->setFetchMode(PDO::FETCH_ASSOC);
                                        $extras->execute();
                                        while ($extras1 = $extras->fetch()) {
                                            ?>
                                            <?php $options = explode(',', $extras1['extraOptions']); ?>
                                            <?php
                                            if ($extras1['extraOptions'] == "") {
                                                ?>
                                                <div class='col-md-6' style='margin-top:30px;'>
                                                    <label style="cursor:pointer; margin-top:5px; margin-right:40px;" >					 	<input id='input_otros_<?php echo $otros_numero ?>' onclick="habilitar(<?php echo $otros_numero ?>, 'otros')" class="uk-checkbox" name="extra5[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                                    </label>
                                                    <?php
                                                    if ($extras1['extraCat'] == "") {
                                                        ?>
                                                        <input class="uk-input superficie" type="text" style="width: 65px; margin-left: 15px !important;padding: 10px;">
                                                        <div style="width:135px; display:inline-block; margin-left:-31px; vertical-align:middle" class="width_opt">
                                                            <select disabled class="form-control">
                                                                <option>d&iacute;  </option>
                                                                <option>total</option>
                                                                <option>kWh</option>
                                                                <option>litro gasoil</option>
                                                            </select>
                                                        </div>

                                                    </div>


                                                <?php }
                                                ?>
                                                <?php
                                            } else {
                                                ?>

                                                <div class="form-group col-md-4">

                                                    <div class="row">                                               <div class="col-md-6 col-sm-6 col-xs-6">
                                                            <label style="cursor:pointer; margin-top:5px;" >
                                                                <input id='input_otros_<?php echo $otros_numero ?>' onclick="habilitar(<?php echo $otros_numero ?>, 'otros')" class="uk-checkbox" name="extra5[]" type="checkbox" value="<?php echo $extras1['id'] ?>">&nbsp; <?php echo $extras1['extraNombre'] ?>
                                                            </label>

                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                            <select disabled  id='select_otros_<?php echo $otros_numero ?>' class="form-control" placeholder="-Seleccionar-" name="extra5Cat[]">
                                                                <?php
                                                                $w = 0;
                                                                foreach ($options as $value) {
                                                                    ?>
                                                                    <option value="<?php echo $value ?>,<?php echo $w ?>"><?php echo $value ?> </option>
                                                                    <?php
                                                                    $w++;
                                                                }
                                                                ?>

                                                            </select>
                                                        </div>
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
                                <?php else: ?>
                                    <?php
                                    $stmt = $db->prepare("SELECT * FROM extras_alquileres ORDER BY id_extra asc");
                                    /* $stmt = $db->prepare("SELECT yourRef,sellerID,propTown,propLocation,propNameES,propType,propPrice,ID FROM rentals_2 ORDER BY yourRef limit 50" ); */
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    $stmt->execute();
                                    $i = 0;
                                    while ($row = $stmt->fetch()) {
                                        ?>

                                        <!--PARTE DEL COLLASE NUEVO PARA EXTRAS ALQUILERES-->
                                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="heading<?php echo $i ?>">
                                                    <h4 class="panel-title">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>" aria-expanded="true" aria-controls="collapse<?php echo $i ?>">
                                                                    <?php echo $row['name_es'] ?>
                                                                </a>
                                                            </div>
                                                        </div>


                                                    </h4>
                                                </div>
                                                <div id="collapse<?php echo $i ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i ?>">
                                                    <div class="panel-body"><!--PANEL BODY-->
                                                        <!--ID DEL EXTRA-->
                                                        <input value="<?php echo $row['id_extra'] ?>" type="hidden" class="form-control" id="id_extra" name="id_extra[]">
                                                        <!--ID DEL EXTRA-->
                                                        <!--------------------------PANEL DE EXTRAS-->
                                                        <input type="hidden" name='name_es<?php echo $i ?>' value="<?php echo $row['name_es'] ?>">
                                                        <!--------------------------PANEL DE EXTRAS-->
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">CONDICIONES DE APLICACI&Oacute;N DEL SERVICIO</div>
                                                            <div class="panel-body">
                                                                <div class="form-group">
                                                                    <label for="aplica">�Cu&aacute;ndo se aplica?<span style="color: red;">*</span></label>
                                                                    <select onchange="tipo_formulario_ajax_add(<?php echo $i ?>)" class="form-control" id="aplica<?php echo $i ?>" required="true" name="aplica<?php echo $i ?>">
                                                                        <option <?php echo $row['aplica'] == '0' ? 'selected' : '' ?> value="0">No se aplica nunca (no disponible)</option>
                                                                        <option <?php echo $row['aplica'] == '1' ? 'selected' : '' ?> value="1">Se aplica si lo elije el turista</option>
                                                                        <option <?php echo $row['aplica'] == '2' ? 'selected' : '' ?> value="2">Se aplica siempre</option>
                                                                        <option <?php echo $row['aplica'] == '3' ? 'selected' : '' ?> value="3">Se aplica seg&uacte;n el n&uacte;mero de ocupantes</option>
                                                                        <option <?php echo $row['aplica'] == '4' ? 'selected' : '' ?> value="4">Se aplica seg&uacte;n el n&uacte;mero de noches de reserva</option>
                                                                        <option <?php echo $row['aplica'] == '5' ? 'selected' : '' ?> value="5">Se aplica seg&uacte;n el n&uacte;mero de noches previas a reservas</option>
                                                                    </select>
                                                                </div>
                                                                <!--RESPUESTA AJAX INICIO-->
                                                                <div id='tipo_formulario_parte_1<?php echo $i ?>'>
                                                                    <?php if ($row['aplica'] != '0'): ?>

                                                                        <div class="form-inline form-group">
                                                                            <div class="form-group" style='margin-right: 3rem;'>
                                                                                <label >�N&uacute;mero?</label>
                                                                            </div>

                                                                            <?php if ($row['cantidad_ocupantes'] != '-'): ?><!--PARTE DE LA CANTIDAD DE OCUPANTES-->
                                                                                <?php $separado_aplica = explode("-", $row['cantidad_ocupantes']); ?>
                                                                                <div class="form-group">
                                                                                    <select style='margin-right: 3rem;' class="form-control" id="cantidad_ocupantes_1<?php echo $i ?>" required="true" name="cantidad_ocupantes_1<?php echo $i ?>">
                                                                                        <option <?php echo $separado_aplica[0] == '0' ? 'selected' : '' ?> value="0">menor a</option>
                                                                                        <option <?php echo $separado_aplica[0] == '1' ? 'selected' : '' ?> value="1">igual a</option>
                                                                                        <option <?php echo $separado_aplica[0] == '2' ? 'selected' : '' ?> value="2">mayor a</option>
                                                                                    </select>
                                                                                    <input value="<?php echo $separado_aplica[1] ?>" type="text" class="form-control" id="cantidad_ocupantes_2<?php echo $i ?>" placeholder="Cantidad" name="cantidad_ocupantes_2<?php echo $i ?>">
                                                                                </div>
                                                                            <?php endif ?>	<!--PARTE DE LA CANTIDAD DE OCUPANTES-->



                                                                        </div>


                                                                        <div class="form-group">
                                                                            <label for="temporadas">�En qu&eacute; temporadas?</label>
                                                                            <select onchange="temporadas_formulario_ajax_add(<?php echo $i ?>)" class="form-control" id="temporadas<?php echo $i ?>" required="true" name="temporadas<?php echo $i ?>">
                                                                                <option <?php echo $row['temporadas'] == '0' ? 'selected' : '' ?> value="0">Todo el A&ntilde;o</option>
                                                                                <option <?php echo $row['temporadas'] == '1' ? 'selected' : '' ?> value="1">Temporadas Espec&iacute;ficas</option>
                                                                            </select>
                                                                        </div>


                                                                        <!--RESPUESTA AJAX TEMPORADAS-->
                                                                        <div id='temporada_formulario<?php echo $i ?>'>
                                                                            <?php if ($row['temporadas'] != null): ?><!--PARTE DE LA TEMPORADA-->
                                                                                <div class="form-inline form-group">
                                                                                    <div class="form-group " style='margin-right: 5rem;'>
                                                                                        <label >Temporadas</label>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input value='<?php echo $row['start_temporada'] ?>' style='margin-right: 3rem;' type="date" class="form-control" id="start_temporada<?php echo $i ?>" name="start_temporada<?php echo $i ?>">
                                                                                        <input value='<?php echo $row['end_temporada'] ?>' type="date" class="form-control" id="end_temporada<?php echo $i ?>" name="end_temporada<?php echo $i ?>">
                                                                                    </div>
                                                                                </div>
                                                                            <?php endif ?>	<!--PARTE DE LA TEMPORADA-->
                                                                        </div>
                                                                        <!--RESPUESTA AJAX TEMPORADAS-->

                                                                        <div class="form-group">
                                                                            <label for="cantidad">�Se puede elegir m&aacute;s de uno?</label>
                                                                            <select onchange="cantidad_formulario_ajax_add(<?php echo $i ?>)" class="form-control" id="cantidad<?php echo $i ?>" required="true" name="cantidad<?php echo $i ?>">
                                                                                <option <?php echo $row['cantidad'] == '0' ? 'selected' : '' ?> value="0">No</option>
                                                                                <option <?php echo $row['cantidad'] == '1' ? 'selected' : '' ?> value="1">S&iacute;</option>
                                                                            </select>
                                                                        </div>

                                                                        <!--RESPUESTA AJAX CANTIDAD FORMULARIO-->
                                                                        <div id='cantidad_formulario<?php echo $i ?>'>
                                                                            <?php if ($row['max_cantidad'] != null): ?><!--PARTE DE LA TEMPORADA-->

                                                                                <div class="form-group">
                                                                                    <label for="max_cantidad">�M&aacute;ximo de unidades?</label>
                                                                                    <select class="form-control" id="max_cantidad<?php echo $i ?>" required="true" name="max_cantidad<?php echo $i ?>">
                                                                                        <?php for ($i = 1; $i <= 150; $i++) { ?>
                                                                                            <option <?php echo $row['max_cantidad'] == $i ? 'selected' : '' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                                                                                        <?php } ?>
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
                                                        <div id='tipo_formulario_parte_2<?php echo $i ?>'>
                                                            <?php if ($row['aplica'] != '0'): ?>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">TARIFAS DEL SERVICIO</div>
                                                                    <div class="panel-body">
                                                                        <div class="form-group">
                                                                            <label for="precio_incluido">�Est&aacute; incluido en el precio?</label>
                                                                            <select onchange="precio_formulario_ajax_add(<?php echo $i ?>)" class="form-control" id="precio_incluido<?php echo $i ?>" required="true" name="precio_incluido<?php echo $i ?>">
                                                                                <option <?php echo $row['precio_incluido'] == '0' ? 'selected' : '' ?> value="0">No</option>
                                                                                <option <?php echo $row['precio_incluido'] == '1' ? 'selected' : '' ?> value="1">Si</option>
                                                                            </select>
                                                                        </div>
                                                                        <!--RESPUESTA AJAX PRECIO-->
                                                                        <div id='precio_formulario_parte_1<?php echo $i ?>'>
                                                                            <?php if ($row['a_que_precio'] != '-'): ?>
                                                                                <?php $separado_precio = explode("-", $row['a_que_precio']); ?>

                                                                                <div class="form-inline form-group">
                                                                                    <div class="form-group " style='margin-right: 3rem;'>
                                                                                        <label >�A qu&eacute; precio?</label>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input value="<?php echo $separado_precio[0] ?>" style='margin-right: 3rem;' type="text" class="form-control" id="a_que_precio_1<?php echo $i ?>" placeholder="Precio" name="a_que_precio_1<?php echo $i ?>">
                                                                                        <select class="form-control" id="a_que_precio_2<?php echo $i ?>" required="true" name="a_que_precio_2<?php echo $i ?>">
                                                                                            <option <?php echo $separado_precio[1] == '0' ? 'selected' : '' ?>value="0">por reserva</option>
                                                                                            <option <?php echo $separado_precio[1] == '1' ? 'selected' : '' ?>value="1">por d&iacute;a</option>
                                                                                            <option <?php echo $separado_precio[1] == '2' ? 'selected' : '' ?>value="2">por persona</option>
                                                                                            <option <?php echo $separado_precio[1] == '3' ? 'selected' : '' ?>value="3">por persona y d&iacute;a</option>
                                                                                            <option <?php echo $separado_precio[1] == '4' ? 'selected' : '' ?>value="4">por hora</option>
                                                                                            <option <?php echo $separado_precio[1] == '5' ? 'selected' : '' ?>value="5">por Kw</option>
                                                                                            <option <?php echo $separado_precio[1] == '6' ? 'selected' : '' ?>value="6">% del precio de la reserva</option>
                                                                                            <option <?php echo $separado_precio[1] == '7' ? 'selected' : '' ?>value="7">por litro</option>
                                                                                            <option <?php echo $separado_precio[1] == '8' ? 'selected' : '' ?>value="8">por metro cúbico</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            <?php endif ?>
                                                                        </div>
                                                                        <!--RESPUESTA AJAX PRECIO-->

                                                                        <div class="form-group">
                                                                            <label for="iva">IVA aplicado</label>
                                                                            <select class="form-control" id="iva<?php echo $i ?>" required="true" name="iva<?php echo $i ?>">
                                                                                <option <?php echo $row['iva'] == '0' ? 'selected' : '' ?> value="0">Exento(0 %)</option>
                                                                                <option <?php echo $row['iva'] == '1' ? 'selected' : '' ?> value="1">Exento ventas intracomunitarias (0 %)</option>
                                                                                <option <?php echo $row['iva'] == '2' ? 'selected' : '' ?> value="2">Exento ventas internacionales no intracomunitarias (0 %)</option>
                                                                                <option <?php echo $row['iva'] == '3' ? 'selected' : '' ?> value="3">No sujeto (0 %)</option>
                                                                                <option <?php echo $row['iva'] == '4' ? 'selected' : '' ?> value="4">Superreducido (4 %)</option>
                                                                                <option <?php echo $row['iva'] == '5' ? 'selected' : '' ?> value="5">IGIC (7 %)</option>
                                                                                <option <?php echo $row['iva'] == '6' ? 'selected' : '' ?> value="6">Reducido (10 %)</option>
                                                                                <option <?php echo $row['iva'] == '7' ? 'selected' : '' ?> value="7">General (21 %)</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!--RESPUESTA AJAX PRECIO PARTE 2-->
                                                                <div id='precio_formulario_parte_2<?php echo $i ?>'>
                                                                    <?php if ($row['precio_incluido'] == '1'): ?>
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading">PAGO DEL SERVICIO</div>
                                                                            <div class="panel-body">
                                                                                <div class="form-group">
                                                                                    <label for="cuando_se_paga">�Cu&aacute;ndo se paga?</label>
                                                                                    <select class="form-control" id="cuando_se_paga<?php echo $i ?>" required="true" name="cuando_se_paga<?php echo $i ?>">
                                                                                        <option <?php echo $row['cuando_se_paga'] == '0' ? 'selected' : '' ?> value="0">Al realizar la reserva</option>
                                                                                        <option <?php echo $row['cuando_se_paga'] == '1' ? 'selected' : '' ?> value="1">A pagar en destino</option>
                                                                                        <option <?php echo $row['cuando_se_paga'] == '2' ? 'selected' : '' ?> value="2">A pagar con el &uacute;ltimo pago antes de la llegada</option>
                                                                                    </select>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    <?php endif ?>
                                                                </div>
                                                                <!--RESPUESTA AJAX PRECIO PARTE 2-->


                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">D&Iacute;AS DE ASIGNACI&Oacute;N POR DEFECTO EN LA RESERVA</div>
                                                                    <div class="panel-body">
                                                                        <div class="form-inline">
                                                                            <label style="margin-right: 50px;">�En qu&eacute; d&iacute;a se aplica?</label>

                                                                            <label class="radio-inline">
                                                                                <input <?php echo $row['que_dia_aplica'] == '0' ? 'checked' : '' ?> type="radio" name="que_dia_aplica<?php echo $i ?>" id="inlineRadio1<?php echo $i ?>" value="0"> En la fecha de entrada
                                                                            </label>


                                                                            <label class="radio-inline">
                                                                                <input <?php echo $row['que_dia_aplica'] == '1' ? 'checked' : '' ?> type="radio" name="que_dia_aplica<?php echo $i ?>" id="inlineRadio2<?php echo $i ?>" value="1"> En la fecha de salida
                                                                            </label>

                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">PROVEEDOR</div>
                                                                    <div class="panel-body">
                                                                        <div class="form-group">
                                                                            <label for="proveedores">Proveedor</label>
                                                                            <select class="form-control" id="proveedores<?php echo $i ?>" required="true" name="proveedores<?php echo $i ?>">
                                                                                <option <?php echo $row['proveedores'] == '0' ? 'selected' : '' ?> value="0">Sin Datos</option>
                                                                                <option <?php echo $row['proveedores'] == '1' ? 'selected' : '' ?> value="1">Endesa-Gesa</option>
                                                                                <option <?php echo $row['proveedores'] == '2' ? 'selected' : '' ?> value="2">Fotovolt&aacute;ico-Propietario</option>
                                                                                <option <?php echo $row['proveedores'] == '3' ? 'selected' : '' ?> value="3">IBred</option>
                                                                                <option <?php echo $row['proveedores'] == '4' ? 'selected' : '' ?> value="4">Mallorca Wifi</option>
                                                                                <option <?php echo $row['proveedores'] == '5' ? 'selected' : '' ?> value="5">Movistar Telefonica</option>
                                                                                <option <?php echo $row['proveedores'] == '6' ? 'selected' : '' ?> value="6">Propietario</option>
                                                                                <option <?php echo $row['proveedores'] == '7' ? 'selected' : '' ?> value="7">Villas Planet SL</option>
                                                                                <option <?php echo $row['proveedores'] == '8' ? 'selected' : '' ?> value="8">WifiBaleares</option>
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
                                            <!--PARTE DEL COLLASE NUEVO PARA EXTRAS ALQUILERES-->

                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    <?php endif ?>
                                </div><!---------------------------DIV DE INFORMACION GENERAL-->
                            </li>

                            <li>
                                <!--PARTE DEL EXTRAS CARACTERISTICAS-->

                                <!--PARTE DE LAS DISTANCIAS-->
                                <!--HASTA AQUI LLEGA PRIMERA PARTE DEL SCRIPT-->
                                <div class="uk-width-1-1 uk-margin-bottom">
                                    <p class="grey-titles"><strong>Gesti&oacute;n de distancias y entorno de la propiedad</strong></p>
                                    <div class="uk-form-controls">
                                        <div class="uk-grid">
                                            <div class=" uk-grid-medium uk-child-width-auto uk-grid ">
                                                <?php
                                                $distancias = $db->prepare("SELECT DISTINCT id, distanciaNombre  FROM distancias_properties where distanciaActivo='si' order by distanciaNombre Asc");
                                                $distancias->setFetchMode(PDO::FETCH_ASSOC);
                                                $distancias->execute();
                                                $a = 0;
                                                while ($distancias1 = $distancias->fetch()) {
                                                    ?>
                                                    <label style="cursor:pointer; margin-top:5px;" >
                                                        <p class="grey3 " style="margin:5px 0 10px 0;">Distancia <?php echo $distancias1['distanciaNombre'] ?></p>
                                                        <input type="hidden" name="idDist[]" value="<?php echo $distancias1['id'] ?>">
                                                        <input class="uk-input superficie" name="distancia[]" type="text" style="width:74%;">
                                                        <div style="width:24%; display:inline-block; vertical-align:middle" class="width_opt">
                                                            <select class="form-control" name="unidad[]">
                                                                <option value="km">Km (Kil&oacute;metros)  </option>
                                                                <option value="m">m (Metros)</option>
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

                            <!--NUEVA SECCION DE LOS EXTRAS-->

                            <li>

                                <div class="uk-width-1-1 uk-margin-bottom">
                                    <p class="grey-titles"><strong>Gestión de Equipamiento</strong></p>
                                    <div class="uk-form-controls">
                                        <?php
                                        $equipamiento = $db->prepare("SELECT DISTINCT id, extraNombre  FROM extras_properties where (extraTipoProp LIKE '%Vacacional%' OR extraTipoProp LIKE '%Anual%' OR extraTipoProp LIKE '%Temporal%') order by id Asc");
                                        $equipamiento->setFetchMode(PDO::FETCH_ASSOC);
                                        $equipamiento->execute();
                                        $a = 0;
                                        ?>
                                        <div class="row">
                                            <?php
                                            while ($equipamiento1 = $equipamiento->fetch()) {
                                                ?>


                                                <div class="col-md-3" style="margin-bottom: 20px;">
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name='equipamiento[]' value="<?php echo $equipamiento1['id'] ?>"> <?php echo $equipamiento1['extraNombre'] ?>
                                                    </label>
                                                </div>



                                                <?php
                                            }
                                            ?>
                                        </div>



                                    </div>
                                </div>
                            </li>

                            <!--NUEVA SECCION DE LOS EXTRAS-->


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
                        <textarea  id="editor4" name="notas"  class="uk-width-1-1"></textarea>
                        <script>
                            CKEDITOR.replace('editor4', {
                                filebrowserBrowseUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl: 'filemanager/dialog.php?type=1&editor=ckeditor&fldr='});
                        </script>
                    </div>

                </div>

                <div class="row" style="margin-top: 40px; padding-bottom: 40px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button onclick="saveData('1')" class="uk-button uk-button-primary" type="button"><strong>Agregar y Publicar <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
                        <button onclick="saveData('0')" class="uk-button uk-button-default uk-modal-close" type="button">Agregar sin publicar</button>

                        <!--<button class="uk-button uk-button-primary" type="submit"><strong>Editar y Publicar <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
                         <button class="uk-button uk-button-default uk-modal-close" type="submit">Editar sin publicar</button>-->

                    </div>
                </div>
                </form>


        </div>

        <div style="height:30px"></div>



        <!-----------------------------------------CUERPO DE LA PAGINA-->


        <?php
//include header template
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
                                    latitude: 39.8439258,
                                    longitude: 3.1300568
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
            $(document).ready(function () {
                $('.box-gallery-poblaciones').SumoSelect({search: false, searchText: 'Escribir aquí...', selectAll: false, noMatch: 'No hay resultados para "{0}"', captionFormat: '{0} Seleccionados',
                    captionFormatAllSelected: '{0} todos seleccionados', locale: ['OK', 'Cancelar', 'Seleccionar todo']});
                $('.car-options').SumoSelect({search: false, searchText: 'Escribir aquí...', selectAll: false, noMatch: 'No hay resultados para "{0}"', captionFormat: '{0} Seleccionados',
                    captionFormatAllSelected: '{0} todos seleccionados', locale: ['OK', 'Cancelar', 'Seleccionar todo']});

                $('select.box-gallery-poblaciones')[0].sumo.disable();


                $('.box-gallery-poblaciones1').SumoSelect({search: false, searchText: 'Escribir aquí...', selectAll: false, noMatch: 'No hay resultados para "{0}"', captionFormat: '{0} Seleccionados',
                    captionFormatAllSelected: '{0} todos seleccionados', locale: ['OK', 'Cancelar', 'Seleccionar todo']});
                $('select.box-gallery-poblaciones1')[0].sumo.disable();




            });

        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.box-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...', selectAll: false, noMatch: 'No hay resultados para "{0}"', captionFormat: '{0} Seleccionados',
                    captionFormatAllSelected: '{0} todos seleccionados', locale: ['OK', 'Cancelar', 'Seleccionar todo']});

            });

            $('#addproperty').on('keyup keypress', function (e) {
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
                        $('#showPrecioOferta').fadeOut('slow');
                    }

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

                var es_alquiler = document.getElementById('es_alquiler').value;

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
                    alert('Los titulos en los 3 idiomas, no debe estar vacio');
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
                UIkit.modal.confirm('¿Confirma que desea Agregar la propiedad?', {center: true, labels: {ok: 'Ok', cancel: 'Volver a Alta de Propiedades'}}).then(function () {
                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }
                    $.ajax({
                        url: '<?php echo DIR; ?>propiedades/savepropiedad', // url where to submit the request
                        type: "POST", // type of action POST || GET
                        dataType: 'text', // data type
                        data: $("#addproperty").serialize(), // post data || get data
                        success: function (result) {
                            if (es_alquiler == 'alquiler') {

                                window.location.replace("<?php echo DIR; ?>propiedades/alquileres");
                            } else {
                                window.location.replace("<?php echo DIR; ?>propiedades/venta");

                            }

                        },
                        error: function (xhr, resp, text, error) {
                            UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> <strong>Ha habido un error al agregar. Inténtelo de nuevo.</strong>', status: 'danger', timeout: 2000})
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
