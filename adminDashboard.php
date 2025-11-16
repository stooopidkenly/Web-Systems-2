<?php

require "dbConnection.php";
require "AdminAuth.php";

$auth = new AdminAuth($pdo); // create an instance of the AdminAuth Classfile.
$auth->requireLogin();

$changed = $_SESSION['changed'] ?? '';
unset($_SESSION['changed']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <style>
        /* Basic modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
        }
    </style>
</head>

<body>

    <h1>Admin Dashboard</h1>
    <?php if ($changed): ?>
        <p style="color:green;"><?php echo $changed; ?></p>
    <?php endif; ?>


    <button id="openModalBtn">Change Admin Password</button>
    <a href="logout.php">Logout</a>

    <!-- MODAL -->
    <div class="modal" id="passwordModal">
        <div class="modal-content">
            <h3>Change Password</h3>

            <form action="changePass.php" method="POST" onsubmit="return validatePassword();">
                <label>New Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <label>Confirm Password:</label><br>
                <input type="password" name="confirm" id="confirmPassword" required><br><br>

                <span id="errorMsg" style="color:red;"></span><br>

                <button type="submit">Save</button>
                <button type="button" id="closeModalBtn">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('passwordModal');
        const openBtn = document.getElementById('openModalBtn');
        const closeBtn = document.getElementById('closeModalBtn');

        openBtn.onclick = () => modal.style.display = 'flex';
        closeBtn.onclick = () => modal.style.display = 'none';

        function validatePassword() {
            const pass = document.getElementById('password').value;
            const confirm = document.getElementById('confirmPassword').value;
            const error = document.getElementById('errorMsg');

            if (pass !== confirm) {
                error.textContent = "Passwords do not match";
                return false;
            }

            return true;
        }
    </script>

</body>

</html>