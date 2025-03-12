-- Create the database for intern management
CREATE DATABASE IHUB;

-- Create table for Administrators
CREATE TABLE Administrator (
    Id_Admin INT PRIMARY KEY AUTO_INCREMENT, -- Unique identifier for administrators
    Name_Admin VARCHAR(50) NOT NULL, -- Name of the administrator
    Password_Admin VARCHAR(50) NOT NULL -- Password for administrator login
);

-- Create table for Interns
CREATE TABLE INTERN (
    Id_Intern INT PRIMARY KEY AUTO_INCREMENT, 
    First_Name VARCHAR(50) NOT NULL,
    Last_Name VARCHAR(50) NOT NULL, 
    Birthday DATE NOT NULL,
    Id_Admin INT ,
    FOREIGN KEY (Id_Admin) REFERENCES Administrator (Id_Admin)
);

-- Create table for Departments
CREATE TABLE DEPARTEMENT (
    Id_Depart INTEGER PRIMARY KEY AUTO_INCREMENT, 
    Id_Admin INT, 
    Name_Depart VARCHAR(50) NOT NULL,
    FOREIGN KEY (Id_Admin) REFERENCES Administrator(Id_Admin)
);

-- Create table for Internships
CREATE TABLE INTERNSHIP (
    Id_Internship INTEGER PRIMARY KEY AUTO_INCREMENT,
    Id_Intern INT,
    Id_Depart INT, 
    Id_Admin INT, 
    StartDate DATE NOT NULL,
    EndDate DATE NOT NULL,
    FOREIGN KEY (Id_Intern) REFERENCES INTERN(Id_Intern), 
    FOREIGN KEY (Id_Depart) REFERENCES DEPARTEMENT(Id_Depart), 
    FOREIGN KEY (Id_Admin) REFERENCES Administrator(Id_Admin)
);

-- Create a user and grant privileges for the project
CREATE USER 'IMRANE'@'localhost' IDENTIFIED BY '0707';
GRANT SELECT,UPDATE ON IHUB.administrator TO 'IMRANE'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON IHUB.departement TO 'IMRANE'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON IHUB.intern TO 'IMRANE'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON IHUB.internship TO 'IMRANE'@'localhost';



