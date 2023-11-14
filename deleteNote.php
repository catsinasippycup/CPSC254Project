<?php
// Establish a connection to the MySQL database
$mysqli = new mysqli("localhost", "root", "1234", "notesDB");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get note ID from the POST request
$noteId = $_POST['id'];

// Delete the note from the database
$sql = "DELETE FROM notes WHERE note_id = $noteId";

if ($mysqli->query($sql) === TRUE) {
    echo "Note deleted successfully";
} else {
    echo "Error deleting note: " . $mysqli->error;
}

// Close the database connection
$mysqli->close();
?>

