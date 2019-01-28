<?php 
include('../includes/conexion_nueva.php'); 


// ESTABLECER ZONA HORARIA DE ESPAÑA
date_default_timezone_set('Europe/Madrid');
// ESTABLECER ZONA HORARIA DE ESPAÑA


   
			  	$clientType                = $_POST['clientType'];
                $dateAdded                 = date("Y-m-d H:i:s");
				$mailerCheck               = $_POST['mailerCheck'];
                $source                    = $_POST['source'];
                $foundBy                   = $_POST['foundBy'];
                $OfficeID                  = $_POST['OfficeID'];                   
                $EmployeeID                = $_POST['EmployeeID'];
                $buyer                     = $_POST['buyer'];
                $clientName                = $_POST['clientName'];
                $clientEmail               = $_POST['clientEmail'];
     			$clientPass                = $_POST['clientPass'];
                $pais                      = $_POST['pais'];
                $nacimiento                = $_POST['nacimiento'];
                $clientSessionID           = $_POST['clientSessionID'];
                $clientTel1                = $_POST['clientTel1'];
                $clientTel2                = $_POST['clientTel2'];
                $clientMob                 = $_POST['clientMob'];
                $clientFax                 = $_POST['clientFax'];
                $clientAddress             = $_POST['clientAddress'];
                $clientLang                = $_POST['clientLang'];
                $clientIDNum               = $_POST['clientIDNum'];
                $propType                  = $_POST['propType'];
                $propPriceStart            = $_POST['propPriceStart'];
                $propPriceEnd              = $_POST['propPriceEnd'];
                $propTowns                 = $_POST['propTowns'];
                $propBedFrom               = $_POST['propBedFrom'];
                $propBedTo                 = $_POST['propBedTo'];
                $sendMailerMonth           = $_POST['sendMailerMonth'];
                $sendMailerNew             = $_POST['sendMailerNew'];
                $sendNewsletter            = $_POST['sendNewsletter'];
                $rentalType                = $_POST['rentalType'];
                $clientFolio               = $_POST['clientFolio'];
                $clientVIP                 = $_POST['clientVIP'];
                $SSMA_TimeStamp            = $_POST['SSMA_TimeStamp'];
                $clientNotes               = $_POST['clientNotes'];

//35 datos a insertar

                //////////////////////INSERT USUARIO
            mysqli_set_charset($connection, "utf8");
            $sql_client="INSERT INTO clients (clientType,dateAdded,mailerCheck,source,foundBy,OfficeID,EmployeeID,buyer,clientName,clientEmail,clientPass,clientSessionID,clientTel1,clientTel2,clientMob,clientFax,clientAddress,clientLang,clientIDNum,propType,propPriceStart,propPriceEnd,propTowns,propBedFrom,propBedTo,sendMailerMonth,sendMailerNew,sendNewsletter,rentalType,clientFolio,clientVIP,SSMA_TimeStamp,pais,nacimiento,clientNotes) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado_client=mysqli_prepare($connection, $sql_client);
           	mysqli_stmt_bind_param($resultado_client, "sssssssssssssssssssssssssssssssssss",$clientType,$dateAdded,$mailerCheck,$source,$foundBy,$OfficeID,$EmployeeID,$buyer,$clientName,$clientEmail,$clientPass,$clientSessionID,$clientTel1,$clientTel2,$clientMob,$clientFax,$clientAddress,$clientLang,$clientIDNum,$propType,$propPriceStart,$propPriceEnd,$propTowns,$propBedFrom,$propBedTo,$sendMailerMonth,$sendMailerNew,$sendNewsletter,$rentalType,$clientFolio,$clientVIP,$SSMA_TimeStamp,$pais,$nacimiento,$clientNotes);
            $ok=mysqli_stmt_execute($resultado_client);
            mysqli_stmt_close($resultado_client);
             if ($ok) {
                $mensaje= 'Cliente Agregado';
                echo json_encode($mensaje);
              }else{
                    $mensaje= ' Error Cliente No Agregado';
                echo json_encode($mensaje);
              }

//////////////////////INSERT USUARIO CIERRO
mysqli_close($connection)

?>


