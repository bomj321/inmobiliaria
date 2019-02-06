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
	<div class="row">
		<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#clientes_tab" aria-controls="clientes_tab" role="tab" data-toggle="tab">Clientes</a></li>
    <li role="presentation"><a href="#reservas_tab" aria-controls="reservas_tab" role="tab" data-toggle="tab">Casas/Reservas</a></li>
    <li role="presentation"><a href="#ventas_tab" aria-controls="ventas_tab" role="tab" data-toggle="tab">Casas/Ventas</a></li>
    <li role="presentation"><a href="#alquileres_tab" aria-controls="alquileres_tab" role="tab" data-toggle="tab">Casas/Alquileres</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">


		    <div role="tabpanel" class="tab-pane active" id="clientes_tab">
		    	<?php require_once('clientes.php'); ?>

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
</div>












<!--Footer-->

<?php
//include header template
require('../layout/footer.php');
?>
<!--Footer-->

<script>
	/****************************RESERVAS*********************/
        /***********************PROGRAMACION DE RANGO DE FECHAS***********************/
      $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {

                    var min = $('#min').datepicker("getDate");
                    var max = $('#max').datepicker("getDate");

                    // need to change str order before making  date obect since it uses a new Date("mm/dd/yyyy") format for short date.
                    var d = data[7].split("-");
                    var startDate = new Date(d[1]+ "/" +  d[0] +"/" + d[2]);

                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );


       $("#min").datepicker({ onSelect: function () { reservas.draw(); }, changeMonth: true, changeYear: true , dateFormat:"dd/mm/yy"});
       $("#max").datepicker({ onSelect: function () { reservas.draw(); }, changeMonth: true, changeYear: true,  dateFormat:"dd/mm/yy" });




       $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {

                    var min_res = $('#min_res').datepicker("getDate");
                    var max_res = $('#max_res').datepicker("getDate");

                    // need to change str order before making  date obect since it uses a new Date("mm/dd/yyyy") format for short date.
                    var d = data[4].split("-");
                    var startDate_res = new Date(d[1]+ "/" +  d[0] +"/" + d[2]);

                    if (min_res == null && max_res == null) { return true; }
                    if (min_res == null && startDate_res <= max_res) { return true;}
                    if(max_res == null && startDate_res >= min_res) {return true;}
                    if (startDate_res <= max_res && startDate_res >= min_res) { return true; }
                    return false;
                }
            );


       $("#min_res").datepicker({ onSelect: function () { reservas.draw(); }, changeMonth: true, changeYear: true , dateFormat:"dd/mm/yy"});
       $("#max_res").datepicker({ onSelect: function () { reservas.draw(); }, changeMonth: true, changeYear: true,  dateFormat:"dd/mm/yy" });
/***********************PROGRAMACION DE RANGO DE FECHAS***********************/

        var reservas = $("#reservas").DataTable({
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



      /* var reservas = $('#reservas').DataTable({
           responsive: true,
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "bSort": false,




          });*/

/*CODIGO QUE ACTUALIZA LA TABLA*/
       $('#min, #max').change(function () {
                reservas.draw();
            });

       $('#min_res, #max_res').change(function () {
                reservas.draw();
            });
/*CODIGO QUE ACTUALIZA LA TABLA*/
 /****************************RESERVAS*********************/

</script>


