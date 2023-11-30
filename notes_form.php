<?php
include("database.php");

$sql = "SELECT title, text FROM notes";  // SQL string

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) { // If Rows > 0 in result sets 
    while ($row = $result->fetch_assoc()) { // iterate through rows title and text and output to notes tabs and notes body
        $noteTitle = $row["title"];
        $noteText = $row["text"];

        //  And output HTML for each row  
        echo "<div id='$noteTitle' class='tabcontent' style='display:none;'>";
        echo "<h3>$noteTitle</h3>";
        echo "<button class='delete-button' onclick='deleteNote(\"$noteTitle\", \"$noteTitle\")'>Delete</button>";
        echo "<form method='post' action='save_note.php' id='form_$noteTitle'>";
        echo "<textarea name='noteBody' placeholder='Write something...' style='height:85%;width:99%'>$noteText</textarea>";
        echo "<input type='hidden' name='noteID' value='$noteTitle'>";
        echo "<button type='submit'>Save</button>";
        echo "</form>";
        echo "</div>";
    }
}
$conn->close(); // As always close the connection when done
?>