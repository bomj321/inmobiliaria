<?php 
	/*PRIMERO SE OBTIENE LA CANTIDAD DE COLUMNAS*/

$query = $db->prepare('show columns from owners');
$query->setFetchMode(PDO::FETCH_ASSOC);

$query->execute();
$queryCondition_propietario = "";

$i = 0;
while ($row = $query->fetch()){
$i++;     
}

/*PRIMERO SE OBTIENE LA CANTIDAD DE COLUMNAS*/

/*DESPUES DE OBTIENDE LA QUERY A AGREGAR AL SELECT*/
$query_2 = $db->prepare('show columns from owners');
$query_2->setFetchMode(PDO::FETCH_ASSOC);

$query_2->execute();
$a = 0;
while ($row = $query_2->fetch()){

       $queryCondition_propietario .= $row['Field'] . " LIKE '%" . $busqueda . "%'";

$a++;    

/*SECCION PARA VERIFICAR SI ES EL ULTIMO REGISTRO Y AGREGAR EL OR*/


if($i!=$a){
              $queryCondition_propietario .= " OR ";
          }

/*SECCION PARA VERIFICAR SI ES EL ULTIMO REGISTRO Y AGREGAR EL OR*/

}

/*DESPUES DE OBTIENDE LA QUERY A AGREGAR AL SELECT*/


 ?>