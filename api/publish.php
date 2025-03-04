<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $user_id = $data['user_id'];
    $title = htmlspecialchars($data['title']);
    $description = htmlspecialchars($data['description']);
    $category = $data['category'];
    $starting_bid = $data['starting_bid'];
    $min_increment = $data['min_increment'];
    $image_url = $data['image_url'];

    try {
        $stmt = $pdo->prepare("INSERT INTO items (user_id, title, description, category, starting_bid, min_increment, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $title, $description, $category, $starting_bid, $min_increment, $image_url]);
        echo json_encode(['success' => true, 'message' => 'Publicación creada correctamente']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al crear la publicación']);
    }
}
?>