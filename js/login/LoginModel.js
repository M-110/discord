export default class LoginModel {
    getUsers() {
        return $.ajax(
            {
                url: "api/users.php",
                type: "GET",
                dataType: "json"
            }
        );
    }

    createUser(username, displayName) {
        return $.ajax(
            {
                url: "api/createUser.php",
                type: "POST",
                data: {
                    username: username,
                    displayName: displayName
                },
                dataType: "json"
            }
        );
    }
}