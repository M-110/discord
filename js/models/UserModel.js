export default class UserModel {
    constructor(userId) {
        this.userId = userId;
    }

    fetchUserProfile(userId) {
        return $.ajax({
            url: "api/user.php",
            type: "GET",
            data: {
                userId: userId
            },
            dataType: "json"
        });
    }
}