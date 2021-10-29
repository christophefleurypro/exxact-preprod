export default {
    init: (app, gsap, Swiper, ScrollMagic) => {
        /*
        |
        | Constants
        |------------
        */
        const controller  = new ScrollMagic.Controller();



         /*
        |
        | Slider TEAM
        |-----------------
        */
        var $slider_Team = $('.slider-team');
        if($slider_Team.length > 0){

            var $slider = new Swiper ($slider_Team.find('.swiper-container'), {
                slidesPerView: 1,
                slidesPerGroup: 1,
                speed: 1000,
                spaceBetween: 15,
                loop: false,
                effect: 'slide',
                navigation: {
                    nextEl: $slider_Team.find('.swiper-button-next'),
                    prevEl: $slider_Team.find('.swiper-button-prev'),
                },
                breakpoints: {
                    692: {
                        slidesPerView: 2,
                        slidesPerGroup: 1
                    },
                    998: {
                        slidesPerView: 4,
                        slidesPerGroup: 1
                    }
                }
              });
        }


         /*
        |
        | Slider Produot
        |-----------------
        */
        var $slider_Produit = $('.slider-product');
        if($slider_Produit.length > 0){

            var $slider = new Swiper ($slider_Produit.find('.swiper-container'), {
                slidesPerView: 1,
                slidesPerGroup: 1,
                speed: 1000,
                spaceBetween: 30,
                loop: false,
                effect: 'slide',
                navigation: {
                    nextEl: $slider_Produit.find('.swiper-button-next'),
                    prevEl: $slider_Produit.find('.swiper-button-prev'),
                },
                breakpoints: {
                    692: {
                        slidesPerView: 2,
                        slidesPerGroup: 1
                    }
                }
              });
        }


        $('.iziModal').iziModal({
            padding: '60px 100px 80px 100px',
            width: "70%",
            group: 'expertise',
            transitionIn: 'comingIn',
            transitionOut: 'comingOut',
            transitionInOverlay: 'fadeIn',
            transitionOutOverlay: 'fadeOut',
            arrowKeys: false,
            navigateCaption: false,
            navigateArrows: false,
            zindex: 999999,
            onOpening: function(e){
                $('.card-expertise[data-izimodal-open="#'+e.id+'"]').addClass('active');
                let _index = $('.card-expertise[data-izimodal-open="#'+e.id+'"]').parent().index();
                $slider.slideTo(_index);
            },
            onClosing: function(e){
                $('.card-expertise[data-izimodal-open="#'+e.id+'"]').removeClass('active');
                let _index = $('.card-expertise[data-izimodal-open="#'+e.id+'"]').parent().index();
                $slider.slideTo(_index);
            }
          
        });

         /*
        |
        | Slider Solution
        |-----------------
        */
        var $slider_mission = $('.slider-missions');
        if($slider_mission.length > 0){

            var $slider = new Swiper ($slider_mission.find('.swiper-container'), {
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
                    el: $slider_mission.find('.swiper-pagination'),
                    type: 'bullets',
                },
                navigation: {
                    nextEl: $slider_mission.find('.swiper-button-next'),
                    prevEl: $slider_mission.find('.swiper-button-prev'),
                },
                breakpoints: {
                    692: {
                        autoHeight:false,
                    }
                }
            });
        }

        /*
        |
        | Slider Expertise
        |-----------------
        */
        var $slider_expertise = $('.slider-expertise');
        if($slider_expertise.length > 0){

            var $slider = new Swiper ($slider_expertise.find('.swiper-container'), {
                slidesPerView: 1,
                slidesPerGroup: 1,
                spaceBetween: 30,
                loop: false,
                pagination: {
                    el: $slider_expertise.find('.swiper-pagination'),
                    type: 'bullets',
                }
            });
        }




        /*
        |
        | subMenu
        |-----------------
        */
        var $header = $('#header'),
            $itemSection = $header.find('.header-principal .item-ul .menu-item .scroll-section')
        ;


        $itemSection.each(function(e){

            var $self    = $(this),
                $section = $( $self.data('id'))
            ; 
            var  _section   = new ScrollMagic.Scene({
                'triggerElement': $self.data('id'),
                'triggerHook'   : 0.2,
                'duration': $section.outerHeight(),
                'reverse': true
            })
            .on('enter', function(e){
                $self.parent().addClass('active');
            })
            .on('leave', function(e){
                $self.parent().removeClass('active');
            })
            .addTo(controller)
            ;
        });












    }
}