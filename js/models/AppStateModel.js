export default class AppStateModel {
    constructor() {
        this.lastUpdate = 0;
        this.lastMessageId = 0;
        this.abortController = new AbortController();
        this.currentRequestId = 0;
    }

    fetchState(serverId, channelId, userId) {
        this.abortController.abort();
        this.abortController = new AbortController();
        this.currentRequestId++;
        const requestId = this.currentRequestId;

        return $.ajax(
            {
                url: "api/stateUpdate.php",
                type: "GET",
                data: {
                    serverId: serverId,
                    channelId: channelId,
                    userId: userId,
                    lastMessageId: this.lastMessageId,
                    lastUpdate: this.lastUpdate
                },
                dataType: "json",
                signal: this.abortController.signal
            }
        ).then(response => {
            if (requestId !== this.currentRequestId) return;
            const messages = response.data.messages;
            this.lastUpdate = response.data.currentTimestamp;
            if (messages.length > 0) {
                this.lastMessageId = messages[messages.length - 1].message_id;
            }
            return response;
        });

    }

}