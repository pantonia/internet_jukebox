<?php 

//settings the Jukebox video voting:


// IMPORTANT: change this one into the name of your homepage file, 
//           for example, index.php 
$callingfile="jukebox.php"; 

// File in which voting scores are kept
$filename = "lppiclist.txt"; 

// Change this password so no one else can access the lp_admin.php via the web
$pwd="jukebox"; 

// Change the number of columns here: where the list of videos (content) will appear here
$ncols=1;

//Time between votes in seconds
$time_between_votes = 36000; 

// Width of graph in pixels
$graph_width = 70; 

// Height of graph in pixels
$graph_height = 12; 

// Messages (Can easily be used as 'dynamic headers' for the poll)
$message1="Your votes please";  
$message2="Thanks for Voting!";
$message3="Voting Results";

// Text on vote button
$vote_str="Vote"; 

// Use CSS code to style the 'vote' button
$buttonstyle="";
?>
