<!DOCTYPE html>
<html lang=es>
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8" />
<meta name=viewport content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no" />
<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="manifest.json">
<link rel="mask-icon" href="safari-pinned-tab.svg" color="#2e4a94">
<meta name="theme-color" content="#ffffff">
<title><?=$title?></title>
<link rel="stylesheet" href="<?php echo DIR;?>css/villasplanetxcontrol.css"/>
<script src="<?php echo DIR;?>js/jquery.min.js"></script>	
<script src="<?php echo DIR;?>js/villasplanetxcontrol.min.js"></script>	
<script src="<?php echo DIR;?>js/villasplanetxcontrol-icons.min.js"></script>
<script src="<?php echo DIR;?>js/jquery.sumoselect.min.js"></script>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
});
</script>

<style>
  
  #example1 td {
    max-width: 70px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

#example1_filter .input-sm
{
  width: 400px !important;
  height: 40px !important;
}

</style>






	
</head>
<body>
<div class="loader" ><div class="uk-position-center uk-overlay uk-overlay-default" style="padding:30px 40px"><div uk-spinner="ratio: 2"></div><p>Cargando...</p></div>

</div>	
	
<div class="uk-height-viewport uk-background-primary">
	<a href="#" class="scrollToTop"><span uk-icon="icon:chevron-up;ratio:1.3;"></span></a>
	<!--<div class="time">&nbsp;&nbsp; <span class="clock"></span></div>-->