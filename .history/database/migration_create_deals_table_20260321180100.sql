CREATE TABLE IF NOT EXISTS deals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    tag VARCHAR(60) DEFAULT NULL,
    short_note VARCHAR(255) NOT NULL,
    items_text TEXT NOT NULL,
    deal_price_lkr DECIMAL(10,2) NOT NULL,
    original_price_lkr DECIMAL(10,2) NOT NULL DEFAULT 0,
    image_url VARCHAR(300) DEFAULT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO deals (title, tag, short_note, items_text, deal_price_lkr, original_price_lkr, image_url, is_active)
SELECT
    'Lunch Saver Combo',
    'Save 12%',
    'Main + side + drink at a discounted bundle price.',
    'Chicken Kottu\nCheese Fries\nLemon Iced Tea',
    2490,
    2830,
    'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1200',
    1
WHERE NOT EXISTS (SELECT 1 FROM deals WHERE title = 'Lunch Saver Combo');

INSERT INTO deals (title, tag, short_note, items_text, deal_price_lkr, original_price_lkr, image_url, is_active)
SELECT
    'Family Value Combo',
    'Save 15%',
    'Perfect for sharing with generous portions and better savings.',
    'Mixed Grill Platter\nLoaded Fries Basket\nClassic Cola',
    4190,
    4930,
    'https://images.unsplash.com/photo-1552566626-52f8b828add9?w=1200',
    1
WHERE NOT EXISTS (SELECT 1 FROM deals WHERE title = 'Family Value Combo');

INSERT INTO deals (title, tag, short_note, items_text, deal_price_lkr, original_price_lkr, image_url, is_active)
SELECT
    'Weekend Chill Combo',
    'Save 10%',
    'Your favorite comfort picks bundled for the weekend.',
    'Spinach Pesto Pasta\nMozzarella Sticks\nSparkling Water',
    3290,
    3650,
    'https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?w=1200',
    1
WHERE NOT EXISTS (SELECT 1 FROM deals WHERE title = 'Weekend Chill Combo');
