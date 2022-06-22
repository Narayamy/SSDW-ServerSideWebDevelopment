CREATE DATABASE db_student;
USE db_student;
CREATE TABLE student (
student_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
first_name VARCHAR(20) NOT NULL,
last_name VARCHAR(40) NOT NULL,
email VARCHAR(60) NOT NULL,
course VARCHAR(60) NOT NULL,
faculty VARCHAR(60) NOT NULL,
registration_date DATETIME NOT NULL,
PRIMARY KEY (student_id)
);