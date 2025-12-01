// ---------- Popup / Auto-Open Logic ----------
document.addEventListener("DOMContentLoaded", () => {
    const chatPopup = document.getElementById("chat-popup");
    const chatToggle = document.getElementById("chat-toggle");
    const chatClose = document.getElementById("chat-close");

    if (chatPopup && chatToggle) {
        // After 10 seconds, show the toggle button and open the chat
        setTimeout(() => {
            chatPopup.classList.add("open");
        }, 10000); // 10,000 ms = 10 seconds

        // Clicking the toggle button shows/hides the chat popup
        chatToggle.addEventListener("click", () => {
            chatPopup.classList.toggle("open");
        });

        // Close button inside the chat
        if (chatClose) {
            chatClose.addEventListener("click", () => {
                chatPopup.classList.remove("open");
            });
        }
    }
});

// ---------- Chat Logic (your original code, with safety checks) ----------
const form = document.getElementById('chat-form');
const messages = document.getElementById('messages');

if (form && messages) {
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const userInput = document.getElementById('user_input').value;
        const userMessage = `<div class="user-message"><strong>You:</strong> ${userInput} </div>`;
        messages.innerHTML += userMessage;

        autoscroll();

        // Fetch data responses in the background
        const response = await fetch('bot_logic.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({ user_input: userInput })
        });

        const botResponse = await response.text();

        const botMessage = `<div class="bot-message"><strong>Bot:</strong> ${botResponse} </div>`;
        messages.innerHTML += botMessage;

        autoscroll();

        form.reset();
    });
}

// Autofill on suggestion click
const suggestions = document.querySelectorAll(".suggestion");
const inputBox = document.getElementById("user_input");

if (suggestions && inputBox) {
    suggestions.forEach(item => {
        item.style.cursor = "pointer"; // make it look clickable

        item.addEventListener("click", () => {
            // Remove numbering (e.g., "1. ")
            const text = item.textContent.replace(/^\d+\.\s*/, "");

            inputBox.value = text; // Fill input box
            inputBox.focus();      // Put cursor there
        });
    });
}

// Autoscrolling Code
function autoscroll() {
    const messagesEl = document.getElementById('messages');
    if (!messagesEl) return;

    messagesEl.scrollTo({
        top: messagesEl.scrollHeight,
        behavior: "smooth"
    });
}
