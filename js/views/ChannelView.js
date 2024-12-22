export default class ChannelView {
    constructor() {
        this.channelsDiv = $('#channels');
        this.channelTitle = $('#channel-title');
        this.messageInput = $('#message-input');
        this.channelGroups = {};

        this.init();
    }

    init() {
        this.initEventListeners();
    }

    initEventListeners() {
        $('#channel-events').on('click', () => {
            document.dispatchEvent(new CustomEvent('eventsPopup'));
        });
    }
    addListener(channelDiv, channel_id) {
        channelDiv.addEventListener('click', () => {
            document.dispatchEvent(new CustomEvent('channelSelected', {
                detail: {
                    channelId: channel_id
                }
            }));
        });
    }

    updateChannels(channels, currentChannelId) {
        this.updateChannel(channels, currentChannelId)
        this.channelsDiv.empty();
        this.channelGroups = {};

        channels.forEach(channel => {
            const groupId = channel.channel_category_id;
            if (!this.channelGroups[groupId]) {
                const group = createChannelGroup(groupId, channel.channel_category_name);
                this.channelGroups[groupId] = group.querySelector("ul");
                this.channelsDiv.append(group);
            }
            const channelDiv = createChannelEntry(channel.channel_id, channel.channel_name);
            if (channel.channel_id == currentChannelId)
                channelDiv.classList.add('channel-group-item-selected');
            this.addListener(channelDiv, channel.channel_id);
            this.channelGroups[groupId].append(channelDiv);
        });
    }

    updateChannel(channels, channelId) {
        const channel = channels.find(channel => channel.channel_id == channelId);
        this.channelTitle.text(channel.channel_name);
        this.messageInput.prop("placeholder", `Message #${channel.channel_name}`)
    }

    clearChannels() {
        this.channelsDiv.empty();
        this.channelGroups = {};
    }
}

function createChannelGroup(groupId, groupName) {
    const channelGroup = document.createElement('div');
    channelGroup.classList.add('channel-group');
    channelGroup.id = `channel-group-${groupId}`;
    channelGroup.innerHTML = `
        <div class="channel-group-header">${groupName}</div>
        <ul class="channel-group-list"></ul>
    `;
    return channelGroup;
}

function createChannelEntry(channelId, channelName) {
    const channelEntry = document.createElement('li');
    channelEntry.classList.add('channel-group-item');
    channelEntry.id = `channel-${channelId}`;
    channelEntry.innerHTML = `
        <div class="channel-group-item-icon">#</div>
        <div class="channel-group-item-name">${channelName}</div>
    `;
    return channelEntry;
}