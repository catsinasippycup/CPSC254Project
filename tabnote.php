<?php
include("database.php");
$sql = "SELECT title, text FROM notes";  // SQL string

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) { // If rows are > 0, 
    while ($row = $result->fetch_assoc()) { // iterate through the rows in the database and fetch title row to display on tabs
        echo "<button class='tablinks' onclick='openTab(event, \"$row[title]\")'>$row[title]</button>";
    }
}
$conn->close(); // As always close the connection when done
?>