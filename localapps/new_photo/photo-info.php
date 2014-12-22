<?php
//the target file here is the album/thumbs foler
$dir = "album/thumbs";
//$types =array("jpg","JPG","jpeg","JPEG","png","PNG","gif","GIF");

//list the files inside the folder
$files = scandir($dir);

empty array for storing the image files
$images=array();
$names =array();

empty array for information of the photos
$info=array();

the image class contains the information for dealing with the images
class image
{
  public $name;
  public $id;
  public $likes;
 
  public function __construct($name, $id, $likes)
  {
      $this->name = $name;
      $this->id = $id;
      $this->likes = $likes;
  }
	 
  public function liked()
  {
      return $this->likes++;
  }  
}

foreach ($files as $value) {
    $ext=substr($value,-3);
    if(in_array($ext,$types)){
	array_push($images,$value);
    }
}
//print_r($images);

foreach ($images as $value){
    $basename = substr($value, 0, strrpos($value, "."));
    array_push($names,$basename);

    $tmp = new image($value,$basename,0);
    array_push($info,$tmp);
}
//print_r($names);
//print_r($info);

?>

