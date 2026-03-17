CREATE DATABASE IF NOT EXISTS cravebites_db;
USE cravebites_db;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    category VARCHAR(80) NOT NULL DEFAULT 'Main Courses',
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

INSERT INTO products (name, category, description, price, image_url) VALUES
('Classic Burger', 'Main Courses', 'Grilled beef patty with cheddar and signature sauce.', 8.99, 'https://images.unsplash.com/photo-1550547660-d9450f859349?w=800'),
('Chicken Wrap', 'Main Courses', 'Spicy chicken wrap with fresh lettuce and mayo.', 6.50, 'https://images.unsplash.com/photo-1530469912745-a215c6b256ea?w=800'),
('Veggie Bowl', 'Main Courses', 'Healthy bowl with quinoa, avocado, and greens.', 7.25, 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800'),
('Teriyaki Chicken Rice', 'Main Courses', 'Grilled chicken glazed in teriyaki served with steamed rice.', 9.80, 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=800'),
('Beef Steak Plate', 'Main Courses', 'Juicy grilled beef steak with herb butter and vegetables.', 14.90, 'https://images.unsplash.com/photo-1544025162-d76694265947?w=800'),
('Seafood Pasta', 'Main Courses', 'Creamy pasta tossed with shrimp and calamari.', 12.75, 'https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?w=800'),
('Chicken Alfredo', 'Main Courses', 'Classic fettuccine alfredo with grilled chicken.', 11.20, 'https://images.unsplash.com/photo-1645112411341-6c4fd023882c?w=800'),
('Spicy Beef Ramen', 'Main Courses', 'Rich spicy broth with beef slices and spring onions.', 10.40, 'https://images.unsplash.com/photo-1557872943-16a5ac26437e?w=800'),
('Mushroom Risotto', 'Main Courses', 'Creamy arborio rice with sauteed mushrooms and parmesan.', 10.10, 'https://images.unsplash.com/photo-1476124369491-e7addf5db371?w=800'),
('Grilled Salmon Bowl', 'Main Courses', 'Lemon herb salmon with quinoa and greens.', 13.60, 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=800'),
('BBQ Chicken Pizza', 'Main Courses', 'Wood-fired pizza topped with BBQ chicken and onions.', 11.50, 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=800'),
('Beef Lasagna', 'Main Courses', 'Layered lasagna with rich beef ragu and cheese.', 10.95, 'https://images.unsplash.com/photo-1619895092538-128341789043?w=800'),
('Thai Green Curry', 'Main Courses', 'Thai green curry with chicken and jasmine rice.', 9.70, 'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=800'),
('Butter Chicken', 'Main Courses', 'Creamy tomato butter chicken served with naan.', 10.80, 'https://images.unsplash.com/photo-1603894584373-5ac82b2ae398?w=800'),
('Fish and Chips', 'Main Courses', 'Crispy battered fish with fries and tartar sauce.', 9.90, 'https://images.unsplash.com/photo-1544982503-9f984c14501a?w=800'),
('Lamb Kofta Plate', 'Main Courses', 'Seasoned lamb kofta with rice and salad.', 12.30, 'https://images.unsplash.com/photo-1529006557810-274b9b2fc783?w=800'),

('Paneer Tikka Masala', 'Main Courses', 'Charred paneer cubes in creamy masala gravy.', 9.20, 'https://images.unsplash.com/photo-1596797038530-2c107229654b?w=800'),
('Chicken Shawarma Plate', 'Main Courses', 'Marinated shawarma chicken with garlic sauce and rice.', 9.85, 'https://images.unsplash.com/photo-1529006557810-274b9b2fc783?w=800'),
('Mediterranean Bowl', 'Main Courses', 'Falafel, hummus, couscous, and fresh vegetables.', 8.95, 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800'),
('Philly Cheese Steak', 'Main Courses', 'Loaded steak sandwich with melted cheese and peppers.', 10.60, 'https://images.unsplash.com/photo-1521305916504-4a1121188589?w=800'),
('Garlic Bread Basket', 'Sides', 'Toasted garlic bread with parsley butter.', 3.50, 'https://images.unsplash.com/photo-1573140247632-f8fd74997d5c?w=800'),
('Onion Rings', 'Sides', 'Crispy golden onion rings served with dip.', 3.90, 'https://images.unsplash.com/photo-1639024471283-03518883512d?w=800'),
('Cheese Fries', 'Sides', 'Fries topped with melted cheese sauce.', 4.20, 'https://images.unsplash.com/photo-1585109649139-366815a0d713?w=800'),
('Mashed Potatoes', 'Sides', 'Creamy mashed potatoes with herb butter.', 3.80, 'https://images.unsplash.com/photo-1604152135912-04a579a1f4ad?w=800'),
('Coleslaw Cup', 'Sides', 'Fresh crunchy slaw with tangy dressing.', 2.80, 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800'),
('Steamed Vegetables', 'Sides', 'Seasonal vegetables lightly seasoned.', 3.40, 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=800'),
('Mozzarella Sticks', 'Sides', 'Breaded mozzarella sticks with marinara.', 4.80, 'https://images.unsplash.com/photo-1548340748-6d2b7d7da280?w=800'),
('Potato Wedges', 'Sides', 'Seasoned thick-cut potato wedges.', 3.70, 'https://images.unsplash.com/photo-1630384060421-cb20d0e0649d?w=800'),
('Caesar Side Salad', 'Sides', 'Romaine lettuce, croutons, and caesar dressing.', 3.95, 'https://images.unsplash.com/photo-1546793665-c74683f339c1?w=800'),
('Mac and Cheese Cup', 'Sides', 'Creamy macaroni and cheddar cheese cup.', 4.30, 'https://images.unsplash.com/photo-1543332164-6e82f355bad6?w=800'),
('Mineral Water', 'Beverages and Drinks', 'Chilled bottled mineral water.', 1.50, 'https://images.unsplash.com/photo-1616118132534-381148898bb4?w=800'),
('Sparkling Water', 'Beverages and Drinks', 'Refreshing sparkling water.', 2.00, 'https://images.unsplash.com/photo-1553456558-aff63285bdd1?w=800'),
('Cola', 'Beverages and Drinks', 'Classic cola served cold.', 2.20, 'https://images.unsplash.com/photo-1629203851122-3726ecdf080e?w=800'),
('Lemon Iced Tea', 'Beverages and Drinks', 'Brewed tea with lemon over ice.', 2.80, 'https://images.unsplash.com/photo-1499638673689-79a0b5115d87?w=800'),
('Peach Iced Tea', 'Beverages and Drinks', 'Sweet peach tea served chilled.', 2.90, 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=800'),
('Orange Juice', 'Beverages and Drinks', 'Freshly squeezed orange juice.', 3.20, 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=800'),
('Apple Juice', 'Beverages and Drinks', 'Cold pressed apple juice.', 3.10, 'https://images.unsplash.com/photo-1603569283847-aa295f0d016a?w=800'),
('Mango Smoothie', 'Beverages and Drinks', 'Creamy mango smoothie blend.', 4.40, 'https://images.unsplash.com/photo-1505252585461-04db1eb84625?w=800'),
('Strawberry Smoothie', 'Beverages and Drinks', 'Fresh strawberry yogurt smoothie.', 4.50, 'https://images.unsplash.com/photo-1553530666-ba11a7da3888?w=800'),
('Chocolate Shake', 'Beverages and Drinks', 'Thick chocolate milkshake.', 4.60, 'https://images.unsplash.com/photo-1572490122747-3968b75cc699?w=800'),
('Vanilla Shake', 'Beverages and Drinks', 'Classic vanilla milkshake.', 4.50, 'https://images.unsplash.com/photo-1541544741938-0af808871cc0?w=800'),
('Hot Americano', 'Beverages and Drinks', 'Freshly brewed americano coffee.', 2.60, 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800'),
('Cappuccino', 'Beverages and Drinks', 'Espresso with steamed milk foam.', 3.40, 'https://images.unsplash.com/photo-1498804103079-a6351b050096?w=800'),
('Cafe Latte', 'Beverages and Drinks', 'Smooth espresso latte.', 3.50, 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=800'),
('Mocha', 'Beverages and Drinks', 'Chocolate flavored espresso drink.', 3.70, 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?w=800'),
('Hot Chocolate', 'Beverages and Drinks', 'Rich hot chocolate with cocoa.', 3.20, 'https://images.unsplash.com/photo-1542990253-0d0f5be5f1cd?w=800'),
('Green Tea', 'Beverages and Drinks', 'Light and refreshing green tea.', 2.40, 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?w=800'),
('Lemonade', 'Beverages and Drinks', 'Fresh homemade lemonade.', 2.70, 'https://images.unsplash.com/photo-1523677011781-c91d1bbe2f9e?w=800'),
('Passion Fruit Cooler', 'Beverages and Drinks', 'Tropical passion fruit cooler.', 3.60, 'https://images.unsplash.com/photo-1536935338788-846bb9981813?w=800'),
('Berry Fizz', 'Beverages and Drinks', 'Sparkling mixed berry refresher.', 3.80, 'https://images.unsplash.com/photo-1470337458703-46ad1756a187?w=800');

INSERT INTO news (title, body) VALUES
('Grand Opening Offer', 'Enjoy a 20 percent discount on your first order this week.'),
('Now Serving Breakfast', 'Our breakfast menu is available from 7:00 AM every day.');
