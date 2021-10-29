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
        | Sections REGIONS
        |-----------------
        */
        var $regions = $('.section-regions');
        if($regions.length > 0){

            var _triggerElement  = $regions.attr('id'),
                _current_slide   = 0,
                $slider_regions  = $regions.find('.slider-region'),
                $blockRegion     = $regions.find('.item-region')
            ;
           
            var sceneMenu     = new ScrollMagic.Scene({
                'triggerElement': '#' + _triggerElement,
                'triggerHook'   : 0,
                'duration': $regions.outerHeight() - $slider_regions.outerHeight() - 50,
                'reverse': true
            })
            .setPin("#slider-region")
            .addTo(controller)
            ;


            var interleaveOffset = 0.5;

            var mySwiper = new Swiper ($slider_regions.find('.swiper-container'), {
                slidesPerView: 1,
                slidesPerGroup: 1,
                speed: 1000,
                spaceBetween: 0,
                parallax: true,
                initialSlide: _current_slide,
                loop: false,
                simulateTouch: false,
                scrollbar: {
                    el: '.swiper-scrollbar'
                },
                on: {
                    progress: function(){
                      let swiper = this;
                      for (let i = 0; i < swiper.slides.length; i++) {
                        let slideProgress = swiper.slides[i].progress,
                            innerOffset = swiper.width * interleaveOffset,
                            innerTranslate = slideProgress * innerOffset;
                       
                            swiper.slides[i].querySelector(".exxact-image--region").style.transform = "translateX(" + innerTranslate + "px)";
                      }
                    },
                    setTransition: function(speed) {
                        let swiper = this;
                        for (let i = 0; i < swiper.slides.length; i++) {
                            swiper.slides[i].style.transition = speed + "ms";
                            swiper.slides[i].querySelector(".exxact-image--region").style.transition = speed + "ms";
                        }
                    }
                }
            });



            $blockRegion.each(function(index) {
                var $block      = $(this),
                    _imgIndex   = $block.data('change-slide') ? $block.data('change-slide') : false
                ;

                let timeline  = new gsap.timeline({ 
                    onComplete: function(){
                    } 
                });
                timeline.fromTo($block.find('.region-block-content p'), 1,
                    { y: 30, autoAlpha: 0.2}, 
                    { y: 0, autoAlpha: 1, ease: "Power1.easeOut" });

                let scrool = new ScrollMagic.Scene({
                    'triggerElement': this,
                    'triggerHook'   : 0.6,
                    'reverse': true
                })
                .addTo(controller)
                .setTween(timeline)
                .on('enter', function(e){
                    if (_imgIndex != false && _imgIndex != 0 ) {
                        mySwiper.slideNext();
                    }

                })
                .on('leave', function(e){
                    if (_imgIndex != false && _imgIndex != 0 ) {
                        mySwiper.slidePrev();
                    }
                })
                ;
            });

        }







    }
}