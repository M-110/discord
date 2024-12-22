import UserListProfilePopupView from "../views/popups/UserListProfilePopupView.js";
import EventsPopupView from "../views/popups/EventsPopupView.js";

export default class PopupController {
    constructor(userModel) {
        this.userModel = userModel;
        this.currentPopup = null;
        this.init();
    }

    init() {
        this.initEventListeners();
    }

    initEventListeners() {
        document.addEventListener("userListProfilePopup", event => {
            const userId = event.detail.userId;
            const userElement = event.detail.userElement;
            const userData = event.detail.userData;
            this.showUserProfilePopup(userId, userElement, userData);
        });
        document.addEventListener("eventsPopup", () => this.showEventsPopup());
    }

    showUserProfilePopup(userId, userElement, userData) {
        if (this.currentPopup) this.destroyPopup();
        this.currentPopup = new UserListProfilePopupView(userId, userElement, userData, () => this.destroyPopup());
        this.currentPopup.render();
    }

    showEventsPopup() {
        if (this.currentPopup) this.destroyPopup();
        this.currentPopup = new EventsPopupView(() => this.destroyPopup());
        this.currentPopup.render();
    }

    destroyPopup() {
        this.currentPopup.destroy();
        this.currentPopup = null;
    }
}