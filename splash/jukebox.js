
$(document).ready(function() {

$('#simple_chat_form').submit(function(event) {
    var formData = {
        'simple_chat_text': $('#simple_chat_text').val(),
    };

    console.log(formData);

    $.ajax({
        type    : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url     : '/splash/chat/simple_chat.php', // the url where we want to POST
        data    : formData, // our data object
        dataType    : 'json', // what type of data do we expect back from the server
        encode      : true
        })
        
// using the done promise callback
   .done(function(data) {
        // log data to the console so we can see
        console.log('OK'); 
        console.log(data['message']); 
        // here we will handle errors and validation messages
        });

   // stop the form from submitting the normal way and refreshing the page
   event.preventDefault();

});
    
// process the form
//
$('#stupid_form').submit(function(event) {
    var formData = {
        'text1': $('#text1').val(),
        'text2': $('#text2').val(),
        'text3': $('#text3').val()
    };

console.log(formData);
    $.ajax({
        type    : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url     : '/splash/forum/stupid_forum.php', // the url where we want to POST
        data    : formData, // our data object
        dataType    : 'json', // what type of data do we expect back from the server
        encode      : true
        })
        
// using the done promise callback
   .done(function(data) {
        // log data to the console so we can see
        console.log('OK'); 
        console.log(data['message']); 
        // here we will handle errors and validation messages
        });

   // stop the form from submitting the normal way and refreshing the page
   event.preventDefault();

});

});
