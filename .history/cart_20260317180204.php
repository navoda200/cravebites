<?php
require_once __DIR__ . '/includes/bootstrap.php';

if (!is_user_logged_in()) {
    set_flash('error', 'Please sign in to use your cart.');
    redirect('/signin.php');
}

$userId = current_user_id();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $productId = (int) ($_POST['product_id'] ?? 0);
        $quantity = max(1, (int) ($_POST['quantity'] ?? 1));

        if ($productId > 0) {
            $stmt = $pdo->prepare(
                'INSERT INTO cart_items (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)
                 ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)'
            );
            $stmt->execute([
                ':user_id' => $userId,
                ':product_id' => $productId,
                ':quantity' => $quantity,
            ]);
            set_flash('success', 'Item added to cart.');
        }

        redirect('/cart.php');
    }

    if ($action === 'update') {
        $itemId = (int) ($_POST['item_id'] ?? 0);
        $quantity = max(1, (int) ($_POST['quantity'] ?? 1));

        $stmt = $pdo->prepare('UPDATE cart_items SET quantity = :quantity WHERE id = :id AND user_id = :user_id');
        $stmt->execute([
            ':quantity' => $quantity,
            ':id' => $itemId,
            ':user_id' => $userId,
        ]);

        set_flash('success', 'Cart updated.');
        redirect('/cart.php');
    }

    if ($action === 'remove') {
        $itemId = (int) ($_POST['item_id'] ?? 0);
        $stmt = $pdo->prepare('DELETE FROM cart_items WHERE id = :id AND user_id = :user_id');
        $stmt->execute([
            ':id' => $itemId,
            ':user_id' => $userId,
        ]);

        set_flash('success', 'Item removed from cart.');
        redirect('/cart.php');
    }

    if ($action === 'clear') {
        $stmt = $pdo->prepare('DELETE FROM cart_items WHERE user_id = :user_id');
        $stmt->execute([':user_id' => $userId]);

        set_flash('success', 'Cart cleared.');
        redirect('/cart.php');
    }
}

$stmt = $pdo->prepare(
    'SELECT ci.id AS cart_item_id, ci.quantity, p.id AS product_id, p.name, p.price, p.image_url
     FROM cart_items ci
     JOIN products p ON p.id = ci.product_id
     WHERE ci.user_id = :user_id
     ORDER BY ci.id DESC'
);
$stmt->execute([':user_id' => $userId]);
$cartItems = $stmt->fetchAll();

$subtotalLkr = 0.0;
foreach ($cartItems as $item) {
    $subtotalLkr += to_lkr((float) $item['price']) * (int) $item['quantity'];
}

$pageTitle = 'Your Cart';
require_once __DIR__ . '/includes/header.php';
?>

<section class="wrap section">
    <div class="section-head">
        <h1>Your Cart</h1>
        <?php if ($cartItems): ?>
            <form method="post" action="<?php echo url('cart.php'); ?>">
                <input type="hidden" name="action" value="clear">
                <button class="btn btn-outline" type="submit">Clear Cart</button>
            </form>
        <?php endif; ?>
    </div>

    <?php if (!$cartItems): ?>
        <article class="news-item">
            <h2>Your cart is empty</h2>
            <p>Add items from the products page to start your order.</p>
            <a class="btn" href="<?php echo url('products.php'); ?>">Browse Products</a>
        </article>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <?php $unitLkr = to_lkr((float) $item['price']); ?>
                        <tr>
                            <td><?php echo escape($item['name']); ?></td>
                            <td>LKR <?php echo number_format($unitLkr, 0); ?></td>
                            <td>
                                <form method="post" action="<?php echo url('cart.php'); ?>" class="inline-form">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="item_id" value="<?php echo (int) $item['cart_item_id']; ?>">
                                    <input type="number" name="quantity" min="1" value="<?php echo (int) $item['quantity']; ?>" class="qty-input">
                                    <button type="submit" class="btn btn-outline">Update</button>
                                </form>
                            </td>
                            <td>LKR <?php echo number_format($unitLkr * (int) $item['quantity'], 0); ?></td>
                            <td>
                                <form method="post" action="<?php echo url('cart.php'); ?>">
                                    <input type="hidden" name="action" value="remove">
                                    <input type="hidden" name="item_id" value="<?php echo (int) $item['cart_item_id']; ?>">
                                    <button type="submit" class="link-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="cart-summary">
            <h3>Subtotal: LKR <?php echo number_format($subtotalLkr, 0); ?></h3>
            <a class="btn" href="<?php echo url('checkout.php'); ?>">Proceed to Checkout</a>
        </div>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
