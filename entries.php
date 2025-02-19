<?php
include 'config.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST"); 

$method = $_SERVER['REQUEST_METHOD'];
/*
if ($method == "GET") {
    $stmt = $pdo->query("SELECT entries.*, categories.name as category FROM entries 
                         JOIN categories ON entries.category_id = categories.id
                         ORDER BY entries.created_at ASC");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}*/

if ($method == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['title'], $data['content'], $data['category_id'])) {
        $stmt = $pdo->prepare("INSERT INTO entries (title, content, category_id) VALUES (?, ?, ?)");
        $stmt->execute([$data['title'], $data['content'], $data['category_id']]);
        echo json_encode(["message" => "Entry added successfully"]);
    }
}
?>
