document.addEventListener("DOMContentLoaded", function () {
    const butacas = document.querySelectorAll(".butaca");

    butacas.forEach(butaca => {
        butaca.addEventListener("click", () => {
            if (butaca.dataset.status === "occupied") {
                return; // No permitir seleccionar butacas ocupadas
            }
            butaca.dataset.status = butaca.dataset.status === "selected" ? "available" : "selected";
            butaca.classList.toggle("selected");
        });
    });
});
