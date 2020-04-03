import '../css/base.scss';

$(document).ready(function() {
    //Fade out alert message
    setTimeout(function()
    {
        $('.alert').alert().fadeToggle('slow');
    }, 5000);

    //Responsive navbar
    $(".navbar-responsive").toggle();

    $("#menu").click(function ()
    {
        $(".navbar-responsive").toggle("slow");
    });
});