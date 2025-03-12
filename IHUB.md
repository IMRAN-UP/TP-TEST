# IHUB Internship Management System

Welcome to IHUB! This project aims to streamline the management of internships by providing an intuitive and user-friendly platform for administrators. Below you'll find detailed information about the setup, database schema, and features of the IHUB system.

## Table of Contents

1. [Project Overview](#project-overview)
2. [Database Schema](DATA\INTERN_GESTION.sql)
3. [Features](#features)
4. [Installation](#installation)
5. [Usage](#usage)
6. [Help](#help)
7. [Contact](#contact)

## Project Overview

IHUB is a web-based application designed to manage internships efficiently. It includes features for managing administrators, interns, departments, and internships. The IHUB Dashboard provides easy access to all essential functions, making it simple to oversee and coordinate internship programs.

## Database Schema

The database consists of four main tables: `Administrator`, `Intern`, `Departement`, and `Internship`. Below is a description of each table and its columns:

- **Administrator**: Stores information about system administrators.

  - `Id_Admin` (INT, PRIMARY KEY, AUTO_INCREMENT): Unique identifier for administrators.
  - `Name_Admin` (VARCHAR(50), NOT NULL): Name of the administrator.
  - `Password_Admin` (VARCHAR(50), NOT NULL): Password for administrator login.
- **Intern**: Stores information about interns.

  - `Id_Intern` (INT, PRIMARY KEY, AUTO_INCREMENT): Unique identifier for interns.
  - `First_Name` (VARCHAR(50), NOT NULL): First name of the intern.
  - `Last_Name` (VARCHAR(50), NOT NULL): Last name of the intern.
  - `Birthday` (DATE, NOT NULL): Birth date of the intern.
  - `Id_Admin` (INT, FOREIGN KEY): References the administrator responsible for the intern.
- **Departement**: Stores information about departments.

  - `Id_Depart` (INT, PRIMARY KEY, AUTO_INCREMENT): Unique identifier for departments.
  - `Id_Admin` (INT, FOREIGN KEY): References the administrator responsible for the department.
  - `Name_Depart` (VARCHAR(50), NOT NULL): Name of the department.
- **Internship**: Stores information about internships.

  - `Id_Internship` (INT, PRIMARY KEY, AUTO_INCREMENT): Unique identifier for internships.
  - `Id_Intern` (INT, FOREIGN KEY): References the intern participating in the internship.
  - `Id_Depart` (INT, FOREIGN KEY): References the department offering the internship.
  - `Id_Admin` (INT, FOREIGN KEY): References the administrator overseeing the internship.
  - `StartDate` (DATE, NOT NULL): Start date of the internship.
  - `EndDate` (DATE, NOT NULL): End date of the internship.

## Features

### Administrator Panel

- Manage system users and settings.
- Secure login and password management.

### Intern Directory

- View and manage intern profiles.
- Track intern progress and milestones.

### Department Management

- Oversee department information.
- Assign interns to specific departments.

### Internship Programs

- Detail all offered programs.
- Enable intern assignments and progress tracking.

## Installation

1. **Clone the repository**:
   ```bash
   git clone <repository-url>
   cd ihub
   ```
