document.addEventListener("DOMContentLoaded", () => {
    const container = document.querySelector(".container-butacas");
    const seats = document.querySelectorAll(".seat:not(.sold)");
    const count = document.getElementById("count");

    function updateSelectedCount() {
        const selectedSeats = document.querySelectorAll(".seat.selected");
        const selectedSeatsCount = selectedSeats.length;

        count.innerText = selectedSeatsCount;
    }

    container.addEventListener("click", (e) => {
        console.log("se hizo click");
        if (
            e.target.classList.contains("seat") &&
            !e.target.classList.contains("sold")
        ) {
            e.target.classList.toggle("selected");
            updateSelectedCount();
        }
    });
});
