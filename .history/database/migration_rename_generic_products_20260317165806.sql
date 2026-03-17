UPDATE products
SET
    name = CASE name
        WHEN 'Main Course 01' THEN 'Chicken Kottu'
        WHEN 'Main Course 02' THEN 'Egg Fried Rice'
        WHEN 'Side 01' THEN 'Seasoned French Fries'
        WHEN 'Side 02' THEN 'Crispy Onion Rings'
        WHEN 'Side 03' THEN 'Spiced Potato Wedges'
        WHEN 'Side 04' THEN 'Garlic Bread Slices'
        WHEN 'Side 05' THEN 'Cheese Fries'
        WHEN 'Side 06' THEN 'Loaded Fries Basket'
        WHEN 'Side 07' THEN 'Caesar Side Salad'
        WHEN 'Side 08' THEN 'Mozzarella Sticks'
        WHEN 'Side 09' THEN 'Steamed Butter Vegetables'
        WHEN 'Drink 01' THEN 'Lemon Iced Tea'
        WHEN 'Drink 02' THEN 'Peach Iced Tea'
        WHEN 'Drink 03' THEN 'Orange Juice'
        WHEN 'Drink 04' THEN 'Apple Juice'
        WHEN 'Drink 05' THEN 'Mango Smoothie'
        WHEN 'Drink 06' THEN 'Strawberry Smoothie'
        WHEN 'Drink 07' THEN 'Chocolate Milkshake'
        WHEN 'Drink 08' THEN 'Vanilla Milkshake'
        WHEN 'Drink 09' THEN 'Hot Americano'
        WHEN 'Drink 10' THEN 'Cappuccino'
        WHEN 'Drink 11' THEN 'Cafe Latte'
        WHEN 'Drink 12' THEN 'Mocha'
        WHEN 'Drink 13' THEN 'Hot Chocolate'
        WHEN 'Drink 14' THEN 'Green Tea'
        WHEN 'Drink 15' THEN 'Fresh Lemonade'
        WHEN 'Drink 16' THEN 'Passion Fruit Cooler'
        WHEN 'Drink 17' THEN 'Mineral Water'
        WHEN 'Drink 18' THEN 'Sparkling Water'
        WHEN 'Drink 19' THEN 'Classic Cola'
        ELSE name
    END,
    description = CASE name
        WHEN 'Main Course 01' THEN 'Sri Lankan chopped roti stir-fried with chicken, egg, and fresh vegetables.'
        WHEN 'Main Course 02' THEN 'Wok-fried rice with egg, spring onion, and mixed vegetables.'
        WHEN 'Side 01' THEN 'Golden fries tossed in house seasoning salt.'
        WHEN 'Side 02' THEN 'Crispy battered onion rings served hot and crunchy.'
        WHEN 'Side 03' THEN 'Thick-cut potato wedges with paprika and herbs.'
        WHEN 'Side 04' THEN 'Toasted bread brushed with garlic butter and parsley.'
        WHEN 'Side 05' THEN 'Crispy fries topped with melted cheese and herbs.'
        WHEN 'Side 06' THEN 'A hearty fries portion with savory seasoning.'
        WHEN 'Side 07' THEN 'Fresh romaine, croutons, and creamy Caesar dressing.'
        WHEN 'Side 08' THEN 'Breaded mozzarella sticks with a soft cheesy center.'
        WHEN 'Side 09' THEN 'Lightly seasoned steamed vegetables with butter glaze.'
        WHEN 'Drink 01' THEN 'Refreshing brewed tea with lemon served over ice.'
        WHEN 'Drink 02' THEN 'Cold peach-infused iced tea with a fruity finish.'
        WHEN 'Drink 03' THEN 'Fresh orange juice served chilled.'
        WHEN 'Drink 04' THEN 'Cold pressed apple juice with natural sweetness.'
        WHEN 'Drink 05' THEN 'Creamy mango smoothie blended to perfection.'
        WHEN 'Drink 06' THEN 'Sweet strawberry smoothie made with fresh fruit.'
        WHEN 'Drink 07' THEN 'Rich chocolate milkshake with a smooth texture.'
        WHEN 'Drink 08' THEN 'Classic vanilla milkshake served chilled.'
        WHEN 'Drink 09' THEN 'Bold black coffee shot with hot water.'
        WHEN 'Drink 10' THEN 'Espresso topped with silky steamed milk foam.'
        WHEN 'Drink 11' THEN 'Smooth espresso with warm milk and light foam.'
        WHEN 'Drink 12' THEN 'Chocolate-flavored espresso drink with milk.'
        WHEN 'Drink 13' THEN 'Warm cocoa drink with a rich chocolate taste.'
        WHEN 'Drink 14' THEN 'Light and soothing brewed green tea.'
        WHEN 'Drink 15' THEN 'Fresh homemade lemonade with citrus punch.'
        WHEN 'Drink 16' THEN 'Tropical passion fruit drink served extra cold.'
        WHEN 'Drink 17' THEN 'Pure chilled bottled mineral water.'
        WHEN 'Drink 18' THEN 'Bubbly sparkling water, crisp and refreshing.'
        WHEN 'Drink 19' THEN 'Classic cola served ice cold.'
        ELSE description
    END
WHERE name REGEXP '^(Main Course|Side|Drink) [0-9]{2}$';

SELECT id, name, category, description
FROM products
WHERE category IN ('Main Courses', 'Sides', 'Beverages and Drinks')
ORDER BY id DESC
LIMIT 40;
