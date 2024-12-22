export default class UserController {
    /**
     * @param {UserModel} userModel
     * @param {UserView} userView
     */
    constructor(userModel, userView) {
        this.userModel = userModel;
        this.userView = userView;
    }

    updateUsers(users) {
        this.userView.updateUsers(users);
    }

    updateUser(user) {
        if (user !== null)
            this.userView.updateUserPanel(user);
    }
}