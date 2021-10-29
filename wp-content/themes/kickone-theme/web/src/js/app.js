/*
|
| Importing Libs 
|------------------
*/
import isotope from "isotope-layout";
import Collapse from 'bootstrap/js/dist/collapse.js';
require('@lib/iziModal/js/iziModal.js')($); //désolé
import Swiper from 'swiper/js/swiper.min';


import gsap from "gsap";
import CustomEase from "@lib/gsap-pro/CustomEase";
import SplitText from "@lib/gsap-pro/SplitText";
//import DrawSvg from "@lib/gsap-pro/DrawSVGPlugin";
import ScrollTo from "gsap/ScrollToPlugin";
import ScrollTrigger from "gsap/ScrollTrigger";


import ScrollMagic from 'scrollmagic';
import Scrollbar from 'smooth-scrollbar';

gsap.registerPlugin(ScrollTrigger);
gsap.registerPlugin(CustomEase);
gsap.registerPlugin(ScrollTo);
//gsap.registerPlugin(DrawSvg);


/*
|
| Importing Components
|-----------------------
*/
import mobileDetect from '@components/mobile-detect';
import Kira from '@components/kira.js';
import Menu from '@components/menu.js';

/*
|
| Importing Utils
|-------------------
*/
import Router from '@utils/router.js';

/*
|
| Importing App files
|----------------------
*/
import * as app from '@components/global.js';
import main from '@pages/page.js';
import animations from '@pages/animations.js';
import contact from '@pages/contact.js';
import home from '@pages/home.js';
import singeJob from '@pages/singleJob.js';
import region from '@pages/region.js';
import produit from '@pages/produit.js';


/*
|
| Routing
|----------
*/
const routes = new Router([
    {
        'file': animations,
        'dependencies': [app, gsap, ScrollTrigger, Menu, Kira, CustomEase]
    },
	{
		'file': main, 
		'dependencies': [app, gsap, Collapse ]
    },
    {
        'file': contact,
        'dependencies': [app, gsap, ScrollMagic],
        'resolve': '#page-contact'
    },
    {
        'file': produit,
        'dependencies': [app, gsap, Swiper, ScrollTrigger],
        'resolve': '#page-produit'
    },
    {
        'file': singeJob,
        'dependencies': [app,gsap, ScrollMagic, mobileDetect],
        'resolve': '#single-fond'
    },
    {
        'file': home,
        'dependencies': [app, gsap, Swiper, ScrollMagic],
        'resolve': '#page-home'
    },
    {
        'file': region,
        'dependencies': [app, gsap, Swiper, ScrollMagic],
        'resolve': '#page-region'
    }
]);

/*
|
| Run
|------
*/
(($) => { routes.load() })(jQuery);
