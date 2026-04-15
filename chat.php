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

$postData = [
    "model" => "gpt-4o-mini",
    "messages" => [
        ["role" => "system", "content" => "Ты помощник UniPath. Помогаешь выбрать университет."],
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