CREATE DATABASE school_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    family_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(20),
    full_name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL,
    random_code INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    level VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO users (family_name, email, phone , full_name ,password ,role , random_code ,image_path, level,created_at , updated_at )
VALUES ('Ali Elshamsey', 'it@m-hub.ae', '+971506045201' , 'mohamed moustafa','$2y$10$7EObOMsaMamIZcOfZqtUhuI4Qn9oebpMq6gMHmMwFeoacJr1v7CT.','it', '52011808','','','2023-10-23 09:36:48','2023-10-30 13:34:44');



INSERT INTO users (family_name, email, phone , full_name ,password ,role , random_code , image_path, level,created_at , updated_at )
VALUES ('مدرس', 'finance@m-hub.ae', '+971506045201' , 'مدرس محمد','$2y$10$7EObOMsaMamIZcOfZqtUhuI4Qn9oebpMq6gMHmMwFeoacJr1v7CT.','Teacher', '17243165','uploads/images.jpeg','','2023-10-23 09:36:48','2023-10-30 13:34:44' );


INSERT INTO users (family_name, email, phone , full_name ,password ,role , random_code , image_path, level,created_at , updated_at  )
VALUES ('طالب', 'shams@shams.com', '+971506045201' , 'Mohamed shams','$2y$10$7EObOMsaMamIZcOfZqtUhuI4Qn9oebpMq6gMHmMwFeoacJr1v7CT.','student', '87673465',' uploads/mohamed-shams.jpeg','Beginner','2023-10-23 09:36:48','2023-10-30 13:34:44');



CREATE TABLE help_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL,
    random_code INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE money_files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    text_value VARCHAR(255) NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    file_data VARCHAR(255) NOT NULL,
   
    random_code VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE user
ADD name VARCHAR(255) NOT NULL;


CREATE TABLE teacher_files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    file_path VARCHAR(255),
    code VARCHAR(50),
   username VARCHAR(255),
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE student_files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    file_path VARCHAR(255),
    code VARCHAR(50),
    username VARCHAR(255),
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE money_teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    month VARCHAR(255),
    full_name VARCHAR(255),
    basic_salary INT,
     additions INT,
      deductions INT,
       totalSalary INT,
    code VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO money_teachers (basic_salary, additions, deductions , totalSalary ,full_name,code , month )
VALUES ('10', '50', '5' , '0' ,'mohamed', '52718225' ,'November');

CREATE TABLE content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    text TEXT NOT NULL,
    link VARCHAR(255),
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    random_code VARCHAR(255) NOT NULL,
    teacher_name VARCHAR(255) NOT NULL,
    user_code VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);











DELIMITER //
CREATE TRIGGER update_teacher_name_trigger
AFTER UPDATE ON users FOR EACH ROW
BEGIN
    UPDATE content
    SET teacher_name = NEW.full_name
    WHERE user_code = NEW.random_code;
END;
//
DELIMITER ;
