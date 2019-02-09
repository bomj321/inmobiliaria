<?php require('../includes/config2.php'); ?>

<?php if (isset($_POST['id']) AND !empty($_POST['id'])): ?>
<?php 
$id=$_POST['id'];
$stmt = $db->prepare("SELECT * FROM owners WHERE ID='$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
 ?>
	<form class="uk-form-stacked" id="owner-form"> 
	<!--INPUT CON EL ID A ACTUALIZAR-->
			<input type="hidden" value='<?php echo $row['ID']?>' name='id_cliente'>
			<!--INPUT CON EL ID A ACTUALIZAR--> 
        <div class="uk-grid uk-grid-medium">

        <div class="uk-width-1-2">
            <label class="uk-form-label"  for="form-stacked-text">Nombre Completo</label>
            <div class="uk-form-controls">
                <input class="uk-input" name="nombre" type="text" placeholder="Ingrese Nombre" value='<?php echo $row['sellerName1']?>'>
            </div>
        </div>         

         <div class="uk-width-1-2">
            <label class="uk-form-label"  for="form-stacked-text">DNI del Propietario</label>
            <div class="uk-form-controls">
                <input type="text" class="uk-input" id="sellerDNI" placeholder="DNI del Propietario" name="sellerDNI" value='<?php echo $row['sellerDNI']?>'>
            </div>
        </div>

        <div class="uk-width-1-2">
            <label class="uk-form-label"  for="form-stacked-text">Ingrese Nacionalidad</label>
            <div class="uk-form-controls">
                <input type="text" class="uk-input" id="sellerNationality" placeholder="Ingrese Nacionalidad" name="sellerNationality" value='<?php echo $row['sellerNationality']?>'>
            </div>
        </div>

         <div class="uk-width-1-2">
            <label class="uk-form-label"  for="form-stacked-text">Idioma del Propietario</label>
            <div class="uk-form-controls">
                <select class="form-control" id="sellerLang" required="true" name="sellerLang">
                       <option >-Seleccionar-</option>
                       <option <?php echo $row['sellerLang'] == 'es' ? 'selected' : '' ?> value="es">Español</option>
                       <option <?php echo $row['sellerLang'] == 'en' ? 'selected' : '' ?> value="en">Ingles</option>
                       <option <?php echo $row['sellerLang'] == 'de' ? 'selected' : '' ?> value="de">Aleman</option>                                                   
                </select>
            </div>
        </div>
       

        <div class="uk-width-1-2">
                <label class="uk-form-label" for="form-stacked-text">Tel&eacute;fono</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="telefono" type="text" placeholder="Ingrese el Tel&eacute;fono" value='<?php echo $row['sellerTel']?>'>
                </div>
        </div>

         <div class="uk-width-1-2">
                <label class="uk-form-label" for="form-stacked-text">Telefono movil del Propietario</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" id="sellerMob" placeholder="Ingrese un numero de movil" name="sellerMob" value='<?php echo $row['sellerMob']?>'>
                </div>
        </div>

        <div class="uk-width-1-2">
                <label class="uk-form-label" for="form-stacked-text">Numero de contacto</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" id="sellerContact" placeholder="Ingrese numero de contacto" name="sellerContact" value='<?php echo $row['sellerContact']?>'>
                </div>
        </div>

         <div class="uk-width-1-2">
                <label class="uk-form-label" for="form-stacked-text">Fax del Propietario</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" id="sellerFax" placeholder="Ingrese un numero de Fax" name="sellerFax" value='<?php echo $row['sellerFax']?>'>
                </div>
        </div>

        <div class="uk-width-1-2">
            <label class="uk-form-label" for="form-stacked-text">Correo electrónico </label>
            <div class="uk-form-controls">
                <input class="uk-input" name="email" type="text" placeholder="Ingrese Correo electrónico" value='<?php echo $row['sellerEmail']?>'>
            </div>
        </div>

        <div class="uk-width-1-2">
            <label class="uk-form-label" for="form-stacked-text">Direcci&oacute;n del Propietario </label>
            <div class="uk-form-controls">
                <input type="text" class="uk-input" id="sellerAddress" placeholder="Ingrese dirección del Propietario" name="sellerAddress" value='<?php echo $row['sellerAddress']?>'>
            </div>
        </div>




        <div class="uk-width-1-2">
            <label class="uk-form-label"  for="form-stacked-text">Tipo de Cliente</label>
            <div class="uk-form-controls">
                <select class="uk-input" id="propType" required="true" name="propType">
                      <option <?php echo $row['propType'] == 'sale' ? 'selected' : '' ?> value="sale">Venta</option>
                      <option <?php echo $row['propType'] == 'rental' ? 'selected' : '' ?> value="rental">Renta</option>     
                      <option <?php echo $row['propType'] == 'alquiler' ? 'selected' : '' ?> value="alquiler">Alquiler</option>        
                    </select>
            </div>
        </div>

        <div class="uk-width-1-2">
                <label class="uk-form-label" for="form-stacked-text">ID de la Sesi&oacute;n del Cliente </label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" id="add_sessionID" placeholder="Ingrese ID de la Sesión" name="add_sessionID" value='<?php echo $row['add_sessionID']?>'>
                </div>
        </div>

        <div class="uk-width-1-2">
                <label class="uk-form-label" for="form-stacked-text">Id de la Oficina</label>
                <div class="uk-form-controls">
                    <select class="uk-input" id="OfficeID" required="true" name="OfficeID">
                      <option <?php echo $row['OfficeID'] == '0' ? 'selected' : '' ?> value="0">0</option>
                      <option <?php echo $row['OfficeID'] == '1' ? 'selected' : '' ?> value="1">1</option>                          
                    </select>
                </div>
        </div>

        <div class="uk-width-1-2">
            <label class="uk-form-label" for="form-stacked-text">Id de los Empleados</label>
                <select class="uk-input" id="EmployeeID" required="true" name="EmployeeID">
                      <option <?php echo $row['EmployeeID'] == '0' ? 'selected' : '' ?> value="0">0</option>
                      <option <?php echo $row['EmployeeID'] == '1' ? 'selected' : '' ?> value="1">1</option>                          
                    </select>
        </div>

        <div class="uk-width-1-2">
                <label class="uk-form-label" for="form-stacked-text">SSMA fecha de Inicio</label>
                <div class="uk-form-controls">
                    <input type="date" class="uk-input" id="SSMA_TimeStamp" placeholder="SSMA fecha de Inicio" name="SSMA_TimeStamp" value='<?php echo $row['SSMA_TimeStamp']?>'>
                </div>
        </div>

    </div>
    
        </div>

        <div class="uk-modal-footer uk-text-right" style="margin-top: 20px;">      
        <button type="button" class="uk-button uk-button-default" data-dismiss="modal">Cerrar</button>     
            <button onclick="updatepropietario()" class="uk-button uk-button-primary boton_editar" type="button" ><strong>Editar cliente <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
        </div>
            </form>
<?php endif ?>


