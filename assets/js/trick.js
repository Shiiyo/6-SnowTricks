import '../css/trick.scss';

$(document).ready(function () {

    //Enlarge picture
    $('.enlarge').on('click', function () {
        $(this).toggleClass('clic-image');
    });

    // Show trick media in small screen
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

    //Load more button
    $("#load-more-btn").on('click', function (event) {
        event.preventDefault();
        const url = this.href;
        var loadMoreValue = $("#load-more-value");
        const trickId = $("#trick-id").data('trick-id');
        const numberOfComments = loadMoreValue.data('count-comment');

        $.post(
            url,
            {
                numberOfComments: numberOfComments,
                trickId: trickId
            },
            function (data) {
                $("#commentBloc").append(data);
                loadMoreValue.data('count-comment', numberOfComments + 3).attr('data-count-comment', numberOfComments + 3);
                if (loadMoreValue.data('count-comment') >= $('#nb-comments').data('nb-comments')){
                    $('#load-more-btn').hide();
                }
            }
        );
    });
});