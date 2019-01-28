<?php
require('../includes/config2.php');
$refreload=$_POST['ref'];
$stmt6999 = $db->prepare("SELECT * FROM image_zonas where ref='$refreload' order by orden asc");
$stmt6999->setFetchMode(PDO::FETCH_ASSOC);
$stmt6999->execute();
while ($row6999 = $stmt6999->fetch()){?>					
<li>

		<div class="image uk-card"><div class="uk-inline-clip uk-transition-toggle uk-light covergallery" tabindex="0"><img src="<?php echo $row6999['small']?>"><div class="uk-position-top-right" style="top:10px !important; right:10px !important">
           
            </div></div> <input type="text" class="uk-input uk-text-center" placeholder="Titulo de imagen" <?php if ($row6999['caption']!="") {?> value="<?php echo $row6999['caption'];?>"<?php }?> disabled></div>
		
			   </li>					
		
<?php }?>