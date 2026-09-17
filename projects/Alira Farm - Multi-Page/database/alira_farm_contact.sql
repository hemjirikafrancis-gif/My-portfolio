-- ALIRA Farm - Contact Form Database
-- Import this file in phpMyAdmin:
--   1. Open phpMyAdmin (usually http://localhost/phpmyadmin)
--   2. Click "New" in the left sidebar to create a database, name it: alira_farm
--   3. Click on the new "alira_farm" database, then go to the "Import" tab
--   4. Choose this file (alira_farm_contact.sql) and click "Go"
--
-- This will create the "alira_farm" database (if it doesn't exist) and the
-- "contact_messages" table used to store submissions from the contact form.

CREATE DATABASE IF NOT EXISTS alira_farm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE alira_farm;

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    subject VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
