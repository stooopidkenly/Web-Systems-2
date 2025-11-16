<?php
require "dbConnection.php";
require "AdminAuth.php";

$nameErr = "";
$passErr = "";
$loginErr = "";

$auth = new AdminAuth($pdo); // create an instance of the AdminAuth Classfile.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validation
    if (empty($username)) {
        $nameErr = "Username is required";
    }

    if (empty($password)) {
        $passErr = "Password is required";
    }

    // pag wala error -> login credentials checking -> tawag sa AdminAuth class login method
    if (empty($nameErr) && empty($passErr)) {
        if ($auth->login($username, $password)) {
            header("Location: adminDashboard.php");
            exit();
        }
    } else {
        $loginErr = "Account Credentials Not Found. Try Again";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
        }

        .btn-login {
            width: 100%;
            background-color: #0078ff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 6px;
            margin-top: 10px;
        }

        .error {
            color: red;
            font-size: 12px;
        }

        .login-error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>

</head>

<body>
    <div class="login-container">
        <h2>Login</h2>

        <?php if (!empty($loginErr)): ?>
            <p class="login-error"><?php echo $loginErr; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" value="">
                <span class="error"><?php echo $nameErr; ?></span>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password">
                <span class="error"><?php echo $passErr; ?></span>
            </div>

            <button type="submit" class="btn-login">Sign In</button>
        </form>
    </div>
</body>

</html>