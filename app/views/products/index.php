<?php $title = 'Danh sách sản phẩm'; ?>
<h1>Danh sách sản phẩm</h1>
<a class="btn btn-primary" href="<?= BASE_URL ?>/?route=products/create">+ Thêm sản phẩm</a>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Ảnh</th>
      <th>Tên</th>
      <th>Giá</th>
      <th>Mô tả</th>
      <th>Hành động</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($products as $p): ?>
    <tr>
      <td><?= (int)$p['id'] ?></td>
      <td>
        <?php if (!empty($p['image'])): ?>
          <img class="thumb" src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($p['image'], ENT_QUOTES, 'UTF-8') ?>" alt="">
        <?php else: ?>
          —
        <?php endif; ?>
      </td>
      <td><?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= number_format((float)$p['price'], 0, ',', '.') ?> đ</td>
      <td><?= nl2br(htmlspecialchars($p['description'] ?? '', ENT_QUOTES, 'UTF-8')) ?></td>
      <td class="actions">
        <a class="btn" href="<?= BASE_URL ?>/?route=products/edit&id=<?= (int)$p['id'] ?>">Sửa</a>
        <a class="btn btn-danger" onclick="return confirm('Xoá sản phẩm này?')" href="<?= BASE_URL ?>/?route=products/delete&id=<?= (int)$p['id'] ?>">Xoá</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
