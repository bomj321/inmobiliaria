<?php 
require('../includes/config2.php'); 
$ciudad=$_POST["poblacion_id"];?>

<?php 

 $zonas = $db->prepare("SELECT DISTINCT Location FROM sys_towns where active='1' and PC LIKE '%$ciudad%' order by Location Asc");
			   $zonas->setFetchMode(PDO::FETCH_ASSOC);
$zonas->execute();

while ($row3 = $zonas->fetch()){
				$zona_definida=ucwords(strtolower($row3['Location']));
	            
				if ($zona_definida=="0") {$zona_definida="Definir zona en $ciudad";$zona_definida2=0;} else {$zona_definida2=ucwords(strtolower($row3['Location']));}
	             
				?>
			   
			   <option value="<?php echo $zona_definida;?>"><?php echo $zona_definida;?></option>
			<?php  $numero++;}?>