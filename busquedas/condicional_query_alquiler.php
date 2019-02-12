<?php 
         $ref=$row['yourRef'];
                        $tipo = explode('|',$row['propType']);
                        $localizaciones = explode(':',$row['propLocation']);
                        $town=$row['propTown'];
                        $title2 = limpia($row['propNameES']);
                        $location=$localizaciones;
                        if (($location=="0") or ($location=" ")) {
                            $location=strtolower($localizaciones[0]);
                        } else {
                            $location=$location;

                        }

                        $location=ucwords($location);

                        $titulo_prop=strtolower($row['propNameES']);

                        if ($location=="0") {
                            $location="<span style='font-style:italic'>-No asignado-</span>";
                        }

                        $precio = number_format((float)$row['propPrice'], 0, ',', '.');

                        if ($precio!="0") {
                            $precio=$precio."€";
                        } else {
                            $precio="<i>-No asignado-</i>";
                        }



/*IMAGENES*/
  if ($row['imagengrande']=="") {
        $imagen_foto = 'imagen_grande_vacia';
                            # code...
    }elseif ($row['imagengrande']!="") {       
         $imagen_foto = 'imagen_grande_no_vacia';

    }elseif ($row['imagenpequena']=="") {

        $imagen_foto = 'imagen_pequena_vacia';
    }elseif ($row['imagenpequena']==!"") {
        $imagen_foto = 'imagen_pequena_no_vacia';

    }  


/*IMAGENES*/

/*ACTIVO*/
if ($row['active']=='1') {
    $activo = '<a><span uk-icon="icon:check;ratio: 1" class="green"></a></span>';
}else{
        $activo = '<a><span uk-icon="icon:close;ratio: 1" class="red"></a></span>';

}

/*ACTIVO*/

/*TIPO*/
 $tipo_de_casa=str_replace('_', ' ',$row['propType']);
/*TIPO*/

 ?>


