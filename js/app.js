import AppStateModel from "./models/AppStateModel.js";
import ChannelModel from "./models/ChannelModel.js";
import MessageModel from "./models/MessageModel.js";
import ServerModel from "./models/ServerModel.js";
import UserModel from "./models/UserModel.js";

import AppStateController from "./controllers/AppStateController.js";
import ChannelController from "./controllers/ChannelController.js";
import MessageController from './controllers/MessageController.js';
import PopupController from "./controllers/PopupController.js";
import ServerController from "./controllers/ServerController.js";
import UserController from "./controllers/UserController.js";

import ChannelView from "./views/ChannelView.js";
import MessageView from "./views/MessageView.js";
import ServerView from "./views/ServerView.js";
import UserView from "./views/UserView.js";

class App {
    constructor() {
        const urlParams = new URLSearchParams(window.location.search);
        const userId = urlParams.get('userId') || 1;

        this.appStateModel = new AppStateModel();
        this.channelModel = new ChannelModel(1);
        this.messageModel = new MessageModel();
        this.serverModel = new ServerModel(1);
        this.userModel = new UserModel(userId);

        this.channelView = new ChannelView();
        this.messageView = new MessageView();
        this.serverView = new ServerView();
        this.userView = new UserView();

        this.channelController = new ChannelController(this.channelModel, this.channelView);
        this.messageController = new MessageController(this.channelModel, this.messageModel,
            this.userModel, this.messageView);
        this.serverController = new ServerController(this.serverModel, this.serverView);
        this.userController = new UserController(this.userModel, this.userView);
        this.appStateController = new AppStateController(
            this.appStateModel, this.channelController, this.messageController, this.serverController, this.userController);
        this.popupController = new PopupController(this.userModel);


        this.pollingInterval = 5000;
        this.init();
    }

    init() {
        this.initEventListeners();
        this.initPolling();
    }

    initEventListeners() {
        $("#message-input").on('keypress', event => {
            if (event.key !== 'Enter')
                return;
            const messageInput = event.target;
            this.messageController.sendMessage(messageInput.value);
            messageInput.value = '';

        });
    }

    initPolling() {
        this.appStateController.fetchState();
        setInterval(() => {
            this.appStateController.fetchState();
        }, this.pollingInterval);
    }
}

const app = new App();