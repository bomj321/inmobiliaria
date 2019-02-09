<?php 
require('../includes/config2.php'); 

if(!$user->is_logged_in()){
 header('Location: ../login'); exit();
  }

$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';
$activo="propiedades";
$activo2="";

require('../layout/header.php');
?>
<?php
include('../layout/menu.php');
?>


<?php 

$busqueda = $_POST['busqueda'];

?>
<!--HOJA DE ESTILO PERSONALIZADA-->
<link rel="stylesheet" href="<?php echo DIR;?>js/busqueda.css" />

<!--HOJA DE ESTILO PERSONALIZADA-->





<div class="container-fluid">
		<div>

			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#clientes_tab" aria-controls="clientes_tab" role="tab" data-toggle="tab">Clientes</a></li>
          <li role="presentation"><a href="#propietarios_tab" aria-controls="propietarios_tab" role="tab" data-toggle="tab">Propietarios</a></li>
			    <li role="presentation"><a href="#reservas_tab" aria-controls="reservas_tab" role="tab" data-toggle="tab">Casas/Reservas</a></li>
			    <li role="presentation"><a href="#ventas_tab" aria-controls="ventas_tab" role="tab" data-toggle="tab">Casas/Ventas</a></li>
			    <li role="presentation"><a href="#alquileres_tab" aria-controls="alquileres_tab" role="tab" data-toggle="tab">Casas/Alquileres</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">


					    <div role="tabpanel" class="tab-pane active" id="clientes_tab">
					    	<?php require_once('clientes.php'); ?>

					    </div>

              <div role="tabpanel" class="tab-pane" id="propietarios_tab">
                <?php require_once('propietarios.php'); ?>

              </div>

					    <div role="tabpanel" class="tab-pane" id="reservas_tab">

					    	<?php require_once('reservas.php'); ?>
					    </div>


					    <div role="tabpanel" class="tab-pane" id="ventas_tab">

					    	<?php require_once('ventas.php'); ?>
					    </div>


					    <div role="tabpanel" class="tab-pane" id="alquileres_tab">
					    	<?php require_once('alquileres.php'); ?>
					    	
					    </div>

			  </div>

		</div>
</div>











<?php require_once('modal_editar.php') ?>
<!--Footer-->

<?php
//include header template
require('../layout/footer.php');
?>
<!--Footer-->

	<script>

 $("#reservas_busqueda").DataTable({
                  "iDisplayLength": 25,
                  'responsive': true,
                   language: {
                      "sProcessing":     "Procesando...",
                      "sLengthMenu":     "Mostrar _MENU_ registros",
                      "sZeroRecords":    "No se encontraron resultados",
                      "sEmptyTable":     "Ningún dato disponible en esta tabla",
                      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                      "sInfoPostFix":    "",
                      "sSearch":         "Buscar:",
                      "sUrl":            "",
                      "sInfoThousands":  ",",
                      "sLoadingRecords": "Cargando...",
                      "oPaginate": {
                          "sFirst":    "Primero",
                          "sLast":     "Último",
                          "sNext":     "Siguiente",
                          "sPrevious": "Anterior"
                  },
                  "oAria": {
                      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                  }
              },
              "aaSorting": [[ 0, "desc" ]],
          });

 $("#clientes_busqueda").DataTable({
                  "iDisplayLength": 25,
                  'responsive': true,
                   language: {
                      "sProcessing":     "Procesando...",
                      "sLengthMenu":     "Mostrar _MENU_ registros",
                      "sZeroRecords":    "No se encontraron resultados",
                      "sEmptyTable":     "Ningún dato disponible en esta tabla",
                      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                      "sInfoPostFix":    "",
                      "sSearch":         "Buscar:",
                      "sUrl":            "",
                      "sInfoThousands":  ",",
                      "sLoadingRecords": "Cargando...",
                      "oPaginate": {
                          "sFirst":    "Primero",
                          "sLast":     "Último",
                          "sNext":     "Siguiente",
                          "sPrevious": "Anterior"
                  },
                  "oAria": {
                      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                  }
              },
              "aaSorting": [[ 0, "desc" ]],
          });


 $("#ventas_busqueda").DataTable({
                  "iDisplayLength": 25,
                  'responsive': true,
                   language: {
                      "sProcessing":     "Procesando...",
                      "sLengthMenu":     "Mostrar _MENU_ registros",
                      "sZeroRecords":    "No se encontraron resultados",
                      "sEmptyTable":     "Ningún dato disponible en esta tabla",
                      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                      "sInfoPostFix":    "",
                      "sSearch":         "Buscar:",
                      "sUrl":            "",
                      "sInfoThousands":  ",",
                      "sLoadingRecords": "Cargando...",
                      "oPaginate": {
                          "sFirst":    "Primero",
                          "sLast":     "Último",
                          "sNext":     "Siguiente",
                          "sPrevious": "Anterior"
                  },
                  "oAria": {
                      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                  }
              },
               "aaSorting": [[ 0, "desc" ]],
          });

     $("#propietarios_busqueda").DataTable({
                  "iDisplayLength": 25,
                  'responsive': true,
                   language: {
                      "sProcessing":     "Procesando...",
                      "sLengthMenu":     "Mostrar _MENU_ registros",
                      "sZeroRecords":    "No se encontraron resultados",
                      "sEmptyTable":     "Ningún dato disponible en esta tabla",
                      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                      "sInfoPostFix":    "",
                      "sSearch":         "Buscar:",
                      "sUrl":            "",
                      "sInfoThousands":  ",",
                      "sLoadingRecords": "Cargando...",
                      "oPaginate": {
                          "sFirst":    "Primero",
                          "sLast":     "Último",
                          "sNext":     "Siguiente",
                          "sPrevious": "Anterior"
                  },
                  "oAria": {
                      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                  }
              },
               "aaSorting": [[ 0, "desc" ]],
          });


            $("#alquileres_busqueda").DataTable({
                  "iDisplayLength": 25,
                  'responsive': true,
                   language: {
                      "sProcessing":     "Procesando...",
                      "sLengthMenu":     "Mostrar _MENU_ registros",
                      "sZeroRecords":    "No se encontraron resultados",
                      "sEmptyTable":     "Ningún dato disponible en esta tabla",
                      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                      "sInfoPostFix":    "",
                      "sSearch":         "Buscar:",
                      "sUrl":            "",
                      "sInfoThousands":  ",",
                      "sLoadingRecords": "Cargando...",
                      "oPaginate": {
                          "sFirst":    "Primero",
                          "sLast":     "Último",
                          "sNext":     "Siguiente",
                          "sPrevious": "Anterior"
                  },
                  "oAria": {
                      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                  }
              },
               "aaSorting": [[ 0, "desc" ]],
          });


/*RESPUESTA A LOS MODALES*/
function modalEditar($id){

	var cliente = {
      id:        $id,     
    };  
	

	$.ajax({
            url: "<?php echo DIR;?>busquedas/respuesta_modal_clientes",
             type:"POST",
             data: cliente,
            beforeSend: function() {
                     toastr.warning('Espere Cargando Información...');
                     toastr.clear()

              },
               success:function(resp){    
             	$('#modal_editar').modal('show');
                $("#modal_editar .modal-body").html(resp);
                $("#modal_editar .modal-title").html('Editar Cliente numero'+' '+$id);
                 var plantilla = `
                    <strong>Editar cliente <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong>
                `;
                $('.boton_editar').html(plantilla);


            },
            error:function(){
             toastr.error('Ha ocurrido un error, intente más tarde.', 'Disculpenos!') 
            }

      });

}

function modalEditarProp($id){

  var cliente = {
      id:        $id,     
    };  
  

  $.ajax({
            url: "<?php echo DIR;?>busquedas/respuesta_modal_propietarios",
             type:"POST",
             data: cliente,
            beforeSend: function() {
                     toastr.warning('Espere Cargando Información...');
                     toastr.clear()

              },
               success:function(resp){    
              $('#modal_editar').modal('show');
                $("#modal_editar .modal-body").html(resp);
                $("#modal_editar .modal-title").html('Editar Propietario numero'+' '+$id);
                var plantilla = `
                    <strong>Editar propietario <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong>
                `;
                $('.boton_editar').html(plantilla);

            },
            error:function(){
             toastr.error('Ha ocurrido un error, intente más tarde.', 'Disculpenos!') 
            }

      });

}

function modalEditarReservas($id){

  var cliente = {
      id:        $id,     
    };  
  

  $.ajax({
            url: "<?php echo DIR;?>busquedas/respuesta_modal_reservas",
             type:"POST",
             data: cliente,
            beforeSend: function() {
                     toastr.warning('Espere Cargando Información...');                     

              },
               success:function(resp){    
              $('#modal_editar').modal('show');
                $("#modal_editar .modal-body").html(resp);
                $("#modal_editar .modal-title").html('Editar Reservas numero'+' '+$id);
                var plantilla = `
                    <strong>Editar Reserva <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong>
                `;
                $('.boton_editar').html(plantilla);

            },
            error:function(){
             toastr.error('Ha ocurrido un error, intente más tarde.', 'Disculpenos!') 
            }

      });

}

/*RESPUESTA A LOS MODALES*/

/*ACTUALIZAR*/

function updatecliente() {
    if (confirm("¿Confirma que desea editar el Cliente?")) {
            $.ajax({
                url: '<?php echo DIR;?>busquedas/updatecliente', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'json', // data type
                data : $("#client-form").serialize(), // post data || get data
            });
            $('#modal_editar').modal('hide');          
} }

function updatepropietario() {
    if (confirm("¿Confirma que desea editar el Propietario?")) {
            $.ajax({
                url: '<?php echo DIR;?>busquedas/updatepropietario', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'json', // data type
                data : $("#owner-form").serialize(), // post data || get data
            });
            $('#modal_editar').modal('hide');          
} }

function updatereserva() {
    if (confirm("¿Confirma que desea editar la Reserva?")) {
            $.ajax({
                url: '<?php echo DIR;?>busquedas/updatereservas', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'json', // data type
                data : $("#updatereserva").serialize(), // post data || get data
            });
            $('#modal_editar').modal('hide');          
} }

/*ACTUALIZAR*/
</script>









<!---------------------------------------JAVASCRIPT DEL MODAL DE RESERVAS--------------------------------------------->
<script type="text/javascript" >
function saveData() {

  /*VALIDAR QUE SE HIZO EL CALCULO*/
var pendiente_input = $('#bookingOutstanding').val();
  if(pendiente_input == 'Calcular Pendiente')
  {
    alert('El campo Pendiente no puede ser Vacio');
    return false;
  }
/*VALIDAR QUE SE HIZO EL CALCULO*/

  UIkit.modal.confirm('¿Confirma que desea editar la Reserva?', { center:true, labels: { ok: 'Ok', cancel: 'Volver a edición de Reservas' } }).then(function() {
   for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
      $.ajax({
                url: '<?php echo DIR;?>reservas/updatereservas', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'text', // data type
                data : $("#updatereserva").serialize(), // post data || get data
                success : function(result) {
                   window.location.replace("<?php echo DIR;?>reservas/index");

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

 <!--SOLO NUMEROS-->
<script>
  function solonumeros(e){
  key = e.keyCode || e.which;
  teclado= String.fromCharCode(key);
  numeros ="0,1,2,3,4,5,6,7,8,9";
  especiales =[8,37,39,46]; // array
  teclado_especial = false;


  for (var i in especiales){
    if(key==especiales[i] || key ==numeros){
      teclado_especial = true;

    }
  }
  

  if(numeros.indexOf(teclado)==-1 && !teclado_especial){
      
      return false;

  }
}
</script>
<!--SOLO NUMEROS-->

<!--CALCULO DEL PRECIO-->
<script>
  function calculo_precio(){
    var precio    = $('#precio').val();
    var descuento = $('#bookingFeeType').val();   
    var pagado    = $('#bookingDeposit').val();

/*VALIDACIONES*/
    if (isNaN(descuento) || descuento == '') {
      descuento = 0;
    }

    if (isNaN(precio) || precio == '') {
      precio = 0;
    }

    if (isNaN(pagado) || pagado == '') {
      pagado = 0;
    }
/*VALIDACIONES*/

  var total = parseInt(precio)-(parseInt(descuento)+parseInt(pagado));

  if (total <= 0 || precio == 0) {

    alert('Calculo no es posible');
    return false;
  }else{
    $('#bookingOutstanding').val(total);
  } 

  }
</script>
<!--CALCULO DEL PRECIO-->

<!--SUMO SELECT-->
<script>
   $(document).ready(function () {
                $('.box-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...', selectAll: false, noMatch: 'No hay resultados para "{0}"', captionFormat: '{0} Seleccionados',
                    captionFormatAllSelected: '{0} todos seleccionados', locale: ['OK', 'Cancelar', 'Seleccionar todo']});

                 $('.box-gallery-propiedad').SumoSelect({search: true, searchText: 'Escribir aquí...', selectAll: false, noMatch: 'No hay resultados para "{0}"', captionFormat: '{0} Seleccionados',
                    captionFormatAllSelected: '{0} todos seleccionados', locale: ['OK', 'Cancelar', 'Seleccionar todo']});

            });
</script>
<!--SUMO SELECT-->


<!---------------------------------------JAVASCRIPT DEL MODAL DE RESERVAS--------------------------------------------->








