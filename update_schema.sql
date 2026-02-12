USE crud_db;
ALTER TABLE users ADD COLUMN department VARCHAR(100) AFTER email;
ALTER TABLE users ADD COLUMN fee DECIMAL(10,2) AFTER department;