<?php require('../includes/config2.php'); 



if(!$user->is_logged_in()){
 header('Location: ../login'); exit();
  } 
$data = date('Y-m-d');;
$hora =  date('H:i:s');
$IPPROXY = $_SERVER['REMOTE_ADDR'];
$IP = getIP();
$Nav = $_SERVER['HTTP_USER_AGENT'];
$accio="Login";
$observacions="Conectado";
$loging = "INSERT INTO logs (data, hora, usuari, ip_conexio, ip_proxy, navegador, accio, observacions) VALUES ('".$data."','".$hora."','".$_SESSION['username']."','".$IPPROXY."', '".$IP."', '".$Nav."','".$accio."','".$observacions."')";
//$db->exec($loging);
$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';
$activo="propiedades";
$activo2="";
require('../layout/header.php');
?>
<?php 
include('../layout/menu.php'); 
?>

<div class="container-fluid">


	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
			<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">
			<a href="<?php echo DIR;?>contenidos/servicio.php">
				<button  class="uk-button button-direct " style="background-color:#F9B233;color:#fff"><span uk-icon="icon:plus;"></span> Añadir Servicio</button>
			</a>
			</h5>

		</div>
	</div>


	<div class="row" style="margin-top: 50px; background-color: white;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 30px;">
			 <table id="services" class="table table-hover bulk_action dt-responsive nowrap table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                	<th></th>
                                	<th>ID</th>
                                    <th>Publicado</th>
                                    <th>Titulo</th>
                                    <th>Texto destacado</th>
                                    <th>Descripci&oacute;n</th>
                                    <th>Fecha de publicación</th>
                                    <th>Acciones</th> 
                                </tr>
                            </thead>
                            <tbody>
                          <!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<?php 
$stmt = $db->prepare("SELECT distinct services.id_services,services.tit_es,services.seo_es,services.des_es,services.published,services.date_published,image_services.full as imagengrande,image_services.small as imagenpequena FROM services LEFT JOIN image_services ON (image_services.ref = services.id_services AND image_services.orden = 1) ORDER BY id_services desc");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$i=1;
while ($row = $stmt->fetch()){// WHILE 1
 ?>                            	
<!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->   
<!--CUERPO DE LA PAGINA-->
<tr>
						                <td>
						                	
						                		<div uk-lightbox style="width:50px;height:50px;" id="servicios<?php echo $i?>">
						                			<?php if (empty($row['imagengrande'])): ?>
							                		<a href="../../services/villas-planet-logo.png" data-caption="<button class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;' uk-toggle='target: #galeria-listado'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
							                			<div>
							                				<img style='height: 50px;  border-radius: 50px;' src="../../services/villas-planet-logo.png" alt="">
							                				
							                			</div>
							                		</a>

						                	 <?php elseif (!empty($row['imagengrande'])): ?>
							                		<a href="../../services/<?php echo $row['imagengrande'];?>" data-caption="<button class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;' uk-toggle='target: #galeria-listado'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
							                			<div >
							                				<img style='height: 50px; border-radius: 50px;' src="../../services/<?php echo $row['imagengrande']; ?>" alt="">
							                			</div>
							                		</a>
						                	</div>
						                		                						                		    
						                <?php endif ?>
						                	
						                </td>
						               <td>
						               	<?php echo $row['id_services']?>
						               </td>

										<td>
												<?php if ($row['published']=='1'): ?>

														<a onclick="estado('<?php echo $row['id_services']?>','<?php echo $row['published']?>')"><span uk-icon="icon:check;ratio: 1" class="green"></a></span>

													<?php else: ?>

														<a onclick="estado('<?php echo $row['id_services']?>','<?php echo $row['published']?>')"><span uk-icon="icon:close;ratio: 1" class="red"></a></span>

												<?php endif ?>
										</td>

										<td>
											<?php echo $row['tit_es']?>
										</td>

										<td >
											<?php echo $row['seo_es']?>
												
										</td>

										<td >
											<?php echo $row['des_es']?>
												
										</td>

										<td>
											<?php echo $row['date_published']?>
										</td>									

										<td>
											<div class="uk-grid uk-grid-small" >
												<a style="color: black;" onclick="previewModal('<?php echo $row['id_services']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>
												<a style="color: black;" href="<?php echo DIR;?>contenidos/edit_servicio.php?idservice=<?php echo $row['id_services']?>"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
												<a style='color: black;' onclick="previewGallery('<?php echo $row['id_services']?>','<?php echo "servicios".$i ?>')"><span uk-icon="icon:image;ratio:1" uk-tooltip="Galería"></span></a>											
												<a style='color: black;' onclick="deletedata(<?php echo $row['id_services']?>)"><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
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

<div id="preview-modal"></div>

</div>

<?php 
//include header template
require('../layout/footer.php'); 
?>
<?php include ("../layout/galeria-listados.php");?>


<script type="text/javascript">
function previewGallery(param,divid) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>contenidos/previewgallery",
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

function previewModal(param) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>contenidos/previewservicio",
	data:'id='+param,
			 beforeSend: function(){
   $(".loader").show();
  },
	success: function(data){
		$(".loader").fadeOut("slow");
		$("#preview-modal").html(data);
		
		
	}
	});   
        }

function deletedata($id) {
	var id = $id;
	UIkit.modal.confirm('¿Confirma que desea eliminar el servicio?', { center:true, labels: { ok: 'Ok', cancel: 'Volver a servicios' } }).then(function() {
  
			$.ajax({
                url: '<?php echo DIR;?>contenidos/delete_servicio?idservicio=' + id, // url where to submit the request               
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
			url: "<?php echo DIR;?>contenidos/activar?idservice=" + id + "&active=" + activacion,
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

