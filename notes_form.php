<?php
include("database.php");

$sql = "SELECT title, text FROM notes"; // Replace 'notes' with your actual table name

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $noteTitle = $row["title"];
        $noteText = $row["text"];

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
?>