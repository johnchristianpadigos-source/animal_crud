<?php
include 'config.php';
$error = $success = "";

if ($_POST) {
    $animal_name = $_POST['animal_name'];
    $species = $_POST['species'];
    $age = $_POST['age'];
    $color = $_POST['color'];
    $habitat = $_POST['habitat'];
    $diet = $_POST['diet'];
    
    // Validation
    if (empty($animal_name) || empty($species) || empty($age) || empty($color) || empty($habitat) || empty($diet)) {
        $error = "All fields are required!";
    } elseif ($age < 0 || $age > 20) {
        $error = "Age must be between 0 and 20!";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO animal_data (animal_name, species, age, color, habitat, diet) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$animal_name, $species, $age, $color, $habitat, $diet]);
            $success = "Record added successfully!";
        } catch(PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Animal</title>
</head>
<body>
    <div align="center">
        <h2>Add New Animal Record</h2>
        <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
        <?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>
        
        <form method="POST">
            <table border="1" cellpadding="10">
                <tr>
                    <td>Animal Name:</td>
                    <td><input type="text" name="animal_name" value="<?php echo isset($_POST['animal_name']) ? $_POST['animal_name'] : ''; ?>" required></td>
                </tr>
                <tr>
                    <td>Species:</td>
                    <td><input type="text" name="species" value="<?php echo isset($_POST['species']) ? $_POST['species'] : ''; ?>" required></td>
                </tr>
                <tr>
                    <td>Age:</td>
                    <td><input type="number" name="age" min="0" max="20" value="<?php echo isset($_POST['age']) ? $_POST['age'] : ''; ?>" required></td>
                </tr>
                <tr>
                    <td>Color:</td>
                    <td><input type="text" name="color" value="<?php echo isset($_POST['color']) ? $_POST['color'] : ''; ?>" required></td>
                </tr>
                <tr>
                    <td>Habitat:</td>
                    <td><input type="text" name="habitat" value="<?php echo isset($_POST['habitat']) ? $_POST['habitat'] : ''; ?>" required></td>
                </tr>
                <tr>
                    <td>Diet:</td>
                    <td>
                        <select name="diet" required>
                            <option value="">Select Diet</option>
                            <option value="Carnivore" <?php echo (isset($_POST['diet']) && $_POST['diet']=='Carnivore') ? 'selected' : ''; ?>>Carnivore</option>
                            <option value="Herbivore" <?php echo (isset($_POST['diet']) && $_POST['diet']=='Herbivore') ? 'selected' : ''; ?>>Herbivore</option>
                            <option value="Omnivore" <?php echo (isset($_POST['diet']) && $_POST['diet']=='Omnivore') ? 'selected' : ''; ?>>Omnivore</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Add Animal">
                        <a href="index.php">Back to List</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>