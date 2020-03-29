import '../css/trick.scss';

$(document).ready(function () {
    $('.enlarge').on('click', function () {
        $(this).toggleClass('clic-image');
    });
});