<?php
if(!defined("PHPCHAT"))
{
	echo '<script>window.location.href("../index.php");</script>';
	exit;
}
?>
</div>
</div>
</body>
<script
	language="javascript" src="theme/js/jquery.js"></script>
<script
	language="javascript" src="install/json.js"></script>
<script
	language="javascript" src="theme/js/jquery-impromptu.js"></script>
<script
	language="javascript" src="theme/js/jquery.qtip.js"></script>


<script type="text/javascript">
$(document).ready(function(){


$(".up_down").click(function(){

   $(this).toggleClass("active");return false;
})

//-------------------setup part------------------------------------------

$(".return_error").hide();
 $("#install_cancel").hide();
 $("#checking").hide();
 $("#db_mode_select").hide();
 $("#db_mode_config").hide();
 $("#movefile_auto").hide();
$("#restart_self").hide();
//$("#restart_auto").hide();
$("#cg_url").hide();
$("#cg_code").hide();
tipword();
	
	
 var integartion = 'no';
 
$("input:text,input:password,textarea").addClass("input_color");

$("input:text,input:password,textarea").blur(function(){
    $(this).addClass("input_color");
});
$("input:text,input:password,textarea").focus(function(){
    $(this).removeClass("input_color");
});


$("#radio_mode_yes").click(function(){
    $("#db_mode_select,#db_mode_config").show("slow");
	integartion = 'yes';
});

$("#radio_mode_no").click(function(){
        $("#db_mode_select").hide("slow");
        $("#db_mode_config").hide("slow");
		$(".return_error").hide();
		$(".return_error").empty();
		$("#checking").hide();
		$("#install_cancel").hide();
		$(".next_prev").show("slow");

	integartion = 'no';
});


$("#auto_movefile_no").click(function(){
       $("#movefile_self").slideDown("slow");
	    $("#movefile_auto").slideUp("slow");

});


$("#auto_movefile_yes").click(function(){
        $("#movefile_self").slideUp("slow");
       $("#movefile_auto").slideDown("slow");
});



$("#auto_restart_yes").click(function(){
       $("#restart_auto").slideDown("slow");
	    $("#restart_self").slideUp("slow");

});


$("#auto_restart_no").click(function(){
        $("#restart_auto").slideUp("slow");
       $("#restart_self").slideDown("slow");
});



$("#show_code1,#show_code2,#show_code3").click(function(){


   var get_code1= $("#show_code1").attr("name");
   var get_code2= $("#show_code2").attr("name");
   var get_code3= $("#show_code3").attr("name");
   var on_code = $(this).attr("name");
   
 
   $("#"+get_code1+",#"+get_code2+",#"+get_code3).hide();
     $("#"+on_code).show();

});




$("#restart_chat").click(function(){
   var txt = 'Do you want to restart chat server now?';
				
				$.prompt(txt,{ 
					buttons:{Restart:true, Cancel:false},
					callback: function(v,m,f){
					
						if(v){
						  var Restarting = 'Restarting! <img src="theme/img/checking.gif" />';
						    $.prompt(Restarting);
						    $.post("install/active_cpfile.php",{active:'<?php echo md5('restart_chat')?>'},function(data){
							   if( data != 'rs_ok') {
							    $('#jqi').remove();
								$('#jqibox').remove();
								$.prompt('Restart unsuccessfully! It just support 7.4 or higher version');
							   
							   }
							   else {
								 $('#jqi').remove();
								$('#jqibox').remove();
								  $.prompt('Restart successfull!');
								}
							  //alert(data);
							});

						}
						
					}
				});
			
});


$("#select_mode").change(function(){
 $("#checking").hide();


     $("#db_mode_config").show("slow");
	 $(".next_prev").show();
	 $("#install_cancel").hide();

  
});



   
$("#host_conf,#local_conf,#free_conf").click(function(){
    $(".return_error").hide();
    $(".return_error").empty();
	var param_val,param_name;
		
   if($(this).attr("id")=='free_conf'){
			 param_val = $("#param_room_name").val();	
			 active_name = 'free_mode_conf';

	}else if($(this).attr("id")=='host_conf'){
			 param_val = $("#param_host_address").val();
			 active_name = 'host_mode_conf';
			 
	}else if($(this).attr("id")=='local_conf'){
			param_val = $("#param_local_server_address").val();
			active_name = 'local_mode_conf';
     }


   

   $.post("install/active.php",{active:active_name,param_post:param_val},function(data){
		return_data(data);
	    ///alert(data);
	});
	
 });   
  
  
  
  
 $("#host_conf_inter,#local_conf_inter").click(function(){

	var param_name;
	

	if($(this).attr("id")=='host_conf_inter'){
			 active_name = 'host_conf_inter_db';

		 }
	else if($(this).attr("id")=='local_conf_inter'){
			 active_name = 'local_conf_inter_db';
			 
		 }

	if(integartion == 'yes'){

		$(".return_error").hide();
		$(".return_error").empty();
		$(".next_prev").hide();
		$("#checking").show();
	    $.post("install/active.php",{
   								active:active_name,
								select_mode:$("#select_mode").val(),
								select_db:$("#select_db").val(),
								param_db_host:$("#param_db_host").val(),
								param_db_port:$("#param_db_port").val(),
								param_db_name:$("#param_db_name").val(),
								param_db_username:$("#param_db_username").val(),
								param_db_password:$("#param_db_password").val(),								
								param_db_user_table:$("#param_db_user_table").val(),
								param_uesrname_field:$("#param_uesrname_field").val(),
								param_pw_field:$("#param_pw_field").val(),
								enablemd5:$("#enablemd5").val()
							   },
		function(data){
			  return_data(data);
			 //alert(data);
		  });
    }else if(integartion == 'no' && $(this).attr("id")=='local_conf_inter' ){

         window.location.href= 'index.php?active=<?php echo md5('local_move_file')?>';
	
	}else{
		 $.post("install/active.php",{active:'no_integration'},function(data){
			window.location.href= data;
		});
	
	}	
 });   
  
  $("#install_done").click(function(){ 
   $.post("install/active.php",{active:'install_done'},function(data){
	    window.location.href= data;
	});
 });

}); //end ready





function return_data(error_meg){

   var json = JSON.parse(error_meg);

 //messenger error 
  if(json['tag']['next']== false){
      
	  var $messenger =  "<div class=\"tip_word\"><ul>";
	
		for(var i=0;i<json['tag']['error_num'];i++)
		{		   
			$messenger += "<li>"+json[i]['error']+"</li>";
		}			  
			  $messenger += "</ul></div>";
			  //  alert($messenger);
		$(".next_prev").show();
		$("#checking").hide();	  
		$(".return_error").show();
        $(".return_error").prepend($messenger);	  
		  
	}else if(json[0]['error']== false){
	//successfull 
	    window.location.href=json['tag']['next'];
	  // alert(json['tag']['next']);
	}
}

function get_3rd_module(data){

    $("#select_3rd_module").prepend(data);

}

function copy(id) 
{
	var text2copy = document.getElementById(id).value;

	document.getElementById(id).select();
	if (window.clipboardData) {
          window.clipboardData.setData("Text",text2copy);
    } 
    else 
    {
		var flashcopier = 'flashcopier';
        if(!document.getElementById(flashcopier)) 
        {
			var divholder = document.createElement('div');
			divholder.id = flashcopier;
			document.body.appendChild(divholder);
      	}
     	document.getElementById(flashcopier).innerHTML = '';
       	var divinfo = '<embed src="theme/_clipboard.swf" FlashVars="clipboard='+escape(text2copy)+'" width="0" height="0" type="application/x-shockwave-flash"></embed>';
   		document.getElementById(flashcopier).innerHTML = divinfo;
   		//alert(document.getElementById(flashcopier).innerHTML);
   }
}




function copy_file(){
				var txt = 'Are you sure you want auto to copy file? It will spend many times';
				
				$.prompt(txt,{ 
					buttons:{Copy:true, Cancel:false},
					callback: function(v,m,f){
					
						if(v){
						  var copyw = 'loading!';
						 $.prompt(copyw);
                         $("#jqi_state0_buttonOk").remove();
						 $(".jqiclose").remove();
						  do_cpfile();
						}
						
					}
				});
			}
			
			
function do_cpfile(){		
				
   $.post("install/active_cpfile.php",{active:'movefile'},function(data){
      var json = JSON.parse(data);
	  var file_list_content = '';
	 
	   if( json['cp_over'] != 'end') {
	   var ratio = json['perv_cp_num']/json['sum_list']*100;
	   var rect_img = ratio*208/100;
	   
	   $(".jqimessage").replaceWith("<div class=\"jqimessage\"> Copying! <br/><div class=\"guage\"><img src=\"theme/img/checking.gif\" style=\"position:absolute;clip:rect(auto "+rect_img.toFixed(1)+"px auto auto)\"/></div><br> <div align=\"right\">"+ratio.toFixed(2)+"%</div></div>");
	  
	      do_cpfile();
	
	   }
	   else {
	    $('#jqi').remove();
		$.prompt('File copy successfull!');
		  $.post("install/active_cpfile.php",{active:'reset'});
		 $('#jqibox').remove();
		}
	  //alert(data);
	});

}

function tipword(){



$("input[name='tipword'],select[name='tipword']").each(function(){
    

	$.post("includes/active_tip_word.php", { tipname: $(this).attr("tipname"), tipid: $(this).attr("id")},
	  function(data){

		 var key = data.split("<!-|||->",1) ;
		  var value = data.split("<!-|||->",2) ;
	     
		  $("#"+key).attr("tipvalue",value[1]);
		 



		$("#"+key).qtip({
		
			 content: $("#"+key).attr("tipvalue"),
			position: {
			  corner: {
				 target: 'topMiddle',
				 tooltip: 'bottomLeft'
			  }
			},
			
			style: { 
				   tip: 'bottomLeft' ,
				  name: 'cream' 
			   }
   
		    });//qtip
	
	  });//post

   }); //for each
}

</script>
</html>