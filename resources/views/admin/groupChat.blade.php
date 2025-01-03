@extends('admin.layouts.main')
@section('content')
<div>
    <div class="chat-wrapper p-0" style="margin-top: 80px;">
        <div class="chat-header font-semibold">
            Protocoloud Team - Group Chat
            <p>14 Participants</p>
        </div>
        <div class="chat-body" id="chatBody">
            <!-- Messages will be dynamically populated here -->
        </div>
        <div class="chat-footer">
            <form id="messageForm" class="d-flex">
                <textarea class="form-control me-2 flex-grow-1" placeholder="Type a message..." id="messageInput" rows="1" style="resize: none;"></textarea>
                <button type="submit" class="btn btn-primary flex-shrink-0">Send</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const form = document.getElementById('messageForm');
    let user_id = "{{ auth()->id() }}";
    const profileImageUrl = "{{ asset('/uploads/banners/' . Auth::user()->Profile) }}";
    const currentUserId = user_id;
    const notificationSound = new Audio('{{ asset("assets/sounds/notification.mp3") }}');
    const notificationDropdown = document.getElementById('notificationsList');
    const messageCount = document.getElementById('messageCount');

    // Function to fetch messages from the server
    async function fetchMessages() {
        try {
            const response = await axios.get('/messages');
            const messages = response.data;

            renderMessages(messages);
            showNotifications(messages);
        } catch (error) {
            console.error('Error fetching messages:', error);
        }
    }

    // Function to render messages
    function renderMessages(messages) {
        const chatBody = document.getElementById('chatBody');
        chatBody.innerHTML = ''; // Clear existing messages

        const fragment = document.createDocumentFragment();

        messages.forEach(msg => {
            const messageDiv = document.createElement('div');
            const messagechildDiv = document.createElement('div');
            const senderImageUrl = `{{ asset('/uploads/banners/') }}/${msg.profile_img}`;

            messageDiv.classList.add('chat-message');
            messagechildDiv.classList.add('chat-box');

            // Check if the message is from the current user or someone else
            if (msg.user_id == currentUserId) {
                messagechildDiv.classList.add('mine');
            }

            messagechildDiv.innerHTML = `
                <div class="d-flex">
                    <div class="profile-pic">
                    <img src="${msg.user_id == currentUserId ? profileImageUrl : senderImageUrl}" alt="Profile Picture">
                </div>
                <div class="username d-flex justify-content-between align-items-center">${sanitizeHTML(msg.sender_name)}
                        <span class="timestamp">${new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'})}</span>
                </div>
                </div>
                <div>
                    <div class="message-text">${sanitizeHTML(msg.message)}</div>
                </div>
            `;

            messageDiv.appendChild(messagechildDiv);
            fragment.appendChild(messageDiv);
        });

        chatBody.appendChild(fragment);
    }

    // Function to show notifications
    function showNotifications(messages) {
        notificationDropdown.innerHTML = ''; // Clear previous notifications
        messageCount.textContent = messages.length; // Update message count

        messages.forEach(msg => {
            const notificationItem = document.createElement('div');
            notificationItem.classList.add('dropdown-item', 'preview-item');
            notificationItem.innerHTML = `
                <div class="preview-thumbnail">
                    <img src="https://www.pngall.com/wp-content/uploads/12/Avatar-Profile-PNG-Photos.png" alt="" class="profile-pic" />
                </div>
                <div class="preview-item-content">
                    <p class="mb-0">${msg.sender_name}</p><span class="text-small text-muted">${msg.message}</span>
                </div>
                <button class="btn btn-danger btn-sm remove-btn" data-id="${msg.id}">X</button>
            `;
            notificationDropdown.appendChild(notificationItem);

            // Attach event to remove button
            notificationItem.querySelector('.remove-btn').addEventListener('click', function() {
                removeNotification(msg.id, notificationItem);
            });
        });

        // Play notification sound
        notificationSound.play();
    }

    // Function to remove a notification
    async function removeNotification(messageId, notificationItem) {
        try {
            await axios.delete(`/messages/${messageId}`);
            notificationItem.remove(); // Remove the notification from UI
            messageCount.textContent = parseInt(messageCount.textContent) - 1; // Update count
        } catch (error) {
            console.error('Error removing notification:', error);
        }
    }

    // Function to sanitize HTML to prevent XSS attacks
    function sanitizeHTML(str) {
        const temp = document.createElement('div');
        temp.textContent = str;
        return temp.innerHTML;
    }

    // Function to send a message
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const message = messageInput.value.trim();

        if (message) {
            await axios.post('/messages', {
                sender_id: currentUserId, // Send the logged-in user ID
                sender_name: '{{ auth()->user()->name }}',
                profile_img: '{{ auth()->user()->Profile }}', // Replace with dynamic user name
                message: message,
            });

            messageInput.value = '';
            fetchMessages(); // Refresh messages
        }
    });

    // Initial fetch of messages
    fetchMessages();

    // Refresh messages every 2 seconds
    setInterval(fetchMessages, 2000);

    // Function to auto-resize the textarea
    const messageInput = document.getElementById('messageInput');
    messageInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
</script>

@endsection