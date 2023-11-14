<?php
// Establish a connection to the MySQL database
$mysqli = new mysqli("localhost", "root", "1234", "notesDB");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve all notes from the database
$sql = "SELECT * FROM notes";
$result = $mysqli->query($sql);

$notes = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
    echo json_encode($notes);
} else {
    echo "No notes found";
}

// Close the database connection
$mysqli->close();
?>
