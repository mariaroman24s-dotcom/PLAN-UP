<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $mensaje = $input['mensaje'] ?? '';
    
    if (empty($mensaje)) {
        http_response_code(400);
        echo json_encode(['error' => 'Falta el mensaje']);
        exit;
    }
    
    // ✅ API KEY SEGURA - desde variables de entorno
    $api_key = getenv('OPENAI_API_KEY');
    if (!$api_key) {
        http_response_code(500);
        echo json_encode(['error' => 'Configuración del servidor incompleta']);
        exit;
    }
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => 'https://api.openai.com/v1/chat/completions',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode([
            'model' => 'gpt-4o-mini',
            'messages' => [  // ✅ CORREGIDO: faltaba "=>"
                [
                    'role' => 'system', 
                    'content' => 'Eres Jenny, una asistente amable y simpática que responde claro y breve.'
                ],
                [
                    'role' => 'user', 
                    'content' => $mensaje
                ]
            ],
            'max_tokens' => 150
        ]),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key
        ]
    ]);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http_code === 200) {
        $data = json_decode($response, true);
        echo json_encode(['respuesta' => $data['choices'][0]['message']['content']]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Error en el servicio de IA']);
    }
}
?>