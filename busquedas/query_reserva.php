<?php 
	/*PRIMERO SE OBTIENE LA CANTIDAD DE COLUMNAS*/

$query = $db_reservas->prepare('show columns from rental_enquiries');
$query->setFetchMode(PDO::FETCH_ASSOC);

$query->execute();
$queryCondition_reserva = "";

$i = 0;
while ($row = $query->fetch()){
$i++;     
}

/*PRIMERO SE OBTIENE LA CANTIDAD DE COLUMNAS*/

/*DESPUES DE OBTIENDE LA QUERY A AGREGAR AL SELECT*/
$query_2 = $db_reservas->prepare('show columns from rental_enquiries');
$query_2->setFetchMode(PDO::FETCH_ASSOC);

$query_2->execute();
$a = 0;
while ($row = $query_2->fetch()){

       $queryCondition_reserva .= ' rental_enquiries.'. $row['Field'] . " LIKE '%" . $busqueda . "%'";

$a++;    

/*SECCION PARA VERIFICAR SI ES EL ULTIMO REGISTRO Y AGREGAR EL OR*/


if($i!=$a){
              $queryCondition_reserva .= " OR ";
          }

/*SECCION PARA VERIFICAR SI ES EL ULTIMO REGISTRO Y AGREGAR EL OR*/

}

/*DESPUES DE OBTIENDE LA QUERY A AGREGAR AL SELECT*/
 ?>