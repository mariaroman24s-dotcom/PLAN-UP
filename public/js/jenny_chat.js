document.addEventListener("DOMContentLoaded", () => {

    const chat = document.getElementById("jenny-chat");
    const btn = document.getElementById("jenny-btn");
    const input = document.getElementById("jenny-input");
    const send = document.getElementById("jenny-send");
    const messages = document.getElementById("jenny-messages");

    // Abrir / cerrar chat
    btn.addEventListener("click", () => {
        chat.style.display = chat.style.display === "flex" ? "none" : "flex";
    });

    // Enviar mensaje
    async function sendMessage() {
        const text = input.value.trim();
        if (text === "") return;

        // Burbuja usuario
        const userBubble = document.createElement("div");
        userBubble.classList.add("bubble", "user");
        userBubble.textContent = text;
        messages.appendChild(userBubble);

        input.value = "";
        messages.scrollTop = messages.scrollHeight;

        // Burbuja "pensando..."
        const thinkingBubble = document.createElement("div");
        thinkingBubble.classList.add("bubble", "bot");
        thinkingBubble.textContent = "Estoy pensando… 💭";
        messages.appendChild(thinkingBubble);
        messages.scrollTop = messages.scrollHeight;

        try {
            const respuesta = await fetch("http://localhost:3000/api/jenny/chat", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ mensaje: text })
            });

            const data = await respuesta.json();

            thinkingBubble.remove();

            const botBubble = document.createElement("div");
            botBubble.classList.add("bubble", "bot");
            botBubble.textContent = data.respuesta;

            messages.appendChild(botBubble);
            messages.scrollTop = messages.scrollHeight;

        } catch (error) {
            thinkingBubble.remove();
            const errorBubble = document.createElement("div");
            errorBubble.classList.add("bubble", "bot");
            errorBubble.textContent = "Error conectando con Jenny 😢.";
            messages.appendChild(errorBubble);
        }
    }

    send.addEventListener("click", sendMessage);
    input.addEventListener("keypress", (e) => {
        if (e.key === "Enter") sendMessage();
    });
});
