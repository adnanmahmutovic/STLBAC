document.addEventListener("DOMContentLoaded", function () {
    // Get the modal element
    var modal = document.getElementById("popupModal");
    
    // Get all "Details" buttons
    var detailsBtns = document.querySelectorAll(".details-btn");
    
    // Get the <span> element that closes the modal
    var closeBtn = document.querySelector(".close");
    
    // Open the modal when any "Details" button is clicked
    detailsBtns.forEach(function (btn) {
      btn.addEventListener("click", function () {
        modal.style.display = "block";
      });
    });
    
    // Close the modal when the close button is clicked
    closeBtn.addEventListener("click", function () {
      modal.style.display = "none";
    });
    
    // Close the modal when clicking outside the modal content
    window.addEventListener("click", function (event) {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    });
  });
  