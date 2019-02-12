<div class="row" style="margin-top: 50px; background-color: white;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 30px;">
			 <table id="clientes_busqueda" class="table table-hover bulk_action dt-responsive nowrap table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                	<th>ID</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Telefono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                          <!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<?php

/*PRIMERO SE OBTIENE LA CANTIDAD DE COLUMNAS*/

$query = $db->prepare('show columns from clients');
$query->setFetchMode(PDO::FETCH_ASSOC);

$query->execute();
$queryCondition = "";

$i = 0;
while ($row = $query->fetch()){
$i++;     
}

/*PRIMERO SE OBTIENE LA CANTIDAD DE COLUMNAS*/

/*DESPUES DE OBTIENDE LA QUERY A AGREGAR AL SELECT*/
$query_2 = $db->prepare('show columns from clients');
$query_2->setFetchMode(PDO::FETCH_ASSOC);

$query_2->execute();
$a = 0;
while ($row = $query_2->fetch()){

       $queryCondition .= $row['Field'] . " LIKE '%" . $busqueda . "%'";

$a++;    

/*SECCION PARA VERIFICAR SI ES EL ULTIMO REGISTRO Y AGREGAR EL OR*/


if($i!=$a){
              $queryCondition .= " OR ";
          }

/*SECCION PARA VERIFICAR SI ES EL ULTIMO REGISTRO Y AGREGAR EL OR*/

}

/*DESPUES DE OBTIENDE LA QUERY A AGREGAR AL SELECT*/











$stmt = $db->prepare("SELECT ID ,clientType, dateAdded, clientName, clientEmail,clientTel1  FROM clients WHERE " . $queryCondition . " ORDER BY ID");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while ($row = $stmt->fetch()){// WHILE 1
 ?>
<!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<!--CUERPO DE LA PAGINA-->
<tr>
						                <td>
						                	<a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" ><?php echo $row['ID']?></a>
						                </td>

										<td>
											<a style='color: black;' href="" class="green"><strong><?php echo $row['clientType']?></strong></a>
										</td>

										<td>
											<a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" class="uk-text-truncate"><?php echo $row['dateAdded']?> / <?php echo $row['dateAdded']?></a>
										</td>

										<td onclick="datoscliente('<?php echo $row['ID']?>')" style="cursor:pointer;" data-toggle="modal" data-target="#cliente_modal">
											<?php echo $row['clientName']?>

										</td>

										<td>
											<a style='color: black;' href="" > <?php echo $row['clientEmail']?> </a>
										</td>

										<td>
											<?php echo $row['clientTel1']?>

										</td>

										<td>
												<!--<a style='color: black;'  onclick="previewModal('<?php //echo $row['ID']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>-->

												<a style='color: black;' id='boton_clientes_editar' onclick="modalEditar(<?php echo $row['ID']?>)"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>												
										</td>

</tr>
<!--CUERPO DE LA PAGINA-->
<?php

}// WHILE 1
?>
                            </tbody>
                        </table>
		</div>
	</div>


<!--------------------------------->

