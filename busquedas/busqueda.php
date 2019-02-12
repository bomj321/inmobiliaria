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

<!--SCRIPT PARA DETECTAR QUIEN TIENE MAS REGISTROS-->
    



<!--SCRIPT PARA DETECTAR QUIEN TIENE MAS REGISTROS-->


<div class="container">
  <div class="row" style="margin-bottom: 30px;">
      <button class="btn btn-primary btn-lg"> Busqueda para: <?php echo $busqueda; ?></button>
  </div>
	<div class="row">
    <?php require_once('orden.php'); ?>
    
  </div>
</div>









<div id="periodosReservas" class="uk-modal-container">
<div id="calendarioReservas" class="uk-modal-container">
  <div id="preview-modal"></div>

<?php
 require_once('modal_editar.php'); 

 ?>
<!--Footer-->

<?php
//include header template
require('../layout/footer.php');
include ("../layout/galeria-listados.php");

?>
<!--Footer-->

	<script>
$( document ).ready(function() {
    

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

$("#ventas_busqueda").dataTable().fnDestroy();

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





<!--JAVASCRIPT DE LA SECCION DE VENtas-->
<script>
    function previewModal(param,divid) {
                 $.ajax({
            type: "POST",
            url: "<?php echo DIR;?>propiedades/preview.php",
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
    url: "<?php echo DIR;?>propiedades/previewgallery.php",
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


/*JAVASCRIPT PARA EL MODAL*/



</script>


<!--JAVASCRIPT DE LA SECCION DE VENtas-->




<!--SECCION ALQUILERES-->
<script>

  function previewModalRentals(param) {
         $.ajax({
  type: "POST",
  url: "<?php echo DIR;?>propiedades/preview_rentals",
  data:'ref='+param,
       beforeSend: function(){
   $(".loader").show();
  },
  success: function(data){
    $(".loader").fadeOut("slow");
    $("#preview-modal").html(data);


  }
  });
        }
function previewGalleryRentals(param,divid) {
         $.ajax({
  type: "POST",
  url: "<?php echo DIR;?>propiedades/previewgallery_rentals",
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


  function verperiodos($id) {
  var id = $id;

  $.ajax({
        url: '<?php echo DIR;?>propiedades/senciyaPeriodos?idrental=' + id, // url where to submit the request
        beforeSend: function(){
        $(".loader").show();
    },
        success : function(result) {
          $(".loader").fadeOut("slow");
      $("#periodosReservas").html(result);
      UIkit.modal("#periodosReservas").show();
        }
    });
}
function vercalendario($id) {
  var id = $id;

  $.ajax({
        url: '<?php echo DIR;?>propiedades/senciyaCalendar?idrental=' + id, // url where to submit the request
        beforeSend: function(){
        $(".loader").show();
    },
        success : function(result) {
          $(".loader").fadeOut("slow");
      $("#calendarioReservas").html(result);
      UIkit.modal("#calendarioReservas").show();
        }
    });
}
</script>

<!--SECCION ALQUILERES-->


<!--JS PARA EL AJAX-->
<script>
  var load_clientes = function(p, num_total,busqueda){
  
  $("#clients_items").remove();
  num = ((p - 1) * 5) + 1;
  pag = p + 1;
  num_ini = num;
  busqueda = busqueda;
  
  $.ajax({
    type: "GET",
    url : 'respuesta_ajax_clientes.php?p='+p+'&busqueda='+busqueda,
    async: true,
     beforeSend : function(){
        toastr.warning('Espere Cargando Información...');  
    },
    success : function (datos){
      var dataJson = eval(datos);
        
        for(var i in dataJson){
          var plantilla_tabla = `
                    <div class="panel-group" id="item-${num}" role="tablist" aria-multiselectable="true" >
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading${num}">
                              <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#item-${num}" href="#collapse${num}" aria-expanded="true" aria-controls="collapse${num}">
                                  ${dataJson[i].cliente_nombre}
                                </a>
                              </h4>
                            </div>
                            <div id="collapse${num}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading${num}">
                              <div class="panel-body">

                               <p><strong>ID del Cliente: </strong>${dataJson[i].cliente_id}</p>
                               <p><strong>Tipo del Cliente: </strong>${dataJson[i].cliente_tipo}</p>                   
                              <p><strong>Fecha de Creaci&oacute;n: </strong><a style='color: black;' onclick="previewModal('${dataJson[i].cliente_id}')" class="uk-text-truncate">${dataJson[i].cliente_fecha}</a></p>                    
                               <p><strong>Email del Cliente: </strong>${dataJson[i].cliente_email}</p> 
                               <p><strong>Telefono del Cliente: </strong>${dataJson[i].cliente_cellp}</p>
                               <button class="btn btn-danger" id='boton_clientes_editar' onclick="modalEditar(${dataJson[i].cliente_id})">Editar Cliente</button>



                              </div>
                            </div>       
                          </div>     
                  </div>
             `
          
          $("#clients_list").append(plantilla_tabla);          
          num++;
        }

        if(num<=num_total){

          var plantilla_boton = `
            <div id="clients_items">
               <button class="btn btn-warning pull-right boton_ver_mas btn-lg" onclick="load_clientes(${pag},${num_total},'${busqueda}')">Ver más</button>
            </div>   
          `
          $("#clients_list").append(plantilla_boton);
            
        }
      
    }
  });
  return false; 
};


/************************PROPIETARIOS*************************************************/

 var load_owners = function(p, num_total,busqueda){
  
  $("#owners_items").remove();
  num = ((p - 1) * 5) + 1;
  pag = p + 1;
  num_ini = num;
  busqueda = busqueda;
  
  $.ajax({
    type: "GET",
    url : 'respuesta_ajax_propietarios.php?p='+p+'&busqueda='+busqueda,
    async: true,
     beforeSend : function(){
        toastr.warning('Espere Cargando Información...');  
    },
    success : function (datos){
      var dataJson = eval(datos);
        
        for(var i in dataJson){
          var plantilla_tabla = `
                    <div class="panel-group" id="owner-${num}" role="tablist" aria-multiselectable="true" >
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading${num}">
                              <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#owner-${num}" href="#owner${num}" aria-expanded="true" aria-controls="collapse${num}">
                                  ${dataJson[i].propietario_nombre}
                                </a>
                              </h4>
                            </div>
                            <div id="owner${num}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading${num}">
                              <div class="panel-body">

                               <p><strong>ID del Cliente: </strong>${dataJson[i].propietario_id}</p>
                               <p><strong>Tipo del Cliente: </strong>${dataJson[i].propietario_tipo}</p>                   
                              <p><strong>Fecha de Creaci&oacute;n: </strong><a style='color: black;' onclick="previewModal('${dataJson[i].propietario_id}')" class="uk-text-truncate">${dataJson[i].propietario_fecha}</a></p>                    
                               <p><strong>Email del Cliente: </strong>${dataJson[i].propietario_email}</p> 
                               <p><strong>Telefono del Cliente: </strong>${dataJson[i].propietario_cellp}</p>
                               <button class="btn btn-danger" id='boton_clientes_editar' onclick="modalEditar(${dataJson[i].propietario_id})">Editar Cliente</button>



                              </div>
                            </div>       
                          </div>     
                  </div>
             `
          
          $("#owners_list").append(plantilla_tabla);          
          num++;
        }

        if(num<=num_total){

          var plantilla_boton = `
            <div id="owners_items">
               <button class="btn btn-primary pull-right boton_ver_mas btn-lg" onclick="load_owners(${pag},${num_total},'${busqueda}')">Ver más</button>
            </div>   
          `
          $("#owners_list").append(plantilla_boton);
            
        }
      
    }
  });
  return false; 
};


/*************************************RESERVAS***************************************************************/

var load_reservas = function(p, num_total,busqueda){
  
  $("#reservas_items").remove();
  num = ((p - 1) * 5) + 1;
  pag = p + 1;
  num_ini = num;
  busqueda = busqueda;
  
  $.ajax({
    type: "GET",
    url : 'respuesta_ajax_reservas.php?p='+p+'&busqueda='+busqueda,
    async: true,
    beforeSend : function(){
        toastr.warning('Espere Cargando Información...');  
    },
    success : function (datos){
      var dataJson = eval(datos);
        
        for(var i in dataJson){
          var plantilla_tabla = `
                     <div class="panel-group" id="reserva-${num}" role="tablist" aria-multiselectable="true" >
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading${num}">
                              <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#reserva-${num}" href="#reserva${num}" aria-expanded="true" aria-controls="collapse${num}">
                                  ${dataJson[i].reserva_name}
                                </a>
                              </h4>
                            </div>
                            <div id="reserva${num}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading${num}">
                              <div class="panel-body">
                                   <p><strong>ID de la Reserva: </strong>${dataJson[i].reserva_id}</p>

                                   <p><strong>Fecha de la Reserva: </strong>${dataJson[i].reserva_fecha}</p>
                                   <p><strong>Cliente: </strong>${dataJson[i].reserva_cliente}</p>                   
                                                  
                                   <p><strong>Tipo Propiedad: </strong>${dataJson[i].reserva_tipo}</p> 
                                   <p><strong>Fecha de Entrada: </strong>${dataJson[i].reserva_entrada}</p>
                                   <p><strong>Tipo de Reserva: </strong>${dataJson[i].reserva_tipo_boton}</p>

                                   <p><strong>Precio: </strong>${dataJson[i].reserva_precio}</p>
                                   <p><strong>Owner: </strong>${dataJson[i].reserva_owner}</p>
                                   <p><strong>Charges: </strong>${dataJson[i].reserva_chargues}</p>
                                   <p><strong>Discount: </strong>${dataJson[i].reserva_discount}</p>

                                   <p><strong>Direcci&oacute;n: </strong>${dataJson[i].reserva_direccion}</p>
                                   <p><strong>Adultos: </strong>${dataJson[i].reserva_adultos}</p>
                                   <p><strong>Ni&ntilde;os: </strong>${dataJson[i].reserva_ninos}</p>
                                   <p><strong>Edades: </strong>${dataJson[i].reserva_edad}</p>
                                   <p><strong>Comentarios: </strong>${dataJson[i].reserva_notas}</p>
                                   <p><strong>Profit: </strong>${dataJson[i].reserva_total}</p>
                                  <button class="btn btn-warning" onclick="modalEditarReservas(${dataJson[i].reserva_id})">Editar Reserva</button>

                              </div>
                            </div>       
                          </div>     
                  </div>
             `
          
          $("#reservas_list").append(plantilla_tabla);          
          num++;
        }

        if(num<=num_total){

          var plantilla_boton = `
            <div id="reservas_items">
               <button class="btn btn-danger pull-right btn-lg" onclick="load_reservas(${pag},${num_total},'${busqueda}')">Ver más</button>
            </div>   
          `
          $("#reservas_list").append(plantilla_boton);
            
        }
      
    }
  });
  return false; 
};

/********************************************************VENTAS*************************************************************/

var load_ventas = function(p, num_total,busqueda){
  
  $("#ventas_items").remove();
  num = ((p - 1) * 5) + 1;
  pag = p + 1;
  num_ini = num;
  busqueda = busqueda;
  url = "<?php echo DIR; ?>";
  $.ajax({
    type: "GET",
    url : 'respuesta_ajax_ventas.php?p='+p+'&busqueda='+busqueda,
    async: true,
    beforeSend : function(){
        toastr.warning('Espere Cargando Información...');  
    },
    success : function (datos){
      var dataJson = eval(datos);
        
        for(var i in dataJson){

            if (dataJson[i].venta_foto =='imagen_grande_vacia') {
                var foto = `
                     <div uk-lightbox style="width:50px;height:50px; " id="activadas${num}">   
                                        <a style='color: black;' href="${url}images/nofoto.jpg" data-caption="<button onclick=previewGallery('${num}','venta${num}') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
                                           <div style="background:url(${url}images/nofotosmall.jpg) no-repeat 50% 50%;height:100%; border-radius:50px"></div> 
                    </div>

                `
            }else if(dataJson[i].venta_foto=="imagen_grande_no_vacia"){
                  var foto = `
                     <div uk-lightbox style="width:50px;height:50px; " id="activadas${num}">   
                                        <a style='color: black;' href="${url}images/nofoto.jpg" data-caption="<button onclick=previewGallery('${num}','venta${num}') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
                                           <div style="background:url(${dataJson[i].venta_img_grande}) no-repeat 50% 50%;height:100%; border-radius:50px"></div> 
                    </div>

                `
            }else if(dataJson[i].venta_foto=='imagen_pequena_vacia'){
                     var foto = `
                     <div uk-lightbox style="width:50px;height:50px; " id="activadas${num}">   
                                        <a style='color: black;' href="${url}images/nofoto.jpg" data-caption="<button onclick=previewGallery('${num}','venta${num}') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
                                           <div style="background:url(${url}images/nofotosmall.jpg) no-repeat 50% 50%;height:100%; border-radius:50px"></div> 
                    </div>

                `



            }else if(dataJson[i].venta_foto=='imagen_pequena_no_vacia'){
                     var foto = `
                     <div uk-lightbox style="width:50px;height:50px; " id="activadas${num}">   
                                        <a style='color: black;' href="${url}images/nofoto.jpg" data-caption="<button onclick=previewGallery('${num}','venta${num}') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
                                           <div style="background:url(${dataJson[i].venta_img_chica}) no-repeat 50% 50%;height:100%; border-radius:50px"></div> 
                    </div>

                `


            }


          var plantilla_tabla = `
                     <div class="panel-group" id="venta-${num}" role="tablist" aria-multiselectable="true" >
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading${num}">
                              <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#venta-${num}" href="#venta${num}" aria-expanded="true" aria-controls="collapse${num}">
                                  ${dataJson[i].venta_name}
                                </a>
                              </h4>
                            </div>
                            <div id="venta${num}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading${num}">
                              <div class="panel-body">
                              </strong>
                                   <strong>Imagen: </strong>${foto}
                                   <p><strong>Estado: </strong>${dataJson[i].venta_active}</p>        
                                   <p><strong>Referencia: </strong><a style='color: black;' onclick="previewModal('${dataJson[i].venta_id}')" ><span style="font-weight:600">${dataJson[i].venta_ref}</span></a></p> 
                                   <p><strong>Tipo: </strong> ${dataJson[i].venta_casa_tipo}</p>      
                                   <p><strong>Propietario / Cliente: </strong>
                                     <a style='color: black;' onclick="modalEditarProp(${dataJson[i].venta_vendedor})" >${dataJson[i].venta_cliente}</a>
                                  </p>     
                                  <p><strong>Poblaci&oacute;n: </strong>${dataJson[i].venta_poblacion}</p>
                                 <p><strong>Precio: </strong>${dataJson[i].venta_precio}</p>  

                                 <button class="btn btn-danger" onclick="previewModal('${dataJson[i].venta_id}')">Previsualizar</button>
                                 <button class="btn btn-success" onclick="previewGallery('${dataJson[i].venta_id}','venta${num}')">Galer&iacute;a</button>
                                 <button class="btn btn-primary" href="http://www.villasplanet.com/es/venta-${dataJson[i].title2}-ref-${dataJson[i].venta_ref}" target="new" >Ficha web</button>      

                              </div>
                            </div>       
                          </div>     
                  </div>
             `
          
          $("#ventas_list").append(plantilla_tabla);          
          num++;
        }

        if(num<=num_total){

          var plantilla_boton = `
            <div id="ventas_items">
               <button class="btn btn-success pull-right btn-lg" onclick="load_ventas(${pag},${num_total},'${busqueda}')">Ver más</button>
            </div>   
          `
          $("#ventas_list").append(plantilla_boton);
            
        }
      
    }
  });
  return false; 
};

/***********************************ALQUILERES******************************************/

var load_alquileres = function(p, num_total,busqueda){
  
  $("#alquileres_items").remove();
  num = ((p - 1) * 5) + 1;
  pag = p + 1;
  num_ini = num;
  busqueda = busqueda;
  url = "<?php echo DIR; ?>";
  $.ajax({
    type: "GET",
    url : 'respuesta_ajax_alquileres.php?p='+p+'&busqueda='+busqueda,
    async: true,
    beforeSend : function(){
        toastr.warning('Espere Cargando Información...');  
    },
    success : function (datos){
      var dataJson = eval(datos);
        
        for(var i in dataJson){

            if (dataJson[i].venta_foto =='imagen_grande_vacia') {
                var foto = `
                     <div uk-lightbox style="width:50px;height:50px; " id="activadas${num}">   
                                        <a style='color: black;' href="${url}images/nofoto.jpg" data-caption="<button onclick=previewGalleryRentals('${num}','alquiler${num}') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
                                           <div style="background:url(${url}images/nofotosmall.jpg) no-repeat 50% 50%;height:100%; border-radius:50px"></div> 
                    </div>

                `
            }else if(dataJson[i].venta_foto=="imagen_grande_no_vacia"){
                  var foto = `
                     <div uk-lightbox style="width:50px;height:50px; " id="activadas${num}">   
                                        <a style='color: black;' href="${url}images/nofoto.jpg" data-caption="<button onclick=previewGalleryRentals('${num}','alquiler${num}') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
                                           <div style="background:url(${dataJson[i].alquiler_img_grande}) no-repeat 50% 50%;height:100%; border-radius:50px"></div> 
                    </div>

                `
            }else if(dataJson[i].venta_foto=='imagen_pequena_vacia'){
                     var foto = `
                     <div uk-lightbox style="width:50px;height:50px; " id="activadas${num}">   
                                        <a style='color: black;' href="${url}images/nofoto.jpg" data-caption="<button onclick=previewGalleryRentals('${num}','alquiler${num}') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
                                           <div style="background:url(${url}images/nofotosmall.jpg) no-repeat 50% 50%;height:100%; border-radius:50px"></div> 
                    </div>

                `



            }else if(dataJson[i].venta_foto=='imagen_pequena_no_vacia'){
                     var foto = `
                     <div uk-lightbox style="width:50px;height:50px; " id="activadas${num}">   
                                        <a style='color: black;' href="${url}images/nofoto.jpg" data-caption="<button onclick=previewGalleryRentals('${num}','alquiler${num}') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
                                           <div style="background:url(${dataJson[i].alquiler_img_chica}) no-repeat 50% 50%;height:100%; border-radius:50px"></div> 
                    </div>

                `


            }


          var plantilla_tabla = `
                     <div class="panel-group" id="alquiler-${num}" role="tablist" aria-multiselectable="true" >
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading${num}">
                              <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#alquiler-${num}" href="#alquiler${num}" aria-expanded="true" aria-controls="collapse${num}">
                                  ${dataJson[i].alquiler_name}
                                </a>
                              </h4>
                            </div>
                            <div id="alquiler${num}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading${num}">
                              <div class="panel-body">
                              </strong>
                                   <strong>Imagen: </strong>${foto}
                                    <p style="margin-top: 40px;"><strong>ID: </strong>${dataJson[i].alquiler_id}</p>
                                   <p><strong>Estado: </strong>${dataJson[i].alquiler_active}</p>        
                                   <p><strong>Referencia: </strong><a style='color: black;' onclick="previewModalRentals('${dataJson[i].alquiler_id}')" ><span style="font-weight:600">${dataJson[i].alquiler_ref}</span></a></p> 
                                   <p><strong>Tipo: </strong> ${dataJson[i].alquiler_casa_tipo}</p>      
                                   <p><strong>Propietario / Cliente: </strong>
                                     <a style='color: black;' onclick="modalEditarProp(${dataJson[i].alquiler_vendedor})" >${dataJson[i].alquiler_cliente}</a>
                                  </p>     
                                  <p><strong>Poblaci&oacute;n: </strong>${dataJson[i].alquiler_poblacion}</p>
                                 <p><strong>Precio: </strong>${dataJson[i].alquiler_precio}</p>  

                                  <button class="btn btn-danger" onclick="previewModalRentals('${dataJson[i].alquiler_id}')">Previsualizar</button>
                                 <button class="btn btn-success" onclick="previewGalleryRentals('${dataJson[i].alquiler_id}','alquiler${num}')">Galer&iacute;a</button>
                                 <button class="btn btn-primary" href="http://www.villasplanet.com/es/venta-${dataJson[i].title2}-ref-${dataJson[i].alquiler_ref}" target="new" >Ficha web</button> 

                                 <button class="btn btn-warning" onclick="vercalendario('${dataJson[i].alquiler_id}','alquiler${num}')">Calendario</button>

                                 <button class="btn btn-default" onclick="verperiodos('${dataJson[i].alquiler_id}','alquiler${num}')">Periodos</button>   

                              </div>
                            </div>       
                          </div>     
                  </div>
             `
          
          $("#alquileres_list").append(plantilla_tabla);          
          num++;
        }

        if(num<=num_total){

          var plantilla_boton = `
            <div id="alquileres_items">
               <button class="btn btn-default pull-right btn-lg" onclick="load_alquileres(${pag},${num_total},'${busqueda}')">Ver más</button>
            </div>   
          `
          $("#alquileres_list").append(plantilla_boton);
            
        }
      
    }
  });
  return false; 
};


</script>
<!--JS PARA EL AJAX-->

