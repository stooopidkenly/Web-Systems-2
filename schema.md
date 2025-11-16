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




