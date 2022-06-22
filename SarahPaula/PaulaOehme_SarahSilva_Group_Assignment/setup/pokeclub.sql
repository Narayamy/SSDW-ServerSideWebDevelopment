CREATE DATABASE pokeclub;
USE pokeclub;
CREATE TABLE user_info (
	user_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(60) NOT NULL,
	last_name VARCHAR(60) NOT NULL,
	nickname VARCHAR (60) NOT NULL,
	email VARCHAR(60) NOT NULL,
	dob DATE NOT NULL,
	gender enum ('Female', 'Male') NOT NULL,
	location VARCHAR(60) NOT NULL,
	team enum ('Valor', 'Instinct', 'Mystic') NOT NULL,
	picture_id MEDIUMINT UNSIGNED,
	password CHAR(40) NOT NULL,
	registration_date DATETIME NOT NULL,
	PRIMARY KEY (user_id)
);

CREATE TABLE relationship(
	user_one_id MEDIUMINT UNSIGNED NOT NULL,
	user_two_id MEDIUMINT UNSIGNED NOT NULL,
	status TINYINT UNSIGNED NOT NULL,
	action_user_id MEDIUMINT UNSIGNED NOT NULL,
	PRIMARY KEY(user_one_id, user_two_id)
);

CREATE TABLE feed_post(
	status TINYINT UNSIGNED NOT NULL,
	post_id MEDIUMINT UNSIGNED NOT NULL,
	PRIMARY KEY(status)
);

CREATE TABLE post(
	post_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id MEDIUMINT UNSIGNED NOT NULL,
	comment_id MEDIUMINT UNSIGNED,
	post_message VARCHAR(255) NOT NULL,
	like_id MEDIUMINT UNSIGNED,
	post_date DATETIME NOT NULL,
	picture_id MEDIUMINT UNSIGNED NOT NULL,
	PRIMARY KEY(post_id)
);

CREATE TABLE likes(
	like_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id MEDIUMINT UNSIGNED NOT NULL,
	PRIMARY KEY(like_id)
);

CREATE TABLE commment(
	comment_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	post_message VARCHAR(200) NOT NULL,
	comment_date DATETIME NOT NULL,
	PRIMARY KEY(comment_id)
);

CREATE TABLE picture(
	picture_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	picture_name VARCHAR (60) NOT NULL,
	picture_address VARCHAR (255) NOT NULL,
	PRIMARY KEY(picture_id)
);


/* https://www.codedodle.com/2014/12/social-network-friends-database.html */ 
