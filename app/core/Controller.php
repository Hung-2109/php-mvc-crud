<?php
class Controller {
    protected function render(string $view, array $params = []): void {
        extract($params);
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        if (!file_exists($viewFile)) {
            throw new RuntimeException('View not found: ' . $viewFile);
        }
        include __DIR__ . '/../views/layout.php';
    }
    protected function redirect(string $path): void {
        header('Location: ' . BASE_URL . $path);
        exit;
    }
}
