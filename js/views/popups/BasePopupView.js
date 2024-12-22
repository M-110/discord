export default class BasePopupView {
    constructor() {
        this.popupElement = null;
        this.eventListeners = [];
        this.mainElement = $('main');
    }

    addEventListener(element, event, handler) {
        element.addEventListener(event, handler);
        this.eventListeners.push({element, event, handler});
    }

    render() {
    }

    show() {
        this.popupElement.style.display = 'visible';
    }

    hide() {
        this.popupElement.style.display = 'none';
    }

    destroy() {
        this.eventListeners.forEach(({element, event, handler}) => {
            element.removeEventListener(event, handler);
        });
        this.eventListeners = [];
        this.popupElement.remove()
        this.popupElement = null;
    }

}