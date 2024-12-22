
export function createUserItem(user) {
    const userElement = document.createElement('li');
    userElement.classList.add('chat-users-group-item');
    userElement.innerHTML = generateUserItemInnerHTML(user)
    return userElement;
}

export function generateUserItemInnerHTML(user) {
    const status = user.user_status !== null ? user.user_status : '';
    const onlineStatus = user.is_online ? 'online-status' : 'offline-status';
    const offlineUser = user.is_online ? '' : 'offline-user';
    return `
            <div class="user-container ${offlineUser}">
                <div class="user-avatar">
                    <div class="user-avatar-image"><img src="${user.user_avatar_url}" alt="avatar"></div>
                    <div class="user-avatar-status ${onlineStatus}"></div>
                </div>
                <div class="users-name-container">
                    <div class="users-user-name">
                        <div class="users-user-name-tag">${user.user_display_name}</div>
                        <div class="users-user-name-icon"></div>
                    </div>
                    <div class="users-user-status">${status}</div>
                </div>
            </div>`;
}

export function generateUserPanelInnerHTML(user) {
    return `<div class="user-avatar">
                <div class="user-avatar-image"><img src="${user.user_avatar_url}" alt="avatar"></div>
                <div class="user-avatar-status online-status"></div>
            </div>
            <div class="user-box-info">
                <div class="user-box-info-name">${user.user_display_name}</div>
                <div class="user-box-info-dynamic">
                    <div class="user-box-info-dynamic-item">Online</div>
                    <div class="user-box-info-dynamic-item">${user.user_name}</div>
                </div>
            </div>`
}

export function createChannelGroup(groupId, groupName) {
    const channelGroup = document.createElement('div');
    channelGroup.classList.add('channel-group');
    channelGroup.id = `channel-group-${groupId}`;
    channelGroup.innerHTML = `
        <div class="channel-group-header">${groupName}</div>
        <ul class="channel-group-list"></ul>
    `;
    return channelGroup;
}

export function createChannelEntry(channelId, channelName) {
    const channelEntry = document.createElement('li');
    channelEntry.classList.add('channel-group-item');
    channelEntry.id = `channel-${channelId}`;
    channelEntry.innerHTML = `
        <div class="channel-group-item-icon">#</div>
        <div class="channel-group-item-name">${channelName}</div>
    `;
    return channelEntry;
}