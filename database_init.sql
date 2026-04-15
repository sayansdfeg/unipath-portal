-- UniPath Database Schema
-- Create database and users table with password_hash() compatible columns

CREATE DATABASE IF NOT EXISTS unipath_db;
USE unipath_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_created_at (created_at)
);

-- Optional: Create profiles table for uppload.php data
CREATE TABLE IF NOT EXISTS user_profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    dob DATE,
    country VARCHAR(100),
    phone VARCHAR(20),
    english_test VARCHAR(50),
    english_score DECIMAL(5, 2),
    gpa DECIMAL(3, 2),
    interests TEXT,
    resume_file VARCHAR(255),
    test_certificate_file VARCHAR(255),
    essay_text LONGTEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id)
);

-- Optional: Create saved scholarships table
CREATE TABLE IF NOT EXISTS saved_scholarships (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    scholarship_name VARCHAR(255),
    saved_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_scholarship (user_id, scholarship_name)
);

-- Sample admin user (password: admin123)
INSERT INTO users (name, email, password) VALUES 
('Administrator', 'admin@unipath.com', '$2y$10$slYQmyNdGzin7olVMH7jCu0WmG2FCEy7CqEbPHtXKQ4E2uP0gEZJm')
ON DUPLICATE KEY UPDATE id=id;
