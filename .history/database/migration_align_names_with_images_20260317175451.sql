UPDATE products
SET
    name = CASE id
        WHEN 22 THEN 'Chicken Shawarma Plate'
        WHEN 20 THEN 'Penne Arrabbiata'
        WHEN 14 THEN 'Spicy Beef Ramen Bowl'
        WHEN 13 THEN 'Coconut Seafood Curry'
        WHEN 26 THEN 'Onion Rings Basket'
        WHEN 30 THEN 'Cheesy Fries Bowl'
        WHEN 45 THEN 'Citrus Lemonade'
        WHEN 46 THEN 'Berry Fizz'
        ELSE name
    END,
    description = CASE id
        WHEN 22 THEN 'Marinated chicken shawarma served with fresh toppings and sauce.'
        WHEN 20 THEN 'Penne pasta tossed in a spicy tomato sauce with herbs.'
        WHEN 14 THEN 'A warm bowl of ramen in rich broth with beef and toppings.'
        WHEN 13 THEN 'Creamy coconut curry with seafood, spices, and fragrant herbs.'
        WHEN 26 THEN 'Crunchy battered onion rings, fried until golden and crisp.'
        WHEN 30 THEN 'Loaded fries topped with creamy cheese and savory seasoning.'
        WHEN 45 THEN 'Cool citrus lemonade served chilled and refreshing.'
        WHEN 46 THEN 'Sparkling berry drink with a sweet and tangy finish.'
        ELSE description
    END
WHERE id IN (22, 20, 14, 13, 26, 30, 45, 46);

SELECT id, name, category, description
FROM products
WHERE id IN (22, 20, 14, 13, 26, 30, 45, 46)
ORDER BY id;
