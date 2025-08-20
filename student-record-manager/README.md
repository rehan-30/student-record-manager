# Student Record Manager (PHP + MySQL)

Simple CRUD web app to add, edit, view and delete student records. Designed to run on XAMPP / LAMP.

## Files
- `config.php` — DB connection (edit with your DB settings)
- `index.php` — List students
- `add.php` — Add new student
- `edit.php` — Edit student
- `delete.php` — Delete student
- `student_db.sql` — SQL file to create database and table

## How to run (XAMPP)
1. Start Apache and MySQL in XAMPP control panel.
2. Copy the project folder `student-record-manager` into `htdocs` (e.g. `C:\xampp\htdocs\student-record-manager`).
3. Open phpMyAdmin (http://localhost/phpmyadmin) → Import → choose `student_db.sql` and run.
4. Open browser: http://localhost/student-record-manager/index.php
5. Use the Add Student button to add entries.

## Notes
- Default DB user in `config.php` is `root` with empty password for XAMPP.
- Change `$pass` in `config.php` if your MySQL has a password.
- This is a small project intended for learning and portfolio use.
