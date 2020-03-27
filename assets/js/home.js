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
});