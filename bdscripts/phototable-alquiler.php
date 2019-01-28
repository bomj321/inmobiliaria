<? include "../includes/mysql2.php";
$link = mysqli_connect("localhost", "2108miq", "A9jew2*1", "webstyle_mallorcapanel2");

 

// Check connection

if($link === false){

    die("ERROR: Could not connect. " . mysqli_connect_error());

}
?>
<?ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>
<p>Creando tabla</p>
<?$query="SELECT * FROM rentals";?>
<? global $wpdb;
$datos = $wpdb->get_results($query);
	 $numero=0;
	foreach($datos as $res){
		
		
		$a['propiedades'][] = array(
			'ID' => $res->ID,
			'ref' => $res->yourRef,
			'fotos' => $res->photoOrder
			
		);
	

        } 
if(empty($a['propiedades'])){ echo '<h1 class="uk-text-center uk-margin-large-top uk-width-1-1">'.$lang['no-hay-propiedades'].'</h1>';
    }else{
foreach($a['propiedades'] as $key=>$res){
	$order=1;
	$ga = explode(',',$res['fotos']);
	$gallery_url = array();
	foreach($ga as $resimg){
		$gallery_url = array();
			$media = wp_get_attachment_image_src($resimg,'thumbnail');
			$media1 = wp_get_attachment_image_src($resimg,'medium');
			$media2 = wp_get_attachment_image_src($resimg,'large');
			$media3 = wp_get_attachment_image_src($resimg,'full');
			$url_media = $media[0];
			$url_media1 = $media1[0];
			$url_media2 = $media2[0];
			$url_media3 = $media3[0];
			$post_img = get_post($resimg);
			if(!empty($post_img)){
				$title = $post_img->post_title;
				$caption = $post_img->post_excerpt;
			}else{
				$title = '';
				$caption = '';
			}
			$gallery_url[] = array($url_media,$url_media1,$url_media2,$url_media3,$title,$caption); 
		    $ref=$res['ref'];
		    $small=$gallery_url[0][0];
		    $medium=$gallery_url[0][1];
		    $full=$gallery_url[0][2];
			$alt=$gallery_url[0][4];
		  $caption=$gallery_url[0][5];
		 $caption=limpia($caption);    
		   $sql = "INSERT INTO image_properties_rentals (ref, full, medium,small,alt,orden,caption) VALUES ('$ref', '$full', '$medium','$small','$alt','$order','$caption')";
		    mysqli_query($link, $sql);
			$order=$order+1;

		}
}}