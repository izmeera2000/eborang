<script>
// Flag to check if navigation should be warned
let shouldWarn = true;

// Track form submission state
let isFormSubmitted = false;

// Add event listener to all links to check their href before navigation
document.addEventListener("click", function (event) {
  // Check if the clicked element is a link (<a>)
  if (event.target.tagName === "A") {
    const href = event.target.getAttribute("href");

    // If href doesn't start with '/SelamaTourism/book', set shouldWarn to true
    if (href && !href.startsWith('<?php echo $rootPath; ?>/book')) {
      shouldWarn = true;
    } else {
      shouldWarn = false;
    }
  }
});

// Check if the confirmbooking button is clicked
const confirmButton = document.querySelector('button[type="submit"]');
if (confirmButton) {
  confirmButton.addEventListener("click", function (event) {
    isFormSubmitted = true;  // Flag that the form is being submitted
  });
}

// Add event listener for the beforeunload event to warn the user
window.addEventListener("beforeunload", function (event) {
  // If navigation is going to a different path or form hasn't been submitted yet, show the warning message
  if ((shouldWarn || !window.location.pathname.startsWith('<?php echo $rootPath; ?>/book')) && !isFormSubmitted) {
    const message = "Are you sure you want to leave? Any unsaved changes will be lost.";

    // Standard way to display the message (not all browsers support custom messages)
    event.returnValue = message; // For modern browsers
    return message;  // For older browsers
  }
});

  </script>