# PHP MVC CRUD (Products) — PHP thuần + PDO + MySQL

Ứng dụng web mẫu theo mô hình MVC, thực hiện CRUD cho **Products** (Sản phẩm), có **upload ảnh**, **validate**, dùng **PDO + prepared statements** chống SQL Injection.

## Yêu cầu môi trường
- PHP 8.x (đã bật PDO MySQL)
- MySQL/MariaDB
- Composer *không bắt buộc*

## Cài đặt
1. Tạo database và import file `database.sql`:
   ```sql
   SOURCE database.sql;
   ```
2. Chỉnh cấu hình DB trong `app/config.php` (DB_HOST/DB_NAME/DB_USER/DB_PASS).
3. Cấp quyền ghi cho thư mục `public/uploads` (nếu cần):
   - Windows: không cần chỉnh
   - macOS/Linux: `chmod -R 775 public/uploads`
4. Chạy server:
   - PHP built-in:  
     ```bash
     php -S localhost:8000 -t public
     ```
   - XAMPP/Laragon: trỏ DocumentRoot vào thư mục `public/`

5. Mở trình duyệt: http://localhost:8000

## Chức năng
- Danh sách sản phẩm, thêm/sửa/xoá
- Upload ảnh (jpg, jpeg, png, gif), giới hạn 2MB
- Validate cơ bản: `name` bắt buộc, `price` là số >= 0
- An toàn: PDO + prepared statements, escape output (`htmlspecialchars`)

## Cấu trúc thư mục
```
php-mvc-crud/
├── README.md
├── database.sql
├── public/
│   ├── index.php
│   ├── assets/
│   │   ├── css/style.css
│   │   └── js/app.js
│   └── uploads/
└── app/
    ├── config.php
    ├── core/
    │   ├── Database.php
    │   └── Controller.php
    ├── controllers/
    │   └── ProductController.php
    ├── models/
    │   └── Product.php
    └── views/
        ├── layout.php
        └── products/
            ├── index.php
            ├── create.php
            ├── edit.php
            └── _form.php
```

## Ghi chú bảo mật
- Không nối chuỗi trực tiếp vào SQL.
- Kiểm tra MIME/đuôi file khi upload, đổi tên file tránh ghi đè.
- Không tải file thực thi (chỉ ảnh). Trên server thật, nên cấu hình web server chặn thực thi trong `uploads/`.

## Nâng cấp gợi ý
- Phân trang, tìm kiếm
- Đăng nhập/Phân quyền
- CSRF token cho form
- Tách router chuẩn hơn
