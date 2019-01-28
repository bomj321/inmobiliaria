<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<?php
require('../includes/config2.php');




if (!$user->is_logged_in()) {
    header('Location: ../login');
    exit();
}

$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';
$activo = "clientes";
$activo2 = "";
require('../layout/header.php');
?>

<?php
include('../layout/menu.php');
?>

<!--CAPTAR ID DEL CLIENTE-->
<!--SECCION PARA AGREGAR EDICION-->
<?php
$id = $_GET['idpropietario'];
$stmt = $db->prepare("SELECT * FROM owners WHERE ID='$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
?>
<!--SECCION PARA AGREGAR EDICION-->
<!--CAPTAR ID DEL CLIENTE-->
<!-----------------------------------------CUERPO DE LA PAGINA-->

<div class="container-fluid" style="background-color: white; margin-top: 50px;">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
            <h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Edici&oacute;n de Propietarios</h5>
        </div>
    </div>

    <form id="addpropietario" style="margin-top: 30px;">
        <!--INPUT CON EL ID A ACTUALIZAR-->
        <input type="hidden" value='<?php echo $row['ID'] ?>' name='id_propietario'>
        <!--INPUT CON EL ID A ACTUALIZAR-->
        <div class="form-group">
            <label for="propType">Tipo de Cliente</label>
            <select class="form-control" id="propType" required="true" name="propType">
                <option <?php echo $row['propType'] == 'sale' ? 'selected' : '' ?> value="sale">Venta</option>
                <option <?php echo $row['propType'] == 'rental' ? 'selected' : '' ?> value="rental">Renta</option>		
                <option <?php echo $row['propType'] == 'alquiler' ? 'selected' : '' ?> value="alquiler">Alquiler</option>	    
            </select>
        </div>

        <div class="form-group">
            <label for="active">Activar Cliente</label>
            <select class="form-control" id="active" required="true" name="active">
                <option <?php echo $row['active'] == '1' ? 'selected' : '' ?> value="1">Si</option>
                <option <?php echo $row['active'] == '2' ? 'selected' : '' ?> value="0">No</option>		    
            </select>
        </div>

        <div class="form-group">
            <label for="add_sessionID">ID de la Sesi&oacute;n del Cliente</label>
            <input value='<?php echo $row['add_sessionID'] ?>' type="text" class="form-control" id="add_sessionID" placeholder="Ingrese ID de la Sesión" name="add_sessionID">
        </div>

        <div class="form-group">
            <label for="OfficeID">Id de la Oficina</label>
            <select class="form-control" id="OfficeID" required="true" name="OfficeID">
                <option <?php echo $row['OfficeID'] == '0' ? 'selected' : '' ?> value="0">0</option>
                <option <?php echo $row['OfficeID'] == '1' ? 'selected' : '' ?> value="1">1</option>				     	    
            </select>
        </div>

        <div class="form-group">
            <label for="EmployeeID">Id de los Empleados</label>
            <select class="form-control" id="EmployeeID" required="true" name="EmployeeID">
                <option <?php echo $row['EmployeeID'] == '0' ? 'selected' : '' ?> value="0">0</option>
                <option <?php echo $row['EmployeeID'] == '1' ? 'selected' : '' ?> value="1">1</option>				     	    
            </select>
        </div>

        <!--SEPARAR NOMBRE--><?php
        $nombrecompleto = $row['sellerName1'];
        $nombres = explode(" ", $nombrecompleto);
        ?>
        <!--SEPARAR NOMBRE-->
        <div class="form-group">
            <label for="sellerName1">Primer Nombre del Propietario</label>
            <input value='<?php echo $nombres[0] ?>' type="text" class="form-control" id="sellerName1" placeholder="Ingrese Primer Nombre del Cliente" name="sellerName1">
        </div>

        <div class="form-group">
            <label for="sellerName2">Apellido del Propietario</label>
            <input value='<?php echo $nombres[1] ?>' type="text" class="form-control" id="sellerName2" placeholder="Ingrese Apellido del Propietario" name="sellerName2">
        </div>

        <div class="form-group">
            <label for="sellerContact">Ingrese numero de contacto</label>
            <input value='<?php echo $row['sellerContact'] ?>' type="text" class="form-control" id="sellerContact" placeholder="Ingrese numero de contacto" name="sellerContact">
        </div>



        <div class="form-group">
            <label for="sellerNationality">Ingrese Nacionalidad</label>
            <input value='<?php echo $row['sellerNationality'] ?>' type="text" class="form-control" id="sellerNationality" placeholder="Ingrese nacionalidad" name="sellerNationality">
        </div>

        <div class="form-group">
            <label for="population">Ingrese Poblaci&oacute;n</label>
            <input value="<?php echo $row['population'] ?>" type="text" class="form-control" id="population" placeholder="Ingrese Poblaci&oacute;n" name="population">
        </div>

        <div class="form-group">
            <label for="postal_code">Ingrese C&oacute;digo Postal</label>
            <input value="<?php echo $row['postal_code'] ?>" type="text" class="form-control" id="postal_code" placeholder="Ingrese C&oacute;digo Postal" name="postal_code">
        </div>


        <div class="form-group">
            <label for="sellerLang">Idioma del Propietario</label>
            <select class="form-control" id="sellerLang" required="true" name="sellerLang">
                <option >-Seleccionar-</option>
                <option <?php echo $row['sellerLang'] == 'es' ? 'selected' : '' ?> value="es">Espa&ntilde;ol</option>
                <option <?php echo $row['sellerLang'] == 'en' ? 'selected' : '' ?> value="en">Ingles</option>
                <option <?php echo $row['sellerLang'] == 'de' ? 'selected' : '' ?> value="de">Aleman</option>		     <option <?php echo $row['sellerLang'] == 'ma' ? 'selected' : '' ?> value="ma">Mallorquin</option>
            </select>
        </div>

        <div class="form-group">
            <label for="sellerAddress">Direcci&oacute;n del Propietario</label>
            <input value='<?php echo $row['sellerAddress'] ?>' type="text" class="form-control" id="sellerAddress" placeholder="Ingrese direcci&oacute;n del Propietario" name="sellerAddress">
        </div>


        <div class="form-group">
            <label for="sellerTel">Telefono del Propietario </label>
            <input value='<?php echo $row['sellerTel'] ?>' type="text" class="form-control" id="sellerTel" placeholder="Ingrese un numero telefonico" name="sellerTel">
        </div>

        <div class="form-group">
            <label for="sellerMob">Telefono movil del Propietario </label>
            <input value='<?php echo $row['sellerMob'] ?>' type="text" class="form-control" id="sellerMob" placeholder="Ingrese un numero de movil" name="sellerMob">
        </div>


        <div class="form-group">
            <label for="sellerFax">Fax del Propietario</label>
            <input value='<?php echo $row['sellerFax'] ?>' type="text" class="form-control" id="sellerFax" placeholder="Ingrese un numero de Fax" name="sellerFax">
        </div>

        <div class="form-group">
            <label for="sellerEmail">Direcci&oacute;n de Email</label>
            <input value='<?php echo $row['sellerEmail'] ?>' type="email" class="form-control" id="sellerEmail" placeholder="Ingrese el Correo Electronico"  name="sellerEmail">
        </div>

        <div class="form-group">
            <label for="sellerDNI">DNI del Propietario</label>
            <input value='<?php echo $row['sellerDNI'] ?>' type="text" class="form-control" id="sellerDNI" placeholder="DNI del Propietario" name="sellerDNI">
        </div>


        <div class="form-group">
            <label for="SSMA_TimeStamp">SSMA fecha de Inicio</label>
            <input value='<?php echo $row['SSMA_TimeStamp'] ?>' type="date" class="form-control" id="SSMA_TimeStamp" placeholder="SSMA fecha de Inicio" name="SSMA_TimeStamp">
        </div>

        <div class="form-group">
            <label for="comment">Comentario del Cliente</label>
            <textarea class="form-control" id="comment" rows="3" name="comment"><?php echo $row['comment'] ?></textarea>
        </div>



        <button  onclick="saveData()" type="button" class="btn btn-primary">Actualizar Propietario</button>


    </form>	

</div>

<div style="height:30px"></div>



<!-----------------------------------------CUERPO DE LA PAGINA-->


<?php
//include header template
require('../layout/footer.php');
?>


<script type="text/javascript" >
    function saveData() {
        UIkit.modal.confirm('¿Confirma que desea agregar el propietario?', {center: true, labels: {ok: 'Ok', cancel: 'Volver a edicion de propietario'}}).then(function () {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
                url: '<?php echo DIR; ?>propietarios/updatepropietario.php', // url where to submit the request
                type: "POST", // type of action POST || GET
                dataType: 'text', // data type
                data: $("#addpropietario").serialize(), // post data || get data
                success: function (result) {
                    window.location.replace("<?php echo DIR; ?>propietarios/index.php");

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


</form>	

</div>

<div style="height:30px"></div>



<!-----------------------------------------CUERPO DE LA PAGINA-->


<?php
//include header template
require('../layout/footer.php');
?>


<script type="text/javascript" >
    function updateData() {
        UIkit.modal.confirm('¿Confirma que desea editar el cliente?', {center: true, labels: {ok: 'Ok', cancel: 'Volver a edición de cliente'}}).then(function () {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
                url: '<?php echo DIR; ?>propietarios/updatepropietario', // url where to submit the request
                type: "POST", // type of action POST || GET
                dataType: 'text', // data type
                data: $("#addpropietario").serialize(), // post data || get data
                success: function (result) {
                    window.location.replace("<?php echo DIR; ?>propietarios/index");

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