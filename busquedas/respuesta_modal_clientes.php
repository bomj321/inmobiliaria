<?php require('../includes/config2.php'); ?>

<?php if (isset($_POST['id']) AND !empty($_POST['id'])): ?>
<?php 
$id=$_POST['id'];
$stmt = $db->prepare("SELECT * FROM clients WHERE ID='$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
 ?>
	<form class="uk-form-stacked" id="client-form"> 
	<!--INPUT CON EL ID A ACTUALIZAR-->
			<input type="hidden" value='<?php echo $row['ID']?>' name='id_cliente'>
			<!--INPUT CON EL ID A ACTUALIZAR--> 
        <div class="uk-grid uk-grid-medium">

        <div class="uk-width-1-2">
            <label class="uk-form-label"  for="form-stacked-text">Nombre Completo</label>
            <div class="uk-form-controls">
                <input class="uk-input" name="clientName" type="text" placeholder="Ingrese Nombre" value='<?php echo $row['clientName']?>'>
            </div>
        </div>
      
        <div class="uk-width-1-2">
            <label class="uk-form-label"  for="form-stacked-text">Ingrese Nacionalidad</label>
            <div class="uk-form-controls">
                <input type="text" class="uk-input" id="pais" placeholder="Ingrese Nacionalidad" name="pais" value='<?php echo $row['pais']?>'>
            </div>
        </div>

         <div class="uk-width-1-2">
            <label class="uk-form-label"  for="form-stacked-text">Idioma del Cliente</label>
            <div class="uk-form-controls">
                <select class="form-control" id="clientLang" required="true" name="clientLang">
                       <option >-Seleccionar-</option>
                       <option <?php echo $row['clientLang'] == 'es' ? 'selected' : '' ?> value="es">Español</option>
                       <option <?php echo $row['clientLang'] == 'en' ? 'selected' : '' ?> value="en">Ingles</option>
                       <option <?php echo $row['clientLang'] == 'de' ? 'selected' : '' ?> value="de">Aleman</option>                                                   
                </select>
            </div>
        </div>
    

        <div class="uk-width-1-2">
                <label class="uk-form-label" for="form-stacked-text">Tel&eacute;fono</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="clientTel1" type="text" placeholder="Ingrese el Tel&eacute;fono" value='<?php echo $row['clientTel1']?>'>
                </div>
        </div>

         <div class="uk-width-1-2">
                <label class="uk-form-label" for="form-stacked-text">Telefono movil del Cliente</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" id="clientMob" placeholder="Ingrese un numero de movil" name="clientMob" value='<?php echo $row['clientMob']?>'>
                </div>
        </div>
       

         <div class="uk-width-1-2">
                <label class="uk-form-label" for="form-stacked-text">Fax del Cliente</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" id="clientFax" placeholder="Ingrese un numero de Fax" name="clientFax" value='<?php echo $row['clientFax']?>'>
                </div>
        </div>

        <div class="uk-width-1-2">
            <label class="uk-form-label" for="form-stacked-text">Correo electrónico </label>
            <div class="uk-form-controls">
                <input class="uk-input" name="email" type="text" placeholder="Ingrese Correo electrónico" value='<?php echo $row['clientEmail']?>'>
            </div>
        </div>

        <div class="uk-width-1-2">
            <label class="uk-form-label" for="form-stacked-text">Direcci&oacute;n del Cliente </label>
            <div class="uk-form-controls">
                <input type="text" class="uk-input" id="clientAddress" placeholder="Ingrese dirección del Propietario" name="clientAddress" value='<?php echo $row['clientAddress']?>'>
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
                <label class="uk-form-label" for="form-stacked-text">ID de la del Cliente</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" id="clientIDNum" placeholder="ID de la del Cliente " name="clientIDNum" value='<?php echo $row['clientIDNum']?>'>
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
      
    </div>
    
        </div>

        <div class="uk-modal-footer uk-text-right" style="margin-top: 20px;">      
        <button type="button" class="uk-button uk-button-default" data-dismiss="modal">Cerrar</button>     
            <button onclick="updatecliente()" class="uk-button uk-button-primary" type="button"><strong>Editar cliente <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
        </div>
            </form>
<?php endif ?>


