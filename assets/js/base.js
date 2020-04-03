import '../css/base.scss';

$(document).ready(function() {
    setTimeout(function()
    {
        $('.alert').alert().fadeToggle('slow');
    }, 5000);
});