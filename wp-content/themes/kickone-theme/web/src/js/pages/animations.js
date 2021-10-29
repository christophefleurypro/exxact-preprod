export default {
	init: (app, gsap, ScrollTrigger, Menu, Kira, CustomEase ) => {
		/*
		|
		| Constants
		|-----------
		*/
        const 
            $body             = $('body'),
            $pageLoader       = $('.page-loader'),
            scrollAreas       = document.querySelectorAll('.scroll-area'),
            $splitItems       = $body.find('[data-splittext]'),
            $menuWrapper      = $('#mobile-menu'),
            $menuButtonClose  = $menuWrapper.find('.btn-menu'),
            $menuBarsClose         = $menuButtonClose.find('.item-burger > span'),
            $header           = $('#header'),
            $menuButton       = $('#header .btn-menu'),
            $menuBars         = $menuButton.find('.item-burger > span'),
            $menuClose        = $menuWrapper.find('.item-close'),
            $menuStaggerItems = $menuWrapper.find('[data-stagger-item]')
        ;
        



        /*
        |
        | Easings
        |----------
        */
        CustomEase.create("easeCustom", "M0,0 C0.4,0 0.2,1 1,1");
        CustomEase.create("easeSmooth", "M0,0 C0.19,1 0.22,1 1,1") ;
        CustomEase.create("easeCustomPower1", "M0,0 C0.165,0.84 0.44,1 1,1") ;
        CustomEase.create("easeExpo", "M0, 0 C1, 0 0, 1 1, 1");
     
          /*
        |
        | SplitText
        |------------
        */
        $.each($splitItems, function() {
            const $item = $(this);
            const type = $item.data('splittext') ? $item.data('splittext') : 'lines, words, chars';
            const split = new SplitText($item, { type: type, linesClass: 'item-line', wordsClass: 'item-word', charsClass: 'item-char' });

            $item[0]['split'] = split;
        });

        $body.on('dom:ready', () => {
            $splitItems.addClass('split-ready')
        } )
		

		/*
        |
        | Scroll Areas
        |---------------
        */
		Array.prototype.forEach.call(scrollAreas, element => {
			Scrollbar.init(element);
		});


        /*
        |
        | Loader
        |---------
        */
        if (sessionStorage.getItem('loaded_once') === null) {
            sessionStorage.setItem('loaded_once', 'loaded_once');
        } 
        
        if ($pageLoader.hasClass('active')){
            const loaderTl = gsap.timeline({ paused: true, /*onComplete: () => $pageLoader.remove()*/ });

            loaderTl.to($pageLoader.find('.item-loadbar-inner'), 0.4, { scaleX: 1, ease: 'Power0.easeNone' }, 'start')
            loaderTl.to($pageLoader.find('.item-content'), 0.8, { autoAlpha: 0, ease: 'Power1.easeOut' }, '-=0')
            loaderTl.call(() => { app.dispachEvent($body, 'dom:ready'); }, null)
            loaderTl.to($pageLoader, 0.8, { autoAlpha: 0, ease: 'Power1.easeOut' }, '-=0')

            $(window).on('load', function () {
                loaderTl.play();

            });
        } else {
            $(window).on('load', function(){
                app.dispachEvent($body, 'dom:ready');
            })
            
        }


        /*
		|
		| Menu
		|-------
        */
        const menu = new Menu($menuWrapper, $menuButton , $menuButtonClose, {
            reverseTimeScale: 2
        });

        menu.menuTimeline
            .to([$menuBarsClose.eq(1)], 0.3, { autoAlpha: 0 }, 'start+=0.2')
			.to([$menuBarsClose.eq(0)], 0.5, { x: 0, y: 8, rotation: 45, ease: "easeCustomPower1" }, 'start+=0.2')
            .to([$menuBarsClose.eq(2)], 0.5, { x: 0, y: -8, rotation: -45, ease: "easeCustomPower1" }, 'start+=0.2')
            .fromTo($menuWrapper, 0.1, { autoAlpha: 0 },{ autoAlpha: 1, ease: "easeCustomPower1" }, 'start+=0.3')
            .fromTo($menuWrapper.find('.bg-skew'), 0.5, { x:"100%", skewX: -33},{ x:"0%", skewX: 0, ease: "easeCustomPower1" }, 'start+=0.3')
			.fromTo($menuWrapper.find('.bg-svg'), 0.8,  { x:"-100%", autoAlpha: 0 },{ x:"0%",autoAlpha: 1,  ease: "easeCustomPower1" }, 'start+=0.6')
            .staggerFrom($menuStaggerItems, 0.6, { autoAlpha: 0, x: 20, ease: "easeCustomPower1" }, '0.1', '+=0')
        
        menu.init();

        /*
        |
        | Header on Scroll
        |
        */
        const showAnim = gsap.from($header, {
            yPercent: -100,
            duration: 0.3,
            ease: "power1.out",
            onStart: (self) => {
                //$header.addClass('is-scroll');
            },
            onReverseComplete: (self) => {
                //$header.removeClass('is-scroll');
            }
        });

        /*
         ScrollTrigger.create({
            start: 'top -50',
            end: 99999,
            onUpdate: (self) => {
                self.direction === -1 ? showAnim.play() : showAnim.reverse()
            },
        });
        */
        
       // window.location.hash ? showAnim.progress(0) : showAnim.progress(1);

        ScrollTrigger.matchMedia({
            "(min-width: 992px)": function () {
                ScrollTrigger.create({
                    start: 'top -100',
                    end: 99999,
                    onEnter: (self) => {
                        console.log('100 - onEnter');
                        $header.addClass('style2');
                        showAnim.pause(0);
                    },
                    onLeaveBack: (self) =>{
                        console.log('100 - onLeaveBack');
                        $header.removeClass('style2');
                        showAnim.play();
                    }
                });
                ScrollTrigger.create({
                    start: 'top -200',
                    end: 99999,
                    toggleClass: { className: 'is-scroll', targets: $header },
                    onEnter: (self) => {
                        console.log('200 - onEnter');
                        showAnim.play();
                    },
                    onLeaveBack: (self) =>{
                        console.log('200 - onLeaveBack');
                        showAnim.reverse();
                    }
                });
            },
            "(max-width: 991px)": function () {
                showAnim.play()
            }
        });


        /*
		|
		| Kira
		|-------
        */
       const kira = new Kira({            
            loadEvent: [$body, 'dom:ready'],
            scrollTrigger: {
                markers: false,
                //scroller: scrollContainerSelector,
            },
            tweenParams: {
                start: '-=0.6'
            }
        });

        var $parallax = $('[data-img-parallax]');
        $.each($parallax, function(){
            let $img = $(this);
            let maxValue = parseInt(getComputedStyle($img[0]).getPropertyValue('--overflow'), 10);

            let timeline  = new TimelineMax();
            timeline.fromTo($img, 0.1,
                    {y: '-' + maxValue },
                    {y: maxValue , ease: Linear.easeNone }, 0
            );
            
            new ScrollMagic.Scene({
                triggerElement: this , 
                triggerHook: 1,
                duration: "200%"
            })
            //.addIndicators()
            .setTween(timeline)
            .addTo(controller);

        });

        /*
        | fadeInUp
        |-----------
        */
        kira.add('fadeInUp', ($item, timeline, start) => {
            timeline.fromTo($item, 1.3, { y: 50 }, { y: 0, autoAlpha: 1, ease: 'easeCustomPower1' }, start)
        });
        kira.add('fadeInUp.parallax.xs', ($item, timeline, start) => {
            timeline.fromTo($item, 0.6, { y: 40 }, { y: 0, autoAlpha: 1, ease: "easeCustomPower1" }, start)
        });
        kira.add('fadeInUp.parallax', ($item, timeline, start) => {
            timeline.fromTo($item, 0.8, { y: 100 }, { y: 0, autoAlpha: 1, ease: "easeCustomPower1" }, start)
        });
        kira.add('fadeInLeft.stagger.sm', ($item, timeline, start) => {
            timeline.fromTo($item, 0.6, {x: -50}, { autoAlpha: 1, x: 0, ease: "easeCustomPower1" }, '0.1', start)
        });
        kira.add('fadeInUp.stagger.sm', ($item, timeline, start) => {
            timeline.staggerFromTo($item.querySelectorAll('[data-stagger-item]'), 0.6, {y: 50}, { autoAlpha: 1, y: 0, ease: "easeCustomPower1" }, '0.1', start)
        });
        kira.add('fadeInUp.stagger.xs', ($item, timeline, start) => {
            timeline.staggerFromTo($item.querySelectorAll('[data-stagger-item]'), 0.6, {y: 20}, { autoAlpha: 1, y: 0, ease: "easeCustomPower1" }, '0.1', start)
        });
        kira.add('fadeInDown.stagger.sm', ($item, timeline, start) => {
            timeline.staggerFromTo($item.querySelectorAll('[data-stagger-item]'), 0.6, {y: -50}, { autoAlpha: 1, y: 0, ease: "easeCustomPower1" }, '0.1', start)
        });
        
        /*
		| fadeInUp.parallax
		|--------------------
        */
        kira.add('scaleX', ($item, timeline, start) => {
            timeline.from($item, 1, { scaleX: 0, transformOrigin: 'left top', ease: "easeCustomPower1" }, start)
        });

        kira.init();
	}
}