export default class MessageModel {
    constructor() {
    }

    sendMessage(channelId, userId, content) {
        console.log(`Sending message: ${content} from user ${userId}`)
        return $.ajax(
            {
                url: "api/messages.php",
                type: "POST",
                data: {
                    channelId: channelId,
                    userId: userId,
                    content: content
                },
                dataType: "json"
            }
        )
    }
}