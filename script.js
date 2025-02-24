document.addEventListener("DOMContentLoaded", function () {
    console.log("JavaScript is loaded!");
    let links = document.querySelectorAll("nav ul li a");
    links.forEach(link => {
        link.addEventListener("click", function () {
            links.forEach(l => l.classList.remove("active"));
            this.classList.add("active");
        });
    });
});
