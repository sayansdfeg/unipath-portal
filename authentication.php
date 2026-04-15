<?php
session_start();
header('Content-Type: application/json');
// include('connection.php');

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Пожалуйста, заполните все поля.']);
    exit;
}

$email_safe = mysqli_real_escape_string($succes, $email);
$sql = "SELECT * FROM users WHERE email='$email_safe'";
$result = mysqli_query($succes, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $userRecord = mysqli_fetch_assoc($result);

    // ✅ FIXED PASSWORD CHECK
    if (password_verify($password, $userRecord['password1'])) {
        $_SESSION['user_email'] = $userRecord['email'];
        $_SESSION['user_name'] = $userRecord['userName'];

        echo json_encode(['success' => true]);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Неверный пароль.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Пользователь не найден.']);
}
?>
