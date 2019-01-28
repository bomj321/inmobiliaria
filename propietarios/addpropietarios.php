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

<!-----------------------------------------CUERPO DE LA PAGINA-->
<div class="container-fluid" style="background-color: white; margin-top: 50px;">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
            <h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Alta de Propietarios</h5>
        </div>
    </div>

    <form id="addpropietario" style="margin-top: 30px;">
        <div class="form-group">
            <label for="propType">Tipo de Cliente</label>
            <select class="form-control" id="propType" required="true" name="propType">
                <option value="sale">Venta</option>
                <option value="rental">Renta</option>		
                <option value="alquiler">Alquiler</option>	    
            </select>
        </div>

        <div class="form-group">
            <label for="active">Activar Cliente</label>
            <select class="form-control" id="active" required="true" name="active">
                <option value="1">Si</option>
                <option value="0">No</option>		    
            </select>
        </div>

        <div class="form-group">
            <label for="add_sessionID">ID de la Sesi&oacute;n del Cliente</label>
            <input type="text" class="form-control" id="add_sessionID" placeholder="Ingrese ID de la Sesión" name="add_sessionID">
        </div>

        <div class="form-group">
            <label for="OfficeID">Id de la Oficina</label>
            <select class="form-control" id="OfficeID" required="true" name="OfficeID">
                <option value="0">0</option>
                <option value="1">1</option>				     	    
            </select>
        </div>

        <div class="form-group">
            <label for="EmployeeID">Id de los Empleados</label>
            <select class="form-control" id="EmployeeID" required="true" name="EmployeeID">
                <option value="0">0</option>
                <option value="1">1</option>				     	    
            </select>
        </div>


        <div class="form-group">
            <label for="sellerName1">Primer Nombre del Propietario</label>
            <input type="text" class="form-control" id="sellerName1" placeholder="Ingrese Primer Nombre del Cliente" name="sellerName1">
        </div>

        <div class="form-group">
            <label for="sellerName2">Apellido del Propietario</label>
            <input type="text" class="form-control" id="sellerName2" placeholder="Ingrese Apellido del Propietario" name="sellerName2">
        </div>

        <div class="form-group">
            <label for="sellerContact">Numero de contacto</label>
            <input type="text" class="form-control" id="sellerContact" placeholder="Ingrese numero de contacto" name="sellerContact">
        </div>

        <div class="form-group">
            <label for="sellerDNI">DNI del Propietario</label>
            <input type="text" class="form-control" id="sellerDNI" placeholder="DNI del Propietario" name="sellerDNI">
        </div>



        <div class="form-group">
            <label for="sellerNationality">Ingrese Nacionalidad</label>
            <input type="text" class="form-control" id="sellerNationality" placeholder="Ingrese nacionalidad" name="sellerNationality">
        </div>
        
         <div class="form-group">
            <label for="population">Ingrese Poblaci&oacute;n</label>
            <input type="text" class="form-control" id="population" placeholder="Ingrese Poblaci&oacute;n" name="population">
        </div>
        
         <div class="form-group">
             <label for="postal_code">Ingrese C&oacute;digo Postal</label>
            <input type="text" class="form-control" id="postal_code" placeholder="Ingrese C&oacute;digo Postal" name="postal_code">
        </div>


        <div class="form-group">
            <label for="sellerLang">Idioma del Propietario</label>
            <select class="form-control" id="sellerLang" required="true" name="sellerLang">
                <option >-Seleccionar-</option>
                <option value="es">Espa&ntilde;ol</option>
                <option value="en">Ingles</option>
                <option value="de">Aleman</option>
                <option value="ma">Mallorquin</option>
            </select>
        </div>

        <div class="form-group">
            <label for="sellerAddress">Direcci&oacute;n del Propietario</label>
            <input type="text" class="form-control" id="sellerAddress" placeholder="Ingrese direcci&oacute;n del Propietario" name="sellerAddress">
        </div>


        <div class="form-group">
            <label for="sellerTel">Telefono del Propietario </label>
            <input type="text" class="form-control" id="sellerTel" placeholder="Ingrese un numero telefonico" name="sellerTel">
        </div>

        <div class="form-group">
            <label for="sellerMob">Telefono movil del Propietario </label>
            <input type="text" class="form-control" id="sellerMob" placeholder="Ingrese un numero de movil" name="sellerMob">
        </div>


        <div class="form-group">
            <label for="sellerFax">Fax del Propietario</label>
            <input type="text" class="form-control" id="sellerFax" placeholder="Ingrese un numero de Fax" name="sellerFax">
        </div>

        <div class="form-group">
            <label for="sellerEmail">Direcci&oacute;n de Email</label>
            <input type="email" class="form-control" id="sellerEmail" placeholder="Ingrese el Correo Electronico"  name="sellerEmail">
        </div>



        <div class="form-group">
            <label for="SSMA_TimeStamp">SSMA fecha de Inicio</label>
            <input type="date" class="form-control" id="SSMA_TimeStamp" placeholder="SSMA fecha de Inicio" name="SSMA_TimeStamp">
        </div>

        <div class="form-group">
            <label for="comment">Comentario del Cliente</label>
            <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
        </div>


        <button  onclick="saveData()" type="button" class="btn btn-primary">Registrar Propietario</button>


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
        UIkit.modal.confirm('¿Confirma que desea agregar el propietario?', {center: true, labels: {ok: 'Ok', cancel: 'Volver a alta de propietario'}}).then(function () {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
                url: '<?php echo DIR; ?>propietarios/savepropietario', // url where to submit the request
                type: "POST", // type of action POST || GET
                dataType: 'text', // data type
                data: $("#addpropietario").serialize(), // post data || get data
                success: function (result) {
                    window.location.replace("<?php echo DIR; ?>propietarios/index");

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