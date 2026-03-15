<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$id = (int) ($_GET['id'] ?? 0);
$isEdit = $id > 0;

$product = [
    'name' => '',
    'description' => '',
    'price' => '',
    'image_url' => '',
];

if ($isEdit) {
    $stmt = $pdo->prepare('SELECT id, name, description, price, image_url FROM products WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $existing = $stmt->fetch();
    if (!$existing) {
        set_flash('error', 'Product not found.');
        redirect('/admin/products.php');
    }
    $product = $existing;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = (float) ($_POST['price'] ?? 0);
    $imageUrl = trim($_POST['image_url'] ?? '');

    if ($name === '' || $description === '' || $price <= 0) {
        set_flash('error', 'Name, description and valid price are required.');
        redirect('/admin/product_form.php' . ($isEdit ? '?id=' . $id : ''));
    }

    if ($isEdit) {
        $update = $pdo->prepare('UPDATE products SET name = :name, description = :description, price = :price, image_url = :image_url WHERE id = :id');
        $update->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':image_url' => $imageUrl,
            ':id' => $id,
        ]);
        set_flash('success', 'Product updated successfully.');
    } else {
        $insert = $pdo->prepare('INSERT INTO products (name, description, price, image_url) VALUES (:name, :description, :price, :image_url)');
        $insert->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':image_url' => $imageUrl,
        ]);
        set_flash('success', 'Product added successfully.');
    }

    redirect('/admin/products.php');
}

$pageTitle = $isEdit ? 'Edit Product' : 'Add Product';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="wrap section">
    <h1><?php echo escape($pageTitle); ?></h1>

    <form class="form" method="post" action="<?php echo url('admin/product_form.php' . ($isEdit ? '?id=' . $id : '')); ?>">
        <label for="name">Product Name</label>
        <input id="name" name="name" type="text" value="<?php echo escape($product['name']); ?>" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" required><?php echo escape($product['description']); ?></textarea>

        <label for="price">Price</label>
        <input id="price" name="price" type="number" step="0.01" min="0.01" value="<?php echo escape((string) $product['price']); ?>" required>

        <label for="image_url">Image URL</label>
        <input id="image_url" name="image_url" type="url" value="<?php echo escape($product['image_url']); ?>">

        <div class="row-gap">
            <button class="btn" type="submit"><?php echo $isEdit ? 'Update Product' : 'Create Product'; ?></button>
            <a class="btn btn-outline" href="<?php echo url('admin/products.php'); ?>">Cancel</a>
        </div>
    </form>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
