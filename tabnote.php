<?php
include("database.php");
$sql = "SELECT title, text FROM notes"; 

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<button class='tablinks' onclick='openTab(event, \"$row[title]\")'>$row[title]</button>";
    }
}
?>