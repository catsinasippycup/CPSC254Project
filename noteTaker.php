<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}

/* Style the tab */
.tab {
  float: left;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  width: 140px; /* width of sidebar */
  height: 600px; /* height of sidebar */
  overflow-y: scroll; /* scroll for sidebar */
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 22px 16px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 0px 12px;
  border: 1px solid #ccc;
  width: 70%;
  border-left: none;
  height: 600px;
}

/* Add this rule to set a fixed height for the textarea with the class 'note-textarea' */
.note-textarea {
  height: 200px; /* Adjust the height as needed */
}
</style>
</head>
<body>

<h2>NoteTaker</h2>

<div class="tab">
  <button class="tablinks" onclick="createNewNote()">Add Note</button>
  <?php include("tabnote.php"); ?>
</div>

<?php include("notes_form.php"); ?>

<script>
var noteCount = <?php echo $result->num_rows; ?>; // Initialize the note count

function openTab(evt, noteNumber) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace("active", "");
  }
  document.getElementById(noteNumber).style.display = "block";
  evt.currentTarget.className += " active";
}

function createNewNote() {
  noteCount++; // Increment the note count
  var newNoteID = "Note" + noteCount;

  // Create a new tab button
  var button = document.createElement("button");
  button.className = "tablinks";
  button.innerHTML = "Note #" + noteCount;
  button.onclick = function (event) {
    openTab(event, newNoteID);
  };

  // Append the new button to the end of the tab container
  document.querySelector(".tab").appendChild(button);

  // Create a new tab content
  var tabcontent = document.createElement("div");
  tabcontent.id = newNoteID;
  tabcontent.className = "tabcontent";
  tabcontent.style.display = "none";
  tabcontent.innerHTML = "<form method='post' action='save_note.php' id='form_" + newNoteID + "'>" +
                        "<h3>Note #" + noteCount + "</h3>" +
                        "<button class='delete-button' onclick='deleteNote(\"" + newNoteID + "\", \"" + button.innerHTML + "\")'>Delete</button>" +
                        "<button type='submit'>Save</button>" +
                        "<input type='hidden' name='noteID' value='" + newNoteID + "'>" +
                        "<textarea name='noteBody' class='note-textarea' placeholder='Write something...' style='width:99%'></textarea>" +
                        "</form>";

  // Append the new tab content to the body
  document.body.appendChild(tabcontent);

  openTab(event, newNoteID); // Open the newly created note
}

function deleteNote(noteID, buttonLabel) {
  // Use fetch to send an AJAX request to delete the note from the server
  fetch('delete_note.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: 'noteID=' + encodeURIComponent(noteID),
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.text();
  })
  .then(data => {
    // Log the server response (for debugging)
    console.log('Server response:', data);

    // On success, remove the note from the UI
    var noteElement = document.getElementById(noteID);
    if (noteElement) {
      noteElement.remove();
    } else {
      console.error('Note element not found in the UI');
    }

    // Remove the corresponding tab button
    var tabButtons = document.querySelectorAll(".tablinks");
    tabButtons.forEach(function (button) {
      if (button.innerHTML === buttonLabel) {
        button.remove();
      }
    });
  })
  .catch(error => {
    console.error('Error deleting note:', error);
  });
}

// Get the element with id="defaultOpen1" and click on it
document.getElementById("defaultOpen1").click();
</script>
   
</body>
</html>
