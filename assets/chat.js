document.addEventListener("DOMContentLoaded", () => {
    const button = document.querySelector(".send-button");
    button.addEventListener("click", sendMessage);
});

function sendMessage() {
    console.log("Sending message...");
    const messageInput = document.getElementById("message-input");
    const message = messageInput.value;

    if (message.trim() !== "") {
        // Display the message in the chat
        displayMessage(message, true);

        // Send the message to the API endpoint (replace 'your-api-endpoint' with the actual endpoint)
        const apiUrl = "http://localhost:88/completion";
        // You can use fetch or any other method to send the message to the server
        // Example using fetch:
        fetch(apiUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ message }),
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                // console.log(response.text(), '-***__***˙_˙**˙_');
                return response.json();
            })
            .then(data => {
                console.log("Message sent successfully:", data);
                displayMessage(data, false);
            })
            .catch(error => {
                console.error("Error sending message:", error);
            });

        // Clear the input field after sending the message
        messageInput.value = "";
    }
}

/**
 * @param {string} message
 * @param {boolean} user
 */
function displayMessage(message, user) {
    const chatMessages = document.getElementById("chat-messages");
    const messageDiv = document.createElement("div");

    if (user) {
        messageDiv.classList.add("user-message");
    } else {
        messageDiv.classList.add("assistant-message");
    }

    messageDiv.classList.add("message");
    messageDiv.textContent = message;
    chatMessages.appendChild(messageDiv);

    // Scroll to the bottom of the chat messages
    chatMessages.scrollTop = chatMessages.scrollHeight;
}