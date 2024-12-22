import BasePopupView from "./BasePopupView.js";

export default class UserListProfilePopupView extends BasePopupView {
    constructor(userId, userElement, userData, onClose) {
        super();
        this.userId = userId;
        this.userElement = userElement;
        this.userData = userData;
        this.onClose = onClose;
    }

    render() {
        this.popupElement = createPopupElement(this.userData, this.userElement);
        this.mainElement.append(this.popupElement);
        this.addEventListener(document, 'click', (event) => {
            if (!this.popupElement.contains(event.target) && !this.userElement.contains(event.target))
                this.onClose();
        });
    }
}

function createPopupElement(userData, anchorElement) {
    const popupElement = document.createElement('div');
    const anchorElementRect = anchorElement.getBoundingClientRect();
    const dateCreated = new Date(userData.user_created_date * 1000).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });

    popupElement.classList.add('popup-profile');
    popupElement.style.top = `${anchorElementRect.top}px`;
    popupElement.innerHTML = `
        <div class="popup-profile-header">
            <div class="popup-profile-avatar">
                <img class="popup-profile-avatar-image" src="${userData.user_avatar_url}" alt="avatar">
                <div class="popup-profile-avatar-status online-status"></div>
            </div>
        </div>
        <div class="popup-profile-body">
            <div class="popup-profile-display-name">${userData.user_display_name}</div>
            <div class="popup-profile-user-name">${userData.user_name}</div>
            <div class="popup-profile-divider"></div>
            <div class="popup-profile-detail-header">MEMBER SINCE</div>
            <div class="popup-profile-detail-body">
                <div class="popup-profile-discord-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-discord" viewBox="0 0 16 16">
                      <path d="M13.545 2.907a13.227 13.227 0 0 0-3.257-1.011.05.05 0 0 0-.052.025c-.141.25-.297.577-.406.833a12.19 12.19 0 0 0-3.658 0 8.258 8.258 0 0 0-.412-.833.051.051 0 0 0-.052-.025c-1.125.194-2.22.534-3.257 1.011a.041.041 0 0 0-.021.018C.356 6.024-.213 9.047.066 12.032c.001.014.01.028.021.037a13.276 13.276 0 0 0 3.995 2.02.05.05 0 0 0 .056-.019c.308-.42.582-.863.818-1.329a.05.05 0 0 0-.01-.059.051.051 0 0 0-.018-.011 8.875 8.875 0 0 1-1.248-.595.05.05 0 0 1-.02-.066.051.051 0 0 1 .015-.019c.084-.063.168-.129.248-.195a.05.05 0 0 1 .051-.007c2.619 1.196 5.454 1.196 8.041 0a.052.052 0 0 1 .053.007c.08.066.164.132.248.195a.051.051 0 0 1-.004.085 8.254 8.254 0 0 1-1.249.594.05.05 0 0 0-.03.03.052.052 0 0 0 .003.041c.24.465.515.909.817 1.329a.05.05 0 0 0 .056.019 13.235 13.235 0 0 0 4.001-2.02.049.049 0 0 0 .021-.037c.334-3.451-.559-6.449-2.366-9.106a.034.034 0 0 0-.02-.019Zm-8.198 7.307c-.789 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.45.73 1.438 1.613 0 .888-.637 1.612-1.438 1.612m5.316 0c-.788 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.451.73 1.438 1.613 0 .888-.631 1.612-1.438 1.612"/>
                    </svg>
                </div>
                ${dateCreated}
            </div>
            <div class="popup-profile-detail-header">NO ROLES</div>
            <div class="popup-profile-detail-body popup-profile-plus">
                <div class="popup-profile-plus"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>
                </div>
            </div>
            <div class="popup-profile-detail-header">NOTE</div>
            <div class="popup-profile-detail-note">Some note</div>
        </div>
    `;
    return popupElement;
}

