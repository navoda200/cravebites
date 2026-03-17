ALTER TABLE products ADD COLUMN IF NOT EXISTS category VARCHAR(80) NOT NULL DEFAULT 'Main Courses' AFTER name;

UPDATE products
SET category = CASE
    WHEN name IN ('Crispy Fries Bucket') THEN 'Sides'
    WHEN name IN ('Chocolate Milkshake') THEN 'Beverages and Drinks'
    ELSE 'Main Courses'
END
WHERE category IS NULL OR category = '' OR category = 'Main Courses';

INSERT INTO products (name, category, description, price, image_url)
SELECT 'Main Course 01', 'Main Courses', 'Chef special main course platter 01.', 8.80, 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Main Course 01');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Main Course 02', 'Main Courses', 'Chef special main course platter 02.', 9.10, 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Main Course 02');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Main Course 03', 'Main Courses', 'Chef special main course platter 03.', 9.40, 'https://images.unsplash.com/photo-1604908176997-4317b64dee77?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Main Course 03');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Main Course 04', 'Main Courses', 'Chef special main course platter 04.', 9.70, 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Main Course 04');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Main Course 05', 'Main Courses', 'Chef special main course platter 05.', 10.00, 'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Main Course 05');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Main Course 06', 'Main Courses', 'Chef special main course platter 06.', 10.30, 'https://images.unsplash.com/photo-1557872943-16a5ac26437e?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Main Course 06');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Main Course 07', 'Main Courses', 'Chef special main course platter 07.', 10.60, 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Main Course 07');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Main Course 08', 'Main Courses', 'Chef special main course platter 08.', 10.90, 'https://images.unsplash.com/photo-1506084868230-bb9d95c24759?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Main Course 08');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Main Course 09', 'Main Courses', 'Chef special main course platter 09.', 11.20, 'https://images.unsplash.com/photo-1559847844-5315695dadae?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Main Course 09');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Main Course 10', 'Main Courses', 'Chef special main course platter 10.', 11.50, 'https://images.unsplash.com/photo-1600891964092-4316c288032e?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Main Course 10');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Main Course 11', 'Main Courses', 'Chef special main course platter 11.', 11.80, 'https://images.unsplash.com/photo-1516685018646-549198525c1b?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Main Course 11');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Main Course 12', 'Main Courses', 'Chef special main course platter 12.', 12.10, 'https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Main Course 12');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Main Course 13', 'Main Courses', 'Chef special main course platter 13.', 12.40, 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Main Course 13');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Main Course 14', 'Main Courses', 'Chef special main course platter 14.', 12.70, 'https://images.unsplash.com/photo-1529006557810-274b9b2fc783?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Main Course 14');

INSERT INTO products (name, category, description, price, image_url)
SELECT 'Side 01', 'Sides', 'Crispy side dish 01.', 2.80, 'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Side 01');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Side 02', 'Sides', 'Crispy side dish 02.', 3.00, 'https://images.unsplash.com/photo-1639024471283-03518883512d?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Side 02');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Side 03', 'Sides', 'Crispy side dish 03.', 3.20, 'https://images.unsplash.com/photo-1630384060421-cb20d0e0649d?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Side 03');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Side 04', 'Sides', 'Crispy side dish 04.', 3.40, 'https://images.unsplash.com/photo-1543332164-6e82f355bad6?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Side 04');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Side 05', 'Sides', 'Crispy side dish 05.', 3.60, 'https://images.unsplash.com/photo-1604152135912-04a579a1f4ad?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Side 05');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Side 06', 'Sides', 'Crispy side dish 06.', 3.80, 'https://images.unsplash.com/photo-1573140247632-f8fd74997d5c?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Side 06');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Side 07', 'Sides', 'Crispy side dish 07.', 4.00, 'https://images.unsplash.com/photo-1546793665-c74683f339c1?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Side 07');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Side 08', 'Sides', 'Crispy side dish 08.', 4.20, 'https://images.unsplash.com/photo-1585109649139-366815a0d713?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Side 08');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Side 09', 'Sides', 'Crispy side dish 09.', 4.40, 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Side 09');

INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 01', 'Beverages and Drinks', 'Refreshing beverage 01.', 2.10, 'https://images.unsplash.com/photo-1499638673689-79a0b5115d87?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 01');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 02', 'Beverages and Drinks', 'Refreshing beverage 02.', 2.30, 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 02');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 03', 'Beverages and Drinks', 'Refreshing beverage 03.', 2.50, 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 03');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 04', 'Beverages and Drinks', 'Refreshing beverage 04.', 2.70, 'https://images.unsplash.com/photo-1603569283847-aa295f0d016a?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 04');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 05', 'Beverages and Drinks', 'Refreshing beverage 05.', 2.90, 'https://images.unsplash.com/photo-1505252585461-04db1eb84625?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 05');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 06', 'Beverages and Drinks', 'Refreshing beverage 06.', 3.10, 'https://images.unsplash.com/photo-1553530666-ba11a7da3888?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 06');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 07', 'Beverages and Drinks', 'Refreshing beverage 07.', 3.30, 'https://images.unsplash.com/photo-1541544741938-0af808871cc0?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 07');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 08', 'Beverages and Drinks', 'Refreshing beverage 08.', 3.50, 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 08');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 09', 'Beverages and Drinks', 'Refreshing beverage 09.', 3.70, 'https://images.unsplash.com/photo-1498804103079-a6351b050096?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 09');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 10', 'Beverages and Drinks', 'Refreshing beverage 10.', 3.90, 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 10');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 11', 'Beverages and Drinks', 'Refreshing beverage 11.', 4.10, 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 11');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 12', 'Beverages and Drinks', 'Refreshing beverage 12.', 4.30, 'https://images.unsplash.com/photo-1542990253-0d0f5be5f1cd?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 12');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 13', 'Beverages and Drinks', 'Refreshing beverage 13.', 4.50, 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 13');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 14', 'Beverages and Drinks', 'Refreshing beverage 14.', 4.70, 'https://images.unsplash.com/photo-1523677011781-c91d1bbe2f9e?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 14');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 15', 'Beverages and Drinks', 'Refreshing beverage 15.', 4.90, 'https://images.unsplash.com/photo-1536935338788-846bb9981813?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 15');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 16', 'Beverages and Drinks', 'Refreshing beverage 16.', 5.10, 'https://images.unsplash.com/photo-1470337458703-46ad1756a187?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 16');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 17', 'Beverages and Drinks', 'Refreshing beverage 17.', 5.30, 'https://images.unsplash.com/photo-1616118132534-381148898bb4?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 17');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 18', 'Beverages and Drinks', 'Refreshing beverage 18.', 5.50, 'https://images.unsplash.com/photo-1553456558-aff63285bdd1?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 18');
INSERT INTO products (name, category, description, price, image_url)
SELECT 'Drink 19', 'Beverages and Drinks', 'Refreshing beverage 19.', 5.70, 'https://images.unsplash.com/photo-1629203851122-3726ecdf080e?w=800'
WHERE NOT EXISTS (SELECT 1 FROM products WHERE name = 'Drink 19');

SELECT category, COUNT(*) AS total FROM products GROUP BY category ORDER BY category;
