import gsap from "gsap";
/*
|
| Class
|--------
|
*/
class Menu
{
    /*
    |
    | Constructor
    |--------------
    */
    constructor($menuWrapper, $menuButton, $menuButtonClose, params = {}) {
		this.bindMethods();

        this.menuWrapper  		= $menuWrapper;
		this.menuButton   		= $menuButton;
		this.menuButtonClose    = $menuButtonClose;
		this.menuTimeline 		= this.initTimeline();
		this.params 	  		= this.initParams(params);


	}

	/*
	|
	| bindMethods
	|--------------
	*/
	bindMethods(){
		this.handleComplete        = this.handleComplete.bind(this);
		this.handleReverseComplete = this.handleReverseComplete.bind(this);
	}

	
	
	/*
	|
	| initParams
	|--------------
	*/
	initParams(params){
		const { activeClass, reverseTimeScale } = params;

		return {
			'activeClass'     : this.isDefined(activeClass) 	 ? activeClass      : 'menu-active',
			'reverseTimeScale': this.isDefined(reverseTimeScale) ? reverseTimeScale : 1
		}
	}

	/*
	|
	| initTimeline
	|---------------
	*/
	initTimeline(){
		return gsap.timeline({ 
			paused: true,
			onComplete: this.handleComplete,
			onReverseComplete: this.handleReverseComplete
		})
	}

    /**
	|
	| Init
	|-------
    */
    init(){
        if (this.menuWrapperExist() && this.menuButtonExist()) {
			this.handleToggleMenu();
        }
	}
	
	/**
    |
    | handleToggleMenu
    |-------------------
    */
	handleToggleMenu(){
		const $menuButton      		= this.menuButton;
		const $menuButtonClose      = this.menuButtonClose;
		const menuTimeline     		= this.menuTimeline;
		const reverseTimeScale 		= this.params.reverseTimeScale;
		const $allItemClose			= this.menuWrapper.find('.item-link[href^="#"]'); 		


		$allItemClose.on('click', () => {            
            this.close();
        });

		$menuButton.on('click', () => {            
            this.open();
        });

        $menuButtonClose.on('click', () => {            
            this.close();
        });
	} 

	/**
	|
	| handleComplete
	|-----------------
	*/
	handleComplete(){
		this.dispachEvent(this.menuWrapper, 'menu:opened');
	}

	/**
	|
	| handleReverseComplete
	|------------------------
	*/
	handleReverseComplete(){
		this.dispachEvent(this.menuWrapper, 'menu:closed');
	}

    /**
	|
	| open
	|-------
	*/
    open(){
        this.menuTimeline.play().timeScale(1);
        this.dispachEvent(this.menuWrapper, 'menu:open');
    }

    /**
	|
	| close
	|-------
	*/
    close() {
        this.menuTimeline.reverse().timeScale(this.params.reverseTimeScale);
        this.dispachEvent(this.menuWrapper, 'menu:close');
    }

	/**
	|
	| menuIsActive
	|---------------
	*/
	menuIsActive(){
        return this.menuTimeline.totalProgress() !== 0;
	}

    /**
    |
    | menuWrapperExist
    |-------------------
    */
    menuWrapperExist(){
        return this.control(this.exist(this.menuWrapper), this.getMessage('menuWrapperExist'));
	}
	
	/**
    |
    | menuButtonExist
    |------------------
    */
   	menuButtonExist() {
        return this.control(this.exist(this.menuButton), this.getMessage('menuButtonExist'));
    }


    /**
	|
	| Helper: isDefined
	|--------------------
	|
	*/
	isDefined(item){
		return typeof item !== 'undefined';
	}


    /**
	|
	| Helper: exist
	|----------------
	*/
	exist($item){
		return $item.length;
	}

	
	/**
	|
	| Helper: control
	|------------------
	*/
	control(condition, message, selector = null){
		if(!condition){
			if(selector === null){
				console.error(message);
			} else {
				console.error(message, selector);
			}
		}

		return condition;
	}

	
	/**
	|
	| Helper: dispachEvent
	|-----------------------
	*/
	dispachEvent($element, eventName, datas = null){
		var event = $.Event(eventName);

		if(datas !== null){
			$.each(datas, function(key, value){
				event[key] = value
			});
		}

		$element.trigger(event);
	}

    /**
	|
	| Helper: getMessage
	|---------------------
	*/
	getMessage(messageKey, var1 = '', var2 = ''){
		var messages = {
			'menuWrapperExist': 'The menu wrapper (specified as 1st parameter) does not exist',
			'menuButtonExist' : 'The button menu (specified as 2nd parameter) does not exist',
		};

		return 'Menu: ' + messages[messageKey];
	}
}

export default Menu;