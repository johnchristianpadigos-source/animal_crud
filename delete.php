<?php
include 'config.php';
$id = $_GET['id'] ?? 0;

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM animal_data WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: index.php?deleted=1");
        exit();
    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: index.php");
    exit();
}
?>