function main() {
    getMessages();
    setInterval(getMessages, 2000);
    $("#chat").scrollTop($("#chat")[0].scrollHeight);
    const input = document.getElementById("message");
    input.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        sendMessage();
  }
});
}

/**
 * Sends request to server for all messages and then displays them.
 */
function getMessages() {
    $.ajax({
        url: "messages.php",
        type: "GET",
        data: {
            lastId: getMostRecentMessageId()
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response["success"])
            {
                displayMessages(response["data"]);
            }
        },
    })  
}

/**
 * Sends request to server to add a message based on the user's input.
 */
function sendMessage() {
    $.ajax({
        url: "messages.php",
        type: "POST",
        data: {
            lastId: getMostRecentMessageId(),
            message: $("#message").val(),
            userId: $("#userId").val(),
        },
        success: function (response) {
            console.log(response);
            if (response["success"])
            {
                displayMessages(response["data"]);
                $("#chat").scrollTop($("#chat")[0].scrollHeight);
            }
        },
    })
}

/**
 * Displays the messages in the chat window.
 * @param {string} messages
 */
function displayMessages(messages) {
    for (let i = 0; i < messages.length; i++) {
        $("#chat").append(`<p id="message${messages[i].MESSAGE_ID}"> ${messages[i].USER_NAME}: ${messages[i].MESSAGE_CONTENT} </p>`);
    }
}
/**
 * Returns most recent message id.
 * @returns {string} Id of the most recent message.
 */
function getMostRecentMessageId() {
    const lastMessageId = $("p").last().attr("id") ?? "0";
    return lastMessageId.replace("message", "");
}

document.addEventListener("DOMContentLoaded", main);
