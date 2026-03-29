# School Encoding Module - MVC Refactor

## Overview
The School Encoding Module is a PHP web application refactored using the Model–View–Controller (MVC) architecture.
The system manages academic data such as users, programs, and subjects while implementing authentication, role-based access control, and organized application structure

## MVC Structure Explanation
1. Models (app/Models)
Handles database interaction and business logic.
- User.php – user management and authentication data
- Program.php – program CRUD operations
- Subject.php – subject CRUD operations

2. Views (app/Views)
Responsible for user interface and presentation.
- Displays forms, tables, and pages
- Receives data from controllers
- Contains minimal logic

3. Controllers (app/Controllers)
Acts as the application logic layer.
- Receives requests from the router
- Validates user access
- Calls models
- Loads appropriate views

4. Core System (app/Core)
Provides reusable system components:
- Autoloader.php – automatic class loading
- Controller.php – base controller utilities
- Auth.php – authentication and access control
- SessionManager.php – session handling
- Database.php – database connection

5. Public Entry Point (public/index.php)
Serves as the front controller:
- Starts sessions
- Routes requests using:

index.php?controller=NAME&action=METHOD



## Default Admin Credentials
- **Username:** admin  
- **Password:** admin12345



## Setup Instructions (XAMPP)
0. Install XAMPP.
1. Copy the project folder to `xampp/htdocs/`.
2. Start Apache and MySQL in XAMPP.
3. Open `http://localhost/PhpProject_B/` in your browser.
4. Import `school.sql`:
   - Open `phpMyAdmin` → Create a database `school` → Import → Choose `school.sql`.
5. Login using default admin credentials.

## IMPORTANT
Double check Database.php if you are in the right server
Default = 3307

## Features
- MVC Architecture Implementation
- Object-Oriented PHP Design
- User Authentication System
- Role-Based Access Control (admin, staff, teacher, student)
- CRUD Operations:
      - Users
      - Programs
      - Subjects
- Password hashing for security
- Session-based login management

## Autoloading
Custom PHP autoloading is implemented using: app/Core/Autoloader.php
No composer.json file is required for this project.

## Folder Structure (Simplified)

app/
├── Controllers/
├── Core/
├── Models/
└── Views/
config/
public/
README.txt
school.sql

## Notes
- Passwords are securely hashed using PHP password hashing functions.
- Access permissions restrict features based on account role.
- public/index.php serves as the single entry point of the application.
