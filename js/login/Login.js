import LoginModel from "./LoginModel.js";

class Login {
    constructor() {
        this.userSection = $("#user-section");
        this.addSection = $("#add-section");
        this.userList = $("#user-login-list");
        this.errorMessage = $("#error");
        this.loginModel = new LoginModel();
        this.init();
    }

    init() {
        this.fetchUsers()
        this.initEventListeners();
    }

    fetchUsers() {
        this.loginModel.getUsers()
            .done(response => {
                if (response.success) this.loadUsers(response.data)
            }).fail(error => console.error(error));
    }

    createUser() {
        const usernameElement = $("#username")
        const displayNameElement = $("#display")
        const username = usernameElement.val()
        const displayName = displayNameElement.val()
        if (!username || !displayName) {
            this.errorMessage.text("Must have a username and display name");
            return;
        }
        this.loginModel.createUser(username, displayName)
            .done(response => {
                if (response.success) {
                    this.errorMessage.text("");
                    this.switchToUserSection();
                    this.fetchUsers();
                    usernameElement.val("");
                    displayNameElement.val("");
                } else {
                    this.errorMessage.text(response.message);
                }
            }).fail(error => this.errorMessage.text(error.message));
    }

    loadUsers(users) {
        this.userList.empty();
        users.forEach(user => {
            const userId = user.user_id;
            const displayName = user.user_display_name;
            const username = user.user_name;
            const avatar = user.user_avatar_url;
            const userItem = createUserElement(userId, displayName, username, avatar);
            this.userList.append(userItem);
        })

    }



    initEventListeners() {
        const addAccountButton = $("#add-account-button");
        const backButton = $("#back-button");
        addAccountButton.on('click', () => this.switchToAddSection());
        backButton.on('click', () => this.switchToUserSection());
        const createUserButton = $("#create-account");
        createUserButton.on('click', () => this.createUser());
    }

    switchToUserSection() {
        this.addSection.hide()
        this.userSection.show()
    }

    switchToAddSection() {
        this.userSection.hide()
        this.addSection.show()
    }
}

function createUserElement(userId, displayName, username, avatar) {
    const userItem = $(`
            <li class="user-login-item">
                <div class="user-login-avatar"><img src="${avatar}"></div>
                <div class="user-login-name">${displayName}</div>
                <button class="user-login-button">Log in</button>
                <button class="user-login-options">···</button>
            </li>
    `)
    userItem.find(".user-login-button").on('click', () => {
        openAppAsUser(userId);
    });
    return userItem;
}

function openAppAsUser(userId) {
    window.location.href = `app.php?userId=${userId}`;
}

const login = new Login();