CREATE DATABASE alumni_portal;

USE alumni_portal;

CREATE TABLE usercred (
	
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	
	rollno VARCHAR(12) NOT NULL,
	hash VARCHAR(32) NOT NULL,
	token VARCHAR(64) NOT NULL,
	lastTime VARCHAR(16) NOT NULL,
	
	fname VARCHAR(20) NOT NULL,
	mname VARCHAR(20) NOT NULL,
	lname VARCHAR(20) NOT NULL,
	email VARCHAR(50) NOT NULL
);


CREATE TABLE useraddress (
	rollno VARCHAR(12) NOT NULL,
	pincode VARCHAR(6) NOT NULL,
	addressline1 VARCHAR(150),
	addressline2 VARCHAR(150),
	sociallink1 VARCHAR(100),
	sociallink2 VARCHAR(100),
	phone1 VARCHAR(12),
	phone2 VARCHAR(12),
	parentphone VARCHAR(12),
	city VARCHAR(20),
	curstate VARCHAR(20)
);