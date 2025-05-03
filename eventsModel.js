document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("eventModal");
  const closeBtn = document.querySelector(".close-modal");

  // References to modal content elements
  const modalTitle = document.getElementById("modalTitle");
  const modalDate = document.getElementById("modalDate");
  const modalTime = document.getElementById("modalTime");
  const modalLocation = document.getElementById("modalLocation");
  const modalAddress = document.getElementById("modalAddress");
  const modalDescription = document.getElementById("modalDescription");

  const detailsButtons = document.querySelectorAll(".details-btn");

  detailsButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const title = btn.getAttribute("data-title");
      const date = btn.getAttribute("data-date");
      const time = btn.getAttribute("data-time");
      const location = btn.getAttribute("data-location");
      const address = btn.getAttribute("data-address");
      const description = btn.getAttribute("data-description");
      const speakers = btn.getAttribute("data-speakers");
      const extras = btn.getAttribute("data-extras");

      // Populate modal basic fields
      modalTitle.textContent = title;
      modalDate.textContent = `Date: ${date}`;
      modalTime.textContent = `Time: ${time}`;
      modalLocation.textContent = `Location: ${location}`;
      modalAddress.textContent = `Address: ${address}`;


      // Build speakers list
      const speakerList = speakers
        .split(',')
        .map(name => `<li>${name.trim()}</li>`)
        .join('');
      const speakersHTML = `
        <p><strong>Speakers:</strong></p>
        <ul>${speakerList}</ul>
      `;

      // Build extras list
      const extrasList = extras
        .split(',')
        .map(item => `<li>${item.trim()}</li>`)
        .join('');
      const extrasHTML = `
        <p><strong>What to Expect:</strong></p>
        <ul>${extrasList}</ul>
      `;

      // Combine all content
      modalDescription.innerHTML = `
        ${speakersHTML}
        ${extrasHTML}
        <hr>
        <p>${description}</p>
      `;

      // Show the modal
      modal.style.display = "block";
    });
  });

  // Modal close behavior
  closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
  });

  window.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
});

const rsvpModal = document.getElementById("rsvpModal");
const closeRsvpBtn = document.querySelector(".close-rsvp");
const rsvpButtons = document.querySelectorAll(".rsvp-btn");

rsvpButtons.forEach((btn) => {
  btn.addEventListener("click", () => {
    rsvpModal.style.display = "block";
  });
});

closeRsvpBtn.addEventListener("click", () => {
  rsvpModal.style.display = "none";
});

window.addEventListener("click", (event) => {
  if (event.target === rsvpModal) {
    rsvpModal.style.display = "none";
  }
});
