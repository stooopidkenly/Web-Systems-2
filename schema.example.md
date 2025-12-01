<!-- CREATE DATABASE portfolio; -->

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
    photo VARCHAR(255)not null,
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
    skillLevel TINYINT UNSIGNED NOT NULL
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
    certs VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL
)

INSERT INTO certs (id, certs, name) VALUES
(
    1,
    'certs/E Cert BYCIT.png',
    '12th Bicol Youth Congress in Information Technology'
),
(
    2,
    'certs/BY.png',
    '13th Bicol Youth Congress in Information Technology'
);

INSERT INTO admin (username, password) 
VALUES ('admin', 'admin123');
    

INSERT INTO links (platform, link)
VALUES
('Facebook', 'https://facebook.com/yourprofile'),
('Instagram', 'https://instagram.com/yourprofile'),
('GitHub', 'https://github.com/yourprofile'),
('LinkedIn', 'https://linkedin.com/in/yourprofile');


INSERT INTO users (id, name, email, photo, description, address, phoneNum)
VALUES 
(
    1,
    'your name',
    'your email',
    'your profile picture',
    'your description',
    'your address',
    'your number'
);

//change the education info into your actual educational infos
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
    'schools/usi.png',
    '2021',
    '2023',
    'Science, Technology, Engineering and Mathematics'
),

-- Junior High School
(
    'Junior High School',
    'Universidad de Sta. Isabel-Pili Campus',
    'schools/usi.png',
    '2017',
    '2021',
    NULL
),

-- Elementary
(
    'Elementary',
    'Pili Central School',
    'schools/pcs.png',
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

INSERT INTO titles (title) VALUES
('a Student'),
('an Aspiring Web Developer'),
('an Aspiring Software Engineer'),
('an Aspiring UI/UX Designer'),
('a Problem Solver'),
('a cutie pie :)');
