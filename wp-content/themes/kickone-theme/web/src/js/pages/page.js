export default {
	init: (app, gsap,  Collapse) => {
		/*
		|
		| Constants
		|-----------
		*/
        const 
            $body         = $('body')
		;


        console.log(Collapse);
        
    

        /*
        |
        |  Scroll Section
        |-----------------
        |*/
        var $linkbottom = $(".scroll-section");
        $linkbottom.on('click',function(e){
            e.preventDefault();
            let $section = $($(this).attr('href'));
            var _offset = $section.data('offset-top') ? $section.data('offset-top') : 60;
            var elemPos = $section.offset().top - _offset;
            gsap.to(window, 0.8, {scrollTo:elemPos,  ease: "Power1.easeOut" });
        });


        $body.on('loaderEnd', () => console.log('exxact-ready'))



       
	}
}