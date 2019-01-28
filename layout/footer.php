</div>


 

<script src="<?php echo DIR;?>js/jquery.min.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.js"></script>
<script src="<?php echo DIR;?>js/villasplanetxcontrol.min.js"></script> 
<script src="<?php echo DIR;?>js/villasplanetxcontrol-icons.min.js"></script>
<script src="<?php echo DIR;?>js/jquery.sumoselect.js"></script>
<!--AGREGANDO JS DE BOOTSTRAP-->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--AGREGANDO JS DE BOOTSTRAP-->
<!--DATATABLE.JS-->
    <script src="<?php echo DIR;?>js/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo DIR;?>js/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo DIR;?>js/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo DIR;?>js/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo DIR;?>js/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo DIR;?>js/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo DIR;?>js/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo DIR;?>js/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo DIR;?>js/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo DIR;?>js/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo DIR;?>js/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo DIR;?>js/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
});
</script>
    
<script>  

    $(document).ready(function() {

       //Check to see if the window is top if not then display button
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });

    //Click event to scroll to top
    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });  

     $("#alquileres").DataTable({
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
                      "sSearch":         "Buscar en listado:",
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

    $("#services").DataTable({
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
                      "sSearch":         "Buscar en listado:",
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
              "aaSorting": [[ 1, "desc" ]],
          });

     $("#propietarios").DataTable({
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
                      "sSearch":         "Buscar en listado:",
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



         $("#example1").DataTable({
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
                      "sSearch":         "Buscar en listado:",
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
              "aaSorting": [[ 2, "desc" ]],
          });

          $("#example2").DataTable({
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
                      "sSearch":         "Buscar en listado:",
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
               "aaSorting": [[ 2, "desc" ]],
          });

          $("#example3").DataTable({
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
                      "sSearch":         "Buscar en listado:",
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
              "aaSorting": [[ 2, "desc" ]],
          });

          $("#example4").DataTable({
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
                      "sSearch":         "Buscar en listado:",
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
              "aaSorting": [[ 2, "desc" ]],
          });


   

      /* $('#min, #max').change(function () {
                table.draw();
            });  */


      });

</script>
<!--DATATABLE.JS-->
<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
});
</script>
<!--JS PARA EL MENU-->
<script>
  function desplegar($id){
    var id = $id;
    $('#'+id).removeClass('dropdown');
    $('#'+id).addClass('open');
    
  }

   function retraer($id){
    var id = $id;
    $('#'+id).removeClass('open');
    $('#'+id).addClass('dropdown');
    
  }
</script>
<!--JS PARA EL MENU-->


<!------------------------------JS PARA EL FORMULARIO DE EXTRAS DE ALQUILERES-->
<script>
//TIPO DE FORMULARIO 

  function tipo_formulario_ajax () {
           // var catalogo   = document.getElementById("catalogo");
           var selecvalue = aplica.options[aplica.selectedIndex].value;
  if (selecvalue == 1 || selecvalue == 2) {
            $.ajax({
                url: '<?php echo DIR;?>extras/ajax_tipo_formulario_parte1.php',
                beforeSend: function() {
                     $('#tipo_formulario_parte_1').html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#tipo_formulario_parte_1').html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#tipo_formulario_parte_1').html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });


             $.ajax({
                url: '<?php echo DIR;?>extras/ajax_tipo_formulario_parte2.php',
                beforeSend: function() {
                     $('#tipo_formulario_parte_2').html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#tipo_formulario_parte_2').html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#tipo_formulario_parte_2').html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });
  }else if(selecvalue == 0){
     $('#tipo_formulario_parte_1').html("");
     $('#tipo_formulario_parte_2').html("");
  }else{
     $.ajax({
                url: '<?php echo DIR;?>extras/ajax_tipo_formulario_parte1_version2.php',
                beforeSend: function() {
                     $('#tipo_formulario_parte_1').html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#tipo_formulario_parte_1').html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#tipo_formulario_parte_1').html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });


             $.ajax({
                url: '<?php echo DIR;?>extras/ajax_tipo_formulario_parte2.php',
                beforeSend: function() {
                     $('#tipo_formulario_parte_2').html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#tipo_formulario_parte_2').html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#tipo_formulario_parte_2').html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });
  }
     
};

//TIPO DE FORMULARIO 

// PRECIOS
function precio_formulario_ajax () {
           // var catalogo   = document.getElementById("catalogo");
           var selecvalue = precio_incluido.options[precio_incluido.selectedIndex].value;
  if (selecvalue == 0) {
            $.ajax({
                url: '<?php echo DIR;?>extras/ajax_precio_formulario_parte1.php',
                beforeSend: function() {
                     $('#precio_formulario_parte_1').html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#precio_formulario_parte_1').html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#precio_formulario_parte_1').html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });


             $.ajax({
                url: '<?php echo DIR;?>extras/ajax_precio_formulario_parte2.php',
                beforeSend: function() {
                     $('#precio_formulario_parte_2').html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#precio_formulario_parte_2').html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#precio_formulario_parte_2').html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });
  }else if(selecvalue == 1){
     $('#precio_formulario_parte_1').html("");
     $('#precio_formulario_parte_2').html("");
  }else{



  }
     
};
// PRECIOS

// CANTIDADES
function cantidad_formulario_ajax () {
           // var catalogo   = document.getElementById("catalogo");
           var selecvalue = cantidad.options[cantidad.selectedIndex].value;
  if (selecvalue == 1) {
            $.ajax({
                url: '<?php echo DIR;?>extras/ajax_cantidad_formulario.php',
                beforeSend: function() {
                     $('#cantidad_formulario').html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#cantidad_formulario').html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#cantidad_formulario').html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });

            
  }else if(selecvalue == 0){
     $('#cantidad_formulario').html("");
  }
     
};
// CANTIDADES



// TEMPORADAS
function temporadas_formulario_ajax () {
           // var catalogo   = document.getElementById("catalogo");
           var selecvalue = temporadas.options[temporadas.selectedIndex].value;
  if (selecvalue == 1) {
            $.ajax({
                url: '<?php echo DIR;?>extras/ajax_temporada_formulario.php',
                beforeSend: function() {
                     $('#temporada_formulario').html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#temporada_formulario').html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#temporada_formulario').html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });

            
  }else if(selecvalue == 0){
     $('#temporada_formulario').html("");
  }
     
};
// TEMPORADAS

</script>
<!------------------------------JS PARA EL FORMULARIO DE EXTRAS DE ALQUILERES-->
<!------------------------------JS PARA EL FORMULARIO DE EXTRAS DE ALQUILERES PERO EN PROPIEDADES-->
<script>
//TIPO DE FORMULARIO 

  function tipo_formulario_ajax_add ($id) {
          var id = $id;
          var id_select = 'aplica'+id;
          var selecvalue = document.getElementById(id_select).value;
  if (selecvalue == 1 || selecvalue == 2) {
            $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_tipo_formulario_parte1.php',                
                data:'divid='+id,
                beforeSend: function() {
                     $('#tipo_formulario_exits_parte_1'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#tipo_formulario_exits_parte_1'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#tipo_formulario_exits_parte_1'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });


             $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_tipo_formulario_parte2.php',                
                data:'divid='+id,
                beforeSend: function() {
                     $('#tipo_formulario_exits_parte_2'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#tipo_formulario_exits_parte_2'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#tipo_formulario_exits_parte_2'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });
  }else if(selecvalue == 0){
     $('#tipo_formulario_exits_parte_1'+id).html("");
     $('#tipo_formulario_exits_parte_2'+id).html("");
  }else{
     $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_tipo_formulario_parte1_version2_add.php',
                data:'divid='+id,
                beforeSend: function() {
                     $('#tipo_formulario_exits_parte_1'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#tipo_formulario_exits_parte_1'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#tipo_formulario_exits_parte_1'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });


             $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_tipo_formulario_parte2.php',
                data:'divid='+id,
                beforeSend: function() {
                     $('#tipo_formulario_exits_parte_2'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                   },
                      success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#tipo_formulario_exits_parte_2'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#tipo_formulario_exits_parte_2'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });
  }
     
};

//TIPO DE FORMULARIO 

// PRECIOS
function precio_formulario_ajax_add ($id) {
          var id = $id;
          var id_select = 'precio_incluido'+id;
          var selecvalue = document.getElementById(id_select).value;
           
  if (selecvalue == 0) {
            $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_precio_formulario_parte1_add.php',
                data:'divid='+id,
                beforeSend: function() {
                     $('#precio_exits_formulario_parte_1'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#precio_exits_formulario_parte_1'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#precio_exits_formulario_parte_1'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });


             $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_precio_formulario_parte2_add.php',
                data:'divid='+id,
                beforeSend: function() {
                     $('#precio_formulario_exits_parte_2'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#precio_formulario_exits_parte_2'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#precio_formulario_exits_parte_2'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });
  }else if(selecvalue == 1){
     $('#precio_exits_formulario_parte_1'+id).html("");
     $('#precio_formulario_exits_parte_2'+id).html("");
  }else{



  }
     
};
// PRECIOS

// CANTIDADES
function cantidad_formulario_ajax_add ($id) {
          var id = $id;
          var id_select = 'cantidad'+id;
          var selecvalue = document.getElementById(id_select).value;  
  if (selecvalue == 1) {
            $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_cantidad_formulario_add.php',
                data:'divid='+id,
                beforeSend: function() {
                     $('#cantidad_exits_formulario'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#cantidad_exits_formulario'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#cantidad_exits_formulario'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });

            
  }else if(selecvalue == 0){
     $('#cantidad_exits_formulario'+id).html("");
  }
     
};
// CANTIDADES



// TEMPORADAS
function temporadas_formulario_ajax_add ($id) {
          var id = $id;
          var id_select = 'temporadas'+id;
          var selecvalue = document.getElementById(id_select).value;           
  if (selecvalue == 1) {
            $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_temporada_formulario_add.php',
                data:'divid='+id,
                beforeSend: function() {
                     $('#temporada_exits_formulario'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#temporada_exits_formulario'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#temporada_exits_formulario'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });

            
  }else if(selecvalue == 0){
     $('#temporada_exits_formulario'+id).html("");
  }
     
};
// TEMPORADAS

</script>


<!------------------------------JS PARA EL FORMULARIO DE EXTRAS DE ALQUILERES PERO EN PROPIEDADES-->






<!------------------------------JS PARA EL FORMULARIO DE EXTRAS DE ALQUILERES QUE NO EXISTEN PERO EN PROPIEDADES-->
<script>
//TIPO DE FORMULARIO 

  function tipo_formulario_ajax_add_not ($id) {
          var id = $id;
          var id_select = 'aplicanot'+id;
          var selecvalue = document.getElementById(id_select).value;
  if (selecvalue == 1 || selecvalue == 2) {
            $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_tipo_formulario_parte1_addnot.php',                
                data:'divid='+id,
                beforeSend: function() {
                     $('#tipo_formulario_parte_1_not'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#tipo_formulario_parte_1_not'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#tipo_formulario_parte_1_not'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });


             $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_tipo_formulario_parte2_addnot.php',                
                data:'divid='+id,
                beforeSend: function() {
                     $('#tipo_formulario_parte_2_not'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#tipo_formulario_parte_2_not'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#tipo_formulario_parte_2_not'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });
  }else if(selecvalue == 0){
     $('#tipo_formulario_parte_1_not'+id).html("");
     $('#tipo_formulario_parte_2_not'+id).html("");
  }else{
     $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_tipo_formulario_parte1_version2_addnot.php',
                data:'divid='+id,
                beforeSend: function() {
                     $('#tipo_formulario_parte_1_not'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#tipo_formulario_parte_1_not'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#tipo_formulario_parte_1_not'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });


             $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_tipo_formulario_parte2_addnot.php',
                data:'divid='+id,
                beforeSend: function() {
                     $('#tipo_formulario_parte_2_not'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                   },
                      success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#tipo_formulario_parte_2_not'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#tipo_formulario_parte_2_not'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });
  }
     
};

//TIPO DE FORMULARIO 

// PRECIOS
function precio_formulario_ajax_add_not ($id) {
          var id = $id;
          var id_select = 'precio_incluidonot'+id;
          var selecvalue = document.getElementById(id_select).value;
           
  if (selecvalue == 0) {
            $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_precio_formulario_parte1_addnot.php',
                data:'divid='+id,
                beforeSend: function() {
                     $('#precio_formulario_parte_1_not'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#precio_formulario_parte_1_not'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#precio_formulario_parte_1_not'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });


             $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_precio_formulario_parte2_addnot.php',
                data:'divid='+id,
                beforeSend: function() {
                     $('#precio_formulario_parte_2_not'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#precio_formulario_parte_2_not'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#precio_formulario_parte_2_not'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });
  }else if(selecvalue == 1){
     $('#precio_formulario_parte_1_not'+id).html("");
     $('#precio_formulario_parte_2_not'+id).html("");
  }else{



  }
     
};
// PRECIOS

// CANTIDADES
function cantidad_formulario_ajax_add_not ($id) {
          var id = $id;
          var id_select = 'cantidadnot'+id;
          var selecvalue = document.getElementById(id_select).value;  
  if (selecvalue == 1) {
            $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_cantidad_formulario_addnot.php',
                data:'divid='+id,
                beforeSend: function() {
                     $('#cantidad_formulario_not'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#cantidad_formulario_not'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#cantidad_formulario_not'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });

            
  }else if(selecvalue == 0){
     $('#cantidad_formulario_not'+id).html("");
  }
     
};
// CANTIDADES



// TEMPORADAS
function temporadas_formulario_ajax_add_not ($id) {
          var id = $id;
          var id_select = 'temporadasnot'+id;
          var selecvalue = document.getElementById(id_select).value;           
  if (selecvalue == 1) {
            $.ajax({
                type: "POST",
                url: '<?php echo DIR;?>extras/ajax_temporada_formulario_addnot.php',
                data:'divid='+id,
                beforeSend: function() {
                     $('#temporada_formulario_not'+id).html("<center><img src='<?php echo DIR;?>images/ajax-loaderfull.gif' /></center>");
                  },
                   success:function(resp){
                     //$("#input_creado").append(resp);
                      $('#temporada_formulario_not'+id).html(resp);
                    //alert(resp);
                },
                error:function(){
                  $('#temporada_formulario_not'+id).html("<center><h4 style='color:red;'>ERROR EN EL SERVIDOR.POR FAVOR ENVIE UN MENSAJE AL ADMINISTRADOR</h4></center>");
                }

            });

            
  }else if(selecvalue == 0){
     $('#temporada_formulario_not'+id).html("");
  }
     
};
// TEMPORADAS

</script>


<!------------------------------JS PARA EL FORMULARIO DE EXTRAS DE ALQUILERES QUE NO EXISTEN PERO EN PROPIEDADES-->

