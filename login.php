<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded credentials
    if ($username === 'admin' && $password === 'password') {
        $_SESSION['loggedin'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #4a90e2, #50c9c3);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 40px 50px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
            
        }
        .login-container form {
            display:flex;
            flex-direction:column;
        }
        h2 {
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            text-align: left;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            /* width: 100%; */
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #4a90e2;
            outline: none;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.5);
        }

        button {
            background-color: #4a90e2;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #3a78c2;
        }

        .error {
            color: #e74c3c;
            background: #fdecea;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>

        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
