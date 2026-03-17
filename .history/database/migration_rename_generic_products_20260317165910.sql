UPDATE products
SET name = CASE name
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
END
WHERE name REGEXP '^(Main Course|Side|Drink) [0-9]{2}$';

UPDATE products
SET description = CASE name
    WHEN 'Chicken Kottu' THEN 'Sri Lankan chopped roti stir-fried with chicken, egg, and fresh vegetables.'
    WHEN 'Egg Fried Rice' THEN 'Wok-fried rice with egg, spring onion, and mixed vegetables.'
    WHEN 'Seasoned French Fries' THEN 'Golden fries tossed in house seasoning salt.'
    WHEN 'Crispy Onion Rings' THEN 'Crispy battered onion rings served hot and crunchy.'
    WHEN 'Spiced Potato Wedges' THEN 'Thick-cut potato wedges with paprika and herbs.'
    WHEN 'Garlic Bread Slices' THEN 'Toasted bread brushed with garlic butter and parsley.'
    WHEN 'Cheese Fries' THEN 'Crispy fries topped with melted cheese and herbs.'
    WHEN 'Loaded Fries Basket' THEN 'A hearty fries portion with savory seasoning.'
    WHEN 'Caesar Side Salad' THEN 'Fresh romaine, croutons, and creamy Caesar dressing.'
    WHEN 'Mozzarella Sticks' THEN 'Breaded mozzarella sticks with a soft cheesy center.'
    WHEN 'Steamed Butter Vegetables' THEN 'Lightly seasoned steamed vegetables with butter glaze.'
    WHEN 'Lemon Iced Tea' THEN 'Refreshing brewed tea with lemon served over ice.'
    WHEN 'Peach Iced Tea' THEN 'Cold peach-infused iced tea with a fruity finish.'
    WHEN 'Orange Juice' THEN 'Fresh orange juice served chilled.'
    WHEN 'Apple Juice' THEN 'Cold pressed apple juice with natural sweetness.'
    WHEN 'Mango Smoothie' THEN 'Creamy mango smoothie blended to perfection.'
    WHEN 'Strawberry Smoothie' THEN 'Sweet strawberry smoothie made with fresh fruit.'
    WHEN 'Chocolate Milkshake' THEN 'Rich chocolate milkshake with a smooth texture.'
    WHEN 'Vanilla Milkshake' THEN 'Classic vanilla milkshake served chilled.'
    WHEN 'Hot Americano' THEN 'Bold black coffee shot with hot water.'
    WHEN 'Cappuccino' THEN 'Espresso topped with silky steamed milk foam.'
    WHEN 'Cafe Latte' THEN 'Smooth espresso with warm milk and light foam.'
    WHEN 'Mocha' THEN 'Chocolate-flavored espresso drink with milk.'
    WHEN 'Hot Chocolate' THEN 'Warm cocoa drink with a rich chocolate taste.'
    WHEN 'Green Tea' THEN 'Light and soothing brewed green tea.'
    WHEN 'Fresh Lemonade' THEN 'Fresh homemade lemonade with citrus punch.'
    WHEN 'Passion Fruit Cooler' THEN 'Tropical passion fruit drink served extra cold.'
    WHEN 'Mineral Water' THEN 'Pure chilled bottled mineral water.'
    WHEN 'Sparkling Water' THEN 'Bubbly sparkling water, crisp and refreshing.'
    WHEN 'Classic Cola' THEN 'Classic cola served ice cold.'
    ELSE description
END
WHERE name IN (
    'Chicken Kottu', 'Egg Fried Rice', 'Seasoned French Fries', 'Crispy Onion Rings',
    'Spiced Potato Wedges', 'Garlic Bread Slices', 'Cheese Fries', 'Loaded Fries Basket',
    'Caesar Side Salad', 'Mozzarella Sticks', 'Steamed Butter Vegetables', 'Lemon Iced Tea',
    'Peach Iced Tea', 'Orange Juice', 'Apple Juice', 'Mango Smoothie', 'Strawberry Smoothie',
    'Chocolate Milkshake', 'Vanilla Milkshake', 'Hot Americano', 'Cappuccino', 'Cafe Latte',
    'Mocha', 'Hot Chocolate', 'Green Tea', 'Fresh Lemonade', 'Passion Fruit Cooler',
    'Mineral Water', 'Sparkling Water', 'Classic Cola'
);

SELECT id, name, category, description
FROM products
WHERE category IN ('Main Courses', 'Sides', 'Beverages and Drinks')
ORDER BY id DESC
LIMIT 40;
