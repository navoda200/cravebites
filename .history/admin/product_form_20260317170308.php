<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$id = (int) ($_GET['id'] ?? 0);
$isEdit = $id > 0;
$categoryOptions = ['Main Courses', 'Sides', 'Beverages and Drinks'];

$product = [
    'name' => '',
    'category' => 'Main Courses',
    'description' => '',
    'price' => '',
    'image_url' => '',
];

if ($isEdit) {
    $stmt = $pdo->prepare('SELECT id, name, category, description, price, image_url FROM products WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $existing = $stmt->fetch();
    if (!$existing) {
        set_flash('error', 'Product not found.');
        redirect('/admin/products.php');
    }
    $product = $existing;
    $product['price'] = format_price_input_lkr((float) $existing['price']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? 'Main Courses');
    $description = trim($_POST['description'] ?? '');
    $priceLkr = (float) ($_POST['price'] ?? 0);
    $price = to_base_from_lkr($priceLkr);
    $imageUrl = trim($_POST['image_url'] ?? '');

    if (!in_array($category, $categoryOptions, true)) {
        $category = 'Main Courses';
    }

    if ($name === '' || $description === '' || $priceLkr <= 0) {
        set_flash('error', 'Please enter a product name, description, and valid price.');
        redirect('/admin/product_form.php' . ($isEdit ? '?id=' . $id : ''));
    }

    if ($isEdit) {
        $update = $pdo->prepare('UPDATE products SET name = :name, category = :category, description = :description, price = :price, image_url = :image_url WHERE id = :id');
        $update->execute([
            ':name' => $name,
            ':category' => $category,
            ':description' => $description,
            ':price' => $price,
            ':image_url' => $imageUrl,
            ':id' => $id,
        ]);
        set_flash('success', 'Product updated.');
    } else {
        $insert = $pdo->prepare('INSERT INTO products (name, category, description, price, image_url) VALUES (:name, :category, :description, :price, :image_url)');
        $insert->execute([
            ':name' => $name,
            ':category' => $category,
            ':description' => $description,
            ':price' => $price,
            ':image_url' => $imageUrl,
        ]);
        set_flash('success', 'New product added.');
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

        <label for="category">Category</label>
        <select id="category" name="category" required>
            <?php foreach ($categoryOptions as $option): ?>
                <option value="<?php echo escape($option); ?>" <?php echo ($product['category'] === $option) ? 'selected' : ''; ?>>
                    <?php echo escape($option); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" required><?php echo escape($product['description']); ?></textarea>

        <label for="price">Price (LKR / portion)</label>
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
