<?php require('includes/config.php'); 

if(!$user->is_logged_in()){ header('Location: login'); exit(); } 

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
$activo="principal";
$activo2="";
require('layout/header.php');
?>
<?php 
include('layout/menu.php'); 
?>
<div class="uk-container uk-margin-large-top">
<div class="uk-grid">
	
<div class="uk-width-2-3@m">
	<div class="uk-card uk-card-primary uk-card-body">
	 <p class="uk-card-title"><span uk-icon="icon:info" class="icon-margin"></span>&nbsp; <strong>Reservas y solicitudes pendientes</strong> </p>
            <ul uk-tab>
    <li class="uk-active"><a href="">Reservas</a></li>
    <li><a href="">Solicitudes</a></li>
    
</ul>
<ul class="uk-switcher">
	<li><table class="uk-table  uk-table-striped">
		<thead>
        <tr>
			<th class="uk-table-shrink">Estado</th>
            <th class="uk-table-shrink" >Referencia</th>
            <th>Nombre</th>
            <th>Cliente</th>
			<th>E-mail</th>
			<th>Fechas</th>
			
        </tr>
    </thead>
    <tbody>
        <tr>
			<td class="uk-table-small"><a class="uk-link-reset" href=""></a></td>
			<td class="uk-table-small"><a class="uk-link-reset" href=""></a></td>
			<td class="uk-table-link"><a class="uk-link-reset" href=""></a></td>
            <td class="uk-text-truncate uk-table-link"><a class="uk-link-reset" href=""></a></td>
            <td class="uk-table-link"><a class="uk-link-reset" href=""></a></td>
			 <td class="uk-table-link"><a class="uk-link-reset" href=""></a></td>
			<td class="uk-table-link"><a class="uk-link-reset" href=""></a></td>
			 
        </tr>
        
    </tbody>
</table></li>
	<li><table class="uk-table  uk-table-striped">
		<thead>
        <tr>
			<th class="uk-table-shrink">Estado</th>
            <th>Referencia</th>
            <th>Tipo de solicitud</th>
            <th>Cliente</th>
			<th>E-mail</th>
			
			
        </tr>
    </thead>
    <tbody>
        <tr>
			<td class="uk-table-small"><a class="uk-link-reset" href=""></a></td>
			<td class="uk-table-link"><a class="uk-link-reset" href=""></a></td>
            <td class="uk-text-truncate uk-table-link"><a class="uk-link-reset" href=""></a></td>
            <td class="uk-table-link"><a class="uk-link-reset" href=""></a></td>
			 <td class="uk-table-link"><a class="uk-link-reset" href=""></a></td>
			
			 
        </tr>
        
    </tbody>
</table></li>
</ul>
        </div>
 <div class="uk-card uk-card-primary uk-card-body  uk-margin-large-top">
	 <p class="uk-card-title"><span uk-icon="icon:home" class="icon-margin"></span>&nbsp; <strong>Propiedades</strong> añadidas recientemente</p>
            <ul uk-tab>
    <li class="uk-active"><a href="">Todas</a></li>
    <li><a href="">Venta</a></li>
    <li><a href="">Alquiler vacacional</a></li>
	<li><a href="">Alquiler</a></li>
</ul>
<ul class="uk-switcher">
	<li><table class="uk-table  uk-table-striped">
		<thead>
        <tr>
			
           <th class="uk-table-shrink">Estado</th>
            <th class="uk-table-shrink" >Referencia</th>
            <th>Nombre</th>
            <th>Tipo</th>
			<th>Propietario / Cliente</th>
			<th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <tr >
			<td class="uk-table-small"><a class="uk-link-reset" href=""></a></td>
            <td></td>
            <td class="uk-text-truncate"></td>
            <td></td>
			 <td></td>
			 <td></td>
        </tr>
        
    </tbody>
</table></li>
	<li><table class="uk-table  uk-table-striped">
		<thead>
        <tr>
            <th class="uk-table-shrink">Estado</th>
            <th class="uk-table-shrink" >Referencia</th>
            <th>Nombre</th>
            <th>Tipo</th>
			<th>Propietario / Cliente</th>
			<th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <tr >
			<td class="uk-table-small"><a class="uk-link-reset" href=""></a></td>
            <td></td>
            <td class="uk-text-truncate"></td>
            <td></td>
			 <td></td>
			 <td></td>
        </tr>
        
    </tbody>
</table></li>
	<li><table class="uk-table  uk-table-striped">
		<thead>
        <tr>
            <th class="uk-table-shrink">Estado</th>
            <th class="uk-table-shrink" >Referencia</th>
            <th>Nombre</th>
            <th>Tipo</th>
			<th>Propietario / Cliente</th>
			<th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <tr >
			<td class="uk-table-small"><a class="uk-link-reset" href=""></a></td>
            <td></td>
            <td class="uk-text-truncate"></td>
            <td></td>
			 <td></td>
			 <td></td>
        </tr>
        
    </tbody>
</table></li>
	<li><table class="uk-table  uk-table-striped">
		<thead>
        <tr>
            <th class="uk-table-shrink">Estado</th>
            <th class="uk-table-shrink" >Referencia</th>
            <th>Nombre</th>
            <th>Tipo</th>
			<th>Propietario / Cliente</th>
			<th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <tr >
			<td class="uk-table-small"><a class="uk-link-reset" href=""></a></td>
            <td></td>
            <td class="uk-text-truncate"></td>
            <td></td>
			 <td></td>
			 <td></td>
        </tr>
        
    </tbody>
</table></li>
</ul>
        </div>
	
</div>
<div class="uk-width-1-3@m">
	<div class="uk-card uk-card-primary uk-card-body directlinks">
	 <p class="uk-card-title"><span uk-icon="icon:link" class="icon-margin"></span>&nbsp; <strong>Accesos directos</strong></p>
	<ul uk-accordion="collapsible: false;multiple:true">
    <li class="uk-open">
        <a class="uk-accordion-title" href="#">PROPIEDADES</a>
        <div class="uk-accordion-content">
            <div class="uk-grid uk-grid-collapse uk-margin-top">
		<div class="uk-width-1-2 uk-text-uppercase" style="font-weight:400"><a href="<?php echo DIR;?>propiedades/propiedad?accion=nuevo"><span uk-icon="icon:plus; ratio:0.8"></span> Añadir propiedad</a></div>
   <div class="uk-width-1-2 uk-text-uppercase" style="font-weight:400"><a href="<?php echo DIR;?>propiedades/"><span uk-icon="icon:grid; ratio:0.8"></span> Gestionar propiedades</a></div>
		 <div class="uk-width-1-2 uk-margin-top uk-text-uppercase" style="font-weight:400"><a href="<?php echo DIR;?>propiedades/zonas"><span uk-icon="icon:location; ratio:0.8"></span> Gestionar zonas </a> </div>
		<div class="uk-width-1-2 uk-margin-top uk-text-uppercase" style="font-weight:400"><a href="clientes"><span uk-icon="icon:users; ratio:0.8"></span> Gestionar clientes</a> </div>
		</div>
        </div>
    </li>
    <li class="uk-open"> 
        <a class="uk-accordion-title" href="#">RESERVAS Y GESTIÓN</a>
        <div class="uk-accordion-content">
            <div class="uk-grid uk-grid-collapse  uk-margin-top">
		<div class="uk-width-1-2 uk-text-uppercase" style="font-weight:400"><a href="reserva?accion=nuevo"><span uk-icon="icon:pencil; ratio:0.8"></span> Nueva reserva</a></div>
   <div class="uk-width-1-2 uk-text-uppercase" style="font-weight:400"><a href="reservas"><span uk-icon="icon:grid; ratio:0.8"></span> Reservas pendientes</a></div>
		 <div class="uk-width-1-2 uk-margin-top uk-text-uppercase" style="font-weight:400"><a href="calendario"><span uk-icon="icon:calendar; ratio:0.8"></span> Gestionar calendario </a></div>
		<div class="uk-width-1-2 uk-margin-top uk-text-uppercase" style="font-weight:400"><a href="solicitudes"><span uk-icon="icon:history; ratio:0.8"></span> Solicitudes pendientes</a></div>
	
		</div>
        </div>
    </li>
   <li>
        <a class="uk-accordion-title" href="#">PÁGINA WEB Y CONTACTO</a>
        <div class="uk-accordion-content">
           <div class="uk-grid uk-grid-collapse uk-margin-top">
		<div class="uk-width-1-2 uk-text-uppercase" style="font-weight:400"><a href=""><span uk-icon="icon:copy; ratio:0.8" class="icon-margin"></span> Gestionar páginas</a></div>
   <div class="uk-width-1-2 uk-text-uppercase" style="font-weight:400"><a href=""><span uk-icon="icon:mail; ratio:0.8" class="icon-margin"></span> Datos de contacto y otros</a></div>
			   <div class="uk-width-1-2 uk-text-uppercase uk-margin-top" style="font-weight:400"><a href="<?php echo DIR;?>contenidos/servicios"><span uk-icon="icon:cog; ratio:0.8" class="icon-margin"></span> Gestionar servicios</a></div>
		</div>
        </div>
    </li>
		<li>
        <a class="uk-accordion-title" href="#">NOTICIAS Y BLOG</a>
        <div class="uk-accordion-content">
           <div class="uk-grid uk-grid-collapse uk-margin-top">
		<div class="uk-width-1-2 uk-text-uppercase" style="font-weight:400"><a href="<?php echo DIR;?>blog/post?accion=nuevo"><span uk-icon="icon: tag; ratio:0.8" class="icon-margin"></span> Nueva noticia</a></div>
   <div class="uk-width-1-2 uk-text-uppercase" style="font-weight:400"><a href="<?php echo DIR;?>blog/"><span uk-icon="icon:world; ratio:0.8" class="icon-margin"></span> Gestionar noticias</a></div>
		</div>
        </div>
    </li>
</ul>	 
	
	</div>
	<div class="uk-card uk-card-primary uk-card-body uk-margin-top">
	 <p class="uk-card-title"><span uk-icon="icon:mail" class="icon-margin"></span>&nbsp; <strong>Bandeja de entrada</strong></p>
	<ul uk-tab>
		<li class="uk-active"><a href="">Correos entrantes &nbsp; <span class="uk-badge bg-green">10</span></a></li>
    <li><a href="">Solicitudes web &nbsp; <span class="uk-badge bg-green">10</span></a></li>
    
</ul>
<ul class="uk-switcher">
	<li><table class="uk-table  uk-table-striped">
		<thead>
        <tr>
            <th>Asunto</th>
            <th>Remitente</th>
            <th>Fecha</th>
			
			
        </tr>
    </thead>
    <tbody>
		
        <tr>
			<td class="uk-table-link"><a class="uk-link-reset" href=""></a></td>
            <td class="uk-text-truncate uk-table-link"><a class="uk-link-reset" href=""></a></td>
            <td class="uk-table-link"><a class="uk-link-reset" href=""></a></td>
			
			 
        </tr>
        
    </tbody>
</table></li>
	<li><table class="uk-table  uk-table-striped">
		<thead>
        <tr>
            <th>Asunto</th>
            <th>Remitente</th>
            <th>Fecha</th>

        </tr>
    </thead>
    <tbody>
        <tr>
			<td class="uk-table-link"><a class="uk-link-reset" href=""></a></td>
            <td class="uk-text-truncate uk-table-link"><a class="uk-link-reset" href=""></a></td>
            <td class="uk-table-link"><a class="uk-link-reset" href=""></a></td>

        </tr>
		
        
    </tbody>
</table></li>
</ul>
		
		
		</div>
	
	</div>
</div>
</div>
       
    </div>




<?php 
//include header template
require('layout/footer.php'); 
?>

</body>
</html>