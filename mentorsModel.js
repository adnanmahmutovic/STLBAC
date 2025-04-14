document.addEventListener("DOMContentLoaded", () => {
  // Get the modal element
  const modal = document.getElementById("mentorModal");
  // Get the close button
  const closeBtn = document.querySelector(".close-modal");

  // Grab fields we'll populate
  const mentorName = document.getElementById("mentorName");
  const mentorExpertise = document.getElementById("mentorExpertise");
  const mentorBio = document.getElementById("mentorBio");

  // Get all "Details" buttons
  const detailsBtns = document.querySelectorAll(".details-btn");

  // Open the modal with dynamic data
  detailsBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      // Read from the data attributes on the button
      const name = btn.getAttribute("data-name");
      const expertise = btn.getAttribute("data-expertise");
      const bio = btn.getAttribute("data-bio");

      // Fill in the modal’s text
      mentorName.textContent = name;
      mentorExpertise.textContent = `Expertise: ${expertise}`;
      mentorBio.textContent = bio;

      // Show the modal
      modal.style.display = "block";
    });
  });

  // Close when clicking the "x"
  closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
  });

  // Close if user clicks outside the modal
  window.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
});
