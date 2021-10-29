export default {
    init: (app,gsap, ScrollMagic, mobileDetect) => {


        /*
        |
        | Constants
        |------------
        */

        const controller  = new ScrollMagic.Controller(),
            $jobForm = $('.job-form'),
            $inputFile  =$jobForm.find('.label-custom')
        ;

           $inputFile.each(function(index){
            var $parent = $(this),
                $input  = $(this).find('input[type=file]'),
                $content = $(this).find('.content')
            ;
            $input.on('change',function(event){
                if ($parent.find('.wpcf7-not-valid-tip')) {
                    $parent.find('.wpcf7-not-valid-tip').remove();
                }
                var files = event.target.files;
                var filename = files[0].name;
                $content.html(filename);
            });
        });

        var _mobil = new mobileDetect(),
            _width = $(window).width();

        if (_mobil.isMobile() == null && _width >= 992) {

            var $contentJob  = $('#content-job'),
                $resumJob    = $('#block-resume'),
                $btnScroll   = $resumJob.find('.btn'),
                $formJob     = $('#postuler')
            ;

            var scene = new ScrollMagic.Scene({
                'triggerElement': '#content-job',
                'triggerHook'   : 0.25,
                'duration': $contentJob.outerHeight() - $formJob.outerHeight() ,
                'reverse': true
            })
            .setPin("#block-resume")
            .addTo(controller)
            //.addIndicators()
            ;

            var scene2 = new ScrollMagic.Scene({
                'triggerElement': '#postuler',
                'triggerHook'   : 0.5,
                'reverse': true
            })
            .on('enter', function(e){
                gsap.to($btnScroll,0.2,{autoAlpha:0, y: 30,ease: "Power1.easeOut" });
            })
            .on('leave', function(e){
                gsap.to($btnScroll,0.2,{autoAlpha:1, y: 0,ease: "Power1.easeOut" });
            })
            .addTo(controller)
            ;

        }




    }
}