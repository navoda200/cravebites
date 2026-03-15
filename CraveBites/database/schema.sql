CREATE DATABASE IF NOT EXISTS cravebites_db;
USE cravebites_db;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(300) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    body TEXT NOT NULL,
    published_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(180) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (name, description, price, image_url) VALUES
('Classic Burger', 'Grilled beef patty with cheddar and signature sauce.', 8.99, 'https://images.unsplash.com/photo-1550547660-d9450f859349?w=800'),
('Chicken Wrap', 'Spicy chicken wrap with fresh lettuce and mayo.', 6.50, 'https://images.unsplash.com/photo-1530469912745-a215c6b256ea?w=800'),
('Veggie Bowl', 'Healthy bowl with quinoa, avocado, and greens.', 7.25, 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800');

INSERT INTO news (title, body) VALUES
('Grand Opening Offer', 'Enjoy a 20 percent discount on your first order this week.'),
('Now Serving Breakfast', 'Our breakfast menu is available from 7:00 AM every day.');
