<?php
require "dbConnection.php";
require "User.php";
require "Education.php";

$user = new User($pdo); // create an instance of the User Classfile for fetching user info.
$educ = new Education($pdo); // create an instance of the User Classfile for fetching the education info.
$info = $user->showInfo(); // call the showInfo function which returns all the data of the user then show it.
$educInfo = $educ->showEducation();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $info['name'] ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
            Hi! I am <span class="gradient"><?= $info['name'] ?></span><br>
            <span class="text-rotate" id="rotatingText"></span>
        </h1>
    </main>

    <div class="about" id="about">
        <h1 style="color: black;">About Me</h1>
        <div class="info">
            <p><?= $info['description'] ?></p>
            <img src="profile.JPG" class="profile" id="profile" alt="John Kenly Pamor">
        </div>
    </div>

    <div class="education-section" id="education">
        <h1 style="color:black;" class="educTitle">Education</h1>
        <div class="education-grid">
            <?php foreach ($educInfo as $edu): ?>
                <div class="edu-card">
                    <div class="edu-card-header">
                        <img src="<?php echo $edu['logo']; ?>" class="edu-logo" alt="<?php echo $edu['schoolName']; ?> Logo">
                        <h3><?php echo $edu['schoolName']; ?></h3>
                    </div>
                    <div class="edu-card-body">
                        <h2><?php echo $edu['level']; ?></h2>
                        <?php if (!empty($edu['program'])): ?>
                            <p class="program"><?php echo $edu['program']; ?></p>
                        <?php endif; ?>
                        <p class="years"><?php echo $edu['start_year'] . " - " . $edu['end_year']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <!-- <div class="education" id="education">
        <h1 style="color:black;">Education</h1>


        <div class="college">
            <img src="schools/cspc.png" alt="Camarines Sur Polytechnic Colleges" style="width: 100px; height: 100px; object-fit: contain;">
            <div class="edu-content">
                <span>College</span>
                <p>2023-Present</p>
                <h1>Camarines Sur Polytechnic Colleges</h1>
                <h1>Bachelor of Science in Information Technology</h1>
            </div>
        </div>
        <div class="shs">
            <img src="schools/usi.png" alt="Universidad de Sta. Isabel-Pili Campus" style="width: 100px; height: 100px; object-fit: contain;">
            <div class="edu-content">
                <span>Senior High School</span>
                <p>2021-2023</p>
                <h1>Universidad de Sta. Isabel-Pili Campus</h1>
                <h1>Science, Technology, Engineering and Mathematics</h1>
            </div>
        </div>
        <div class="jhs">
            <img src="schools/usi.png" alt="Universidad de Sta. Isabel-Pili Campus" style="width: 100px; height: 100px; object-fit: contain;">
            <div class="edu-content">
                <span>Junior High School</span>
                <p>2017-2021</p>
                <h1>Universidad de Sta. Isabel-Pili Campus</h1>
            </div>
        </div>
        <div class="elementary">
            <img src="schools/pcs.png" alt="Pili Central School" style="width: 100px; height: 100px; object-fit: contain;">
            <div class="edu-content">
                <span>Elementary</span>
                <p>2011-2017</p>
                <h1>Pili Central School</h1>
            </div>
        </div>
    </div> -->

    <div class="skillsContainer" id="skills">
        <h1 class="skills" style="color:black;">Skills</h1>
        <div class="skills-grid">
            <div class="skill">
                <span>HTML</span>
                <div class="progress-bar">
                    <div class="progress" style="width: 90%;"></div>
                </div>
                <span class="percent">90%</span>
            </div>
            <div class="skill">
                <span>CSS</span>
                <div class="progress-bar">
                    <div class="progress" style="width: 85%;"></div>
                </div>
                <span class="percent">85%</span>
            </div>
            <div class="skill">
                <span>JavaScript</span>
                <div class="progress-bar">
                    <div class="progress" style="width: 70%;"></div>
                </div>
                <span class="percent">70%</span>
            </div>
            <div class="skill">
                <span>PHP</span>
                <div class="progress-bar">
                    <div class="progress" style="width: 80%;"></div>
                </div>
                <span class="percent">80%</span>
            </div>
            <div class="skill">
                <span>Laravel</span>
                <div class="progress-bar">
                    <div class="progress" style="width: 75%;"></div>
                </div>
                <span class="percent">75%</span>
            </div>
            <div class="skill">
                <span>CodeIgniter 4</span>
                <div class="progress-bar">
                    <div class="progress" style="width: 70%;"></div>
                </div>
                <span class="percent">70%</span>
            </div>
            <div class="skill">
                <span>SQL</span>
                <div class="progress-bar">
                    <div class="progress" style="width: 85%;"></div>
                </div>
                <span class="percent">85%</span>
            </div>
            <div class="skill">
                <span>Figma</span>
                <div class="progress-bar">
                    <div class="progress" style="width: 60%;"></div>
                </div>
                <span class="percent">60%</span>
            </div>
        </div>
    </div>

    <div class="projectContainer" id="projects">
        <h1 class="projectsTitle" style="color:black;">Projects</h1>
        <div class="projectsGrid">
            <div class="projectCard">
                <h2>Deal Or No Deal</h2>
                <p>A simple game developed for educational purpose.</p>
                <div class="buttons">
                    <a href="https://dealornodeal-black.vercel.app/" class="btn demo" target="_blank">Live Demo</a>
                    <a href="https://github.com/stooopidkenly/Deal-or-No-Deal" class="btn code" target="_blank">View Code</a>
                </div>
            </div>
            <div class="projectCard">
                <h2>SunnyTrips</h2>
                <p>AI-powered travel booking system that personalizes itineraries and budgets.</p>
                <div class="buttons">
                    <a href="#" class="btn demo">Live Demo</a>
                    <a href="#" class="btn code">View Code</a>
                </div>
            </div>
            <div class="projectCard">
                <h2>FoodieFinds</h2>
                <p>Restaurant finder built with CodeIgniter 4 and integrated Google Maps API.</p>
                <div class="buttons">
                    <a href="#" class="btn demo">Live Demo</a>
                    <a href="#" class="btn code">View Code</a>
                </div>
            </div>
            <div class="projectCard">
                <h2>PortfolioHub</h2>
                <p>Dynamic portfolio CMS for students to showcase their work online.</p>
                <div class="buttons">
                    <a href="#" class="btn demo">Live Demo</a>
                    <a href="#" class="btn code">View Code</a>
                </div>
            </div>
            <div class="projectCard">
                <h2>SecureAuth</h2>
                <p>Login and registration system with rate limiting and password hashing.</p>
                <div class="buttons">
                    <a href="#" class="btn demo">Live Demo</a>
                    <a href="#" class="btn code">View Code</a>
                </div>
            </div>
        </div>
    </div>

    <div class="contactContainer">
        <div class="contactGrid">
            <div class="personalInfo">
                <h2>Personal Info</h2>
                <p><strong>Email:</strong><?= $info['email'] ?></p>
                <p><strong>Phone:</strong> <?= $info['phoneNum'] ?></p>
                <p><strong>Address:</strong> <?= $info['address'] ?></p>
                <p><strong><a href="https://github.com/stooopidkenly">Github</a></strong></p>
                <p><strong><a href="https://www.facebook.com/johnkenly.pamor.13">Facebook</a></strong></p>
                <p><strong><a href="https://www.instagram.com/heykenlyp_/">Instagram</a></strong></p>
            </div>
            <div class="contactFormWrapper">
                <h2>Contact Me</h2>
                <form class="contactForm" action="#" method="POST">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Your Email" required>
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Your Message" rows="6" required></textarea>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2025 John Kenly Pamor. All rights reserved.</p>
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

                const newContainer = this.createTextElement(this.texts[index]);
                this.element.appendChild(newContainer);
                await this.animateIn(newContainer);

                this.isAnimating = false;
            }

            next() {
                this.currentIndex = (this.currentIndex + 1) % this.texts.length;
                this.showText(this.currentIndex);
            }

            start() {
                this.showText(this.currentIndex);
                this.intervalId = setInterval(() => this.next(), this.rotationInterval);
            }

            stop() {
                if (this.intervalId) {
                    clearInterval(this.intervalId);
                }
            }

            init() {
                const srOnly = document.createElement('span');
                srOnly.className = 'text-rotate-sr-only';
                srOnly.textContent = this.texts[this.currentIndex];
                this.element.appendChild(srOnly);

                this.start();
            }
        }

        // Initialize the rotating text
        const rotatingTextElement = document.getElementById('rotatingText');
        const rotatingText = new RotatingText(rotatingTextElement, {
            texts: [
                'a Student',
                'an Aspiring Web Developer',
                'an Aspiring Software Engineer',
                'an Aspiring UI/UX Designer',
                'a Problem Solver',
                'a cutie pie :)'
            ],
            rotationInterval: 1000
        });
    </script>
</body>

</html>