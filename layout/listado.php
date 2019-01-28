
        <tr>
			<td><span uk-icon="icon:check;" class="green"></span></td>
			 <td class="uk-table-link"><a href="" ><span style="font-weight:600"><?php echo $row['yourRef']?></span></a>
			<td class="uk-table-link"><a href="" >Venta</a></td>
			
				 <!--¿IMAGEN? <div style="width:110px;height:70px; "><div style="background:url(images/listexample.jpg) no-repeat 50% 50%;height:100%; border-radius:25px"></div></div>-->
			</td>
           
            
			 <td class="uk-table-link uk-text-truncate" ><a href="" class="uk-text-truncate"><?php echo $row['propNameES']?></a></td>
	<td class="uk-table-link"><a href="" ><?php echo tipo_propiedad($tipo[0]);?></a></td>
			 <td class="uk-table-link"><a href="" ><?php echo $row2['sellerName1']?></a></td>
			 <td class="uk-table-link"><a href="" ><?php echo $location?></a></td>
			 <td class="uk-text-right" style="padding-right:35px;"><?php echo $precio?> €</td>
			<td class="uk-table-expand" style="float:right"><div class="uk-grid uk-grid-small">
				<a href="" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>
				<a href=""><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
				<a  uk-toggle="target: #galeria-listado"><span uk-icon="icon:image;ratio:1" uk-tooltip="Galería"></span></a>
				<a href=""><span uk-icon="icon:link;ratio:1" uk-tooltip="Ficha web"></span></a>
				<a href=""><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
				
				
				</div></td>
        </tr>
		