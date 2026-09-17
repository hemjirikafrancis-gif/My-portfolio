-- ═══════════════════════════════════════════════════════════
--  InvoicePro — Database Setup
--  Run this in phpMyAdmin or:
--    mysql -u root -p < setup.sql
-- ═══════════════════════════════════════════════════════════

CREATE DATABASE IF NOT EXISTS invoice_generator
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE invoice_generator;

-- ── Users ────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS users (
    id              INT UNSIGNED      NOT NULL AUTO_INCREMENT,
    name            VARCHAR(120)      NOT NULL,
    email           VARCHAR(180)      NOT NULL UNIQUE,
    password        VARCHAR(255)      NOT NULL,
    company_name    VARCHAR(160)      DEFAULT NULL,
    address         TEXT              DEFAULT NULL,
    phone           VARCHAR(50)       DEFAULT NULL,
    currency_symbol VARCHAR(10)       NOT NULL DEFAULT '$',
    created_at      TIMESTAMP         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP         NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Clients ──────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS clients (
    id          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    user_id     INT UNSIGNED  NOT NULL,
    name        VARCHAR(160)  NOT NULL,
    email       VARCHAR(180)  DEFAULT NULL,
    phone       VARCHAR(50)   DEFAULT NULL,
    address     TEXT          DEFAULT NULL,
    created_at  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Invoices ─────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS invoices (
    id              INT UNSIGNED      NOT NULL AUTO_INCREMENT,
    user_id         INT UNSIGNED      NOT NULL,
    client_id       INT UNSIGNED      NOT NULL,
    invoice_number  VARCHAR(60)       NOT NULL,
    status          ENUM('draft','pending','sent','paid','overdue') NOT NULL DEFAULT 'draft',
    issue_date      DATE              NOT NULL,
    due_date        DATE              NOT NULL,
    notes           TEXT              DEFAULT NULL,
    subtotal        DECIMAL(12,2)     NOT NULL DEFAULT 0.00,
    tax_rate        DECIMAL(5,2)      NOT NULL DEFAULT 0.00,
    tax_amount      DECIMAL(12,2)     NOT NULL DEFAULT 0.00,
    discount        DECIMAL(12,2)     NOT NULL DEFAULT 0.00,
    total           DECIMAL(12,2)     NOT NULL DEFAULT 0.00,
    created_at      TIMESTAMP         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP         NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id)   REFERENCES users(id)   ON DELETE CASCADE,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE RESTRICT,
    UNIQUE KEY uq_invoice_number (user_id, invoice_number),
    INDEX idx_user_status   (user_id, status),
    INDEX idx_user_created  (user_id, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Invoice Items ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS invoice_items (
    id          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    invoice_id  INT UNSIGNED  NOT NULL,
    description TEXT          NOT NULL,
    quantity    DECIMAL(10,2) NOT NULL DEFAULT 1.00,
    unit_price  DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    amount      DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    PRIMARY KEY (id),
    FOREIGN KEY (invoice_id) REFERENCES invoices(id) ON DELETE CASCADE,
    INDEX idx_invoice_id (invoice_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ═══════════════════════════════════════════════════════════
--  Setup complete! 
--  Now update includes/db.php with your MySQL credentials.
-- ═══════════════════════════════════════════════════════════
