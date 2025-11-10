<?php
require_once __DIR__ . '/../models/Product.php';

class ProductsController extends Controller {
    private Product $model;
    public function __construct() {
        $this->model = new Product();
    }
    // alias để khớp với router 'products'
    public function index(): void {
        $products = $this->model->all();
        $this->render('products/index', ['products' => $products, 'title' => 'Product List']);
    }
    public function create(): void {
        $errors = [];
        $old = ['name'=>'','price'=>'','description'=>''];
        $this->render('products/create', compact('errors','old'));
    }
    private function validate(array $input, array &$errors): array {
        $name = trim($input['name'] ?? '');
        $price = $input['price'] ?? '';
        $description = trim($input['description'] ?? '');
        if ($name === '') $errors['name'] = 'Tên sản phẩm là bắt buộc.';
        if ($price === '' || !is_numeric($price) || $price < 0) $errors['price'] = 'Giá phải là số không âm.';
        return ['name'=>$name, 'price'=>(float)$price, 'description'=>$description];
    }
    private function handleUpload(?array $file, array &$errors, ?string $current = null): ?string {
        if (!$file || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            return $current; // không đổi ảnh
        }
        if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
            $errors['image'] = 'Tải ảnh thất bại (mã lỗi ' . ($file['error'] ?? -1) . ').';
            return null;
        }
        if ($file['size'] > MAX_FILE_SIZE) {
            $errors['image'] = 'Ảnh vượt quá kích thước 2MB.';
            return null;
        }
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = unserialize(ALLOWED_EXT);
        if (!in_array($ext, $allowed, true)) {
            $errors['image'] = 'Định dạng không hợp lệ. Chỉ cho phép: ' . implode(', ', $allowed);
            return null;
        }
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);
        $allowedMime = ['image/jpeg','image/png','image/gif'];
        if (!in_array($mime, $allowedMime, true)) {
            $errors['image'] = 'MIME không hợp lệ.';
            return null;
        }
        if (!is_dir(UPLOAD_DIR)) { mkdir(UPLOAD_DIR, 0775, true); }
        $newName = time() . '_' . bin2hex(random_bytes(5)) . '.' . $ext;
        $dest = UPLOAD_DIR . $newName;
        if (!move_uploaded_file($file['tmp_name'], $dest)) {
            $errors['image'] = 'Không thể lưu file upload.';
            return null;
        }
        return $newName;
    }
    public function store(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('/?route=products/create'); }
        $errors = [];
        $clean = $this->validate($_POST, $errors);
        $image = $this->handleUpload($_FILES['image'] ?? null, $errors, null);
        if (!empty($errors)) {
            $old = array_merge($clean, []);
            $this->render('products/create', compact('errors','old'));
            return;
        }
        $data = $clean + ['image' => $image];
        $this->model->create($data);
        $this->redirect('/?route=products/index');
    }
    public function edit(): void {
        $id = (int)($_GET['id'] ?? 0);
        $product = $this->model->find($id);
        if (!$product) { http_response_code(404); echo 'Product not found'; return; }
        $errors = [];
        $old = $product;
        $this->render('products/edit', compact('errors','old','product'));
    }
    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $product = $this->model->find($id);
        if (!$product) { http_response_code(404); echo 'Product not found'; return; }
        $errors = [];
        $clean = $this->validate($_POST, $errors);
        $image = $this->handleUpload($_FILES['image'] ?? null, $errors, $product['image'] ?? null);
        if (!empty($errors)) {
            $old = array_merge($product, $clean);
            $this->render('products/edit', compact('errors','old','product'));
            return;
        }
        $data = $clean + ['image' => $image];
        $this->model->update($id, $data);
        $this->redirect('/?route=products/index');
    }
    public function delete(): void {
        $id = (int)($_GET['id'] ?? 0);
        $product = $this->model->find($id);
        if ($product) {
            // xoá file ảnh nếu có
            if (!empty($product['image'])) {
                $file = UPLOAD_DIR . $product['image'];
                if (is_file($file)) @unlink($file);
            }
            $this->model->delete($id);
        }
        $this->redirect(BASE_URL . '/?route=products/index');

    }
}
