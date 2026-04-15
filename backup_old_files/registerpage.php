<?php 
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Mode Registration</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    background-color: #121212;
    color: #e0e0e0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* контейнер как в signin */
.container {
    background-color: #1e1e1e;
    padding: 2.5rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.5);
    width: 100%;
    max-width: 400px;
    border: 1px solid #333;
}

/* заголовок */
h2 {
    font-size: 1.8rem;
    color: #ffffff;
    margin-bottom: 0.5rem;
    text-align: center;
}

p.subtitle {
    color: #a0a0a0;
    font-size: 0.9rem;
    text-align: center;
    margin-bottom: 2rem;
}

/* поля */
.form-group {
    margin-bottom: 1.25rem;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: #ccc;
}

input {
    width: 100%;
    padding: 0.75rem;
    border-radius: 6px;
    border: 1px solid #444;
    background-color: #2c2c2c;
    color: #fff;
    font-size: 1rem;
    transition: 0.3s;
}

input:focus {
    outline: none;
    border-color: #bb86fc;
    background-color: #333;
}

/* кнопка */
.submit-btn {
    width: 100%;
    padding: 0.85rem;
    border: none;
    border-radius: 6px;
    background-color: #bb86fc;
    color: #121212;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
    margin-top: 1rem;
}

.submit-btn:hover {
    background-color: #9e67e3;
}

/* футер */
.form-footer {
    margin-top: 1.5rem;
    text-align: center;
    font-size: 0.9rem;
    color: #a0a0a0;
}

.form-footer a {
    color: #bb86fc;
    text-decoration: none;
    font-weight: 500;
}

.form-footer a:hover {
    text-decoration: underline;
}

/* ошибки */
.error-msg {
    color: #ff6b6b;
    font-size: 0.9rem;
    text-align: center;
    margin-bottom: 1rem;
}
</style>
</head>
<body>

    <div class="container">
        <h2>Create Account</h2>
        <p class="subtitle">Join us to get started</p>

        <form action="uppload.php" method="POST">
            
            <?php if (!empty($errors)): ?>
                <div class="error-msg">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="userName" placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="john@example.com" required>
            </div>
            <div class="form-group">
                
                <label>Password</label>
                <input type="password" name="password1" placeholder="••••••••" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password2" placeholder="••••••••" required>
            </div>

            <button type="submit" name="reg_user" class="submit-btn">Sign Up</button>
        </form>

        <div class="form-footer">
            <p>Already have an account? <a href="signin.html">Sign In</a></p>
        </div>
    </div>

</body>
</html>
