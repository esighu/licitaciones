<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $name = htmlspecialchars($data['name']);
    $email = htmlspecialchars($data['email']);
    $password = password_hash($data['password'], PASSWORD_BCRYPT);
    $role = 'user'; // Por defecto, todos son usuarios normales

    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $role]);
        echo json_encode(['success' => true, 'message' => 'Usuario registrado correctamente']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al registrar el usuario']);
    }
}
?>