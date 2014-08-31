
$(document).ready(function() {

    
// process the form
//
$('#stupid_form').submit(function(event) {
// get the form data
// there are many ways to get this data using jQuery (you can use the class or id also)
//
    var formData = {
        'text1': $('#text1').val(),
        'text2': $('#text2').val(),
        'text3': $('#text3').val()
    };

console.log(formData);
    // process the form
    $.ajax({
        type    : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url     : '/splash/stupid_forum.php', // the url where we want to POST
        data    : formData, // our data object
        dataType    : 'json', // what type of data do we expect back from the server
        encode      : true
        })
        
// using the done promise callback
//
   .done(function(data) {
        // log data to the console so we can see
        console.log(data); 
        // here we will handle errors and validation messages
        });

   // stop the form from submitting the normal way and refreshing the page
   event.preventDefault();

});

});
