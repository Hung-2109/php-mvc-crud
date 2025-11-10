<?php
// ========================
// App config
// ========================
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'php_mvc_crud');
define('DB_USER', 'root');   // đổi tuỳ môi trường
define('DB_PASS', '');       // đổi tuỳ môi trường

// ========================
// Base URL
// ========================
// Cố định URL theo đường dẫn dự án XAMPP
define('BASE_URL', 'http://localhost/php-mvc-crud/public');

// ========================
// Upload config
// ========================
define('UPLOAD_DIR', __DIR__ . '/../public/uploads/'); // thư mục lưu ảnh
define('MAX_FILE_SIZE', 2 * 1024 * 1024); // 2MB
$ALLOWED_EXT = ['jpg','jpeg','png','gif'];
define('ALLOWED_EXT', serialize($ALLOWED_EXT));

// ========================
// PDO options
// ========================
define('PDO_OPTIONS', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
