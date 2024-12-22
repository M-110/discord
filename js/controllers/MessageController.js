export default class MessageController {
    /**
     *
     * @param {ChannelModel} channelModel
     * @param {MessageModel} messageModel
     * @param {UserModel} userModel
     * @param {MessageView} messageView
     */
    constructor(channelModel, messageModel, userModel, messageView) {
        this.channelModel = channelModel;
        this.messageModel = messageModel;
        this.userModel = userModel;
        this.messageView = messageView;
        this.init();
    }

    init() {
        this.initEventListeners();
    }

    initEventListeners() {
        document.addEventListener('sendMessage', event => {
            this.sendMessage(event.detail);
        });
        document.addEventListener('channelSelected', () => this.clearMessages());
        document.addEventListener('serverSelected', () => this.clearMessages());
    }

    sendMessage(message) {
        const content = message.trim();
        const userId = this.userModel.userId;
        const channelId = this.channelModel.channelId;
        if (content)
            this.messageModel.sendMessage(channelId, userId, content)
                .done(() => document.dispatchEvent(new CustomEvent('fetchState')))
                .fail(error => console.error(error));
    }

    updateMessages(messages) {
        if (messages.length === 0) return;
        this.messageView.updateMessages(messages);
    }

    clearMessages() {
        this.messageView.clearMessages();
    }
}