DROP DATABASE IF EXISTS job_board;
CREATE DATABASE job_board;
USE job_board;

CREATE TABLE users (
	userName VARCHAR(50) NOT NULL PRIMARY KEY,
	first_name VARCHAR(20),	
	last_name VARCHAR(20),
    isAdmin BOOLEAN DEFAULT FALSE,
	password VARCHAR(250)
);

CREATE TABLE positions (
    positionId INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    positionName VARCHAR(50) NOT NULL,
    datePosted DATE NOT NULL,
    jobType VARCHAR(20),
    jobDescription VARCHAR(200)
);

CREATE TABLE applications (
    userName VARCHAR(50),
    positionId INT,
    submitDate DATE,
    status VARCHAR(10),
    note VARCHAR(200),
    FOREIGN KEY (userName) REFERENCES users (userName)
        ON DELETE CASCADE,
    FOREIGN KEY (positionId) REFERENCES positions (positionId)
);

INSERT INTO users VALUES('admin', 'Shinya', 'Aoi', TRUE, '12345678');

