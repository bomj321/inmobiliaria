
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
$activo="web";
$activo2="";
require('../layout/header.php');
?>

<?php 

	include('../layout/menu.php'); 

?>
<div class="uk-container">
<div class="uk-grid">
<div class="uk-width-1-1">
	<!--FILTROS-->
<div class="filters" style="padding: 5px 15px;">
	<div class="uk-grid">
		<div class="uk-width-3-5">
	<h3 class="orange uk-margin-small-bottom"><span uk-icon="icon:cog; ratio:0.9;"></span> <strong>Informes</strong></h3>
	<p class="uk-margin-small-bottom" style="margin-top:0">Imprimir para expositor, sacar listados personalizados para clientes...</p>
		</div>		
	</div>	
</div>
<!-- FIN FILTROS-->
 <div class="uk-card uk-card-primary uk-card-body" style="margin-bottom:80px;">
<div class="uk-grid uk-grid-collapse">	
- Expositor formato vertical A4  ID: <form action="previewa4.php?id=<? $POST[Id];?>"> <input type="text" name="id"> <input type="submit" value="Imprimir" name="Imprimir"> </form>  <br>
- Expositor formato horizontal A3 <br>
<br>
- Listado propiedades según filtros

        </div>
	
</div>

</div>
</div>       
    </div>
<div id="preview-modal"></div>
<?php 
//include header template
require('../layout/footer.php'); 

?>
<script type="text/javascript">
function previewModal(param) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>contenidos/previewservicio.php",
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
</script>
<script type="text/javascript">
        $(document).ready(function () {
          $('.search-box').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:true,noMatch: 'No hay resultadao para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			$('.select-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultadao para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			$('.simple').SumoSelect();
        });	
    </script>
<script>
 UIkit.upload('.js-upload');
</script>
</body>
</html>