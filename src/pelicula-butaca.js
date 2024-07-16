document.addEventListener("DOMContentLoaded", () => {
    const container = document.querySelector(".container-butacas");
    const count = document.getElementById("count");

    function updateSelectedCount() {
        const selectedSeats = Array.from(document.querySelectorAll(".seat.selected:not(.invisible)")).filter(seat => {
            const row = seat.getAttribute('data-row');
            const column = seat.getAttribute('data-column');
            return row && column;
        });

        const selectedSeatsCount = selectedSeats.length;
        count.innerText = selectedSeatsCount;

        const selectedSeatList = selectedSeats.map(seat => {
            const row = seat.getAttribute('data-row');
            const column = seat.getAttribute('data-column');
            return `${row}${column}`;
        });

        console.log("Asientos seleccionados:", selectedSeatList.join(', '));
    }

    container.addEventListener("click", (e) => {
        console.log("se hizo click");
        if (
            e.target.classList.contains("seat") &&
            !e.target.classList.contains("sold") &&
            !e.target.classList.contains("invisible")
        ) {
            e.target.classList.toggle("selected");
            updateSelectedCount();
        }
    });
});
    