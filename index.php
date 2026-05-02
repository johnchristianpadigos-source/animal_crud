<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Animal Database - View All</title>
</head>
<body>
    <div align="center">
        <h2>Animal Database Records</h2>
        <a href="create.php">Add New Animal</a><br><br>
        
        <table border="1" cellpadding="10" cellspacing="0" width="80%">
            <tr bgcolor="#ccc">
                <th>ID</th>
                <th>Animal Name</th>
                <th>Species</th>
                <th>Age</th>
                <th>Color</th>
                <th>Habitat</th>
                <th>Diet</th>
                <th>Actions</th>
            </tr>
            <?php
            $stmt = $pdo->query("SELECT * FROM animal_data ORDER BY id");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['animal_name'] . "</td>";
                echo "<td>" . $row['species'] . "</td>";
                echo "<td>" . $row['age'] . "</td>";
                echo "<td>" . $row['color'] . "</td>";
                echo "<td>" . $row['habitat'] . "</td>";
                echo "<td>" . $row['diet'] . "</td>";
                echo "<td>
                        <a href='edit.php?id=" . $row['id'] . "'>Edit</a> | 
                        <a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br><a href="index.php">Refresh</a>
    </div>
</body>
</html>