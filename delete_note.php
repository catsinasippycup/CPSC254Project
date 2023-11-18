<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noteID = $_POST["noteID"];

    $sql = "DELETE FROM notes WHERE title='$noteID'";

    if ($conn->query($sql) === TRUE) {
        echo "Note deleted successfully";
    } else {
        echo "Error deleting note: " . $conn->error;
    }
} else {
    echo "Invalid request method";
}

$conn->close();
?>
