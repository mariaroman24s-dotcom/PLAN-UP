import express from "express";
import cors from "cors";
import dotenv from "dotenv";
import OpenAI from "openai";

dotenv.config();

const app = express();
app.use(cors());
app.use(express.json());

// Inicializar cliente de OpenAI
const openai = new OpenAI({
  apiKey: process.env.OPENAI_API_KEY
});

// Endpoint de Jenny
app.post("/api/jenny/chat", async (req, res) => {
    try {
        const { mensaje } = req.body;

        if (!mensaje) {
            return res.status(400).json({ error: "Falta el mensaje" });
        }

        // Petición al modelo GPT-4o mini (demo friendly)
        const completion = await openai.chat.completions.create({
            model: "gpt-4o-mini",
            messages: [
                { role: "system", content: "Eres Jenny, una asistente amable y simpática, que responde claro y breve." },
                { role: "user", content: mensaje }
            ]
        });

        const respuesta = completion.choices[0].message.content;

        res.json({ respuesta });

    } catch (error) {
        console.error("ERROR EN JENNY:", error);
        res.status(500).json({
            error: "Error al generar respuesta",
            detalle: error.message
        });
    }
});

// Iniciar servidor
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log("🚀 Servidor Jenny corriendo en puerto " + PORT);
});
