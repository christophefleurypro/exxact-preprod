export default {
    init: (app,gsap,ScrollMagic) => {
        /*
        |
        | Constants
        |------------
        */
        
        const controller  = new ScrollMagic.Controller(),
            $contactForm  = $('.contact-form'),
            $inputFile    = $contactForm.find('.label-custom')

        ;

        new ScrollMagic.Scene({
            'triggerElement': '#footer',
            'triggerHook'   : 1,
            'reverse': true
        })
        .on('enter', function(e){
            $('#detail-ctr').addClass('absolute');
        })
        .on('leave', function(e){
            $('#detail-ctr').removeClass('absolute');
        })
        .addTo(controller)
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






    }
}