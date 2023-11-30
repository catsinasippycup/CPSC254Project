<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noteID = $_POST["noteID"];
    $noteBody = $_POST["noteBody"];

    // Check if the note with the given ID exists
    $checkQuery = "SELECT * FROM notes WHERE title='$noteID'"; // SQL string
    $result = $conn->query($checkQuery);
   
    if ($result->num_rows > 0) { // If num rows > 0, 
        $sql = "UPDATE notes SET text='$noteBody' WHERE title='$noteID'"; // Update notes col by setting to the note body and changing title col to noteID 
    } else {
        //  Otherwise just create the note in the database
        $sql = "Insert INTO notes (title, text) 
                VALUES ('$noteID', '$noteBody');";
    }

    if ($conn->query($sql) === TRUE) { // Checks if connection is valid and query is possible
        // Output a script to perform client-side redirection
        echo '<script>window.location.href = "noteTaker.php";</script>';
        exit();
    } else { 
        echo "Error updating note: " . $conn->error; // Otherwise output error
    }

}
$conn->close(); // As always close the connection when done
?>