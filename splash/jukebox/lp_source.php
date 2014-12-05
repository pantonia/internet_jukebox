<?php
//version 1.4 optimized for PHP 5.4
date_default_timezone_set('UTC');
include("lp_settings.php"); //include file containing general settings


if (!isset($_COOKIE['votingstep'])) {
	$votingstep=1;
	} else { $votingstep = $_COOKIE['votingstep']; }

function SumArray($arr) {
	$h=count($arr); $in=0; $m=0;
	while ($in<$h) { $m += $arr[$in]; $in++;	}
	return $m;
}

function getIP() {
	if (getenv("HTTP_CLIENT_IP")) $ip = getenv("HTTP_CLIENT_IP");
	else if(getenv("HTTP_X_FORWARDED_FOR")) $ip = getenv("HTTP_X_FORWARDED_FOR");
	else if(getenv("REMOTE_ADDR")) $ip = getenv("REMOTE_ADDR");
	else $ip = "UNKNOWN";
return $ip;
}

function write2log ($linetoadd) {
	$rightnow=date("F j, Y, g:i a");
	$fplog=fopen('lp_log.dat', "a");
	fputs($fplog, getIP()."|".$rightnow."|".$linetoadd."\n");
	fclose($fplog);
}

// function that reads the adminstrator inputs that are stored in lppiclist.txt (defined in the settings)
function ReadElements() {
	global $filename;
	$fp=fopen($filename, "r");
	$file_contents=fread($fp,filesize($filename)-1);
	fclose($fp);
	$elements=explode("|",$file_contents);
	$h=(count($elements)-1)/4;
	$question=stripslashes($elements[0]);
	$in=0;
	while ($h>$in) {
		$item[$in]=$elements[(4*$in+1)];
		$smallpic[$in]=$elements[(4*$in+2)];
		$bigpic[$in]=$elements[(4*$in+3)];
		$itemvoted[$in]=$elements[(4*$in+4)];
		$in++;
	}
	return array ($item, $smallpic, $bigpic, $itemvoted, $question);
}

list ($item, $smallpic, $bigpic, $itemvoted, $question) = ReadElements();

if(isset($_COOKIE['pollidcookie'])) {
	if ($question != stripslashes($_COOKIE['pollidcookie'])) {
	$votingstep=1;
	}
}
setcookie("pollidcookie", $question, time()+$time_between_votes);


function ShowTheStuff($item, $smallpic, $bigpic, $itemvoted, $graph_width, $graph_height) {
	global $ncols; //defined in the settings
	$hector=count($itemvoted);$totalvotes=0;$in=0;$stepstr='';
	$totalvotes=SumArray($itemvoted);
	$in=0;
	if ($totalvotes==0) { $totalvotes=0.0001; }
	$stepstr=$stepstr.'<table border=0><tr>';
	while ($in<$hector) {
		$timesred=(int)((($itemvoted[$in]/$totalvotes))*$graph_width);
		$stepstr=$stepstr.'<td><table border=0><tr><td>&nbsp</td><td><font size="1">'.stripslashes($item[$in]).'</td></tr>';
		$stepstr=$stepstr.'<tr><td align="center"><font size="1">'.(int)(($itemvoted[$in]/$totalvotes)*100).'%<br><img width='.$graph_height.' height='.($graph_width-$timesred).' src="lp_0.gif"><br><img width='.$graph_height.' height='.$timesred.' src="lp_1.gif"></td>';
		$stepstr=$stepstr.'<td><a href="#" OnClick="window.open(\''.$bigpic[$in].'\', \'GOto\', \'toolbar=no\');"><img src="'.$smallpic[$in].'" border=0></a></td></tr></table></td>';
			

		if ((($in-$ncols+1) % $ncols) == 0)  {
			$stepstr=$stepstr.'</tr></table><table border=0><tr>';
		}
		$in++;
	}
	$stepstr=$stepstr.'</tr></table>';
	return $stepstr;
}


if (!isset($votingstep)) {
	$votingstep=1;
	}

if ($votingstep==2) {
	if(!isset($_POST['radios'])){
		$votingstep=1;
		write2log("Clicked vote button without choosing an item");
	} // detect if someone has clicked the voting button without choosing an item
}

if ($votingstep==1) {
	write2log("Enters Poll");
	setcookie("votingstep","2",time()+$time_between_votes);
	$mainstr=$message1;
	$step1str='<form action="'.$callingfile.'" method="post" name="form1">';
	$totalvotes=SumArray($itemvoted);
	$in=0;
	$step1str=$step1str.'<table border=0><tr>';
	$datop=count($item);
	while($in<$datop){
	    $step1str=$step1str.'<td><table border=0><tr>';
		$step1str=$step1str.'<td><input type="radio" name="radios" value="'.$in.'"></td><td><font size="1">'.stripslashes($item[$in]).'</td></tr>';
		//$step1str=$step1str.'<tr><td align="center"><font size="1">'.(int)(($itemvoted[$in]/$totalvotes)*100).'%<br><img width='.$graph_height.' height='.($graph_width-$timesred).' src="lp_0.gif"><br><img width='.$graph_height.' height='.$timesred.' src="lp_1.gif"></td>';
		$step1str=$step1str.'<tr><td>&nbsp</td><td><a href="#" OnClick="window.open(\''.$bigpic[$in].'\', \'GOto\', \'toolbar=no\');"><img src="'.$smallpic[$in].'" border=0></a></td></tr></table></td>';
		if ((($in-$ncols+1) % $ncols) == 0)  {
		$step1str=$step1str.'</tr></table><table border=0><tr>';
		}

		$in++;
	}
	$step1str=$step1str.'</tr></table>';
	$step1str=$step1str.'<br><input style="'.$buttonstyle.'" type="Submit" value="'.$vote_str.'"></form>';
}

if ($votingstep==2) {
	setcookie("votingstep","3",time()+$time_between_votes);
	$mainstr=$message2;
	$itemvoted[$_POST['radios']]=$itemvoted[$_POST['radios']]+1;
	$totalvotes=SumArray($itemvoted);
	$fp=fopen($filename, "w");
	$hector=count($item);
	$in=0;
	$linetoadd=$question.'|';
	fputs($fp, $linetoadd);
	while($in<$hector) {
		$linetoadd=$item[$in].'|'.$smallpic[$in].'|'.$bigpic[$in].'|'.$itemvoted[$in].'|';
		fputs($fp, $linetoadd);
		$in++;
	}
	fclose($fp);
	write2log("Vote received on ".$item[$_POST['radios']]);
	$step2str=ShowTheStuff($item, $smallpic, $bigpic, $itemvoted, $graph_width, $graph_height);
}
if ($votingstep==3) {
	$mainstr=$message3;
	$totalvotes=SumArray($itemvoted);
	write2log("Views results");
	$step3str=ShowTheStuff($item, $smallpic, $bigpic, $itemvoted, $graph_width, $graph_height);
}

?>
