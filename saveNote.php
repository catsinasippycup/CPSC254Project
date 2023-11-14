<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
// Establish a connection to the MySQL database
$mysqli = new mysqli("localhost", "root", "1234", "notesDB");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get note content from the POST request
$noteContent = $_POST['content'];

// Insert the note into the database
$sql = "INSERT INTO notes (note_content) VALUES ('$noteContent')";

if ($mysqli->query($sql) === TRUE) {
    echo "Note saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

// Close the database connection
$mysqli->close();
?>
