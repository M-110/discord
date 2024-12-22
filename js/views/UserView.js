export default class UserView {
    constructor() {
        this.users = {'online': {}, 'offline': {}};
        this.userData = {};
        this.userBox = $('#user-box');
        this.userListElement = $('#chat-users');
        this.shouldUpdateCount = false;

        this.init();
    }

    init() {
        this.initEventListeners();
    }

    initEventListeners() {
        this.userListElement.on('click', '.chat-users-group-item', event => {
            const element = $(event.currentTarget);
            const userId = element.data('user-id');
            const userData = this.userData[userId];
            document.dispatchEvent(new CustomEvent('userListProfilePopup', {
                detail: {
                    userId: userId,
                    userData: userData,
                    userElement: element[0]
                }
            }));
        });
    }

    updateUserPanel(user) {
        this.userBox.html(generateUserPanelInnerHTML(user));
    }

    updateUsers(users) {
        // reverse users
        users.forEach(user => {
            this.updateUserData(user);
            const previousStatus = this.getPreviousUserStatus(user.user_id);
            if (previousStatus !== null)
                this.updateUserElement(user, previousStatus);
            else
                this.addUserElement(user);
        });
        if (this.shouldUpdateCount) {
            this.updateUserCount();
            this.shouldUpdateCount = false;
        }
    }

    updateUserData(user) {
        this.userData[user.user_id] = user;
    }

    getPreviousUserStatus(user_id) {
        if (this.users['online'][user_id])
            return 'online';
        if (this.users['offline'][user_id])
            return 'offline';
        return null;
    }

    /**
     * Updates current user element and moves it to the correct position.
     *
     * @param user
     * @param previousStatus
     */
    updateUserElement(user, previousStatus) {
        const currentStatus = user.is_online ? 'online' : 'offline';
        const userElement = this.users[previousStatus][user.user_id];
        userElement.innerHTML = generateUserItemInnerHTML(user);
        if (currentStatus !== previousStatus) {
            delete this.users[previousStatus][user.user_id];
            this.placeUserElement(user.user_id, userElement, currentStatus);
            this.users[currentStatus][user.user_id] = userElement;
            this.shouldUpdateCount = true;
        }
    }

    /**
     * Creates new user element and places it in the correct position.
     *
     * @param user
     */
    addUserElement(user) {
        const userId = user.user_id;
        const userElement = createUserItem(user);
        const status = user.is_online ? 'online' : 'offline';
        this.placeUserElement(userId, userElement, status);
        this.users[status][userId] = userElement;
        this.shouldUpdateCount = true;
    }


    placeUserElement(newUserId, newUserElement, status) {
        if (this.users[status].length !== 0)
            for (const [userId, userElement] of Object.entries(this.users[status])) {
                if (newUserId < userId) {
                    userElement.before(newUserElement);
                    return;
                }
            }
        const userList = $(`#${status}-users-list`);
        userList.append(newUserElement);
    }

    updateUserCount() {
        const onlineCount = Object.keys(this.users['online']).length;
        const offlineCount = Object.keys(this.users['offline']).length;
        const onlineCountElement = $('#online-users-count');
        const offlineCountElement = $('#offline-users-count');
        onlineCountElement.text(`${onlineCount}`);
        offlineCountElement.text(`${offlineCount}`);
    }
}

function createUserItem(user) {
    const userElement = document.createElement('li');
    userElement.classList.add('chat-users-group-item');
    userElement.setAttribute('data-user-id', user.user_id);
    userElement.innerHTML = generateUserItemInnerHTML(user)
    return userElement;
}

function generateUserItemInnerHTML(user) {
    const status = user.user_status !== null ? user.user_status : '';
    const onlineStatus = user.is_online ? 'online-status' : 'offline-status';
    const offlineUser = user.is_online ? '' : 'offline-user';
    return `
            <div class="user-container ${offlineUser}">
                <div class="user-avatar">
                    <div class="user-avatar-image"><img src="${user.user_avatar_url}" alt="avatar"></div>
                    <div class="user-avatar-status ${onlineStatus}"></div>
                </div>
                <div class="users-name-container">
                    <div class="users-user-name">
                        <div class="users-user-name-tag">${user.user_display_name}</div>
                        <div class="users-user-name-icon"></div>
                    </div>
                    <div class="users-user-status">${status}</div>
                </div>
            </div>`;
}

function generateUserPanelInnerHTML(user) {
    return `<div class="user-avatar">
                <div class="user-avatar-image"><img src="${user.user_avatar_url}" alt="avatar"></div>
                <div class="user-avatar-status online-status"></div>
            </div>
            <div class="user-box-info">
                <div class="user-box-info-name">${user.user_display_name}</div>
                <div class="user-box-info-dynamic">
                    <div class="user-box-info-dynamic-item">Online</div>
                    <div class="user-box-info-dynamic-item">${user.user_name}</div>
                </div>
            </div>`
}