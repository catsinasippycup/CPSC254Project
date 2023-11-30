<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noteID = $_POST["noteID"];

    $sql = "DELETE FROM notes WHERE title='$noteID'"; // SQL string

    if ($conn->query($sql) === TRUE) { // Checks if the connection and query is possible and deletes the note otherwise give an error
        echo "Note deleted successfully";
    } else {
        echo "Error deleting note: " . $conn->error;
    }
} else {
    echo "Invalid request method";
}
$conn->close(); // As always close the connection when done
?>
