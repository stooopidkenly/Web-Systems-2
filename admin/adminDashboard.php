<?php
require "../classes/User.php";
require_once "../path.php";
require_once CLASS_PATH . "/AdminAuth.php";
require_once BASE_PATH . "/dbConnection.php";
require "../classes/Education.php";
require "../classes/Skills.php";
require "../classes/Projects.php";
require "../classes/Links.php";


$auth = new AdminAuth($pdo);
$auth->requireLogin();

$changed = $_SESSION['changed'] ?? '';
unset($_SESSION['changed']);

$user = new User($pdo); // create an instance of the User Classfile for fetching user info.
$info = $user->showInfo(); // call the showInfo function which returns all the data of the user then show it.

$sql = "SELECT title FROM titles";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$titles = $stmt->fetchAll(PDO::FETCH_COLUMN);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }

        .dashboard-menu {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }

        .menu-btn {
            padding: 20px 30px;
            font-size: 18px;
            cursor: pointer;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .menu-btn:hover {
            background-color: #0056b3;
        }

        /* Modal Styles */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.5);
            /* Black w/ opacity */
            justify-content: center;
            align-items: flex-start;
            padding-top: 50px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 25px;
            border: 1px solid #888;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            /* Restrict width for better look */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Close Button (X) */
        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 5px;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Form Styles inside Modal */
        form label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="number"],
        form textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            /* Ensures padding doesn't widen element */
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        form button:hover {
            background-color: #218838;
        }

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

        .modal-changepass {
            width: 300px;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        .closeBtn {
            float: right;
            font-size: 20px;
            cursor: pointer;
        }

        .modal-content input {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
        }

        .saveBtn {
            width: 100%;
            padding: 8px;
            background: #007bff;
            color: white;
            border: none;
        }
    </style>
</head>

<body>

    <h1>Admin Dashboard</h1>

    <a href="../logout.php" style="color: red;">Logout</a>

    <!-- Change Password Button -->
    <button id="openModalBtn">Change Password</button>

    <!-- Modal -->
    <div id="changePassModal" class="modal">
        <div class="modal-changepass">
            <span class="closeBtn">&times;</span>

            <h3>Change Password</h3>

            <form action="changePass.php" method="POST">
                <label>New Password</label>
                <input type="password" name="password" required>

                <label>Confirm Password</label>
                <input type="password" name="confirm" required>

                <button type="submit" class="saveBtn">Save</button>
            </form>

        </div>
    </div>

    <?php if ($changed): ?>
        <script>
            alert("<?php echo addslashes($changed); ?>");
        </script>
    <?php endif; ?>

    <!-- ================================================================== -->
    <!-- DASHBOARD BUTTONS -->
    <!-- ================================================================== -->
    <h3>Manage Content</h3>
    <div class="dashboard-menu">
        <button class="menu-btn" onclick="openModal('modal-user')">Add User Info</button>
        <button class="menu-btn" onclick="openModal('modal-education')">Add Education</button>
        <button class="menu-btn" onclick="openModal('modal-skills')">Add Skills</button>
        <button class="menu-btn" onclick="openModal('modal-projects')">Add Projects</button>
        <button class="menu-btn" onclick="openModal('modal-links')">Add Links</button>
        <button class="menu-btn" onclick="openModal('modal-titles')">Add Titles</button>
        <button class="menu-btn" onclick="openModal('modal-certs')">Add Certifications</button>
    </div>


    <!-- ================================================================== -->
    <!-- MODALS -->
    <!-- ================================================================== -->

    <!-- 1. USER INFO MODAL -->
    <div id="modal-user" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('modal-user')">&times;</span>
            <h2>Add User Info</h2>
            <form id="updateForm" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $info['id']; ?>">
                <label>Name</label>
                <input type="text" name="name" required value="<?= $info['name'] ?>">

                <label>Email</label>
                <input type="email" name="email" required value="<?= $info['email'] ?>">

                <label>Address</label>
                <input type="text" name="address" required value="<?= $info['address'] ?>">

                <label>Phone Number</label>
                <input type="text" name="phoneNum" required value="<?= $info['phoneNum'] ?>">

                <label>Description</label>
                <textarea name="description" rows="4" required><?= $info['description'] ?></textarea>


                <label>Profile Photo</label>
                <input type="file" name="photo">

                <button type="submit">Save User</button>
            </form>
        </div>
    </div>

    <!-- 2. EDUCATION MODAL -->
    <div id="modal-education" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('modal-education')">&times;</span>
            <h2>Add Education</h2>
            <form action="actions/addEducation.php" method="POST" enctype="multipart/form-data">
                <label>Level</label>
                <input type="text" name="level" required>

                <label>School Name</label>
                <input type="text" name="schoolName" required>

                <label>School Logo</label>
                <input type="file" name="logo" required>

                <label>Start Year</label>
                <input type="text" name="start_year" required>

                <label>End Year</label>
                <input type="text" name="end_year" required>

                <label>Program</label>
                <input type="text" name="program" required>

                <button type="submit">Save Education</button>
            </form>
        </div>
    </div>

    <!-- 3. SKILLS MODAL -->
    <div id="modal-skills" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('modal-skills')">&times;</span>
            <h2>Add Skill</h2>
            <form action="actions/addSkill.php" method="POST">
                <label>Skill Name</label>
                <input type="text" name="skillName" required>

                <label>Skill Level (0–100)</label>
                <input type="number" name="skillLevel" min="0" max="100" required>

                <button type="submit">Save Skill</button>
            </form>
        </div>
    </div>

    <!-- 4. PROJECTS MODAL -->
    <div id="modal-projects" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('modal-projects')">&times;</span>
            <h2>Add Project</h2>
            <form action="actions/addProject.php" method="POST" enctype="multipart/form-data">
                <label>Project Name</label>
                <input type="text" name="projectName" required>

                <label>Description</label>
                <textarea name="description" rows="4" required></textarea>

                <label>Live Demo URL</label>
                <input type="text" name="liveDemo">

                <label>Source Code URL</label>
                <input type="text" name="sourceCode">

                <label>Project Image</label>
                <input type="file" name="image" required>

                <button type="submit">Save Project</button>
            </form>
        </div>
    </div>

    <!-- 5. LINKS MODAL -->
    <div id="modal-links" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('modal-links')">&times;</span>
            <h2>Add Link</h2>
            <form action="actions/addLink.php" method="POST">
                <label>Platform</label>
                <input type="text" name="platform" required>

                <label>Link</label>
                <input type="text" name="link" required>

                <button type="submit">Save Link</button>
            </form>
        </div>
    </div>

    <!-- 6. TITLES MODAL -->
    <div id="modal-titles" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('modal-titles')">&times;</span>
            <h2>Add Title</h2>
            <form action="actions/addTitle.php" method="POST">
                <label>Title Text</label>
                <input type="text" name="title" required>

                <button type="submit">Save Title</button>
            </form>
        </div>
    </div>

    <!-- 7. CERTIFICATIONS MODAL -->
    <div id="modal-certs" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('modal-certs')">&times;</span>
            <h2>Add Certification</h2>
            <form action="actions/addCert.php" method="POST" enctype="multipart/form-data">
                <label>Certification Image</label>
                <input type="file" name="certs" required>

                <label>Certification Name</label>
                <input type="text" name="name" required>

                <button type="submit">Save Certification</button>
            </form>
        </div>
    </div>


    <!-- ================================================================== -->
    <!-- JAVASCRIPT FOR MODALS -->
    <!-- ================================================================== -->
    <script>
        // Function to open a specific modal
        function openModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = "flex"; // Use flex to center
        }

        // Function to close a specific modal
        function closeModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = "none";
        }

        // Close modal if user clicks outside the content area
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = "none";
            }
        }

        const modal = document.getElementById("changePassModal");
        const openBtn = document.getElementById("openModalBtn");
        const closeBtn = document.querySelector(".closeBtn");

        openBtn.onclick = () => modal.style.display = "flex";
        closeBtn.onclick = () => modal.style.display = "none";

        window.onclick = (e) => {
            if (e.target === modal) modal.style.display = "none";
        };

        document.getElementById("updateForm").addEventListener("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch("actions/updateUser.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.text())
                .then(data => {
                    alert(data);
                    // OPTIONAL: automatically close modal
                    closeModal('modal-user');
                    // OPTIONAL: reload displayed values without full page reload
                    location.reload();
                })
                .catch(err => console.log(err));
        });
    </script>

</body>

</html>