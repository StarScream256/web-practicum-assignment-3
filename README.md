# Praktikum Pemrograman Web - Tugas 3 - CRUD Pendaftaran Bimbel

This project is a submission for the Web Practicum "Tugas 3" assignment, implementing a full CRUD application in PHP with a MySQL database.

## Features

Create: Add new applicant data via a form with a confirmation modal.

Read: View all applicants in a DataTables-powered dashboard and see a detailed breakdown for each applicant.

Update: Modify existing applicant information. The "Update" button is disabled until a change is made.

Delete: Remove an applicant with a confirmation modal.

Security: Uses prepared statements in the controller for all database operations to prevent SQL injection.

## How to Run This Project

### 1. Database Setup

Open the `/sql/database.sql` file in a MySQL management tool (like phpMyAdmin).

Import the file to create the bimbel database (or your chosen name) and the pendaftar table.

### 2. Configuration

In the `/config` directory, find the file `db_credentials.example.php`.

Make a copy of this file in the same folder and rename it to `db_credentials.php`.

Open `db_credentials.php` and update the `$hostname`, `$username`, `$password`, and `$database` variables to match your local MySQL setup.

### 3. Running the Application

Once the database and credentials are set up, open the project's root folder in your browser. The `index.php` file will automatically redirect you to the main dashboard.
