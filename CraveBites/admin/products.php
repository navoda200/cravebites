<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    $id = (int) ($_POST['id'] ?? 0);
    $stmt = $pdo->prepare('DELETE FROM products WHERE id = :id');
    $stmt->execute([':id' => $id]);
    set_flash('success', 'Product deleted successfully.');
    redirect('/admin/products.php');
}

$products = $pdo->query('SELECT id, name, price, created_at FROM products ORDER BY id DESC')->fetchAll();

$pageTitle = 'Manage Products';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="wrap section">
    <div class="section-head">
        <h1>Manage Products</h1>
        <a class="btn" href="<?php echo url('admin/product_form.php'); ?>">Add Product</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $item): ?>
                    <tr>
                        <td><?php echo (int) $item['id']; ?></td>
                        <td><?php echo escape($item['name']); ?></td>
                        <td>$<?php echo format_price((float) $item['price']); ?></td>
                        <td><?php echo escape(date('Y-m-d', strtotime($item['created_at']))); ?></td>
                        <td class="actions">
                            <a href="<?php echo url('admin/product_form.php?id=' . (int) $item['id']); ?>">Edit</a>
                            <form method="post" action="<?php echo url('admin/products.php'); ?>" onsubmit="return confirm('Delete this product?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo (int) $item['id']; ?>">
                                <button type="submit" class="link-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
