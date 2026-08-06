ALTER TABLE products ADD COLUMN gender ENUM('nam', 'nu', 'unisex') DEFAULT 'unisex' AFTER description;

UPDATE categories SET name = 'Chạy bộ' WHERE name = 'Running' OR name = 'Chạy bộ';

INSERT INTO categories (name, description) 
SELECT * FROM (SELECT 'Bóng rổ', 'Giày bóng rổ') AS tmp 
WHERE NOT EXISTS (SELECT name FROM categories WHERE name = 'Bóng rổ') LIMIT 1;

INSERT INTO categories (name, description) 
SELECT * FROM (SELECT 'Đá bóng', 'Giày đá bóng') AS tmp 
WHERE NOT EXISTS (SELECT name FROM categories WHERE name = 'Đá bóng') LIMIT 1;
