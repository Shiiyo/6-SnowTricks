import '../css/home.scss';

$(document).ready(function() {
    //Slow scrolling
        $('a[href*="#"]').click(function (event) {
            var target = $(this.hash);
            event.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 1000);
        });

    //Top arrow show in scroll
    if ($(document).width() > 1439)
    {
        $(window).scroll(function()
        {
            if ($(this).scrollTop() >= 100)
            {
                $('#top-arrow').fadeIn(200);
            }
            else
            {
                $('#top-arrow').fadeOut(200);
            }
        });
    }

    //Load more button
    $("#load-more-btn").on('click', function (event) {
        event.preventDefault();
        const url = this.href;
        var loadMoreValue = $("#load-more-value");
        const numberOfTricks = loadMoreValue.data('count-trick');


        $.post(
            url,
            {numberOfTricks: numberOfTricks},
            function (data) {
                $("#tricks-bloc").append(data);
                loadMoreValue.data('count-trick', numberOfTricks + 9).attr('data-count-trick', numberOfTricks + 9);
                if (loadMoreValue.data('count-trick') >= $('#nb-tricks').data('nb-tricks')){
                    $('#load-more-btn').hide();
                }
            }
        );
    });
});