
<?php require('../includes/config2.php'); 

if(!$user->is_logged_in()){ header('Location: ../login'); exit(); } 

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
$activo="clientes";
$activo2="";
require('../layout/header.php');
?>
<script src="<?php echo DIR?>js/flatpickr.min.js"></script>	
<?php 
include('../layout/menu.php'); 

?>
<div class="uk-container">
<div class="uk-grid">
<div class="uk-width-1-1">
	<!--FILTROS-->

<div class="filters">
<div class="uk-grid uk-grid-medium">
<div class="uk-width-1-6">
	<form class="uk-search uk-search-default">
        <a href="" uk-search-icon></a>
        <input class="uk-search-input search-filter" type="search" placeholder="Localizador...">
    </form>
	</div>
	<div class="uk-width-1-6">
	 <select multiple="multiple" placeholder="<span uk-icon='icon:tag; ratio:0.75' class='icon-margin3'></span> Estado" onchange="" class="search-box">
      
    </select>
	</div>
	<div class="uk-width-1-6">
	<div class="uk-grid uk-grid-small">
	<div class="uk-width-1-2">
	 <div class="uk-margin uk-width-1-1">
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon" uk-icon="icon: calendar"></span>
            <input class="uk-input datepicker1" type="text" placeholder="F. Entrada" style="cursor:pointer">
        </div>
    </div>
		</div>
		<div class="uk-width-1-2">
	 <div class="uk-margin uk-width-1-1">
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon" uk-icon="icon: calendar"></span>
            <input class="uk-input datepicker2" type="text" id="fecha-entrada" placeholder="F. Salida" style="cursor:pointer">
        </div>
    </div>
		</div>
		</div> 
   
	</div>
	<div class="uk-width-1-6">
	<select multiple="multiple" placeholder="<span uk-icon='icon:home; ratio:0.75' class='icon-margin3'></span> Alojamiento/Ref" onchange="" class="search-box"></select>
	</div>
	
	<div class="uk-width-1-6">
	 <select multiple="multiple" placeholder="<span uk-icon='icon:user; ratio:0.75' class='icon-margin3'></span> Cliente/Ocupante" onchange="" class="search-box">
      
    </select>
	</div>
	<div class="uk-width-1-6">
	 <button class="uk-button button-filter" type="button"><span uk-icon='icon:search; ratio:0.75' class='icon-margin3'></span> Filtrar resultados</button>
	</div>
</div>
</div>
<!-- FIN FILTROS-->
<?php 
//$fecha_hoy = date('Y-m-d');
//$fecha_antes = date('Y-m-d', strtotime(".$fecha_hoy. - 1 months"));
//$total = "SELECT ID FROM rental_enquiries WHERE dateAdded between '$fecha_antes ' AND '$fecha_hoy '"; 
//$total_prop = $db->query($total)->fetchAll(); 
 
?>
 <div class="uk-card uk-card-primary uk-card-body" style="margin-bottom:80px;">
<div class="uk-grid uk-grid-collapse">
	<div class="uk-width-1-3">
	 <p class="uk-card-title"><span uk-icon="icon:home" class="icon-margin"></span>&nbsp; <strong>CLIENTES</strong> </p>	
	</div>
	<div class="uk-width-2-3 direct-filter">
	<div class="uk-grid uk-grid-medium" style="float:right;margin-top:4px; margin-right:10px;">
		
		<div style="width:200px;">		<?php $nombre = 'meses';
$resultado = lista($nombre, $meses);
echo $resultado;?></div>
		<div style="width:200px;"><select  placeholder="Ordenar por" class="simple">
        <option> Más recientes</option> 
		<option> Pendiente de pago</option>
		<option> Últimas 2 semanas </option> 
		<option> Mayor duración</option>
    </select></div>
	</div>
	</div>
 </div>
<table class="uk-table uk-table-middle  uk-table-striped">
		<thead>
        <tr>
			<th class="uk-width-small"><a href="" class="uk-link-reset icon-margin-top">ID <span class="sort "></span></a></th>
			<th class="uk-width-small"><a href="" class="uk-link-reset icon-margin-top">Tipo <span class="sort "></span></a></th>
            <th class="uk-width-medium"><a href="" class="uk-link-reset icon-margin-top">Fecha alta <span class="sort"></span></a></th>
			<th class="uk-width-medium"><a href="" class="uk-link-reset icon-margin-top">Nombre <span class="sort"></span></a></th>
			<th class="uk-width-medium"><a href="" class="uk-link-reset icon-margin-top">Email <span class="sort"></span></a></th>
			<th class="uk-width-medium"><a href="" class="uk-link-reset icon-margin-top">Tel 1<span class="sort"></span></a></th>
		
			<th class="uk-width-small"></th>
			
        </tr>
    </thead>
    <tbody>
           
<?php 
		
//selects para listar reservas
$stmt = $db->prepare("SELECT * FROM clients  ORDER BY ID DESC LIMIT 50");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while ($row = $stmt->fetch()){

$ref=$row['ID'];	

/*$cliente=$row['sellerID'];
$stmt2 = $db->prepare("SELECT sellerName1 FROM owners WHERE ID='$cliente'");
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);*/




		?>      
      
      
        <tr style="background-color:rgba(34,139,34,0.1) !important;">
			
			
			 <td class="uk-table-link"><a onclick="previewModal('<?php echo $row['yourRef']?>')" ><?php echo $row['ID']?></a></td>
			<td class="uk-table-link"><a href="" class="green"><strong><?php echo $row['clientType']?></strong></a></td>
			</td>
           
            
			<td class="uk-table-link uk-text-truncate" ><a onclick="previewModal('<?php echo $row['ID']?>')" class="uk-text-truncate"><?php echo $row['dateAdded']?> / <?php echo $row['dateAdded']?></a></td>
			<td ><?php echo $row['clientName']?></td>
			<td class="uk-table-link"><a href="" > <?php echo $row['clientEmail']?> </a></td>
			<td class="" style="padding-right:35px;"> <?php echo $row['clientTel1']?> </td>
	   
	     
			<td class="uk-table-expand" >
				<div class="uk-grid uk-grid-small">
			
			<a onclick="previewModal('<?php echo $row['yourRef']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>
			<a href=""><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
			<a href=""><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
				
				
				</div>
			</td>
        </tr> 
          
	<?php }?>
		
        
    </tbody>
</table>
        </div>
	
</div>

</div>
</div>
       
    </div>

<div id="preview-modal"></div>


<?php 
//include header template
require('../layout/footer.php'); 
include ('../layout/galeria-listados.php');
?>
<script type="text/javascript">
function previewModal(param) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>reservas/previewreserva.php",
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
</script>
<script src="<?php echo DIR;?>js/es.js"></script>
<script type="text/javascript">

	$(".datepicker1").flatpickr({
    dateFormat: "d/m/Y",
	locale:'es'
});	
	$(".datepicker2").flatpickr({
    dateFormat: "d/m/Y",
	locale:'es'
});	
        $(document).ready(function () {
          $('.search-box').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:true,noMatch: 'No hay resultadao para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			$('.select-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultadao para "{0}"',captionFormat:'{0} Seleccionados', 
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
	
    </script>
<script>
 UIkit.upload('.js-upload');
</script>
</body>
</html>