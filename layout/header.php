<!DOCTYPE html>
<html lang=es>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">    
<meta name=viewport content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no" />
<!--AGREGANDO BOOTSTRAP-->
<link href="<?php echo DIR;?>js/bootstrap.css" rel="stylesheet">
<!--AGREGANDO BOOTSTRAP-->
<!-- Datatables -->
<link href="<?php echo DIR;?>js/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo DIR;?>js/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo DIR;?>js/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo DIR;?>js/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo DIR;?>js/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
 <!-- Datatables -->
<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
<!--<link rel="manifest" href="manifest.json">-->
<link rel="mask-icon" href="safari-pinned-tab.svg" color="#2e4a94">
<meta name="theme-color" content="#ffffff">
<title><?=$title?></title>
<link rel="stylesheet" href="<?php echo DIR;?>css/villasplanetxcontrol.css"/>


<style>
  
  #example1 td {
    max-width: 70px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

 #example2 td {
    max-width: 70px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

 #example3 td {
    max-width: 70px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

#example4 td {
    max-width: 70px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

#services td {
    max-width: 70px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

#propietarios td {
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

#example2_filter .input-sm
{
  width: 400px !important;
  height: 40px !important;
}

#example3_filter .input-sm
{
  width: 400px !important;
  height: 40px !important;
}

#example4_filter .input-sm
{
  width: 400px !important;
  height: 40px !important;
}

#services_filter .input-sm
{
  width: 400px !important;
  height: 40px !important;
}

#propietarios_filter .input-sm
{
  width: 400px !important;
  height: 40px !important;
}

#example1_filter label
  {
    font-weight: bold;
  }

#example2_filter label
  {
    font-weight: bold;
  }

#example3_filter label
  {
    font-weight: bold;
  }

#example4_filter label
  {
    font-weight: bold;
  }

#services_filter label
{
  font-weight: bold;
}

 #propietarios_filter label
  {
    font-weight: bold;
  }

/*ESTILOS PARA EL BOTON*/
 .flotante {
        display:scroll;
        position:fixed;
        bottom:50%;
        right:5.5%;
        z-index: 9999;
        writing-mode: vertical-lr;
        transform: rotate(90deg);
        -moz-transform: rotate(0deg);
}
.flotante strong {
    padding: 0px 0px 0px 0px;
}
@-moz-document url-prefix() {

    .flotante {
      max-width:45px;
      padding: 10px 10px 10px 10px;
      right:15.5% !important;
    } 
  
  .flotante strong {
        padding: 0px 0px 0px 0px;
     }
}
/*ESTILOS PARA EL BOTON*/
</style>
</style>






  
</head>
<body>
<div class="loader" ><div class="uk-position-center uk-overlay uk-overlay-default" style="padding:30px 40px"><div uk-spinner="ratio: 2"></div><p>Cargando...</p></div>

</div>  
  
<div class="uk-height-viewport uk-background-primary">
  <a href="#" class="scrollToTop"><span uk-icon="icon:chevron-up;ratio:1.3;"></span></a>
  <!--<div class="time">&nbsp;&nbsp; <span class="clock"></span></div>-->