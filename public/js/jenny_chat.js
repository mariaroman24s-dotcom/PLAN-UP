document.addEventListener("DOMContentLoaded", () => {

    const chat = document.getElementById("jenny-chat");
    const btn = document.getElementById("jenny-btn");
    const input = document.getElementById("jenny-input");
    const send = document.getElementById("jenny-send");
    const messages = document.getElementById("jenny-messages");

    // ✅ URL CORRECTA - llama a nuestro endpoint PHP seguro
    const JENNY_API_URL = '/src/config/jenny_api.php';

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
            console.log("📤 Enviando mensaje a Jenny:", text);
            
            const response = await fetch(JENNY_API_URL, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ mensaje: text })
            });

            console.log("📥 Respuesta HTTP:", response.status);

            if (!response.ok) {
                throw new Error(`Error ${response.status}: ${response.statusText}`);
            }

            const data = await response.json();
            console.log("🤖 Datos recibidos:", data);

            if (data.error) {
                throw new Error(data.error);
            }

            thinkingBubble.remove();

            const botBubble = document.createElement("div");
            botBubble.classList.add("bubble", "bot");
            botBubble.textContent = data.respuesta;

            messages.appendChild(botBubble);
            messages.scrollTop = messages.scrollHeight;

        } catch (error) {
            console.error("❌ Error conectando con Jenny:", error);
            
            // 🌟 SI LA API FALLA, USAR DEMO
            thinkingBubble.remove();

            const botBubble = document.createElement("div");
            botBubble.classList.add("bubble", "bot");

            // Usar respuestas demo
            botBubble.textContent = jennyDemoResponse(text);

            messages.appendChild(botBubble);
            messages.scrollTop = messages.scrollHeight;
        }
    }

    send.addEventListener("click", sendMessage);
    input.addEventListener("keypress", (e) => {
        if (e.key === "Enter") sendMessage();
    });
});