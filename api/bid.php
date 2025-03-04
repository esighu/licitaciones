<?php
require_once '../db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $item_id = $data['item_id'];
    $user_id = $data['user_id'];
    $amount = $data['amount'];

    try {
        // Validar que la oferta sea mayor que la última oferta
        $stmt = $pdo->prepare("SELECT MAX(amount) as max_bid FROM bids WHERE item_id = ?");
        $stmt->execute([$item_id]);
        $maxBid = $stmt->fetch(PDO::FETCH_ASSOC)['max_bid'] ?? 0;

        if ($amount <= $maxBid) {
            echo json_encode(['success' => false, 'message' => 'La oferta debe ser mayor que la última']);
            exit;
        }

        // Guardar la nueva oferta
        $stmt = $pdo->prepare("INSERT INTO bids (item_id, user_id, amount) VALUES (?, ?, ?)");
        $stmt->execute([$item_id, $user_id, $amount]);
        echo json_encode(['success' => true, 'message' => 'Oferta realizada correctamente']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al realizar la oferta']);
    }
}
?>