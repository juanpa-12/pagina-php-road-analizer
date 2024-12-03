$(document).ready(function() {

    $('#contactForm').submit(function(event) {
        event.preventDefault(); 


        
        setTimeout(function() {
            $('.success-message').fadeIn(); 
            $('#contactForm')[0].reset(); 
        }, 1000);
    });
});
