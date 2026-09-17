-- ============================================================
-- Employee Attendance System (E.A.S.) Database
-- Import this file into phpMyAdmin or run via MySQL CLI
-- ============================================================

CREATE DATABASE IF NOT EXISTS eas_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE eas_db;

-- Departments
CREATE TABLE IF NOT EXISTS departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Employees
CREATE TABLE IF NOT EXISTS employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    emp_id VARCHAR(20) UNIQUE NOT NULL,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    department_id INT,
    position VARCHAR(100),
    monthly_salary DECIMAL(12,2) DEFAULT 0.00,
    work_start_time TIME DEFAULT '08:00:00',
    grace_period_minutes INT DEFAULT 15,
    pin VARCHAR(6) NOT NULL,
    status ENUM('active','inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE SET NULL
);

-- Attendance Records
CREATE TABLE IF NOT EXISTS attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    clock_in DATETIME,
    clock_out DATETIME,
    date DATE NOT NULL,
    minutes_late INT DEFAULT 0,
    penalty_amount DECIMAL(10,2) DEFAULT 0.00,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_emp_date (employee_id, date),
    FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE
);

-- Penalty Rules
CREATE TABLE IF NOT EXISTS penalty_rules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rule_name VARCHAR(100) NOT NULL,
    minutes_late_from INT NOT NULL,
    minutes_late_to INT,
    penalty_type ENUM('fixed','percentage') DEFAULT 'fixed',
    penalty_value DECIMAL(10,2) NOT NULL,
    description TEXT,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Monthly Deduction Summary
CREATE TABLE IF NOT EXISTS monthly_deductions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    month INT NOT NULL,
    year INT NOT NULL,
    total_late_days INT DEFAULT 0,
    total_minutes_late INT DEFAULT 0,
    total_penalty DECIMAL(12,2) DEFAULT 0.00,
    salary_before DECIMAL(12,2) DEFAULT 0.00,
    salary_after DECIMAL(12,2) DEFAULT 0.00,
    finalized TINYINT(1) DEFAULT 0,
    finalized_at DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_emp_month (employee_id, month, year),
    FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE
);

-- Admin Users
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(80) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(150),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================
-- Seed Data
-- ============================================================

INSERT INTO departments (name) VALUES ('Management'),('Human Resources'),('Finance'),('IT'),('Operations');

Default admin: username=admin password=admin123
INSERT INTO admins (username, password, full_name)
VALUES ('admin', '$2y$12$GfEoGAXYCpUVqUUmEHKmDuASsVjJHVrTlnhzqVV5RXqvbP2KqRUkq', 'System Administrator');

-- Default penalty rules
INSERT INTO penalty_rules (rule_name, minutes_late_from, minutes_late_to, penalty_type, penalty_value, description) VALUES
('Minor Late (16–30 min)',  16,  30,  'fixed',      500.00, 'Arrives 16 to 30 minutes after grace period'),
('Moderate Late (31–60 min)',31, 60,  'fixed',     1000.00, 'Arrives 31 to 60 minutes late'),
('Severe Late (1–2 hrs)',   61, 120, 'percentage',    1.00, '1% of monthly salary'),
('Half Day (2+ hrs)',      121, NULL,'percentage',    5.00, '5% of monthly salary');

-- Sample employees (PIN: 1234 for all)
INSERT INTO employees (emp_id, full_name, email, department_id, position, monthly_salary, work_start_time, grace_period_minutes, pin) VALUES
('EAS-001','Amara Okonkwo','amara@eas.com', 1,'General Manager',   350000.00,'08:00:00',15,'1234'),
('EAS-002','Bello Musa',   'bello@eas.com', 4,'Senior Developer',  220000.00,'08:00:00',15,'1234'),
('EAS-003','Chidinma Eze', 'chidinma@eas.com',2,'HR Officer',      180000.00,'08:00:00',15,'1234'),
('EAS-004','David Abubakar','david@eas.com',3,'Accountant',        200000.00,'08:00:00',15,'1234'),
('EAS-005','Fatima Suleiman','fatima@eas.com',5,'Operations Lead', 210000.00,'08:00:00',15,'1234');
