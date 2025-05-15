<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discord PHP</title>
    <link rel="stylesheet" href="css/main.css">
    <style>
    </style>
</head>
<body>
<main>
    <div class="server-sidebar">
        <ul class="server-list">
            <li class="server-item">
                <div class="server-item-pill-container">
                    <div class="server-item-pill"></div>
                </div>
                <div class="server-item-icon" aria-label="Direct Messages">
                    <svg class="server-item-icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48" height="48" viewBox="0 -28.5 256 256" version="1.1" preserveAspectRatio="xMidYMid">
                        <g>
                            <path d="M216.856339,16.5966031 C200.285002,8.84328665 182.566144,3.2084988 164.041564,0 C161.766523,4.11318106 159.108624,9.64549908 157.276099,14.0464379 C137.583995,11.0849896 118.072967,11.0849896 98.7430163,14.0464379 C96.9108417,9.64549908 94.1925838,4.11318106 91.8971895,0 C73.3526068,3.2084988 55.6133949,8.86399117 39.0420583,16.6376612 C5.61752293,67.146514 -3.4433191,116.400813 1.08711069,164.955721 C23.2560196,181.510915 44.7403634,191.567697 65.8621325,198.148576 C71.0772151,190.971126 75.7283628,183.341335 79.7352139,175.300261 C72.104019,172.400575 64.7949724,168.822202 57.8887866,164.667963 C59.7209612,163.310589 61.5131304,161.891452 63.2445898,160.431257 C105.36741,180.133187 151.134928,180.133187 192.754523,160.431257 C194.506336,161.891452 196.298154,163.310589 198.110326,164.667963 C191.183787,168.842556 183.854737,172.420929 176.223542,175.320965 C180.230393,183.341335 184.861538,190.991831 190.096624,198.16893 C211.238746,191.588051 232.743023,181.531619 254.911949,164.955721 C260.227747,108.668201 245.831087,59.8662432 216.856339,16.5966031 Z M85.4738752,135.09489 C72.8290281,135.09489 62.4592217,123.290155 62.4592217,108.914901 C62.4592217,94.5396472 72.607595,82.7145587 85.4738752,82.7145587 C98.3405064,82.7145587 108.709962,94.5189427 108.488529,108.914901 C108.508531,123.290155 98.3405064,135.09489 85.4738752,135.09489 Z M170.525237,135.09489 C157.88039,135.09489 147.510584,123.290155 147.510584,108.914901 C147.510584,94.5396472 157.658606,82.7145587 170.525237,82.7145587 C183.391518,82.7145587 193.761324,94.5189427 193.539891,108.914901 C193.539891,123.290155 183.391518,135.09489 170.525237,135.09489 Z" fill="#5865F2" fill-rule="nonzero">
                            </path>
                        </g>
                    </svg>
                </div>
            </li>
        </ul>
        <div class="server-divider"></div>
        <ul class="server-list" id="server-list">
            <li class="server-item">
                <div class="server-item-pill-container">
                    <div class="server-item-pill"></div>
                </div>
                <div class="server-item-icon">
                    <svg class="server-item-icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48" height="48" viewBox="0 -28.5 256 256" version="1.1" preserveAspectRatio="xMidYMid">
                        <g>
                            <path d="M216.856339,16.5966031 C200.285002,8.84328665 182.566144,3.2084988 164.041564,0 C161.766523,4.11318106 159.108624,9.64549908 157.276099,14.0464379 C137.583995,11.0849896 118.072967,11.0849896 98.7430163,14.0464379 C96.9108417,9.64549908 94.1925838,4.11318106 91.8971895,0 C73.3526068,3.2084988 55.6133949,8.86399117 39.0420583,16.6376612 C5.61752293,67.146514 -3.4433191,116.400813 1.08711069,164.955721 C23.2560196,181.510915 44.7403634,191.567697 65.8621325,198.148576 C71.0772151,190.971126 75.7283628,183.341335 79.7352139,175.300261 C72.104019,172.400575 64.7949724,168.822202 57.8887866,164.667963 C59.7209612,163.310589 61.5131304,161.891452 63.2445898,160.431257 C105.36741,180.133187 151.134928,180.133187 192.754523,160.431257 C194.506336,161.891452 196.298154,163.310589 198.110326,164.667963 C191.183787,168.842556 183.854737,172.420929 176.223542,175.320965 C180.230393,183.341335 184.861538,190.991831 190.096624,198.16893 C211.238746,191.588051 232.743023,181.531619 254.911949,164.955721 C260.227747,108.668201 245.831087,59.8662432 216.856339,16.5966031 Z M85.4738752,135.09489 C72.8290281,135.09489 62.4592217,123.290155 62.4592217,108.914901 C62.4592217,94.5396472 72.607595,82.7145587 85.4738752,82.7145587 C98.3405064,82.7145587 108.709962,94.5189427 108.488529,108.914901 C108.508531,123.290155 98.3405064,135.09489 85.4738752,135.09489 Z M170.525237,135.09489 C157.88039,135.09489 147.510584,123.290155 147.510584,108.914901 C147.510584,94.5396472 157.658606,82.7145587 170.525237,82.7145587 C183.391518,82.7145587 193.761324,94.5189427 193.539891,108.914901 C193.539891,123.290155 183.391518,135.09489 170.525237,135.09489 Z" fill="#5865F2" fill-rule="nonzero">
                            </path>
                        </g>
                    </svg>
                </div>
            </li>
            <li class="server-item">
                <div class="server-item-pill-container">
                    <div class="server-item-pill"></div>
                </div>
                <div class="server-item-icon">
                    <svg width=36 height=36 viewBox="0 0 128 128">
                    <path fill="#F0DB4F" d="M2 1v125h125V1H2zm66.119 106.513c-1.845 3.749-5.367 6.212-9.448 7.401-6.271 1.44-12.269.619-16.731-2.059-2.986-1.832-5.318-4.652-6.901-7.901l9.52-5.83c.083.035.333.487.667 1.071 1.214 2.034 2.261 3.474 4.319 4.485 2.022.69 6.461 1.131 8.175-2.427 1.047-1.81.714-7.628.714-14.065C58.433 78.073 58.48 68 58.48 58h11.709c0 11 .06 21.418 0 32.152.025 6.58.596 12.446-2.07 17.361zm48.574-3.308c-4.07 13.922-26.762 14.374-35.83 5.176-1.916-2.165-3.117-3.296-4.26-5.795 4.819-2.772 4.819-2.772 9.508-5.485 2.547 3.915 4.902 6.068 9.139 6.949 5.748.702 11.531-1.273 10.234-7.378-1.333-4.986-11.77-6.199-18.873-11.531-7.211-4.843-8.901-16.611-2.975-23.335 1.975-2.487 5.343-4.343 8.877-5.235l3.688-.477c7.081-.143 11.507 1.727 14.756 5.355.904.916 1.642 1.904 3.022 4.045-3.772 2.404-3.76 2.381-9.163 5.879-1.154-2.486-3.069-4.046-5.093-4.724-3.142-.952-7.104.083-7.926 3.403-.285 1.023-.226 1.975.227 3.665 1.273 2.903 5.545 4.165 9.377 5.926 11.031 4.474 14.756 9.271 15.672 14.981.882 4.916-.213 8.105-.38 8.581z"></path>
                    </svg>
                </div>
            </li>
        </ul>
        <div class="server-item server-button">
            <div class="server-item-icon" aria-label="Add a Server">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                </svg>
            </div>
        </div>
        <div class="server-item server-button">
            <div class="server-item-pill-container">
                <div class="server-item-pill"></div>
            </div>
            <div class="server-item-icon" aria-label="Explore Discoverable Servers">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-compass-fill" viewBox="0 0 16 16">
                  <path d="M15.5 8.516a7.5 7.5 0 1 1-9.462-7.24A1 1 0 0 1 7 0h2a1 1 0 0 1 .962 1.276 7.503 7.503 0 0 1 5.538 7.24m-3.61-3.905L6.94 7.439 4.11 12.39l4.95-2.828 2.828-4.95z"/>
                </svg>
            </div>
        </div>
        <div class="server-divider"></div>
        <div class="server-item server-button">
            <div class="server-item-pill-container">
                <div class="server-item-pill"></div>
            </div>
            <div class="server-item-icon" aria-label="Download Apps">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                  <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                </svg>
            </div>
        </div>
    </div>
    <div class="sidebar">
        <nav class="channel-section">
            <div class="server-header" id="server-title">Colin's Server</div>
            <div class="channel-group-item channel-events" id="channel-events">
                <div class="channel-group-item-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                      <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                      <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                    </svg>
                </div>
                <div class="channel-group-item-name">Events</div></div>
            <div class="channel-divider"></div>
            <div class="channel-groups-section" id="channels">
                <div class="channel-group">
                    <div class="channel-group-header">Text Channels</div>
                    <ul class="channel-group-list">
                        <li class="channel-group-item">
                            <div class="channel-group-item-icon">#</div>
                            <div class="channel-group-item-name">welcome-channel</div>
                        </li>
                        <li class="channel-group-item">
                            <div class="channel-group-item-icon">#</div>
                            <div class="channel-group-item-name">general-chat</div>
                        </li>
                        <li class="channel-group-item">
                            <div class="channel-group-item-icon">#</div>
                            <div class="channel-group-item-name">off-topic-chat</div>
                        </li>
                    </ul>
                </div>
                <div class="channel-group">
                    <div class="channel-group-header">csis-311</div>
                    <ul class="channel-group-list">
                        <li class="channel-group-item">
                            <div class="channel-group-item-icon">#</div>
                            <div class="channel-group-item-name">homework-help</div>
                        </li>
                        <li class="channel-group-item">
                            <div class="channel-group-item-icon">#</div>
                            <div class="channel-group-item-name">php-enthusiasts</div>
                        </li>
                        <li class="channel-group-item">
                            <div class="channel-group-item-icon">#</div>
                            <div class="channel-group-item-name">html-css-discussion</div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="user-panel">
            <div class="user-box" id="user-box">
                <div class="user-avatar">
                    <div class="user-avatar-image"><img src="images/avatar.png" alt="avatar"></div>
                    <div class="user-avatar-status online-status"></div>
                </div>
                <div class="user-box-info">
                    <div class="user-box-info-name">Colin</div>
                    <div class="user-box-info-dynamic">
                        <div class="user-box-info-dynamic-item">Online</div>
                        <div class="user-box-info-dynamic-item">cmm.1</div>
                    </div>
                </div>
            </div>
            <div class="user-toolbar">
                <div class="user-toolbar-item">🎤</div>
                <div class="user-toolbar-item">🔉</div>
                <div class="user-toolbar-item">⚙️</div>
            </div>
        </section>
    </div>
    <div class="channel-window">
        <section class="chat-header">
            <div class="chat-header-channel">
                <div class="chat-header-channel-icon">#</div>
                <div class="chat-header-channel-name" id="channel-title">general-chat</div>
            </div>
            <nav class="chat-header-toolbar">
                <ul class="chat-toolbar-list">
                    <li class="chat-toolbar-item">#️⃣</li>
                    <li class="chat-toolbar-item">🔔</li>
                    <li class="chat-toolbar-item">📌</li>
                    <li class="chat-toolbar-item">👤</li>
                    <li class="chat-toolbar-search">
                        <input aria-label="search" type="text" placeholder="Search">
                        <div class="chat-toolbar-search-icon">🔍</div>
                    </li>
                    <li class="chat-toolbar-item">📥️</li>
                    <li class="chat-toolbar-item">⏺️</li>
                </ul>
            </nav>
        </section>
        <div class="chat-container">
            <div class="chat-window">
                <div class="chat-messages" id="message-window">
                    <ul class="chat-messages-list" id="chat-messages-list">
                        <li class="spacer"></li>
                    </ul>
                </div>
                <div class="chat-input">
                    <div class="chat-input-box">
                        <div class="chat-input-box-icon">
                            +
                        </div>
                        <input id="message-input" aria-label="message" type="text" placeholder="Message #general-chat">
                    </div>
                </div>
            </div>
            <div class="chat-users" id="chat-users">
                <div class="chat-users-group" id="online-users-group">
                    <div class="chat-users-group-header">
                        <div class="chat-users-group-header-name">Online — </div>
                        <div class="chat-users-group-header-count" id="online-users-count">2</div>
                    </div>
                    <ul class="chat-users-group-list" id="online-users-list">

                    </ul>
                </div>
                <div class="chat-users-group">
                    <div class="chat-users-group-header">
                        <div class="chat-users-group-header-name">Offline — </div>
                        <div class="chat-users-group-header-count" id="offline-users-count">1</div>
                    </div>
                    <ul class="chat-users-group-list" id="offline-users-list">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="module" src="js/app.js"></script>
</body>
</html>