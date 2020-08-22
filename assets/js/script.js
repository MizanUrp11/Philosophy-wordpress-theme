(function ($) {
    $(document).ready(function () {
        $('#comment').addClass('full-width');

        $('nav.navigation').removeClass('navigation pagination').addClass('pgn');
        $('ul.page-numbers').unwrap();
        $('ul.page-numbers').removeAttr('class');
        $('li a.prev').removeClass('prev page-numbers pgn__num').addClass('pgn__prev');
        $('li a.page-numbers').removeClass('page-numbers').addClass('pgn__num');
        $('li a.next').removeClass('next pgn__num').addClass('pgn__next');


        $('li span.page-numbers').addClass('pgn__num');

        $('div.leaflet-control-attribution a').hide();



        var slider = tns({
            "autoWidth": true,
            "items": 1,
            "gutter": 10,
            "mouseDrag": true,
            "swipeAngle": false,
            "container": ".my-slider",
            "speed": 400,
            "controls": false,
            "nav": false,
        });


    });
})(jQuery);