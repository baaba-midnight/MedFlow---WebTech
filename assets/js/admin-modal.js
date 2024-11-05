const seeDetailsBtns = document.querySelectorAll(".see-details");
const modal = document.querySelector(".modal");
const closeBtn = document.querySelector(".close");

// Open modal
seeDetailsBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        modal.style.display = "block";
    });
});

// Close modal
closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

// Close when clicking outside
window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});

// Store data for each section
