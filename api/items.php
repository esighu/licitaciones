<?php
require_once '../db.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT i.*, MAX(b.amount) as last_bid FROM items i LEFT JOIN bids b ON i.id = b.item_id GROUP BY i.id");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($items);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error al cargar los productos']);
}
?>