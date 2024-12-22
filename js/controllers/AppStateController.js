export default class AppStateController {
    /**
     * @param {AppStateModel} appStateModel
     * @param {ChannelController} channelController
     * @param {MessageController} messageController
     * @param {ServerController} serverController
     * @param {UserController} userController
     */
    constructor(appStateModel, channelController, messageController,
                serverController, userController) {
        this.appStateModel = appStateModel;
        this.channelController = channelController;
        this.messageController = messageController;
        this.serverController = serverController;
        this.userController = userController;

        this.init();
    }

    init() {
        this.initEventListeners();
    }

    initEventListeners() {
        document.addEventListener('fetchState', () => this.fetchState());
        document.addEventListener('channelSelected', () => this.clearState());
        document.addEventListener('channelSelected', () => this.fetchState());
        document.addEventListener('serverSelected', () => this.clearState());
        document.addEventListener('serverSelected', () => this.fetchState());
    }

    fetchState() {
        const serverId = this.serverController.serverModel.serverId;
        const channelId = this.channelController.channelModel.channelId;
        const userId = this.userController.userModel.userId;
        this.appStateModel.fetchState(serverId, channelId, userId)
            .done(response => {
                if (response) this.updateState(response.data)
            }).fail(error => console.error(error));
    }

    updateState(data) {
        this.channelController.updateChannels(data.channels, data.channelId);
        this.serverController.updateServers(data.servers);
        this.messageController.updateMessages(data.messages);
        this.userController.updateUsers(data.users);
        this.userController.updateUser(data.user);
    }

    clearState() {
        this.appStateModel.lastMessageId = 0;
        this.appStateModel.lastUpdate = 0;
    }
}