// Function to save a note
  function saveNote() {
    var noteContent = document.getElementById("subject").value;

    $.ajax({
      type: "POST",
      url: "saveNote.php",
      data: { content: noteContent },
      success: function(response) {
        console.log("Note saved successfully");
      },
      error: function(error) {
        console.error("Error saving note");
      }
    });
  }

  // Function to load notes
  function loadNotes() {
    $.ajax({
      type: "GET",
      url: "getNotes.php",
      success: function(notes) {
        // Process and display notes on the page
        console.log("Notes loaded successfully", notes);
      },
      error: function(error) {
        console.error("Error loading notes");
      }
    });
  }

  // Function to delete a note
  function deleteNote(noteId) {
    $.ajax({
      type: "POST",
      url: "deleteNote.php",
      data: { id: noteId },
      success: function(response) {
        console.log("Note deleted successfully");
      },
      error: function(error) {
        console.error("Error deleting note");
      }
    });
  }
