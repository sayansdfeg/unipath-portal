<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

$apiKey = getenv("OPENAI_API_KEY");

if (!$apiKey) {
    echo json_encode(["error" => "API key not found"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$message = $data["message"] ?? "Привет";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

$headers = [
    "Content-Type: application/json",
    "Authorization: Bearer " . $apiKey
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$systemPrompt = "Eres el Asistente Educativo de UniPath, una plataforma especializada en ayudar estudiantes a encontrar la universidad perfecta. Tu rol es actuar como un consultor educativo profesional y experimentado en admisiones universitarias internacionales.

INSTRUCCIONES CLAVE:
1. PERSONALIZACIÓN: Haz preguntas estratégicas para entender los objetivos, fortalezas académicas, intereses y presupuesto del estudiante.
2. RESPUESTAS ESTRUCTURADAS: Siempre organiza tus respuestas con:
   • Puntos clave en viñetas
   • Explicaciones claras y concisas
   • Recomendaciones específicas cuando sea posible
3. COBERTURA GLOBAL: Sugiere universidades de diferentes países (USA, UK, Canadá, Australia, Europa, etc.) considerando presupuesto y ubicación.
4. ASPECTOS A CONSIDERAR:
   • Ranking académico y especialización
   • Costos de matrícula y opciones de financiamiento
   • Oportunidades de becas
   • Vida estudiantil y ubicación
   • Posibilidades de empleabilidad post-graduación
5. TONO: Profesional pero accesible, motivador pero realista, siempre enfocado en el éxito del estudiante.
6. PROFUNDIDAD: Proporciona información valiosa y práctica, no solo respuestas genéricas.

Cuando un estudiante haga preguntas sobre universidades, programas, países o procesos de admisión, responde de manera estructurada y especializada. Si necesitas más información para dar mejores recomendaciones, pregunta claramente.";

$postData = [
    "model" => "gpt-4o-mini",
    "messages" => [
        ["role" => "system", "content" => $systemPrompt],
        ["role" => "user", "content" => $message]
    ]
];

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

$response = curl_exec($ch);

if(curl_errno($ch)) {
    echo json_encode(["error" => curl_error($ch)]);
    exit;
}

curl_close($ch);

$result = json_decode($response, true);

// 🔥 ВОТ ГЛАВНОЕ
if (isset($result["error"])) {
    echo json_encode(["error" => $result["error"]["message"]]);
    exit;
}

echo json_encode([
    "reply" => $result["choices"][0]["message"]["content"] ?? "Нет ответа"
]);