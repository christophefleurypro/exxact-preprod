export default {
    init: (app, gsap, Swiper, ScrollTrigger) => {
        /*
        |
        | Constants
        |------------
        */

        /*
        |
        | Sections REGIONS
        |-----------------
        */
        var $slide_galery = $('.section-galery');
        if($slide_galery.length > 0){
           var mySwiper = new Swiper ($slide_galery.find('.swiper-container'), {
                slidesPerView: 1,
                slidesPerGroup: 1,
                speed: 1000,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                spaceBetween: 0,
                parallax: true,
                loop: false,
                simulateTouch: false,
                 pagination: {
                    el: $slide_galery.find('.swiper-pagination'),
                    type: 'bullets',
                },
                navigation: {
                    nextEl: $slide_galery.find('.swiper-button-next'),
                    prevEl: $slide_galery.find('.swiper-button-prev'),
                },
                on: {
                    progress: function(){
                    },
                    setTransition: function(speed) {
                       
                    }
                }
            });
        }



        /*
        |
        | Slider Contect
        |-----------------
        */
        var $slider_context = $('.section-context');
        if($slider_context.length > 0){

            var $slider = new Swiper ($slider_context.find('.swiper-container'), {
                slidesPerView: 1,
                slidesPerGroup: 1,
                spaceBetween: 0,
                loop: false,
                effect: 'fade',
                autoHeight:true,
                fadeEffect: {
                    crossFade: true
                },
                pagination: {
                    el: $slider_context.find('.swiper-pagination'),
                    type: 'bullets',
                },
                navigation: {
                    nextEl: $slider_context.find('.swiper-button-next'),
                    prevEl: $slider_context.find('.swiper-button-prev'),
                },
                breakpoints: {
                    692: {
                        autoHeight:false,
                    }
                }
            });
        }



        const $sections     = $('section[data-scroll-submenu]'),
            $nav            = $('.section-nav'),
            $allLinks       = $nav.find('.scroll-section')
        ;


        $sections.each(function(index){
            let $menuItem = $nav.find('a[href="#'+$(this).attr('id')+'"]');
            console.log($(this).find('.content-block').outerHeight(true));
            ScrollTrigger.create({
                trigger: $(this),
                start: '0 25%',
                markers: false,
                end: '+='+$(this).outerHeight(true),
                onEnter: (self) => {
                    console.log('onEnter');
                    $allLinks.removeClass('is-active');
                    $menuItem.addClass('is-active');
                },
                onEnterBack: (self) => {
                    console.log('onEnterBack');
                    $allLinks.removeClass('is-active');
                    $menuItem.addClass('is-active');
                }
            });
        });



    }
}