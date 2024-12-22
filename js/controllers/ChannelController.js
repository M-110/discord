export default class ChannelController {
    /**
     * @param {ChannelModel} channelModel
     * @param {ChannelView} channelView
     */
    constructor(channelModel, channelView) {
        this.channelModel = channelModel;
        this.channelView = channelView;

        this.init();
    }

    init() {
        this.initEventListeners();
    }

    initEventListeners() {
        document.addEventListener('channelSelected', (event) => this.changeChannel(event.detail.channelId));
        document.addEventListener('serverSelected', () => this.clearChannels())
    }

    updateChannels(channels, channelId) {
        this.changeChannel(channelId)
        if (channels && channels.length > 0)
            this.channelView.updateChannels(channels, this.channelModel.channelId);
    }

    changeChannel(channelId) {
        this.channelModel.channelId = channelId;
    }

    clearChannels() {
        this.channelView.clearChannels();
        this.changeChannel(null);
    }
}