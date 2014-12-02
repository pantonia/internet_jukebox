
<!DOCTYPE html>
<html>
<head>
<title>Internet Jukebox</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="jukebox.css" media="screen" title="home">
<link rel="stylesheet" href="input.css" media="screen" title="home">
<script>
if (!window.jQuery) {
        document.write('<script src="/js/jquery.min.js"><\/script>');
}
</script>
<script src="jukebox.js"></script>
</head>
<body>

<?php //include('./iptables.php');?>

<script>

$(document).ready(function() {

jQuery('#debugdiv').hide();

jQuery('#main_internet').hide();
jQuery('#main_files').hide();
jQuery('#main_jukebox').show();
jQuery('#main_local').hide();
jQuery('#main_all').hide();
jQuery('#main_info').hide();
jQuery('#main_search').hide();

jQuery('#info_icon').click(function () {
jQuery('#main_internet').hide();
jQuery('#main_files').hide();
jQuery('#main_jukebox').hide();
jQuery('#main_local').hide();
jQuery('#main_all').hide();
jQuery('#main_info').show();
jQuery('#main_search').hide();
});

jQuery('#search_menu').click(function () {
jQuery('#main_internet').hide();
jQuery('#main_files').hide();
jQuery('#main_jukebox').hide();
jQuery('#main_local').hide();
jQuery('#main_all').hide();
jQuery('#main_search').show();
jQuery('#main_info').hide();
});

jQuery('#search_icon').click(function () {
jQuery('#main_internet').hide();
jQuery('#main_files').hide();
jQuery('#main_jukebox').hide();
jQuery('#main_local').hide();
jQuery('#main_all').hide();
jQuery('#main_search').show();
jQuery('#main_info').hide();
});

jQuery('#home_icon').click(function () {
jQuery('#main_internet').hide();
jQuery('#main_files').hide();
jQuery('#main_jukebox').hide();
jQuery('#main_local').hide();
jQuery('#main_all').show();
jQuery('#main_search').hide();
jQuery('#main_info').hide();
});

jQuery('#local_menu').click(function () {
//jQuery('#main_local').load("./plocal.php?update=1");
jQuery('#main_internet').hide();
jQuery('#main_files').hide();
jQuery('#main_jukebox').hide();
jQuery('#main_local').show();
jQuery('#main_all').hide();
jQuery('#main_info').hide();
jQuery('#main_search').hide();
});

jQuery('#local_icon').click(function () {
//jQuery('#main_local').load("./plocal.php?update=1");
jQuery('#main_internet').hide();
jQuery('#main_files').hide();
jQuery('#main_jukebox').hide();
jQuery('#main_local').show();
jQuery('#main_all').hide();
jQuery('#main_info').hide();
jQuery('#main_search').hide();
});

jQuery('#jukebox_menu').click(function () {
//jQuery('#main_jukebox').load("./jukebox_download.php");
jQuery('#jukebox_iframe').attr("src", $('#jukebox_iframe').attr("src"));
jQuery('#main_internet').hide();
jQuery('#main_files').hide();
jQuery('#main_jukebox').show();
jQuery('#main_local').hide();
jQuery('#main_all').hide();
jQuery('#main_info').hide();
});

jQuery('#jukebox_icon').click(function () {
//jQuery('#main_jukebox').load("./jukebox_download.php");
jQuery('#jukebox_iframe').attr("src", $('#jukebox_iframe').attr("src"));
jQuery('#main_internet').hide();
jQuery('#main_files').hide();
jQuery('#main_jukebox').show();
jQuery('#main_local').hide();
jQuery('#main_all').hide();
jQuery('#main_info').hide();
jQuery('#main_search').hide();
});

jQuery('#files_menu').click(function () {
jQuery('#watch_iframe').attr("src", $('#watch_iframe').attr("src"));
jQuery('#main_internet').hide();
jQuery('#main_files').show();
jQuery('#main_jukebox').hide();
jQuery('#main_local').hide();
jQuery('#main_all').hide();
jQuery('#main_info').hide();
});

jQuery('#files_icon').click(function () {
jQuery('#watch_iframe').attr("src", $('#watch_iframe').attr("src"));
jQuery('#main_internet').hide();
jQuery('#main_files').show();
jQuery('#main_jukebox').hide();
jQuery('#main_local').hide();
jQuery('#main_all').hide();
jQuery('#main_info').hide();
jQuery('#main_search').hide();
});

jQuery('#internet_menu').click(function () {
jQuery('#main_internet').show();
jQuery('#main_files').hide();
jQuery('#main_jukebox').hide();
jQuery('#main_local').hide();
jQuery('#main_all').hide();
jQuery('#main_info').hide();
});

jQuery('#internet_icon').click(function () {
jQuery('#main_internet').show();
jQuery('#main_files').hide();
jQuery('#main_jukebox').hide();
jQuery('#main_local').hide();
jQuery('#main_all').hide();
jQuery('#main_info').hide();
jQuery('#main_search').hide();
});


//function() {
//setInterval(function() {
//jQuery('#main_local').attr("src", $('#main_local').attr("src"));
//}, 3000); });

});

</script>

<div id='debugdiv'></div>

<div class='top' id='top_menu'>
<table width=900px>
<tr><td align=left>
<span id='home_icon' align='left'><img src='./images/home.png'></span>
</td><td align=center>
<span id='internet_icon'>
<img src='./images/internet.jpg' width=60>
</span>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
<span id='search_icon'>
<img src='./images/search.png' width=45>
</span>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
<span id='jukebox_icon'>
<img src='./images/jukebox.png' width=45>
</span>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
<span id='files_icon'>
<img src='./images/files.png' width=40>
</span>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
<span id='local_icon'>
<img src='./images/local.png' width=45>
</span>
</td><td align=right>
<span id='info_icon' align='right'><img src='./images/info.png'></span>
</td></tr></table>
</div>
<br/>

<div id='container_all'>

<div class='center' id='main_all'>
<?php include('./details.php');?>
</div>

<div class='center' id='main_info'>
<?php include('./pinfo.php');?>
</div>

<div class='center' id='main_internet'>
<?php include('./pinternet.php');?>
</div>
<div class='center' id='main_files'>
<?php include('./pwatch.php');?>
</div>
<div class='center' id='main_jukebox'>
<?php include('./pjukebox.php');?>
</div>
<div class='center' id='main_local'>
<?php include('./plocal.php');?>
</div>
<div class='center' id='main_search'>
<?php include('./psearch.php');?>
</div>

</div>

</body>
</html>
