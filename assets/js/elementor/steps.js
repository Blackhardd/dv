class Steps extends elementorModules.frontend.handlers.Base {
    getDefaultSettings(){
        return {
            selectors: {
                steps: '.steps__slider'
            }
        }
    }

    getDefaultElements(){
        const selectors = this.getSettings('selectors');

        return {
            $steps: this.$element.find(selectors.steps)
        }
    }

    bindEvents(){
        jQuery(document).ready(this.initSlider.bind(this));
    }

    initSlider(){
        if(window.matchMedia('(min-width: 768px)').matches){
            let glider = new Glider(this.elements.$steps[0], {
                slidesToShow: 2.5,
                slidesToScroll: 2.5,
                draggable: true,
                duration: 0.1,
                dragVelocity: 1
            });
        }
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(Steps, {
            $element,
        });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/dv_steps.default', addHandler);
});