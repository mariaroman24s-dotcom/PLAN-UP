// Jenny DEMO: respuestas sin IA

function jennyDemoResponse(message) {
    const msg = message.toLowerCase();

    // ===============================
    // RESPUESTAS SEGÚN PALABRAS CLAVE
    // ===============================
    if (msg.includes("hola") || msg.includes("hello")) {
        return "¡Hola! 😊 ¿En qué puedo ayudarte hoy?";
    }

    if (msg.includes("tarea") || msg.includes("tareas")) {
        return "Puedo ayudarte a organizar tus tareas. ¿Quieres crear una nueva o revisar las existentes?";
    }

    if (msg.includes("evento") || msg.includes("eventos")) {
        return "Los eventos te ayudan a recordar cosas importantes. ¿Quieres crear uno nuevo?";
    }

    if (msg.includes("consejo") || msg.includes("consejos")) {
        return "Un consejo: divide tus actividades grandes en pasos pequeños. 💡";
    }

    if (msg.includes("motiva") || msg.includes("motivar") || msg.includes("ánimo")) {
        return "¡Tú puedes! 🚀 A veces avanzar un poquito también es avanzar.";
    }

    if (msg.includes("adios") || msg.includes("bye") || msg.includes("nos vemos")) {
        return "¡Hasta luego! 💜 Estaré por aquí si me necesitas.";
    }

    // RESPUESTA GENERAL
    return "No entendí muy bien, pero estoy aquí para ayudarte 💜. ¿Puedes decirme de otra manera?";
}
