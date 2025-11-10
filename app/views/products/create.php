<?php $title = 'Thêm sản phẩm'; ?>
<h1>Thêm sản phẩm</h1>
<form method="post" action="<?= BASE_URL ?>/?route=products/store" enctype="multipart/form-data">
  <?php include __DIR__ . '/_form.php'; ?>
</form>
