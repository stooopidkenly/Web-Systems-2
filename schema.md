CREATE DATABASE portfolio;

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR (100) NOT NULL,
    address VARCHAR(255),
    phoneNum VARCHAR(20),
    description TEXT
);

CREATE TABLE education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    level VARCHAR(100) NOT NULL,
    schoolName VARCHAR(255) NOT NULL,
    logo VARCHAR(255), 
    start_year VARCHAR(20),
    end_year VARCHAR(20),
    program VARCHAR(255)
);

CREATE TABLE skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    skillName VARCHAR(100) NOT NULL,
    skillLevel TINYINT UNSIGNED NOT NULL,
);

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    projectName VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    liveDemo VARCHAR(255),
    sourceCode VARCHAR(255),
    image VARCHAR(255)
);

CREATE TABLE links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    platform VARCHAR(100) NOT NULL,
    link VARCHAR(255) NOT NULL
);

CREATE TABLE titles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL
);

CREATE TABLE certs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    certs VARCHAR(255) NOT NULL
)

INSERT INTO certs (id, certs) VALUES
(
    1,
    'certs/E Cert BYCIT.png'
),
(
    2,
    'certs/BY.png'
)
    


INSERT INTO links (platform, link)
VALUES
('Facebook', 'https://facebook.com/yourprofile'),
('Instagram', 'https://instagram.com/yourprofile'),
('GitHub', 'https://github.com/yourprofile'),
('LinkedIn', 'https://linkedin.com/in/yourprofile');


INSERT INTO users (id, name, email, description, address, phoneNum)
VALUES 
(
    1,
    'John Kenly Pamor',
    'johnkenlypamor13@gmail.com',
    'Hi! I''m John Kenly Pamor, an aspiring Software Engineer and Web Developer dedicated to solving complex problems with clean, efficient code. Currently, I''m a college student pursuing Bachelor of Science in Information Technology at Camarines Sur Polytechnic Colleges. My technical focus is on backend development, specifically mastering PHP(Laravel and Codeigniter4) and SQL. I''m committed to continuous learning and invite you to look through my portfolio projects to see my skills in action.',
    'Pili, Camarines Sur, Philippines',
    '+649123456789'
);

INSERT INTO education (level, schoolName, logo, start_year, end_year, program)
VALUES
-- College
(
    'College',
    'Camarines Sur Polytechnic Colleges',
    'schools/cspc.png',
    '2023',
    'Present',
    'Bachelor of Science in Information Technology'
),

-- Senior High School
(
    'Senior High School',
    'Universidad de Sta. Isabel-Pili Campus',
    'schools/usipili.png',
    '2021',
    '2023',
    'Science, Technology, Engineering and Mathematics'
),

-- Junior High School
(
    'Junior High School',
    'Universidad de Sta. Isabel-Pili Campus',
    'schools/usipili.png',
    '2017',
    '2021',
    NULL
),

-- Elementary
(
    'Elementary',
    'Pili Central School',
    'schools/pili_central.png',
    '2011',
    '2017',
    NULL
);

INSERT INTO skills (skillName, skillLevel) VALUES
('HTML', 90),
('CSS', 30),
('Javascript', 10),
('PHP', 90),
('Laravel', 90),
('CodeIgniter4', 70),
('SQL', 90),
('FIGMA', 50);

INSERT INTO projects (projectName, description, liveDemo, sourceCode, image)
VALUES
(
    'Portfolio Website',
    'A personal portfolio showcasing my skills, education, and projects.',
    'https://your-demo-link.com',
    'https://github.com/yourgithub/portfolio',
    'projects/portfolio.png'
),
(
    'Simple CRUD System',
    'A CRUD application built using PHP and MySQL with authentication.',
    'https://your-crud-demo.com',
    'https://github.com/yourgithub/crud-system',
    'projects/crud.png'
),
(
    'Task Manager App',
    'A basic task manager with add, update, delete, and mark-done features.',
    'https://your-task-demo.com',
    'https://github.com/yourgithub/task-manager',
    'projects/task.png'
);

