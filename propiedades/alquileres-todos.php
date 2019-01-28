<?php require('../includes/config2.php');

if(!$user->is_logged_in()){
 header('Location: ../login'); exit();
  }

$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';
$activo="propiedades";
$activo2="";
require('../layout/header.php');
?>
<?php
include('../layout/menu-alquiler.php');
?>

<div class="container-fluid">

<!--------------------------------------TABS-->
			<div style="margin-top: 0px;">
			  <ul class="nav nav-tabs" role="tablist">
								<li role="presentation" ><a style='color: black;' href="alquileres.php" >Activadas/Short</a></li>
					<li role="presentation"><a style='color: black;' href="alquileres-long.php" >Activadas/Long</a></li>
					<li role="presentation"><a style='color: black;' href="alquileres-temporal.php" >Activadas/Temporal</a></li>
					<li role="presentation"><a style='color: black;' href="alquileres-desactivados.php" >Desactivadas</a></li>
					<li role="presentation" class="active"><a style='color: black;' href="alquileres-todos.php" aria-controls="todas" role="tab" data-toggle="tab">Todas</a></li>

					<a href="<?php echo DIR;?>propiedades/propiedad?action=alquiler">
						<button  class="uk-button button-direct " style="background-color:#F9B233;color:#fff"><span uk-icon="icon:plus;"></span> Añadir propiedad</button></a> &nbsp;&nbsp; <b>Estás en: Alquileres > Todos</b>

			  </ul>

			  <div class="tab-content">

<!-----------------CASAS ACTIVADAS SHORT--------------- -->

				    <div role="tabpanel" class="tab-pane active" id="todas">

	<div class="row" style="margin-top: 0px; background-color: white;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 10px;">
			 <table id="example1" class="table table-hover bulk_action dt-responsive nowrap table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>

                                    <th>Publicado</th>
                                    <th>Referencia</th>

                                    <th>Titulo / Nombre</th>

                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                          <!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<?php
$stmt = $db->prepare("SELECT rentals.yourRef,rentals.propNameES,rentals.ID,rentals.active FROM rentals ORDER BY yourRef desc  limit 1630 ");
/*$stmt = $db->prepare("SELECT yourRef,sellerID,propTown,propLocation,propNameES,propType,propPrice,ID FROM rentals ORDER BY yourRef limit 50" );*/
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$i=1;
while ($row = $stmt->fetch())
{// WHILE 1
$ref=$row['yourRef'];
//$tipo = explode('|',$row['propType']);
$localizaciones = explode(':',$row['propLocation']);
$town=$row['propTown'];
$title2 = limpia($row['propNameES']);

$titulo_prop=strtolower($row['propNameES']);


 ?>

<tr>


										<td>
											<center>
												<?php if ($row['active']=='1'): ?>

														<a onclick="estado('<?php echo $row['ID']?>','<?php echo $row['active']?>')"><span uk-icon="icon:check;ratio: 1" class="green"></a></span>

													<?php else: ?>

														<a onclick="estado('<?php echo $row['ID']?>','<?php echo $row['active']?>')"><span uk-icon="icon:close;ratio: 1" class="red"></a></span>

												<?php endif ?>
											</center>
										</td>
										<td><a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" ><span style="font-weight:600"><?php echo $row['yourRef']?></span></a></td>

										<td><a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" class="uk-text-truncate"><?php echo $row['propNameES']?></a></td>

										<td>
											<div class="uk-grid uk-grid-small">
													<!--<a style='color: black;' onclick="previewModal('<?php //echo $row['yourRef']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>-->
													<a style='color: black;' href="<?php echo DIR;?>propiedades/editar_rentals?yourRef=<?php echo trim($row['yourRef'])?>"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>


													<a style='color: black;'  onclick="deletedata(<?php echo $row['ID']?>)"><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>

											</div>
										</td>
</tr>
<!--CUERPO DE LA PAGINA-->
<?php
$i++;
}// WHILE 1
?>
                            </tbody>
                        </table>
		</div>
	</div>
<!--TABLA TODAS-->



				    </div>
<!-----------------CASAS ACTIVADAS SHORT----------------->



<!----------------



				    </div>
<!--------------------TODAS LAS CASAS-->



				    </div>
<!-----------------CASAS TODAS----------------->

			  </div>
		</div>
<!--------------------------------------TABS-->

</div>

<div id="preview-modal"></div>
<div id="calendarioReservas" class="uk-modal-container" uk-modal>
<div id="periodosReservas" class="uk-modal-container" uk-modal>
<?php
//include header template
require('modal_clientes.php');
require('../layout/footer.php');
?>

<?php include ("../layout/galeria-listados.php");?>

<script type="text/javascript">
function previewModal(param) {
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
function previewGallery(param,divid) {
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

</script>
<script type="text/javascript">
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
function deletedata($id) {
	var id = $id;
	UIkit.modal.confirm('¿Confirma que desea eliminar el alquiler?', { center:true, labels: { ok: 'Ok', cancel: 'Volver a Alquileres' } }).then(function() {

			$.ajax({
                url: '<?php echo DIR;?>propiedades/deleterental?idrental=' + id, // url where to submit the request
                success : function(result) {
                   location.reload();

                },
                error: function(xhr, resp, text,error) {
                     UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> <strong>Ha habido un error al eliminar. Inténtelo de nuevo.</strong>', status: 'danger', timeout:2000})
					alert(error);
                }

			});
}, function () {

});

}


function estado($id,$active)
{
	var id = $id;
	var active = Number($active);
	if (active==1) {
		var activacion = 0;
	}else{
		var activacion = 1;
	}

	  $.ajax({
		    type:"GET",
		    cache: false,
			url: "<?php echo DIR;?>propiedades/activar_rentals?idventa=" + id + "&active=" + activacion,
				beforeSend: function(){
		  				 $(".loader").show();
		 		 },
			success: function(data){
				location.reload();
				$(".loader").fadeOut("slow");

			}
			});
}

</script>
<!--JAVASCRIPT PARA EL MODAL-->

<script type="text/javascript">

function datoscliente($id_cliente){
        var id = $id_cliente;
        $.ajax({
            url: "<?php echo DIR;?>propiedades/respuesta_modal?idcliente=" + id,
            type:"GET",
	          beforeSend: function(){
			  		$("#cliente_modal .modal-body").html(
			  				 "<center ><img src='../images/ajax-loader.gif'/></center>"
			  		);
		 		 },
            success:function(resp){
                $("#cliente_modal .modal-body").html(resp);
                $("#cliente_modal .modal-title").html('Información del Cliente');
                //alert(resp);
            }

        });
}
</script>

<script type="text/javascript">

function updatecliente() {
    if (confirm("¿Confirma que desea editar el propietario?")) {
            $.ajax({
                url: '<?php echo DIR;?>propiedades/updatecliente', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'json', // data type
                data : $("#owner-form").serialize(), // post data || get data
            });
            $('#cliente_modal').modal('hide');
} }
</script>

<!--JAVASCRIPT PARA EL MODAL-->


</body>

</body>
</html>
