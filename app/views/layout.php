<?php
// layout
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($title ?? 'Products', ENT_QUOTES, 'UTF-8') ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
  <header>
    <div class="topbar">
      <a href="<?= BASE_URL ?>/?route=products/index"><strong>PHP MVC CRUD</strong></a>
      <nav>
        <a class="btn" href="<?= BASE_URL ?>/?route=products/index">Danh sách</a>
        <a class="btn btn-primary" href="<?= BASE_URL ?>/?route=products/create">Thêm sản phẩm</a>
      </nav>
    </div>
  </header>
  <div class="container">
    <?php include $viewFile; ?>
  </div>
  <footer>
    <p>Demo MVC • PHP thuần + PDO • <?= date('Y') ?></p>
  </footer>
  <script src="<?= BASE_URL ?>/assets/js/app.js"></script>
</body>
</html>
