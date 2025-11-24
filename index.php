<?php
require_once "path.php";
require_once "dbConnection.php";
require "classes/User.php";
require "classes/Education.php";
require "classes/Skills.php";
require "classes/Projects.php";
require "classes/Links.php";

$user = new User($pdo); // create an instance of the User Classfile for fetching user info.
$educ = new Education($pdo); // create an instance of the User Classfile for fetching the education info.
$info = $user->showInfo(); // call the showInfo function which returns all the data of the user then show it.
$educInfo = $educ->showEducation();
$skills = new Skills($pdo);
$skillsInfo = $skills->showAllSkills();
$projects = new Projects($pdo);
$projectInfo = $projects->showAllProjects();
$links = new Links($pdo);
$linkInfo = $links->showAllLinks();
$certInfo = $links->showCert();

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
    <title><?= $info['name'] ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <div class="headerContainer">
            <h1 class="title1">kenly.dev &lt;/&gt;</h1>
            <nav class="links">
                <ul>
                    <li><a href="#about">About</a></li>
                    <li><a href="#skills">Skills</a></li>
                    <li><a href="#projects">Projects</a></li>
                </ul>
            </nav>
        </div>
        <div class="line"></div>
    </header>

    <main class="bodyContainer">
        <h1 class="headerTitle">
            Hi! I am <span class="gradient" id="name"><?= $info['name'] ?></span><br>
            <span class="text-rotate" id="rotatingText"></span>
        </h1>
    </main>

    <div class="about" id="about">
        <h1 style="color: black;">About Me</h1>
        <div class="info">
            <p id="description"><?= $info['description'] ?></p>
            <img src="<?= $info['photo'] ?>" class="profile" id="profile" alt="<?= $info['name'] ?>">
        </div>
    </div>

    <div class="education-section" id="education">
        <h1 style="color:black;" class="educTitle">Education</h1>
        <div class="education-grid">
            <?php foreach ($educInfo as $edu): ?>
                <div class="edu-card">
                    <div class="edu-card-header">
                        <img id="logo" src="<?php echo $edu['logo']; ?>" class="edu-logo" alt="<?php echo $edu['schoolName']; ?> Logo">
                        <h3 id="schoolName"><?php echo $edu['schoolName']; ?></h3>
                    </div>
                    <div class="edu-card-body">
                        <h2 id="level"><?php echo $edu['level']; ?></h2>
                        <?php if (!empty($edu['program'])): ?>
                            <p id="program" class="program"><?php echo $edu['program']; ?></p>
                        <?php endif; ?>
                        <p class="years" id="years"><?php echo $edu['start_year'] . " - " . $edu['end_year']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <h1 style="color:black;" class="skillsTitle" id="skills">Skills</h1>
    <div class="skill-card">
        <?php foreach ($skillsInfo as $skill): ?>
            <div class="skill-item">
                <div class="skill-info">
                    <div class="skill-title">
                        <?= $skill['skillName'] ?>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: <?= $skill['skillLevel'] ?>%; height:100%"></div>
                    </div>
                </div>
                <div class="skill-level-text">
                    <?= $skill['skillLevel'] ?>%
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="projectContainer" id="projects">
        <h1 class="projectsTitle" style="color:black;">Projects</h1>
        <div class="projectsGrid">
            <?php foreach ($projectInfo as $project): ?>
                <div class="projectCard">
                    <div class="project-image-wrapper">
                        <img src="<?= $project['image'] ?>" alt="<?= $project['projectName'] ?> Screenshot">
                        <div class="overlay">
                        </div>
                    </div>
                    <div class="project-content">
                        <h2><?= $project['projectName'] ?></h2>
                        <p><?= $project['description'] ?></p>
                        <div class="buttons">
                            <a href="<?= $project['liveDemo'] ?>" class="btn demo" target="_blank">
                                <i class="fas fa-eye"></i> Live Demo
                            </a>
                            <a href="<?= $project['sourceCode'] ?>" class="btn code" target="_blank">
                                <i class="fas fa-code"></i> View Code
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="cert-section">
        <h1 class="cert-title">Certifications</h1>
        <div class="cert-grid">
            <?php foreach ($certInfo as $cert): ?>
                <div class="cert-card">
                    <img
                        src="<?php echo $cert['certs']; ?>"
                        class="cert-img"
                        alt="<?php echo $cert['name']; ?> Logo"
                        onclick="openCert('<?php echo $cert['certs']; ?>')">
                    <h3 class="cert-name"><?php echo $cert['name']; ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="certModal" class="cert-modal" onclick="closeCert()">
        <img id="certModalImg" class="cert-modal-img">
    </div>


    <div class="contactContainer">
        <div class="contactGrid">
            <div class="personalInfo">
                <h2>Personal Info</h2>
                <div class="contactItem">
                    <i class="fas fa-envelope"></i>
                    <p><strong>Email:</strong> <a id="email" href="mailto:<?= $info['email'] ?>"><?= $info['email'] ?></a></p>
                </div>
                <div class="contactItem">
                    <i class="fas fa-phone"></i>
                    <p><strong>Phone:</strong> <a id="phoneNum" href="tel:<?= $info['phoneNum'] ?>"><?= $info['phoneNum'] ?></a></p>
                </div>
                <div class="contactItem">
                    <i class="fas fa-map-marker-alt"></i>
                    <p id="address"><strong>Address:</strong> <?= $info['address'] ?></p>
                </div>

                <div class="socialLinks">
                    <?php foreach ($linkInfo as $link): ?>
                        <a href="<?= $link['link'] ?>" target="_blank" aria-label="<?= $link['platform'] ?> Profile">
                            <!-- Example: Use Font Awesome for social icons, dynamically -->
                            <i class="fab fa-<?= strtolower(str_replace(' ', '-', $link['platform'])) ?>"></i>
                        </a>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="contactFormWrapper">
                <h2>Contact Me</h2>
                <form class="contactForm" action="process_contact.php" method="POST">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Your Email" required>
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Your Message" rows="6" required></textarea>
                    <!-- Honeypot field (hidden by CSS) -->
                    <input type="text" name="trap" style="display:none; visibility:hidden; opacity:0; position:absolute; left:-9999px;">
                    <button type="submit">Send Message</button>
                    <div id="form-messages" aria-live="polite"></div> <!-- For success/error messages -->
                </form>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2025 <?= $info['name'] ?>. All rights reserved.</p>
        <!-- <p>Made with ❤️</p> -->
    </footer>

    <script>
        class RotatingText {
            constructor(element, options = {}) {
                this.element = element;
                this.texts = options.texts || [];
                this.rotationInterval = options.rotationInterval || 3000;
                this.currentIndex = 0;
                this.isAnimating = false;

                this.init();
            }

            createTextElement(text) {
                const container = document.createElement('span');
                container.className = 'text-rotate-container';

                const textSpan = document.createElement('span');
                textSpan.className = 'text-rotate-text';
                textSpan.textContent = text;

                container.appendChild(textSpan);
                return container;
            }

            async animateIn(container) {
                const textElement = container.querySelector('.text-rotate-text');
                textElement.classList.add('animate-in');
                await new Promise(resolve => setTimeout(resolve, 600));
            }

            async animateOut(container) {
                const textElement = container.querySelector('.text-rotate-text');
                textElement.classList.remove('animate-in');
                textElement.classList.add('animate-out');
                await new Promise(resolve => setTimeout(resolve, 400));
            }

            async showText(index) {
                if (this.isAnimating) return;
                this.isAnimating = true;

                const currentContainer = this.element.querySelector('.text-rotate-container');

                if (currentContainer) {
                    await this.animateOut(currentContainer);
                    currentContainer.remove();
                }

                this.element.innerHTML = "";

                const newContainer = this.createTextElement(this.texts[index]);
                this.element.appendChild(newContainer);
                await this.animateIn(newContainer);

                this.isAnimating = false;
            }

            next() {
                let nextIndex = this.currentIndex + 1;

                if (nextIndex >= this.texts.length) {
                    nextIndex = 0; // reset properly
                }

                this.currentIndex = nextIndex;
                this.showText(this.currentIndex);
            }

            stop() {
                if (this.intervalId) {
                    clearInterval(this.intervalId);
                }
            }

            init() {
                this.showText(this.currentIndex);
                this.intervalId = setInterval(() => this.next(), this.rotationInterval);
            }
        }

        // Initialize the rotating text
        const dynamicTitles = <?php echo json_encode($titles); ?>;
        const rotatingTextElement = document.getElementById('rotatingText');
        const rotatingText = new RotatingText(rotatingTextElement, {
            texts: dynamicTitles,
            rotationInterval: 1500
        });

        function openCert(src) {
            document.getElementById("certModalImg").src = src;
            document.getElementById("certModal").style.display = "flex";
        }

        function closeCert() {
            document.getElementById("certModal").style.display = "none";
        }
    </script>
</body>

</html>