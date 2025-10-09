<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>John Kenly Pamor</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="icon.png">
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

    <!-- <main class="bodyContainer">
        <h1 class="headerTitle">
            Hi! I am <span class="gradient">John Kenly Pamor</span><br>
            An Aspiring <span class="headerTitle1">Software Engineer</span><br>
            and <span class="headerTitle1">Web Developer</span>
        </h1>
    </main> -->

    <main class="bodyContainer">
        <h1 class="headerTitle">
            Hi! I am <span class="gradient">John Kenly Pamor</span><br>
            <span class="typing-text"></span>
        </h1>
    </main>

    <div class="about" id="about">
        <h1>About Me</h1>
        <div class="info">
            <p>Hi! <span style="font-weight: bold;">I'm John Kenly Pamor</span>, an aspiring Software Engineer and Web
                Developer dedicated to solving complex
                problems
                with clean, efficient code. Currently, I'm a college student pursuing Bachelor of Science in
                Information Technology at Camarines Sur Polytechnic Colleges. My technical focus is on backend
                development, specifically
                mastering PHP(Laravel and Codeigniter4) and SQL. I'm committed
                to continuous learning and invite you to look through my portfolio projects to see my skills in action.
            </p>
            <img src="profile.JPG" class="profile" id="profile" alt="John Kenly Pamor">
        </div>
    </div>

    <div class="education" id="education">
        <h1>Education</h1>
        <div class="college">
            <img src="schools/cspc.png" alt="Camarines Sur Polytechnic Colleges">
            <div class="edu-content">
                <span>College</span>
                <p>2023-Present</p>
                <h1>Camarines Sur Polytechnic Colleges</h1>
                <h1>Bachelor of Science in Information Technology</h1>
            </div>
        </div>
        <div class="shs">
            <img src="schools/usi.png" alt="Universidad de Sta. Isabel-Pili Campus">
            <div class="edu-content">
                <span>Senior High School</span>
                <p>2021-2023</p>
                <h1>Universidad de Sta. Isabel-Pili Campus</h1>
                <h1>Science, Technology, Engineering and Mathematics</h1>
            </div>
        </div>
        <div class="jhs">
            <img src="schools/usi.png" alt="Universidad de Sta. Isabel-Pili Campus">
            <div class="edu-content">
                <span>Junior High School</span>
                <p>2021-2023</p>
                <h1>Universidad de Sta. Isabel-Pili Campus</h1>
            </div>
        </div>
        <div class="elementary">
            <img src="schools/pcs.png" alt="Pili Central School">
            <div class="edu-content">
                <span>Elementary</span>
                <p>2011-2017</p>
                <h1>Pili Central School</h1>
            </div>
        </div>
    </div>

    <div class="skillsContainer" id="skills">
        <h1 class="skills">Skills</h1>

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
        <h1 class="projectsTitle">Projects</h1>

        <div class="projectsGrid">

            <div class="projectCard">
                <h2>Deal Or No Deal</h2>
                <p>A simple game developed for educational purpose.</p>
                <div class="buttons">
                    <a href="https://dealornodeal-black.vercel.app/" class="btn demo" target="_blank">Live Demo</a>
                    <a href="https://github.com/stooopidkenly/Deal-or-No-Deal" class="btn code" target="_blank">View
                        Code</a>
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
            <!-- Left Side: Personal Info -->
            <div class="personalInfo">
                <h2>Personal Info</h2>
                <p><strong>Email:</strong> johnkenly@example.com</p>
                <p><strong>Phone:</strong> +63 912 345 6789</p>
                <p><strong>Address:</strong> Pili, Camarines Sur, Philippines</p>
            </div>

            <!-- Right Side: Contact Form -->
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
        <p>Special Credits: AI models and LLMs ❤️</p>
        <p>Bachelor of Science in Information Technology</p>
        <p>Camarines Sur Polytechnic Colleges</p>
    </footer>


    <script>
        const roles = [
            "a Student",
            "an Aspiring Web Developer",
            "an Aspiring Software Engineer",
            "an Aspiring UI/UX Designer",
            "a Problem Solver",
            "a cutie pie"
        ];

        const typingElement = document.querySelector(".typing-text");
        let roleIndex = 0;
        let charIndex = 0;
        let isDeleting = false;

        function typeEffect() {
            const currentRole = roles[roleIndex];
            const displayedText = currentRole.substring(0, charIndex);

            typingElement.textContent = displayedText;

            if (!isDeleting && charIndex < currentRole.length) {
                charIndex++;
                setTimeout(typeEffect, 100);
            } else if (isDeleting && charIndex > 0) {
                charIndex--;
                setTimeout(typeEffect, 50);
            } else {
                if (!isDeleting) {
                    setTimeout(() => (isDeleting = true), 1000);
                } else {
                    isDeleting = false;
                    roleIndex = (roleIndex + 1) % roles.length;
                }
                setTimeout(typeEffect, 500);
            }
        }
        typeEffect();
    </script>

</body>

</html>

<!-- <p class="description">
            Transform ideas into business opportunities<br>
            and deliver swift solutions and results.
        </p> -->