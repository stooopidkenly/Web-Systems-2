<?php

require_once "../path.php";
require_once CLASS_PATH . "/Skills.php";
require_once BASE_PATH . "/dbConnection.php";


$skill = new Skills($pdo);

$skillsInfo = $skill->showAllSkills();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Update Skills Information Here</h1>

    <table border="1">
        <tr>
            <th>Skill Name</th>
            <th>Skill Level</th>
            <th>Action</th>
        </tr>
        <?php foreach ($skillsInfo as $skill): ?>
            <tr
                data-id="<?= $skill['id'] ?>"
                data-name="<?= $skill['skillName'] ?>"
                data-level="<?= $skill['skillLevel'] ?>">
                <td><?= $skill['skillName'] ?></td>
                <td><?= $skill['skillLevel'] ?></td>
                <td>
                    <button
                        class="update-btn"
                        type="button">
                        Update
                    </button>

                    <button
                        class="delete-btn"
                        type="button">
                        Delete
                    </button>
                </td>
            </tr>
        <?php endforeach ?>
    </table>

    <!-- Update Modal -->
    <div id="updateSkillModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
        <div style="background:#fff; padding:20px; width:300px;">
            <h3>Update Skill</h3>
            <form id="updateSkillForm">
                <input type="hidden" id="updateSkillId" name="id">

                <label>Skill Name</label>
                <input type="text" id="updateSkillName" name="skillName" required>

                <label>Skill Level</label>
                <input type="number" id="updateSkillLevel" name="skillLevel" min="0" max="100" required>

                <br><br>
                <button type="submit">Update</button>
                <button type="button" id="closeUpdateModal">Cancel</button>
            </form>
        </div>
    </div>
    <script src="js/skills.js"></script>
</body>

</html>