<?php

//include the file for plotting different tables
include("phpgraphlib.php");
//include("phpgraphlib_pie.php");

//The data file going to be processed.
$data_file = "./votes/votes_Rpi1.txt";

//empty array for storing the items
$items=array();

//the item class contains the information for dealing with the item
class item
{
  public $name;
  public $count;
  public $percent;

  public function __construct($name, $count, $percent)
  {
      $this->name = $name;
      $this->count = $count;
      $this->percent = $percentage;
  }
}

//Reading the file line by line
$lines = file($data_file);

foreach($lines as $line_num => $line)
{

//echo $line;

//Store the name of the music
$pos = strpos($line,"=");
$name = substr($line,0,$pos);
//echo $name;

//Store the count of the vote
$count = filter_var($line, FILTER_SANITIZE_NUMBER_INT);
//echo $count;
//echo "<br>";


//make a new struct
$tmp = new item($name,$count,0);

//push this in the array of structs 
array_push($items,$tmp);

}

//print_r($items);


//count the total votes now.
$total_votes=count_total_votes($items);

function count_total_votes($items)
{
	
   $total_votes=0;
   foreach ($items as $value)
   {
//	echo $value->count;
        $total_votes=$total_votes+$value->count;
   }

   return $total_votes;
}

//echo $total_votes;


//Calculate the percentage for each item and put this value in

foreach ($items as $value) 
{
    $tmp=$value->count/$total_votes;
    $value->percentage=$tmp;
}

//print_r($items);


//Plot the bar table of the votes

$bar=array();

foreach ($items as $value)
{
    $tmp_name=$value->name;
    $tmp_count=$value->count;
    $tmp_element=array($tmp_name=>$tmp_count);
    array_push($bar,$tmp_element);
}

//print_r($bar);

$data_bar = json_encode($bar);
//echo $data_bar;

$graph1 = new PHPGraphLib(400,300);
$graph1->addData($data_bar);
$graph1->setTitle("Number of Votes for each type of music");
$graph1->setTextColor("blue");
$graph1->createGraph();


//Plot the pie table of the votes with percentage

$pie=array();

foreach ($items as $value)
{
    $tmp_name=$value->name;
    $tmp_percentage=$value->percentage;
    $tmp_element=array($tmp_name=>$tmp_percentage);
    array_push($pie,$tmp_element);
}

//print_r($pie);

$data_pie = json_encode($pie);
//echo $data_bar;

$graph2 = new PHPGraphLib(400,300);
$graph2->addData($data_pie);
$graph2->setTitle("Percentage of Votes for each type of music");
$graph2->setLabelTextColor("blue");
$graph2->createGraph();


?>


