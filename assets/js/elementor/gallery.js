class Gallery extends elementorModules.frontend.handlers.Base {
    getDefaultSettings(){
        return {
            selectors: {
                gallery: ''
            }
        }
    }

    getDefaultElements(){
        const selectors = this.getSettings('selectors');

        return {
            $steps: this.$element.find(selectors.gallery)
        }
    }

    bindEvents(){

    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(Gallery, {
            $element,
        });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/dv_gallery.default', addHandler);
});