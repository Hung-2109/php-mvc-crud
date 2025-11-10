<?php
class Product {
    private PDO $db;
    public function __construct() {
        $this->db = Database::getInstance();
    }
    public function all(): array {
        $stmt = $this->db->query('SELECT * FROM products ORDER BY id DESC');
        return $stmt->fetchAll();
    }
    public function find(int $id): ?array {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
    public function create(array $data): int {
        $stmt = $this->db->prepare('INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)');
        $stmt->execute([$data['name'], $data['price'], $data['description'], $data['image']]);
        return (int)$this->db->lastInsertId();
    }
    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare('UPDATE products SET name = ?, price = ?, description = ?, image = ? WHERE id = ?');
        return $stmt->execute([$data['name'], $data['price'], $data['description'], $data['image'], $id]);
    }
    public function delete(int $id): bool {
        $stmt = $this->db->prepare('DELETE FROM products WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
