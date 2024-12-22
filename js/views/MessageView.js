export default class MessageView {
    constructor() {
        this.messageWindow = $("#message-window");
        this.messageList = $("#chat-messages-list");
        this.messageInput = $("#message-input");

        this.init();
    }

    init() {
        this.initEventListeners();
    }

    initEventListeners() {
        this.messageInput.on('keypress', event => {
            if (event.key !== 'Enter')
                return;
            document.dispatchEvent(new CustomEvent('sendMessage', { detail: this.messageInput.val() }));
            this.messageInput.val('');
        });
    }

    updateMessages(messages) {
        messages.forEach(message => {
            const messageElement = createMessageItem(message);
            this.messageList.append(messageElement);
        });
        this.messageWindow.scrollTop(this.messageWindow.prop('scrollHeight'));
    }

    clearMessages() {
        this.messageList.empty();
        this.messageList.append('<li class="spacer"></li>');
    }
}

function createMessageItem(message) {
    const messageElement = document.createElement('li');
    messageElement.classList.add('chat-message-item');
    const date = new Date(message.message_timestamp * 1000);
    const formattedDate = date.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });

    messageElement.innerHTML = `
                        <li class="chat-messages-item">
                            <div class="message-avatar">
                                <img src="${message.user_avatar_url}" alt="user avatar">
                            </div>
                            <div class="message-content">
                                <div class="message-content-header">
                                    <div class="message-content-header-name">${message.user_display_name}</div>
                                    <div class="message-content-header-timestamp">${formattedDate}</div>
                                </div>
                                <div class="message-content-body">
                                    <div class="message-content-body-text">${message.message_content}</div>
                                    <div class="message-content-attachment"></div>
                                </div>
                            </div>
                        </li>
    `
    return messageElement;
}
