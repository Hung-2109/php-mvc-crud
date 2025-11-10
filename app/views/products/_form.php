<?php
$nameVal = htmlspecialchars($old['name'] ?? '', ENT_QUOTES, 'UTF-8');
$priceVal = htmlspecialchars((string)($old['price'] ?? ''), ENT_QUOTES, 'UTF-8');
$descVal = htmlspecialchars($old['description'] ?? '', ENT_QUOTES, 'UTF-8');
?>
<?php if (!empty($errors)): ?>
  <div class="error">
    <ul style="margin:0 0 0 16px;">
      <?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8') ?></li><?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<div class="form-group">
  <label for="name">Tên sản phẩm *</label>
  <input type="text" id="name" name="name" value="<?= $nameVal ?>" required>
</div>
<div class="form-group">
  <label for="price">Giá (đ) *</label>
  <input type="number" id="price" name="price" min="0" step="0.01" value="<?= $priceVal ?>" required>
</div>
<div class="form-group">
  <label for="description">Mô tả</label>
  <textarea id="description" name="description" rows="4"><?= $descVal ?></textarea>
</div>
<div class="form-group">
  <label for="image">Ảnh (jpg, jpeg, png, gif — tối đa 2MB)</label>
  <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.gif">
  <?php if (!empty($old['image'])): ?>
    <p>Ảnh hiện tại: <code><?= htmlspecialchars($old['image'], ENT_QUOTES, 'UTF-8') ?></code></p>
    <img class="thumb" src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($old['image'], ENT_QUOTES, 'UTF-8') ?>" alt="">
  <?php endif; ?>
</div>
<button class="btn btn-primary" type="submit">Lưu</button>
<a class="btn" href="<?= BASE_URL ?>/?route=products/index">Huỷ</a>
