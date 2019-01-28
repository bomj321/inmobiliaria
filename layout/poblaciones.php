<?php 
require('../includes/config2.php'); 
$ciudad2=$_POST["ciudad_id"];?>

<?php 

 $zonas1 = $db->prepare("SELECT DISTINCT Town FROM sys_towns where active='1' and PC LIKE '%$ciudad2%' order by Town Asc");
			   $zonas1->setFetchMode(PDO::FETCH_ASSOC);
$zonas1->execute();

while ($row4 = $zonas1->fetch()){
				$zona_definida=ucwords(strtolower($row4['Town']));
				
	          
				?>
			   
			   <option><?php echo $zona_definida;?></option>
			<?php  $numero++;}?>