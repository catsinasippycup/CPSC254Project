<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noteID = $_POST["noteID"];
    
    // Check if the note with the given ID exists
    $checkQuery = "SELECT * FROM notes WHERE title='$noteID'";
    $result = $conn->query($checkQuery);
   
    if ($result->num_rows > 0) {
        // Note exists, so delete it
        $sql = "DELETE FROM notes WHERE title='$noteID'";
        
        if ($conn->query($sql) === TRUE) {
            // Redirect back to the main page after deleting the note
            header("Location: noteTaker.php");
            exit();
        } else {
            echo "Error deleting note: " . $conn->error;
        }
    } else {
        echo "Note does not exist.";
    }
} else {
    echo "Invalid request method";
}

$conn->close();
?>
