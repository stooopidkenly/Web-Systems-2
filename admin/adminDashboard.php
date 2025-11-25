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

$user = new User($pdo); // create an instance of the User Classfile for fetching user info.
$info = $user->showInfo(); // call the showInfo function which returns all the data of the user then show it.

$sql = "SELECT id, title FROM titles";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$titles = $stmt->fetchAll(PDO::FETCH_ASSOC);

$educ = new Education($pdo); // create an instance of the User Classfile for fetching the education info.
$educInfo = $educ->showEducation();


$project = new Projects($pdo);
$projectInfo = $project->showAllProjects();

$links = new Links($pdo);
$certInfo = $links->showCert();
$linkInfo = $links->showAllLinks();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="styles.css" rel="stylesheet">
</head>

<body>

    <h1>Admin Dashboard</h1>
    <h2>Current User Info (Live Preview)</h2>

    <div style="margin-bottom: 20px;">
        <p><strong>Name:</strong> <span class="user-name"><?= $info['name'] ?></span></p>
        <p><strong>Email:</strong> <span class="user-email"><?= $info['email'] ?></span></p>
        <p><strong>Address:</strong> <span class="user-address"><?= $info['address'] ?></span></p>
        <p><strong>Phone:</strong> <span class="user-phone"><?= $info['phoneNum'] ?></span></p>
        <p><strong>Description:</strong> <span class="user-description"><?= $info['description'] ?></span></p>

        <img class="user-photo" src="../<?= $info['photo'] ?>" width="120">
    </div>


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

    <?php if (!empty($_GET['passwordChanged'])): ?>
        <script>
            alert("Password Changed Successfully");
            if (window.history.replaceState) {
                const url = new URL(window.location);
                url.searchParams.delete("passwordChanged");
                window.history.replaceState({}, document.title, url);
            }
        </script>
    <?php endif; ?>

    <!-- ================================================================== -->
    <!-- DASHBOARD BUTTONS -->
    <!-- ================================================================== -->
    <h3>Manage Content</h3>
    <div class="dashboard-menu">
        <button class="menu-btn" onclick="openModal('modal-user')">Update User Info</button>
        <button class="menu-btn" onclick="openModal('modal-education')">Add Education</button>
        <button class="menu-btn" onclick="openModal('modal-skills')">Add Skills</button>
        <button class="menu-btn" onclick="openModal('modal-projects')">Add Projects</button>
        <button class="menu-btn" onclick="openModal('modal-links')">Add Links</button>
        <button class="menu-btn" onclick="openModal('modal-titles')">Add Titles</button>
        <button class="menu-btn" onclick="openModal('modal-certs')">Add Certifications</button>
    </div>

    <div class="dashboard-menu">
        <button class="menu-btn"> <a href="skillsView.php">Update Skills</a></button>
        <button class="menu-btn" onclick="openModal('delete-education')">Delete Education Info</button>
        <button class="menu-btn" onclick="openModal('delete-projects')">Delete Projects</button>
        <button class="menu-btn" onclick="openModal('delete-links')">Delete Links</button>
        <button class="menu-btn" onclick="openModal('delete-titles')">Delete Titles</button>
        <button class="menu-btn" onclick="openModal('delete-certs')">Delete Certifications</button>
    </div>

    <!-- ================================================================== -->
    <!-- MODALS -->
    <!-- ================================================================== -->

    <!-- 1. USER INFO MODAL -->
    <div id="modal-user" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('modal-user')">&times;</span>
            <h2>Update User Information</h2>
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

                <button type="submit">Update</button>
            </form>
        </div>
    </div>

    <div id="modal-education" class="modal">
        <div class="modal-content">

            <!-- ✔️ Close button should be here -->
            <span class="close-btn" onclick="closeModal('modal-education')">&times;</span>

            <h2>Add Education Information</h2>

            <!-- ✔️ Form starts AFTER the close button -->
            <form id="educationForm" enctype="multipart/form-data">

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
                <input type="text" name="program">

                <button type="submit">Add</button>
            </form>
        </div>
    </div>

    <!-- DELETE EDUCATION -->
    <div id="delete-education" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('delete-education')">&times;</span>
            <h2>Delete Education Information</h2>
            <table id="eduTable" border="1">
                <thead>
                    <tr>
                        <th>Level</th>
                        <th>School Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($educInfo as $edu): ?>
                        <tr data-id="<?= $edu['id'] ?>">
                            <td><?= $edu['level'] ?></td>
                            <td><?= $edu['schoolName'] ?></td>
                            <td>
                                <button class="btn-delete" data-id="<?= $edu['id'] ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- DELETE PROJECTS -->
    <div id="delete-projects" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('delete-projects')">&times;</span>
            <h2>Delete Project Display</h2>
            <table id="eduTable" border="1">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projectInfo as $project): ?>
                        <tr data-id="<?= $project['id'] ?>">
                            <td><?= $project['projectName'] ?></td>
                            <td>
                                <button class="btn-delete-project" data-id="<?= $project['id'] ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- DELETE LINKS -->
    <div id="delete-links" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('delete-links')">&times;</span>
            <h2>Delete Links Display</h2>

            <table id="linksTable" border="1">
                <thead>
                    <tr>
                        <th>Platform</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($linkInfo as $link): ?>
                        <tr data-id="<?= $link['id'] ?>">
                            <td><?= $link['platform'] ?></td>
                            <td><?= $link['link'] ?></td>
                            <td>
                                <button class="btn-delete-link" data-id="<?= $link['id'] ?>">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="delete-titles" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('delete-titles')">&times;</span>
            <h2>Delete Titles</h2>

            <table id="titlesTable" border="1">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($titles as $t): ?>
                        <tr data-id="<?= $t['id'] ?>">
                            <td><?= htmlspecialchars($t['title']) ?></td>
                            <td>
                                <button class="btn-delete-title" data-id="<?= $t['id'] ?>">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- DELETE CERTIFICATIONS -->
    <div id="delete-certs" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('delete-certs')">&times;</span>
            <h2>Delete Certification Display</h2>

            <table border="1">
                <thead>
                    <tr>
                        <th>Certification</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($certInfo as $cert): ?>
                        <tr data-id="<?= $cert['id'] ?>">
                            <td><?= $cert['name'] ?></td>
                            <td>
                                <button class="btn-delete-cert" data-id="<?= $cert['id'] ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </div>


    <!-- 3. SKILLS MODAL -->
    <div id="modal-skills" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('modal-skills')">&times;</span>
            <h2>Add Skill</h2>
            <form id="skillsForm">
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
            <form id="projectForm" enctype="multipart/form-data">
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
            <form id="linkForm">
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
            <form id="titleForm">
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
            <form id="certForm" enctype="multipart/form-data">
                <label>Certification Image</label>
                <input type="file" name="image" required>

                <label>Certification Name</label>
                <input type="text" name="projectName" required>

                <button type="submit">Save Certification</button>
            </form>
        </div>
    </div>

    <!-- JS FILES IMPORTS -->
    <script src="js/openClose.js"></script> <!-- MODALS -->
    <script src="js/updateInfo.js"></script> <!-- INFORMATION -->
    <script src="js/education.js"></script> <!-- EDUCATION -->
    <script src="js/skills.js"></script> <!-- SKILLS -->
    <script src="js/projects.js"></script> <!-- Projects -->
    <script src="js/cert.js"></script>
    <script src="js/links.js"></script>
    <script src="js/title.js"></script>
</body>

</html>