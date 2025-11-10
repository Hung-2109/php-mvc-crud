<?php $title = 'Sửa sản phẩm'; ?>
<h1>Sửa sản phẩm #<?= (int)($product['id'] ?? 0) ?></h1>
<form method="post" action="<?= BASE_URL ?>/?route=products/update" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= (int)($product['id'] ?? 0) ?>">
  <?php include __DIR__ . '/_form.php'; ?>
</form>
