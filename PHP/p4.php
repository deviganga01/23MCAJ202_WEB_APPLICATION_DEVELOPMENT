<?php
$servername = "localhost"; // Change if needed
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is empty
$database = "CricketDB"; 

// Step 1: Create Connection
$conn = new mysqli($servername, $username, $password, $database);

// Step 2: Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 3: Retrieve Data
$sql = "SELECT id, name, role, team FROM players";
$result = $conn->query($sql);

// Step 4: Display Data in HTML Table
echo "<h2>Indian Cricket Players</h2>";
echo "<table border='1' style='border-collapse: collapse; width: 50%; text-align: center;'>
        <tr style='background-color: #f2f2f2;'>
            <th>ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Team</th>
        </tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['role']}</td>
                <td>{$row['team']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No records found</td></tr>";
}

echo "</table>";

// Step 5: Close Connection
$conn->close();
?>
