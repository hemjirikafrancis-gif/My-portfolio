-- Hemjirika's Pharmaceuticals - Contact Form Database
-- Import this file in phpMyAdmin:
--   1. Open phpMyAdmin (usually http://localhost/phpmyadmin)
--   2. Click "New" in the left sidebar to create a database, name it: hemjirikas_pharmaceuticals
--   3. Click on the new database, then go to the "Import" tab
--   4. Choose this file (hemjirikas_contact.sql) and click "Go"
--
-- This will create the database (if it doesn't exist) and the
-- "contact_messages" table used to store submissions from the contact form.

CREATE DATABASE IF NOT EXISTS hemjirikas_pharmaceuticals CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE hemjirikas_pharmaceuticals;

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
