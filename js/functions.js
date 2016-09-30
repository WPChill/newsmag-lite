jQuery(document).ready(function ($) {
    Newsmag.initOwlCarousel($);
    Newsmag.initNewsTicker($('.newsmag-news-carousel'));
    Newsmag.initGoToTop($);
    Newsmag.initLazyLoad($);
    Newsmag.initSearchForm($);
    Newsmag.initMainSlider($);
});


var Newsmag = {
    initMainSlider: function ($) {
        jQuery('.newsmag-slider').owlCarousel({
            loop: true,
            nav: true,
            items: 1,
            dots: true,
            mouseDrag: true,
            navText: [
                "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            navClass: ["main-slider-previous", "main-slider-next"],
            autoplay: true,
            autoplayTimeout: 17000,
            responsive: {
                1: {
                    nav: false,
                    dots: false
                },
                600: {
                    nav: false,
                    dots: false
                },
                991: {
                    nav: false,
                    dots: true

                },
                1300: {
                    nav: true,
                    dots: true
                }
            }
        })
        ;
    },
    initSearchForm: function ($) {
        $('#search-top-bar-submit').on('click', function (e) {
            e.preventDefault();
            $('#search-field-top-bar').toggleClass('opened');
        });
    },
    initLazyLoad: function ($) {
        $(".lazy").lazyload({
            effect: "fadeIn",
            skip_invisible: false
        });
        $("img.lazy").each(function () {
            $(this).attr("src", $(this).attr("data-original"));
            $(this).removeAttr("data-original");
        });
    },
    initGoToTop: function ($) {

        var offset = 300,
            offset_opacity = 1200,
            scroll_top_duration = 700,
            $back_to_top = $('#back-to-top');
        jQuery(window).scroll(function () {
            ( jQuery(this).scrollTop() > offset ) ? $back_to_top.addClass('back-to-top-is-visible') : $back_to_top.removeClass('back-to-top-is-visible back-to-top-fade-out');
            if (jQuery(this).scrollTop() > offset_opacity) {
                $back_to_top.addClass('back-to-top-fade-out');
            }
        });
        $back_to_top.on('click', function (event) {
            event.preventDefault();
            jQuery('body,html').animate({
                    scrollTop: 0
                }, scroll_top_duration
            );
        });
    },
    // News ticker carousel
    initNewsTicker: function (element) {
        element.owlCarousel({
                items: 1,
                autoplay: true,
                dots: false,
                autoplayTimeout: 5000,
                loop: true
            }
        );
    },
    // Owl Carousel - used to create carousels throughout the site
    // http://owlgraphic.com/owlcarousel/
    initOwlCarousel: function ($) {
        if (typeof $.fn.owlCarousel !== 'undefined') {

            $('.owlCarousel').each(function (index) {

                var sliderSelector = '#owlCarousel-' + $(this).data('slider-id'); // this is the slider selector
                var sliderItems = $(this).data('slider-items');
                var sliderSpeed = $(this).data('slider-speed');
                var sliderAutoPlay = $(this).data('slider-auto-play');
                var sliderSingleItem = $(this).data('slider-single-item');

                //conversion of 1 to true & 0 to false


                // auto play
                if (sliderAutoPlay == 0 || sliderAutoPlay == 'false') {
                    sliderAutoPlay = false;
                } else {
                    sliderAutoPlay = true;
                }
                // Custom Navigation events outside of the owlCarousel mark-up
                $(".newsmag-owl-next").on('click', function (event) {
                    event.preventDefault();
                    $(sliderSelector).trigger('next.owl.carousel');
                });
                $(".newsmag-owl-prev").on('click', function (event) {
                    event.preventDefault();
                    $(sliderSelector).trigger('prev.owl.carousel');
                });


                // instantiate the slider with all the options
                $(sliderSelector).owlCarousel({
                    items: sliderItems,
                    loop: false,
                    margin: 20,
                    autoplay: sliderAutoPlay,
                    dots: false,
                    autoplayTimeout: sliderSpeed * 10,
                    responsive: {
                        0: {
                            items: 1
                        },
                        768: {
                            items: sliderItems
                        }
                    }
                });

            });

        } // end
    }
};