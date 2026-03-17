<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_user();

$userId = current_user_id();

$stmt = $pdo->prepare(
    'SELECT ci.id AS cart_item_id, ci.quantity, p.id AS product_id, p.name, p.price
     FROM cart_items ci
     JOIN products p ON p.id = ci.product_id
     WHERE ci.user_id = :user_id
     ORDER BY ci.id DESC'
);
$stmt->execute([':user_id' => $userId]);
$cartItems = $stmt->fetchAll();

if (!$cartItems) {
    set_flash('error', 'Your cart is empty.');
    redirect('/cart.php');
}

$deliveryOptions = [
    'standard' => ['label' => 'Standard Delivery (2-3 hours)', 'fee' => 350],
    'express' => ['label' => 'Express Delivery (45-60 mins)', 'fee' => 700],
    'pickup' => ['label' => 'Self Pickup', 'fee' => 0],
];

$subtotalLkr = 0.0;
foreach ($cartItems as $item) {
    $subtotalLkr += to_lkr((float) $item['price']) * (int) $item['quantity'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $addressLine = trim($_POST['address_line'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $deliveryType = trim($_POST['delivery_type'] ?? 'standard');

    if ($fullName === '' || $phone === '' || $addressLine === '' || $city === '') {
        set_flash('error', 'Please fill all checkout fields.');
        redirect('/checkout.php');
    }

    if (!isset($deliveryOptions[$deliveryType])) {
        $deliveryType = 'standard';
    }

    $deliveryFee = (float) $deliveryOptions[$deliveryType]['fee'];
    $totalLkr = $subtotalLkr + $deliveryFee;

    try {
        $pdo->beginTransaction();

        $orderInsert = $pdo->prepare(
            'INSERT INTO orders (user_id, full_name, phone, address_line, city, delivery_type, delivery_fee_lkr, subtotal_lkr, total_lkr, status)
             VALUES (:user_id, :full_name, :phone, :address_line, :city, :delivery_type, :delivery_fee_lkr, :subtotal_lkr, :total_lkr, :status)'
        );
        $orderInsert->execute([
            ':user_id' => $userId,
            ':full_name' => $fullName,
            ':phone' => $phone,
            ':address_line' => $addressLine,
            ':city' => $city,
            ':delivery_type' => $deliveryType,
            ':delivery_fee_lkr' => $deliveryFee,
            ':subtotal_lkr' => $subtotalLkr,
            ':total_lkr' => $totalLkr,
            ':status' => 'Pending',
        ]);

        $orderId = (int) $pdo->lastInsertId();

        $itemInsert = $pdo->prepare(
            'INSERT INTO order_items (order_id, product_id, product_name, unit_price_lkr, quantity, line_total_lkr)
             VALUES (:order_id, :product_id, :product_name, :unit_price_lkr, :quantity, :line_total_lkr)'
        );

        foreach ($cartItems as $item) {
            $unitLkr = to_lkr((float) $item['price']);
            $qty = (int) $item['quantity'];
            $lineTotal = $unitLkr * $qty;

            $itemInsert->execute([
                ':order_id' => $orderId,
                ':product_id' => (int) $item['product_id'],
                ':product_name' => $item['name'],
                ':unit_price_lkr' => $unitLkr,
                ':quantity' => $qty,
                ':line_total_lkr' => $lineTotal,
            ]);
        }

        $clearCart = $pdo->prepare('DELETE FROM cart_items WHERE user_id = :user_id');
        $clearCart->execute([':user_id' => $userId]);

        $pdo->commit();

        set_flash('success', 'Order placed successfully. We will contact you soon.');
        redirect('/products.php');
    } catch (Throwable $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        set_flash('error', 'Could not place your order. Please try again.');
        redirect('/checkout.php');
    }
}

$pageTitle = 'Checkout';
require_once __DIR__ . '/includes/header.php';
?>

<section class="wrap section">
    <div class="section-head">
        <h1>Checkout</h1>
        <p>Choose your delivery option and confirm your order.</p>
    </div>

    <div class="checkout-grid">
        <form class="form" method="post" action="<?php echo url('checkout.php'); ?>">
            <label for="full_name">Full Name</label>
            <input id="full_name" name="full_name" type="text" required>

            <label for="phone">Phone Number</label>
            <input id="phone" name="phone" type="text" required>

            <label for="address_line">Delivery Address</label>
            <input id="address_line" name="address_line" type="text" required>

            <label for="city">City</label>
            <input id="city" name="city" type="text" required>

            <label for="delivery_type">Delivery Option</label>
            <select id="delivery_type" name="delivery_type" required>
                <?php foreach ($deliveryOptions as $key => $option): ?>
                    <option value="<?php echo escape($key); ?>"><?php echo escape($option['label'] . ' - LKR ' . number_format((float) $option['fee'], 0)); ?></option>
                <?php endforeach; ?>
            </select>

            <button class="btn" type="submit">Place Order</button>
        </form>

        <article class="news-item">
            <h2>Order Summary</h2>
            <p><?php echo count($cartItems); ?> item(s) in your cart.</p>
            <p><strong>Subtotal:</strong> LKR <?php echo number_format($subtotalLkr, 0); ?></p>
            <p class="small-note">Delivery fee depends on the option you choose.</p>
        </article>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
