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
  button.onclick = function () {
    openTab(event, newNoteID);
  }
  
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
                          "<textarea name='noteBody' placeholder='Write something...' style='height:85%;width:99%'></textarea>" +
                          "</form>";
  
  // Append the new button and tab content to their respective containers
  document.querySelector(".tab").insertBefore(button, document.querySelector(".tab").lastChild);
  document.body.appendChild(tabcontent);
  
  openTab(event, newNoteID); // Open the newly created note
}

function deleteNote(noteID, buttonLabel) {
  var noteElement = document.getElementById(noteID);
  noteElement.remove(); // Remove the note content
  
  // Remove the corresponding tab button
  var tabButtons = document.querySelectorAll(".tablinks");
  tabButtons.forEach(function (button) {
    if (button.innerHTML === buttonLabel) {
      button.remove();
    }
  });
}

// Get the element with id="defaultOpen1" and click on it
document.getElementById("defaultOpen1").click();
</script>
   
</body>
</html>