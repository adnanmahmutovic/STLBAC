document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("eventModal");
  const closeBtn = document.querySelector(".close-modal");
  
  // Existing references
  const modalTitle = document.getElementById("modalTitle");
  const modalDate = document.getElementById("modalDate");
  const modalTime = document.getElementById("modalTime");
  const modalLocation = document.getElementById("modalLocation");
  const modalDescription = document.getElementById("modalDescription");
  
  const detailsButtons = document.querySelectorAll(".details-btn");

  detailsButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const title = btn.getAttribute("data-title");
      const date = btn.getAttribute("data-date");
      const time = btn.getAttribute("data-time");
      const location = btn.getAttribute("data-location");
      const description = btn.getAttribute("data-description");
      
      // Populate the modal
      modalTitle.textContent = title;
      modalDate.textContent = `Date: ${date}`;
      modalTime.textContent = `Time: ${time}`;
      modalLocation.textContent = `Location: ${location}`;
      modalDescription.textContent = description;
      
      // Show the modal
      modal.style.display = "block";
    });
  });

  closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
  });

  window.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
});

  