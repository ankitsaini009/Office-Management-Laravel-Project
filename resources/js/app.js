import './bootstrap';
import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;


window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

// Listen for new messages
window.Echo.channel("group-chat")
    .listen("MessageSent", (e) => {
        const chatBox = document.getElementById("chat-box");
        chatBox.innerHTML += `<p><strong>${e.message.user.name}:</strong> ${e.message.message}</p>`;
        chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll to the bottom
    });