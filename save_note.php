<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noteID = $_POST["noteID"];
    $noteBody = $_POST["noteBody"];

    // Check if the note with the given ID exists
    $checkQuery = "SELECT * FROM notes WHERE title='$noteID'";
    $result = $conn->query($checkQuery);
   
    if ($result->num_rows > 0) {
        $sql = "UPDATE notes SET text='$noteBody' WHERE title='$noteID'";
    } else {
        // create the note in the database
        $sql = "Insert INTO notes (title, text) 
                VALUES ('$noteID', '$noteBody');";
    }

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the main page after saving the note
        header("Location: noteTaker.php");
        exit();
    } else {
        echo "Error updating note: " . $conn->error;
    }
} else {
    echo "Invalid request method";
}

$conn->close();
?>