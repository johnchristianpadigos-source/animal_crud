<?php
include 'config.php';
$id = $_GET['id'] ?? 0;
$error = $success = "";

$stmt = $pdo->prepare("SELECT * FROM animal_data WHERE id = ?");
$stmt->execute([$id]);
$animal = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$animal) {
    die("Record not found!");
}

if ($_POST) {
    $animal_name = $_POST['animal_name'];
    $species = $_POST['species'];
    $age = $_POST['age'];
    $color = $_POST['color'];
    $habitat = $_POST['habitat'];
    $diet = $_POST['diet'];
    
    if (empty($animal_name) || empty($species) || empty($age) || empty($color) || empty($habitat) || empty($diet)) {
        $error = "All fields are required!";
    } elseif ($age < 0 || $age > 20) {
        $error = "Age must be between 0 and 20!";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE animal_data SET animal_name=?, species=?, age=?, color=?, habitat=?, diet=? WHERE id=?");
            $stmt->execute([$animal_name, $species, $age, $color, $habitat, $diet, $id]);
            $success = "Record updated successfully!";
        } catch(PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Animal Record</title>
</head>
<body>
    <div align="center">
        <h2>Edit Animal Record (ID: <?php echo $id; ?>)</h2>
        <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
        <?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>
        
        <form method="POST">
            <table border="1" cellpadding="10">
                <tr>
                    <td>Animal Name:</td>
                    <td><input type="text" name="animal_name" value="<?php echo $animal['animal_name']; ?>" required></td>
                </tr>
                <tr>
                    <td>Species:</td>
                    <td><input type="text" name="species" value="<?php echo $animal['species']; ?>" required></td>
                </tr>
                <tr>
                    <td>Age:</td>
                    <td><input type="number" name="age" min="0" max="20" value="<?php echo $animal['age']; ?>" required></td>
                </tr>
                <tr>
                    <td>Color:</td>
                    <td><input type="text" name="color" value="<?php echo $animal['color']; ?>" required></td>
                </tr>
                <tr>
                    <td>Habitat:</td>
                    <td><input type="text" name="habitat" value="<?php echo $animal['habitat']; ?>" required></td>
                </tr>
                <tr>
                    <td>Diet:</td>
                    <td>
                        <select name="diet" required>
                            <option value="Carnivore" <?php echo ($animal['diet']=='Carnivore') ? 'selected' : ''; ?>>Carnivore</option>
                            <option value="Herbivore" <?php echo ($animal['diet']=='Herbivore') ? 'selected' : ''; ?>>Herbivore</option>
                            <option value="Omnivore" <?php echo ($animal['diet']=='Omnivore') ? 'selected' : ''; ?>>Omnivore</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Update Animal">
                        <a href="index.php">Back to List</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>