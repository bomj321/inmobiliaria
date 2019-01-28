<div id="nuevo-cliente" uk-modal>
    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <h5 class="uk-modal-title "><span uk-icon="icon:user;ratio:1;" class="icon-margin"></span> Creaci&oacute;n r&aacute;pida de nuevo propietario/cliente</h5>
                </div>

            </div>
        </div>
        <div class="uk-modal-body">
            <form class="uk-form-stacked" id="owner-form">  
                <div class="uk-grid uk-grid-medium">

                    <div class="uk-width-1-2">
                        <label class="uk-form-label"  for="form-stacked-text">Nombre </label>
                        <div class="uk-form-controls">
                            <input class="uk-input" name="nombre" type="text" placeholder="Ingrese Nombre">
                        </div>
                    </div>

                    <div class="uk-width-1-2">
                        <label class="uk-form-label" for="form-stacked-text">Apellidos </label>
                        <div class="uk-form-controls">
                            <input class="uk-input" name="apellidos" type="text" placeholder="Ingrese Apellido">
                        </div>
                    </div>

                    <div class="uk-width-1-2">
                        <label class="uk-form-label"  for="form-stacked-text">DNI del Propietario</label>
                        <div class="uk-form-controls">
                            <input type="text" class="uk-input" id="sellerDNI" placeholder="DNI del Propietario" name="sellerDNI">
                        </div>
                    </div>

                    <div class="uk-width-1-2">
                        <label class="uk-form-label"  for="form-stacked-text">Ingrese Nacionalidad</label>
                        <div class="uk-form-controls">
                            <input type="text" class="uk-input" id="sellerNationality" placeholder="Ingrese Nacionalidad" name="sellerNationality">
                        </div>
                    </div>

                    <div class="uk-width-1-2">
                        <label class="uk-form-label"  for="form-stacked-text">Idioma del Propietario</label>
                        <div class="uk-form-controls">
                            <select class="form-control" id="sellerLang" required="true" name="sellerLang">
                                <option >-Seleccionar-</option>
                                <option value="es">Espa&ntilde;ol</option>
                                <option value="en">Ingles</option>
                                <option value="de">Aleman</option>
                                <option value="ma">Mallorquin</option>
                            </select>
                        </div>
                    </div>


                    <div class="uk-width-1-2">
                        <label class="uk-form-label" for="form-stacked-text">Tel&eacute;fono</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" name="telefono" type="text" placeholder="Ingrese el Tel&eacute;fono">
                        </div>
                    </div>

                    <div class="uk-width-1-2">
                        <label class="uk-form-label" for="form-stacked-text">Telefono movil del Propietario</label>
                        <div class="uk-form-controls">
                            <input type="text" class="uk-input" id="sellerMob" placeholder="Ingrese un numero de movil" name="sellerMob">
                        </div>
                    </div>

                    <div class="uk-width-1-2">
                        <label class="uk-form-label" for="form-stacked-text">Numero de contacto</label>
                        <div class="uk-form-controls">
                            <input type="text" class="uk-input" id="sellerContact" placeholder="Ingrese numero de contacto" name="sellerContact">
                        </div>
                    </div>

                    <div class="uk-width-1-2">
                        <label class="uk-form-label" for="form-stacked-text">Fax del Propietario</label>
                        <div class="uk-form-controls">
                            <input type="text" class="uk-input" id="sellerFax" placeholder="Ingrese un numero de Fax" name="sellerFax">
                        </div>
                    </div>

                    <div class="uk-width-1-2">
                        <label class="uk-form-label" for="form-stacked-text">Correo electr&oacute;nico </label>
                        <div class="uk-form-controls">
                            <input class="uk-input" name="email" type="text" placeholder="Ingrese Correo electr&oacute;nico">
                        </div>
                    </div>

                    <div class="uk-width-1-2">
                        <label class="uk-form-label" for="form-stacked-text">Ingrese Poblaci&oacute;n</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" name="population" type="text" placeholder="Ingrese Poblaci&oacute;n">
                        </div>
                    </div>

                    <div class="uk-width-1-2">
                        <label class="uk-form-label" for="form-stacked-text">C&oacute;digo Postal</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" name="postal_code" type="text" placeholder="Ingrese C&oacute;digo Postal">
                        </div>
                    </div>


                    <div class="uk-width-1-2">
                        <label class="uk-form-label" for="form-stacked-text">Direcci&oacute;n del Propietario </label>
                        <div class="uk-form-controls">
                            <input type="text" class="uk-input" id="sellerAddress" placeholder="Ingrese direcci&oacute;n del Propietario" name="sellerAddress">
                        </div>
                    </div>




                    <div class="uk-width-1-2">
                        <label class="uk-form-label"  for="form-stacked-text">Tipo de Cliente</label>
                        <div class="uk-form-controls">
                            <select class="uk-input" id="propType" required="true" name="propType">
                                <option value="sale">Venta</option>
                                <option value="rental">Renta</option>     
                                <option value="alquiler">Alquiler</option>        
                            </select>
                        </div>
                    </div>

                    <div class="uk-width-1-2">
                        <label class="uk-form-label" for="form-stacked-text">ID de la Sesi&oacute;n del Cliente </label>
                        <div class="uk-form-controls">
                            <input type="text" class="uk-input" id="add_sessionID" placeholder="Ingrese ID de la Sesi&oacute;n" name="add_sessionID">
                        </div>
                    </div>

                    <div class="uk-width-1-2">
                        <label class="uk-form-label" for="form-stacked-text">Id de la Oficina</label>
                        <div class="uk-form-controls">
                            <select class="uk-input" id="OfficeID" required="true" name="OfficeID">
                                <option value="0">0</option>
                                <option value="1">1</option>                          
                            </select>
                        </div>
                    </div>

                    <div class="uk-width-1-2">
                        <label class="uk-form-label" for="form-stacked-text">Id de los Empleados</label>
                        <select class="uk-input" id="EmployeeID" required="true" name="EmployeeID">
                            <option value="0">0</option>
                            <option value="1">1</option>                          
                        </select>
                    </div>

                    <div class="uk-width-1-2">
                        <label class="uk-form-label" for="form-stacked-text">SSMA fecha de Inicio</label>
                        <div class="uk-form-controls">
                            <input type="date" class="uk-input" id="SSMA_TimeStamp" placeholder="SSMA fecha de Inicio" name="SSMA_TimeStamp">
                        </div>
                    </div>

                    <div class="uk-width-1">
                        <label class="uk-form-label" for="form-stacked-text">SSMA fecha de Inicio</label>
                        <div class="uk-form-controls">
                            <textarea class="uk-input" name="comment" style="height: 100px;"></textarea>

                        </div>
                    </div>

                </div>

        </div>
        <div class="uk-modal-footer uk-text-right">
            <p class="uk-text-center" style="font-size:0.9rem" clas="icon-margin"><span uk-icon="icon:warning;"></span> No olvides completar los datos del nuevo cliente al finalizar la gestiÃ³n de la propiedad</p>
            <button onclick="closeEdit2()" class="uk-button uk-button-default" type="button">Cancelar</button>
            <button onclick="saveData2('1')" class="uk-button uk-button-primary" type="button"><strong>Guardar cliente <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function saveData2(param) {
        if (confirm("Â¿Confirma que desea guardar el nuevo propietario?")) {


            $.ajax({
                url: '<?php echo DIR; ?>propiedades/newownerficha', // url where to submit the request
                type: "POST", // type of action POST || GET
                dataType: 'json', // data type
                data: $("#owner-form").serialize(), // post data || get data
                success: function (result) {
                    $("#owner-form")[0].reset();
                    UIkit.modal("#nuevo-cliente").hide();
                    reloadOwner();
                    $("select.box-gallery")[0].sumo.reload();
                    // $("#recargas").load(" #recargas");



                },
                error: function (xhr, resp, text, result) {

                }

            });
        } else {
        }
    }
    function closeEdit2() {
        if (confirm("¿Quiere cerrar sin guardar? Se perderán todos los cambios.")) {
            UIkit.modal("#nuevo-cliente").hide();
        } else {
        }
    }
    $(document).ready(function () {
        $('.simple').SumoSelect();
    });
</script>