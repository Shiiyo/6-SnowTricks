import '../css/trick.scss';

$(document).ready(function () {
    $('.enlarge').on('click', function () {
        $(this).toggleClass('clic-image');
    });

    /*-----------------------------------------------------------------------------------*/

    /*  /* Show trick media in small screen */

    /*-----------------------------------------------------------------------------------*/
    $("#loadMedia").on('click', function (e) {
        e.preventDefault();
        $("div.load-media").removeClass('d-none');
        $("#loadMedia").addClass('d-none');
        $("#hideMedia").removeClass('d-none');
    });
    $("#hideMedia").on('click', function (e) {
            e.preventDefault();
            $("div.load-media").addClass('d-none');
            $("#loadMedia").removeClass('d-none');
            $("#hideMedia").addClass('d-none');
        });

});