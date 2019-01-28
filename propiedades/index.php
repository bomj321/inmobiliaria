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
$activo="propiedades";
$activo2="";
require('../layout/header.php');
?>
<?php 
include('../layout/menu.php'); 
?>
<script type="text/javascript">
$(document).ready(function() {
	var param='';
	         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>propiedades/loadventa.php",
	data:'reload='+param,
	 beforeSend: function(){
   $(".loader").show();
 
  },
	success: function(data){
		$(".loader").fadeOut("slow");
		$("#loadproperties").html(data).fadeIn('slow');
		$("select.search-box")[0].sumo.reload();
		$("select.simple")[0].sumo.reload();
		
		
	}
	});   
});	
</script>
<div class="uk-container">
<div class="uk-grid">
<div class="uk-width-1-1">
	<!--FILTROS-->
<div class="filters">
<div class="uk-grid uk-grid-medium">
<div class="uk-width-1-6">
	<form class="uk-search uk-search-default">
        <a href="" uk-search-icon></a>
        <input class="uk-search-input search-filter" type="search" placeholder="Referencia/titulo...">
    </form>
	</div>
	<form class="uk-width-5-6 uk-grid uk-grid-medium">
	<div class="uk-width-1-5">
	 <select multiple="multiple" placeholder="<span uk-icon='icon:home; ratio:0.75' class='icon-margin3'></span> Tipo de propiedad" onchange="" class="search-box">
			   <option name="tipoprop" value="Pisos_y_Apartamentos">Pisos y apartamentos</option>
			   <option  name="tipoprop" value="Chalet_y_Villas">Chalet y villas</option>
			   <option  name="tipoprop" value="Casas_y_fincas_rústicas">Casas y fincas rústicas</option>
			   <option  name="tipoprop" value="Casas_de_pueblo">Casas de pueblo</option>
			   <option  name="tipoprop" value="Solares_y_parcelas">Solares y parcelas</option>
			   <option  name="tipoprop" value="Negocio">Negocio</option>
			   <option  name="tipoprop" value="Obra_nueva">Obra nueva</option>
    </select>
	</div>
	<div class="uk-width-1-5">
	 <select multiple="multiple" placeholder="<span uk-icon='icon:location; ratio:0.75' class='icon-margin3'></span> Área/Población" onchange="" class="search-box">
      <?php $total = "SELECT DISTINCT Town FROM sys_towns where active='1' and Location='0'"; 
$total_prop = $db->query($total)->fetchAll(); 
$zonas = $db->prepare("SELECT DISTINCT Town FROM sys_towns where active='1' and Location='0' order by Town Asc");
$zonas->setFetchMode(PDO::FETCH_ASSOC);
$zonas->execute();?>
		 <?php while ($optionzona = $zonas->fetch()){?>
		 <?php $zonalower=strtolower($optionzona['Town']); $zonalower = ucwords($zonalower);?> 
		 <option value="<?php echo $optionzona['Town']?>" style="text-transform:capitalize"><?php echo $zonalower;?></option>
			 <?php }?> 
    </select>
		
	</div>
	<div class="uk-width-1-5">
	 <select multiple="multiple" placeholder="<span uk-icon='icon:tag; ratio:0.75' class='icon-margin3'></span> Estado" onchange="" class="search-box">
      
			   <option name="estado" value="apartamentos">Oferta</option>
			   <option  name="estado" value="villas">Disponible</option>
			   <option  name="estado" value="fincas">Reservado</option>
			  
    </select>
	</div>
	<div class="uk-width-1-5">
	 <select multiple="multiple" placeholder="<span uk-icon='icon:user; ratio:0.75' class='icon-margin3'></span> Propietario/Cliente" onchange="" class="search-box">
     <?php 
			  
			   $clientes = $db->prepare("SELECT DISTINCT sellerName1 FROM owners where active='1' order by sellerName1 Asc");
			   $clientes->setFetchMode(PDO::FETCH_ASSOC);
$clientes->execute();
while ($row2 = $clientes->fetch()){?>
			   <option><?php echo $row2['sellerName1'];?></option>
			<?php  }?>
    </select>
	</div>
	<div class="uk-width-1-5">
	 <button class="uk-button button-filter" type="button"><span uk-icon='icon:search; ratio:0.75' class='icon-margin3'></span> Filtrar resultados</button>
	</div>
	</form>
</div>
</div>
<span id="loadproperties">
<?php include ("loadventa.php");?>
</div>	
</div>
</div>
</div>      
    </div>

<div id="preview-modal"></div>
<?php include ("../layout/galeria-listados.php");?>

<?php 
//include header template
require('../layout/footer.php'); 
?>
<script type="text/javascript">
function previewModal(param) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>propiedades/preview.php",
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
function previewGallery(param) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>propiedades/previewgallery.php",
	data:'ref='+param,
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
	function reloadProp(param) {
	
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>propiedades/loadproperties.php",
	data:'reload='+param,
	 beforeSend: function(){
   $(".loader").show();
 
  },
	success: function(data){
		$(".loader").fadeOut("slow");
		$("#loadproperties").html(data).fadeIn('slow');
		$("select.search-box")[0].sumo.reload();
		$("select.simple")[0].sumo.reload();
		
		
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
	
    </script>
<script>
 UIkit.upload('.js-upload');
</script>
</body>
</html>