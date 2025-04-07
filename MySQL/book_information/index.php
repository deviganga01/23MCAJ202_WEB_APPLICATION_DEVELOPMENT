<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Book Entry</title>
</head>
<body>
    <h2>Add Book</h2>
    <form method="POST" action="">
        Accession Number: <input type="text" name="accession_number" required><br><br>
        Title: <input type="text" name="title" required><br><br>
        Authors: <input type="text" name="authors" required><br><br>
        Edition: <input type="text" name="edition" required><br><br>
        Publisher: <input type="text" name="publisher" required><br><br>
        <input type="submit" name="add" value="Add Book">
    </form>

    <?php
    if (isset($_POST['add'])) {
        $accession = $_POST['accession_number'];
        $title = $_POST['title'];
        $authors = $_POST['authors'];
        $edition = $_POST['edition'];
        $publisher = $_POST['publisher'];

        $sql = "INSERT INTO books (accession_number, title, authors, edition, publisher)
                VALUES ('$accession', '$title', '$authors', '$edition', '$publisher')";
        if ($conn->query($sql)) {
            echo "<p>Book added successfully!</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    }
    ?>

    <h2>Search Book by Title</h2>
    <form method="GET" action="">
        Title: <input type="text" name="search_title" required>
        <input type="submit" value="Search">
    </form>

    <?php
    if (isset($_GET['search_title'])) {
        $search = $_GET['search_title'];
        $sql = "SELECT * FROM books WHERE title LIKE '%$search%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h3>Search Results:</h3>";
            echo "<table border='1'>
                    <tr>
                        <th>Accession Number</th>
                        <th>Title</th>
                        <th>Authors</th>
                        <th>Edition</th>
                        <th>Publisher</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['accession_number']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['authors']}</td>
                        <td>{$row['edition']}</td>
                        <td>{$row['publisher']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No books found with that title.</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>
