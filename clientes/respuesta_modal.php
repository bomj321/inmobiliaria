<?php require('../includes/config2.php'); ?>

<?php if (isset($_GET['idcliente']) AND !empty($_GET['idcliente'])): ?>
<?php
$id=$_GET['idcliente'];
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
          <label class="uk-form-label"  for="clientType">Tipo de Cliente</label>
          <div class="uk-form-controls">
              <select class="uk-input" id="clientType" required="true" name="clientType">
                     <option >-Seleccionar-</option>
                     <option <?php echo $row['clientType'] == 'sale' ? 'selected' : '' ?> value="sale">Venta</option>
       				       <option <?php echo $row['clientType'] == 'renta' ? 'selected' : '' ?> value="renta">Renta</option>
       				       <option <?php echo $row['clientType'] == 'otros' || $row['clientType'] == 'ALQUILER VACACIONAL' ? 'selected' : '' ?> value="otros">Otros</option>
              </select>
          </div>
        </div>

         <div class="uk-width-1-2">
            <label class="uk-form-label"  for="mailerCheck">Checkeo por Email</label>
            <div class="uk-form-controls">
              <select class="uk-input" id="mailerCheck" required="true" name="mailerCheck">
               <option <?php echo $row['mailerCheck'] == 'yes' ? 'selected' : '' ?> value="yes">Si</option>
               <option <?php echo $row['mailerCheck'] == 'no' ? 'selected' : '' ?> value="no">No</option>
             </select>
            </div>
        </div>

        <div class="uk-width-1-2">
            <label class="uk-form-label"  for="source">Desde nos vi&oacute;</label>
            <div class="uk-form-controls">
              <select class="uk-input" id="source" required="true" name="source">
  				      <option <?php echo $row['source'] == 'website' ? 'selected' : '' ?> value="website">Sitio Web</option>
  				      <option <?php echo $row['source'] == 'others' ? 'selected' : '' ?> value="others">Otros</option>
  				    </select>
            </div>
        </div>

         <div class="uk-width-1-2">
            <label class="uk-form-label"  for="foundBy">Como nos encontr&oacute;</label>
            <div class="uk-form-controls">
              <select class="uk-input" id="foundBy" required="true" name="foundBy">
               <option <?php echo $row['foundBy'] == 'Ask' ? 'selected' : '' ?> value="Ask">Ask</option>
               <option <?php echo $row['foundBy'] == 'Google' ? 'selected' : '' ?> value="Google">Google</option>
               <option <?php echo $row['foundBy'] == 'Periodico' ? 'selected' : '' ?> value="Periodico">Periodico Local</option>
               <option <?php echo $row['foundBy'] == 'Internet' ? 'selected' : '' ?> value="Internet">Internet</option>
               <option <?php echo $row['foundBy'] == 'Other' ? 'selected' : '' ?> value="Other">Other</option>
             </select>
            </div>
        </div>


        <div class="uk-width-1-2">
                <label class="uk-form-label" for="OfficeID">Id de la Oficina</label>
                <div class="uk-form-controls">
                  <select class="uk-input" id="OfficeID" required="true" name="OfficeID">
                   <option <?php echo $row['OfficeID'] == '0' ? 'selected' : '' ?> value="0">0</option>
                   <option <?php echo $row['OfficeID'] == '1' ? 'selected' : '' ?> value="1">1</option>
                 </select>
                </div>
        </div>

         <div class="uk-width-1-2">
                <label class="uk-form-label" for="EmployeeID">Id de los Empleados</label>
                <div class="uk-form-controls">
                  <select class="uk-input" id="EmployeeID" required="true" name="EmployeeID">
                   <option <?php echo $row['EmployeeID'] == '0' ? 'selected' : '' ?> value="0">0</option>
                   <option <?php echo $row['EmployeeID'] == '1' ? 'selected' : '' ?> value="1">1</option>
                 </select>
                </div>
        </div>

        <div class="uk-width-1-2">
                <label class="uk-form-label" for="buyer">¿Es Comprador?</label>
                <div class="uk-form-controls">
                  <select class="uk-input" id="buyer" required="true" name="buyer">
                   <option <?php echo $row['buyer'] == 'yes' ? 'selected' : '' ?> value="yes">SI</option>
                   <option <?php echo $row['buyer'] == 'no' ? 'selected' : '' ?> value="no">No</option>
                 </select>
                </div>
        </div>

         <div class="uk-width-1-2">
                <label class="uk-form-label" for="clientName">Nombre del Cliente</label>
                <div class="uk-form-controls">
                    <input value='<?php echo $row['clientName']?>' type="text" class="uk-input" id="clientName" placeholder="Ingrese nombre del Cliente" name="clientName">
                </div>
        </div>

        <div class="uk-width-1-2">
            <label class="uk-form-label" for="clientEmail">Direcci&oacute;n de Email</label>
            <div class="uk-form-controls">
                 <input value='<?php echo $row['clientEmail']?>' type="email" class="uk-input" id="clientEmail" placeholder="Ingrese el Correo Electronico"  name="clientEmail">
            </div>
        </div>

        <div class="uk-width-1-2">
           <label class="uk-form-label" for="clientPass">Contraseña de Cliente</label>
            <div class="uk-form-controls">
                <input value='<?php echo $row['clientPass']?>' type="text" class="uk-input" id="clientPass" placeholder="Ingrese la clave de usuario" name="clientPass">
            </div>
        </div>




        <div class="uk-width-1-2">
            <label class="uk-form-label"  for="pais">Pais del Cliente</label>
            <div class="uk-form-controls">
              <input value='<?php echo $row['pais']?>' type="text" class="uk-input" id="pais" placeholder="Pais del Cliente" name="pais">
            </div>
        </div>

        <div class="uk-width-1-2">
                 <label class="uk-form-label" for="nacimiento">Fecha de Nacimiento</label>
                <div class="uk-form-controls">
                  <input value='<?php echo $row['nacimiento']?>' type="date" class="uk-input" id="nacimiento" placeholder="Fecha de Nacimiento" name="nacimiento">
                </div>
        </div>

        <div class="uk-width-1-2">
                <label class="uk-form-label" for="clientSessionID">ID de la Sesi&oacute;n del Cliente</label>
                <div class="uk-form-controls">
                     <input value='<?php echo $row['clientSessionID']?>' type="text" class="uk-input" id="clientSessionID" placeholder="Ingrese ID de la Sesión" name="clientSessionID">
                </div>
        </div>

        <div class="uk-width-1-2">
            <label class="uk-form-label" for="clientTel1">Telefono #1 de Cliente </label>
            <div class="uk-form-controls">
                 <input value='<?php echo $row['clientTel1']?>' type="text" class="uk-input" id="clientTel1" placeholder="Ingrese un numero telefonico" name="clientTel1">
            </div>
        </div>

        <div class="uk-width-1-2">
                <label class="uk-form-label" for="clientTel2">Telefono #2 de Cliente </label>
                <div class="uk-form-controls">
                     <input value='<?php echo $row['clientTel2']?>' type="text" class="uk-input" id="clientTel2" placeholder="Ingrese un numero telefonico" name="clientTel2">
                </div>
        </div>
<!--SECCION CON ESTILOS DE BOOTSTRAP-->
        <div class="uk-width-1-2">
          <div class="uk-form-controls">
           <label class="uk-form-label" for="clientMob">Telefono movil del Cliente </label>
           <input value='<?php echo $row['clientMob']?>' type="text" class="uk-input" id="clientMob" placeholder="Ingrese un numero de movil" name="clientMob">
</div>
        </div>

         <div class="uk-width-1-2">
           <div class="uk-form-controls">
           <label class="uk-form-label" for="clientFax">Fax de Cliente</label>
           <input value='<?php echo $row['clientFax']?>' type="text" class="uk-input" id="clientFax" placeholder="Ingrese un numero de Fax" name="clientFax">
</div>
        </div>

        <div class="uk-width-1-2">
          <div class="uk-form-controls">
           <label class="uk-form-label" for="clientAddress">Direcci&oacute;n del Cliente</label>
           <input value='<?php echo $row['clientAddress']?>' type="text" class="uk-input" id="clientAddress" placeholder="Ingrese dirección del Cliente" name="clientAddress">
</div>
        </div>

         <div class="uk-width-1-2">
           <div class="uk-form-controls">
             <label class="uk-form-label" for="clientLang">Idioma del Cliente</label>
             <select class="uk-input" id="clientLang" required="true" name="clientLang">
                <option >-Seleccionar-</option>
                <option <?php echo $row['clientLang'] == 'es' ? 'selected' : '' ?> value="es">Español</option>
              <option <?php echo $row['clientLang'] == 'en' ? 'selected' : '' ?> value="en">Ingles</option>
              <option <?php echo $row['clientLang'] == 'de' ? 'selected' : '' ?> value="de">Aleman</option>
              <option <?php echo $row['clientLang'] == 'ma' ? 'selected' : '' ?> value="ma">Mallorquin</option>
             </select>
</div>
        </div>

        <div class="uk-width-1-2">
          <div class="uk-form-controls">
           <label class="uk-form-label" for="clientIDNum">Numero de Id del Cliente</label>
           <input value='<?php echo $row['clientIDNum']?>' type="text" class="uk-input" id="clientIDNum" placeholder="Numero de Id del Cliente" name="clientIDNum">
</div>
        </div>

         <div class="uk-width-1-2">
           <div class="uk-form-controls">
             <label class="uk-form-label" for="propType">Tipo de Propiedades</label>
             <select class="uk-input" id="propType" required="true" name="propType">
                <option >-Seleccionar-</option>
                <option <?php echo $row['propType'] == 'all' ? 'selected' : '' ?> value="all">Todos </option>
              <option <?php echo $row['propType'] == 'Pisos_y_apartamentos' ? 'selected' : '' ?> value="Pisos_y_apartamentos">Pisos y apartamentos</option>
              <option <?php echo $row['propType'] == 'chalet_villas' ? 'selected' : '' ?> value="chalet_villas">Chalet y villas</option>
              <option <?php echo $row['propType'] == 'casas_rusticas' ? 'selected' : '' ?> value="casas_rusticas">Casas y fincas rústicas</option>
              <option <?php echo $row['propType'] == 'casa_pueblo' ? 'selected' : '' ?> value="casa_pueblo">Casas de pueblo</option>
              <option <?php echo $row['propType'] == 'solares_parcelas' ? 'selected' : '' ?> value="solares_parcelas">Solares y parcelas</option>
             </select>
</div>
        </div>

         <div class="uk-width-1-2">
           <div class="uk-form-controls">
           <label class="uk-form-label" for="propPriceStart">Precio Minimo</label>
           <input value='<?php echo $row['propPriceStart']?>' type="text" class="uk-input" id="propPriceStart" placeholder="Precio Minimo" name="propPriceStart">
</div>
        </div>

         <div class="uk-width-1-2">
           <div class="uk-form-controls">
           <label class="uk-form-label" for="propPriceEnd">Precio Maximo</label>
           <input value='<?php echo $row['propPriceEnd']?>' type="text" class="uk-input" id="propPriceEnd" placeholder="Precio Maximo" name="propPriceEnd">
</div>
        </div>

         <div class="uk-width-1-2">
           <div class="uk-form-controls">
             <label class="uk-form-label" for="propTowns">Lugar de las Propiedades</label>
             <select class="uk-input" id="propTowns" required="true" name="propTowns">
                <option >-Seleccionar-</option>
                <option <?php echo $row['propTowns'] == 'all' ? 'selected' : '' ?> value="all">Todas</option>
             <!--CONSULTA SQL-->
              <?php
                $provincias = $db->prepare("SELECT * FROM provincia");
                $provincias->setFetchMode(PDO::FETCH_ASSOC);
               $provincias->execute();
             while ($provincia = $provincias->fetch()){
               ?>
             <!--CONSULTA SQL-->
              <option <?php echo $provincia['provincia'] == $row['propTowns'] ? 'selected' : '' ?> value="<?php echo $provincia['provincia'] ?>"><?php echo $provincia['provincia'] ?></option>

           <?php  }?>

             </select>
</div>
        </div>


        <div class="uk-width-1-2">
          <div class="uk-form-controls">
           <label class="uk-form-label" for="propBedFrom">Cantidad minima de cuartos</label>
           <input value='<?php echo $row['propBedFrom']?>' type="text" class="uk-input" id="propBedFrom" placeholder="Cantidad minima de cuartos" name="propBedFrom">
</div>
        </div>

        <div class="uk-width-1-2">
          <div class="uk-form-controls">
           <label class="uk-form-label" for="propBedTo">Cantidad m&aacute;xima de cuartos</label>
           <input value='<?php echo $row['propBedTo']?>' type="text" class="uk-input" id="propBedTo" placeholder="Cantidad máxima de cuartos" name="propBedTo">
</div>
        </div>

        <div class="uk-width-1-2">
          <div class="uk-form-controls">
             <label class="uk-form-label" for="sendMailerMonth">¿Enviar email mensualmente?</label>
             <select class="uk-input" id="sendMailerMonth" required="true" name="sendMailerMonth">
               <option <?php echo $row['sendMailerMonth'] == 'yes' ? 'selected' : '' ?> value="yes">SI</option>
               <option <?php echo $row['sendMailerMonth'] == 'no' ? 'selected' : '' ?> value="no">No</option>
             </select>
</div>
        </div>

         <div class="uk-width-1-2">
           <div class="uk-form-controls">
             <label class="uk-form-label" for="sendMailerNew">¿Enviar email sobre Novedades?</label>
             <select class="uk-input" id="sendMailerNew" required="true" name="sendMailerNew">
               <option <?php echo $row['sendMailerNew'] == 'yes' ? 'selected' : '' ?> value="yes">SI</option>
               <option <?php echo $row['sendMailerNew'] == 'no' ? 'selected' : '' ?> value="no">No</option>
             </select>
</div>
        </div>

         <div class="uk-width-1-2">
           <div class="uk-form-controls">
             <label class="uk-form-label" for="sendNewsletter">¿Enviar cartas?</label>
             <select class="uk-input" id="sendNewsletter" required="true" name="sendNewsletter">
               <option <?php echo $row['sendNewsletter'] == 'yes' ? 'selected' : '' ?> value="yes">SI</option>
               <option <?php echo $row['sendNewsletter'] == 'no' ? 'selected' : '' ?> value="no">No</option>
             </select>
</div>
        </div>

        <div class="uk-width-1-2">
          <div class="uk-form-controls">
             <label class="uk-form-label" for="rentalType">Tipo de Renta</label>
             <select class="uk-input" id="rentalType" required="true" name="rentalType">
               <option <?php echo $row['rentalType'] == 'any' ? 'selected' : '' ?> value="any">Cualquier Tipo</option>
               <option <?php echo $row['rentalType'] == 'short' ? 'selected' : '' ?> value="short">Corta</option>
             </select>
</div>
        </div>


        <div class="uk-width-1-2">
          <div class="uk-form-controls">
           <label class="uk-form-label" for="clientFolio">Folio del Cliente</label>
           <input value='<?php echo $row['clientFolio']?>' type="text" class="uk-input" id="clientFolio" placeholder="Numero de Folio del Cliente" name="clientFolio">
</div>
        </div>

         <div class="uk-width-1-2">
           <div class="uk-form-controls">
             <label class="uk-form-label" for="clientVIP">¿Es cliente VIP?</label>
             <select class="uk-input" id="clientVIP" required="true" name="clientVIP">
               <option <?php echo $row['clientVIP'] == 'yes' ? 'selected' : '' ?> value="yes">SI</option>
               <option <?php echo $row['clientVIP'] == 'no' ? 'selected' : '' ?> value="no">NO</option>
             </select>
</div>
        </div>


         <div class="uk-width-1-2">
           <div class="uk-form-controls">
           <label class="uk-form-label" for="SSMA_TimeStamp">SSMA fecha de Inicio</label>
           <input value='<?php echo $row['SSMA_TimeStamp']?>' name="SSMA_TimeStamp" type="date" class="uk-input" id="SSMA_TimeStamp" placeholder="SSMA fecha de Inicio">
</div>
        </div>

         <div class="uk-width-1">
           <div class="uk-form-controls">
           <label class="uk-form-label" for="clientNotes">Notas del Cliente</label>
           <textarea name="clientNotes" id="clientNotes" class="uk-input" placeholder="Ingrese las notas del cliente" style="height: 100px;"><?php echo $row['clientNotes']?></textarea>
</div>
        </div>
<!--SECCION CON ESTILOS DE BOOTSTRAP-->


    </div>

        </div>

        <div class="uk-modal-footer uk-text-right" style="margin-top: 20px;">
        <button type="button" class="uk-button uk-button-default" data-dismiss="modal">Cerrar</button>
            <button onclick="updatecliente()" class="uk-button uk-button-primary" type="button"><strong>Editar cliente <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
        </div>
            </form>
<?php endif ?>
