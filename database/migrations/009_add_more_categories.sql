-- Cập nhật danh mục
UPDATE categories SET name = 'Chạy bộ' WHERE name = 'Running';

-- Thêm danh mục mới
INSERT INTO categories (name, description) 
SELECT * FROM (SELECT 'Bóng rổ', 'Giày chơi bóng rổ') AS tmp 
WHERE NOT EXISTS (SELECT name FROM categories WHERE name = 'Bóng rổ') LIMIT 1;

INSERT INTO categories (name, description) 
SELECT * FROM (SELECT 'Đá bóng', 'Giày đá bóng sân cỏ') AS tmp 
WHERE NOT EXISTS (SELECT name FROM categories WHERE name = 'Đá bóng') LIMIT 1;

INSERT INTO categories (name, description) 
SELECT * FROM (SELECT 'Tennis', 'Giày chơi quần vợt') AS tmp 
WHERE NOT EXISTS (SELECT name FROM categories WHERE name = 'Tennis') LIMIT 1;

INSERT INTO categories (name, description) 
SELECT * FROM (SELECT 'Tập Gym', 'Giày tập thể hình') AS tmp 
WHERE NOT EXISTS (SELECT name FROM categories WHERE name = 'Tập Gym') LIMIT 1;
