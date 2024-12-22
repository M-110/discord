export default class ServerView {
    constructor() {
        this.serverList = $('#server-list');
        this.serverTitle = $('#server-title');
    }

    updateServers(servers, serverId) {
        this.serverList.empty();
        servers.forEach(server => {
            const serverElement = createServerItem(server);
            if (server.server_id == serverId) {
                this.serverTitle.text(server.server_name);
                serverElement.querySelector('.server-item-pill').classList.add('server-item-pill-selected');
                serverElement.querySelector('.server-item-icon').classList.add('server-item-icon-selected');
            }
            this.serverList.append(serverElement);
            serverElement.addEventListener('click', () => {
                document.dispatchEvent(new CustomEvent('serverSelected', { detail: server.server_id }));
            });
        });
    }
}

function createServerItem(server) {
    const serverElement = document.createElement('li');
    serverElement.classList.add('server-item');
    serverElement.innerHTML = `
                <div class="server-item-pill-container">
                    <div class="server-item-pill"></div>
                </div>
                <div class="server-item-icon"  aria-label="${server.server_name}">
                    <img class="server-item-icon-img" src="${server.server_icon_url}" alt="${server.server_name}">
                </div>`;
    return serverElement;
}

