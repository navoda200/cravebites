<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$id = (int) ($_GET['id'] ?? 0);
$isEdit = $id > 0;

$deal = [
    'title' => '',
    'tag' => '',
    'short_note' => '',
    'items_text' => '',
    'deal_price_lkr' => '',
    'original_price_lkr' => '',
    'image_url' => '',
    'is_active' => 1,
];

if ($isEdit) {
    $stmt = $pdo->prepare('SELECT id, title, tag, short_note, items_text, deal_price_lkr, original_price_lkr, image_url, is_active FROM deals WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $existing = $stmt->fetch();

    if (!$existing) {
        set_flash('error', 'Deal not found.');
        redirect('/admin/deals.php');
    }

    $deal = $existing;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $tag = trim($_POST['tag'] ?? '');
    $shortNote = trim($_POST['short_note'] ?? '');
    $itemsText = trim($_POST['items_text'] ?? '');
    $dealPrice = (float) ($_POST['deal_price_lkr'] ?? 0);
    $originalPrice = (float) ($_POST['original_price_lkr'] ?? 0);
    $imageUrl = trim($_POST['image_url'] ?? '');
    $isActive = isset($_POST['is_active']) ? 1 : 0;

    if ($title === '' || $shortNote === '' || $itemsText === '' || $dealPrice <= 0) {
        set_flash('error', 'Please complete title, short note, items, and deal price.');
        redirect('/admin/deal_form.php' . ($isEdit ? '?id=' . $id : ''));
    }

    if ($originalPrice < 0) {
        $originalPrice = 0;
    }

    if ($isEdit) {
        $update = $pdo->prepare('UPDATE deals SET title = :title, tag = :tag, short_note = :short_note, items_text = :items_text, deal_price_lkr = :deal_price_lkr, original_price_lkr = :original_price_lkr, image_url = :image_url, is_active = :is_active WHERE id = :id');
        $update->execute([
            ':title' => $title,
            ':tag' => $tag,
            ':short_note' => $shortNote,
            ':items_text' => $itemsText,
            ':deal_price_lkr' => $dealPrice,
            ':original_price_lkr' => $originalPrice,
            ':image_url' => $imageUrl,
            ':is_active' => $isActive,
            ':id' => $id,
        ]);
        set_flash('success', 'Deal updated.');
    } else {
        $insert = $pdo->prepare('INSERT INTO deals (title, tag, short_note, items_text, deal_price_lkr, original_price_lkr, image_url, is_active) VALUES (:title, :tag, :short_note, :items_text, :deal_price_lkr, :original_price_lkr, :image_url, :is_active)');
        $insert->execute([
            ':title' => $title,
            ':tag' => $tag,
            ':short_note' => $shortNote,
            ':items_text' => $itemsText,
            ':deal_price_lkr' => $dealPrice,
            ':original_price_lkr' => $originalPrice,
            ':image_url' => $imageUrl,
            ':is_active' => $isActive,
        ]);
        set_flash('success', 'New deal added.');
    }

    redirect('/admin/deals.php');
}

$pageTitle = $isEdit ? 'Edit Deal' : 'Add Deal';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="wrap section">
    <h1><?php echo escape($pageTitle); ?></h1>

    <form class="form" method="post" action="<?php echo url('admin/deal_form.php' . ($isEdit ? '?id=' . $id : '')); ?>">
        <label for="title">Deal Title</label>
        <input id="title" name="title" type="text" value="<?php echo escape((string) $deal['title']); ?>" required>

        <label for="tag">Tag (optional)</label>
        <input id="tag" name="tag" type="text" value="<?php echo escape((string) $deal['tag']); ?>" placeholder="Save 10%">

        <label for="short_note">Short Note</label>
        <input id="short_note" name="short_note" type="text" value="<?php echo escape((string) $deal['short_note']); ?>" required>

        <label for="items_text">Items (one per line)</label>
        <textarea id="items_text" name="items_text" rows="6" required><?php echo escape((string) $deal['items_text']); ?></textarea>

        <label for="deal_price_lkr">Deal Price (LKR)</label>
        <input id="deal_price_lkr" name="deal_price_lkr" type="number" step="1" min="1" value="<?php echo escape((string) $deal['deal_price_lkr']); ?>" required>

        <label for="original_price_lkr">Original Price (LKR)</label>
        <input id="original_price_lkr" name="original_price_lkr" type="number" step="1" min="0" value="<?php echo escape((string) $deal['original_price_lkr']); ?>">

        <label for="image_url">Image URL</label>
        <input id="image_url" name="image_url" type="url" value="<?php echo escape((string) $deal['image_url']); ?>">

        <label>
            <input type="checkbox" name="is_active" value="1" <?php echo (int) $deal['is_active'] === 1 ? 'checked' : ''; ?>>
            Show this deal on public pages
        </label>

        <div class="row-gap">
            <button class="btn" type="submit"><?php echo $isEdit ? 'Update Deal' : 'Create Deal'; ?></button>
            <a class="btn btn-outline" href="<?php echo url('admin/deals.php'); ?>">Cancel</a>
        </div>
    </form>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>