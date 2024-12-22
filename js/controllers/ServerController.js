export default class ServerController {
    /**
     *
     * @param {ServerModel} serverModel
     * @param {ServerView} serverView
     */
    constructor(serverModel, serverView) {
        this.serverModel = serverModel;
        this.serverView = serverView;

        this.init();
    }

    init() {
        this.initEventListeners();
    }

    initEventListeners() {
        document.addEventListener('serverSelected', (event) => this.changeServer(event.detail));
    }

    updateServers(servers) {
        if (servers && servers.length > 0)
            this.serverView.updateServers(servers, this.serverModel.serverId);
    }

    changeServer(serverId) {
        this.serverModel.serverId = serverId;
    }
}