document.addEventListener("DOMContentLoaded", function() {
    const prevButton = document.querySelector(".prev-page");
    const nextButton = document.querySelector(".next-page");
    const pageNumber = document.querySelector(".page-number");
    const cines = document.querySelectorAll(".container-cine");

    let currentPage = 1;
    const perPage = 3;
    const totalPages = Math.ceil(cines.length / perPage);

    function showPage(page) {
        cines.forEach((cine, index) => {
            cine.style.display = (index >= (page - 1) * perPage && index < page * perPage) ? "block" : "none";
        });
        pageNumber.textContent = page;
    }

    prevButton.addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    nextButton.addEventListener("click", () => {
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    });

    showPage(currentPage);
});