<?php 
// error_reporting (E_ALL ^ E_NOTICE);
// photo gallery settings
$mainFolder    = 'album';   // folder where your albums are located - relative to root
$itemsPerPage  = '30';       // number of images per page    
$thumb_width   = '150';      // width of thumbnails
//$thumb_height  = '85';       // height of thumbnails
$extensions    = array(".jpg",".jpeg",".png",".gif",".JPG",".JPEG",".PNG",".GIF"); // allowed extensions in photo gallery


// create thumbnails from images
function make_thumb($folder,$src,$dest,$thumb_width) {

//	$type = exif_imagetype($folder.'/'.$src);
	
//	switch($stype) {
//		case 1:
//			$source_image = imagecreatefromgif($folder.'/'.$src);
//			break;
//		case 3:
//              	$source_image = imagecreatefrompng($folder.'/'.$src);
//			break;
//		case 2:
			$source_image = imagecreatefromjpeg($folder.'/'.$src);
//			break;
//	}

	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	$thumb_height = floor($height*($thumb_width/$width));
	
	$virtual_image = imagecreatetruecolor($thumb_width,$thumb_height);
	
	imagecopyresampled($virtual_image,$source_image,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
	
//	switch($stype) {
//		case 1:
//			imagegif($virtual_image, $dest,100);
//			break;
//		case 3:
//			imagepng($virtual_image, $dest,100);
//			break;
//		case 2:
			imagejpeg($virtual_image, $dest,100);
//			break;
//	}
	
}

// display pagination
function print_pagination($numPages,$urlVars,$currentPage) {
        
   if ($numPages > 1) {
      
	   echo 'Page '. $currentPage .' of '. $numPages;
	   echo '&nbsp;&nbsp;&nbsp;';
   
       if ($currentPage > 1) {
	       $prevPage = $currentPage - 1;
	       echo '<a href="?'. $urlVars .'p='. $prevPage.'">&laquo;&laquo;</a> ';
	   }	   
	   
	   for( $e=0; $e < $numPages; $e++ ) {
           $p = $e + 1;
       
	       if ($p == $currentPage) {	    
		       $class = 'current-paginate';
	       } else {
	           $class = 'paginate';
	       } 
	       

		       echo '<a class="'. $class .'" href="?'. $urlVars .'p='. $p .'">'. $p .'</a>';
		  	  
	   }
	   
	   if ($currentPage != $numPages) {
           $nextPage = $currentPage + 1;	
		   echo ' <a href="?'. $urlVars .'p='. $nextPage.'">&raquo;&raquo;</a>';
	   }	  	 
   
   }

}

// display photos in album
$src_folder = $mainFolder.'/'.$_GET['album'];
$src_files  = scandir($src_folder);

$files = array();
foreach($src_files as $file) {

	$ext = strrchr($file, '.');
    if(in_array($ext, $extensions)) {
          
		array_push( $files, $file );
		  
		   
		if (!is_dir($src_folder.'/thumbs')) {
            mkdir($src_folder.'/thumbs');
            chmod($src_folder.'/thumbs', 0777);
            //chown($src_folder.'/thumbs', 'apache'); 
        }
		   
		$thumb = $src_folder.'/thumbs/'.$file;
        if (!file_exists($thumb)) {
            make_thumb($src_folder,$file,$thumb,$thumb_width); 
          
		}
        
	}
      
}
 


if ( count($files) == 0 ) {

    echo 'There are no photos in this album!';
   
} else {
   
    $numPages = ceil( count($files) / $itemsPerPage );

    if(isset($_GET['p'])) {
      
	    $currentPage = $_GET['p'];
        if($currentPage > $numPages) {
        	$currentPage = $numPages;
        }

	} else {
        $currentPage=1;
    } 

   $start = ( $currentPage * $itemsPerPage ) - $itemsPerPage;

   echo '<div class="titlebar">
           <div class="float-left"><span class="title">'. $_GET['album'] .'</span> - <a href="'.$_SERVER['PHP_SELF'].'">View All Photos</a></div>
           <div class="float-right">'.count($files).' images</div>
         </div>';	  
   echo '<div class="clear"></div>';


   for( $i=$start; $i<$start + $itemsPerPage; $i++ ) {
		  
		if( isset($files[$i]) && is_file( $src_folder .'/'. $files[$i] ) ) { 
	   
	    	echo '<div class="thumb shadow">
	                <div class="thumb-wrapper">
				<a href="'. $src_folder .'/'. $files[$i] .'" class="albumpix" rel="albumpix">
				<img src="'. $src_folder .'/thumbs/'. $files[$i] .'" width="'.$thumb_width.'" alt="" />
				</a>
			</div>  
		     </div>'; 
      
	    } else {
		  
			if( isset($files[$i]) ) {
			  echo $files[$i];
		    }
		   
		}
     
    }
	   

    echo '<div class="clear"></div>';
  
    echo '<div align="center" class="paginate-wrapper">';
        	 
    $urlVars = "album=".urlencode($_GET['album'])."&amp;";
    print_pagination($numPages,$urlVars,$currentPage);
  
    echo '</div>';	 

}//end else

?>
