<?php
include 'config.php';
$sql = "CREATE TABLE IF NOT EXISTS animal_data (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    animal_name VARCHAR(30) NOT NULL,
    species VARCHAR(30) NOT NULL,
    age INT(3),
    color VARCHAR(20),
    habitat VARCHAR(50),
    diet VARCHAR(50)
)";
if ($pdo->query($sql)) {
    echo "Table animal_data created successfully";
} else {
    echo "Error creating table: " . $pdo->errorInfo()[2];
}
?>