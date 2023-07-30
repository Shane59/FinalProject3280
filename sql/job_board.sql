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
    datePosted DATE,
    jobType VARCHAR(20) NOT NULL,
    jobDescription VARCHAR(200)
);

CREATE TABLE applications (
    userName VARCHAR(50),
    positionId INT,
    submitDate DATE,
    status VARCHAR(10),
    note VARCHAR(200),
    PRIMARY KEY (userName, positionId),
    FOREIGN KEY (userName) REFERENCES users (userName)
        ON DELETE CASCADE,
    FOREIGN KEY (positionId) REFERENCES positions (positionId)
        ON DELETE CASCADE
);

-- 12345678
INSERT INTO users VALUES('admin', 'Admin', '', TRUE, '$2y$10$d9reYfJ9eHMQkGb44z3B4.3pYwXK3o9RjXBLdGwI9/PXSlCr3TvaS');

-- generate some positions data
-- 1.
-- 1.
INSERT INTO positions (positionName, datePosted, jobType, jobDescription)
VALUES ('Software Engineer', '2023-07-29', 'full-time', 'Developing and maintaining software applications.');

-- 2.
INSERT INTO positions (positionName, datePosted, jobType, jobDescription)
VALUES ('Data Analyst', '2023-07-28', 'part-time', 'Analyzing and interpreting data to provide insights.');

-- 3.
INSERT INTO positions (positionName, datePosted, jobType, jobDescription)
VALUES ('Marketing Manager', '2023-07-27', 'full-time', 'Creating and executing marketing campaigns.');

-- 4.
INSERT INTO positions (positionName, datePosted, jobType, jobDescription)
VALUES ('Sales Representative', '2023-07-26', 'contract', 'Selling products and services.');

-- 5.
INSERT INTO positions (positionName, datePosted, jobType, jobDescription)
VALUES ('Product Designer', '2023-07-25', 'full-time', 'Designing user interfaces and experiences.');

-- 6.
INSERT INTO positions (positionName, datePosted, jobType, jobDescription)
VALUES ('Financial Analyst', '2023-07-24', 'full-time', 'Analyzing financial data and preparing reports.');

-- 7.
INSERT INTO positions (positionName, datePosted, jobType, jobDescription)
VALUES ('Human Resources Coordinator', '2023-07-23', 'internship', 'Assisting with HR tasks and processes.');

-- 8.
INSERT INTO positions (positionName, datePosted, jobType, jobDescription)
VALUES ('Customer Service Representative', '2023-07-22', 'part-time', 'Assisting customers with inquiries and issues.');

-- 9.
INSERT INTO positions (positionName, datePosted, jobType, jobDescription)
VALUES ('Graphic Designer', '2023-07-21', 'contract', 'Creating visual assets for marketing campaigns.');

-- 10.
INSERT INTO positions (positionName, datePosted, jobType, jobDescription)
VALUES ('Administrative Assistant', '2023-07-20', 'part-time', 'Providing administrative support to the team.');

-- 11.
INSERT INTO positions (positionName, datePosted, jobType, jobDescription)
VALUES ('IT Support Specialist', '2023-07-19', 'full-time', 'Providing technical support to employees.');

-- 12.
INSERT INTO positions (positionName, datePosted, jobType, jobDescription)
VALUES ('Content Writer', '2023-07-18', 'internship', 'Creating content for various platforms.');

-- 13.
INSERT INTO positions (positionName, datePosted, jobType, jobDescription)
VALUES ('Project Manager', '2023-07-17', 'full-time', 'Planning and overseeing project execution.');

-- 14.
INSERT INTO positions (positionName, datePosted, jobType, jobDescription)
VALUES ('Operations Analyst', '2023-07-16', 'contract', 'Analyzing operational processes and optimizing efficiency.');

-- 15.
INSERT INTO positions (positionName, datePosted, jobType, jobDescription)
VALUES ('Quality Assurance Tester', '2023-07-15', 'full-time', 'Testing software for bugs and issues.');
