CREATE DATABASE IF NOT EXISTS php_mvc_crud CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE php_mvc_crud;

DROP TABLE IF EXISTS products;
CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  price DECIMAL(12,2) NOT NULL DEFAULT 0,
  description TEXT,
  image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO products (name, price, description, image) VALUES
('Bút bi Thiên Long', 5000, 'Bút bi xanh 0.5mm', NULL),
('Giấy A4', 65000, 'Ram giấy A4 70gsm', NULL),
('Kẹp giấy', 12000, 'Kẹp tài liệu 41mm', NULL);
