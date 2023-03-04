CREATE TABLE usergroup (

	id 			INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	createdby 	INT NOT NULL,
	updatedby 	INT NOT NULL,

	title	 	VARCHAR(75) NOT NULL,
	lasttime 	VARCHAR(16) NOT NULL,
	profilepic 	TEXT
);


CREATE TABLE groupmember (
	
	id 		INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	groupid INT NOT NULL,
	userid 	INT NOT NULL,
);


CREATE TABLE groupmessage (

	id			INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	groupid 	INT NOT NULL,
	userid 		INT NOT NULL,
	createat 	VARCHAR(16) NOT NULL,
	message 	TINYTEXT NOT NULL
);


CREATE TABLE privatemessage (

	id 			INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	userid 		INT NOT NULL,
	recvid 		INT NOT NULL,
	createat 	VARCHAR(16) NOT NULL,
	message 	TINYTEXT NOT NULL
);