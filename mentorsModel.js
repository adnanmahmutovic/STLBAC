document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("mentorModal");
  const closeBtn = document.querySelector(".close-modal");

  const mentorName = document.getElementById("mentorName");
  const mentorExpertise = document.getElementById("mentorExpertise");
  const mentorEducation = document.getElementById("mentorEducation");
  const mentorOccupation = document.getElementById("mentorOccupation");
  const mentorBio = document.getElementById("mentorBio");

  const detailsBtns = document.querySelectorAll(".details-btn");

  detailsBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      const name = btn.getAttribute("data-name");
      const expertise = btn.getAttribute("data-expertise");
      const education = btn.getAttribute("data-education");
      const occupation = btn.getAttribute("data-occupation");
      const bio = btn.getAttribute("data-bio");

      mentorName.textContent = name;
      mentorExpertise.textContent = `Expertise: ${expertise}`;

      const educationList = education
        .split('|')
        .map(item => `<li>${item.trim()}</li>`)
        .join('');
      mentorEducation.innerHTML = `<strong>Education:</strong><ul>${educationList}</ul>`;

      const occupationList = occupation
        .split('|')
        .map(item => `<li>${item.trim()}</li>`)
        .join('');
      mentorOccupation.innerHTML = `<strong>Occupation:</strong><ul>${occupationList}</ul>`;

      mentorBio.innerHTML = bio;
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

const messageModal = document.getElementById("messageModal");
const closeMsgBtn = document.querySelector(".close-message-modal");
const messageBtns = document.querySelectorAll(".rsvp-btn");

messageBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    messageModal.style.display = "block";
  });
});

closeMsgBtn.addEventListener("click", () => {
  messageModal.style.display = "none";
});

window.addEventListener("click", (event) => {
  if (event.target === messageModal) {
    messageModal.style.display = "none";
  }
});

const messageForm = document.getElementById("messageForm");
const messageConfirmModal = document.getElementById("messageConfirmModal");
const confirmCloseBtn = document.querySelector(".close-confirm-modal");

messageForm.addEventListener("submit", (e) => {
  e.preventDefault();
  messageModal.style.display = "none";
  messageConfirmModal.style.display = "block";
});

confirmCloseBtn.addEventListener("click", () => {
  messageConfirmModal.style.display = "none";
});

window.addEventListener("click", (event) => {
  if (event.target === messageConfirmModal) {
    messageConfirmModal.style.display = "none";
  }
});
