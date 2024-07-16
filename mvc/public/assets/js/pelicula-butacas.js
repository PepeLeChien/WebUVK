document.addEventListener("DOMContentLoaded", () => {
    const container = $(".container-butacas");
    const count = $("#count");

    function updateSelectedCount() {
        const selectedSeats = $(".seat.selected:not(.invisible)").filter((index, seat) => {
            const row = $(seat).data('row');
            const column = $(seat).data('column');
            return row && column;
        });

        const selectedSeatsCount = selectedSeats.length;
        count.text(selectedSeatsCount);

        const selectedSeatList = selectedSeats.map((index, seat) => {
            const row = $(seat).data('row');
            const column = $(seat).data('column');
            return `${row}${column}`;
        }).get();

        console.log("Asientos seleccionados:", selectedSeatList.join(', '));

        // Actualizar localStorage con las butacas seleccionadas
        const ticketData = JSON.parse(localStorage.getItem('ticketData')) || {};
        ticketData.butaca = selectedSeatList.join(', ');
        localStorage.setItem('ticketData', JSON.stringify(ticketData));
    }

    function fetchOccupiedSeats() {
        const ticketData = JSON.parse(localStorage.getItem('ticketData'));
        const idFuncion = ticketData ? ticketData.idFuncion : 1; // Cambia esto según el ID de la función actual
        $.ajax({
            url: `/api/obtenerButacasOcupadas`,
            method: "GET",
            data: { id_funcion: idFuncion },
            dataType: "json",
            success: function(data) {
                if (data.butacas) {
                    data.butacas.forEach(butaca => {
                        const seatElement = $(`.seat[data-column="${butaca.column}"][data-row="${butaca.row}"]`);
                        if (seatElement.length) {
                            seatElement.addClass("sold");
                        }
                    });
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }

    function loadTicketDetails() {
        const ticketData = JSON.parse(localStorage.getItem('ticketData'));
        if (ticketData) {
            $('#ticket-movie').text(ticketData.movieName || '----');
            $('#ticket-date').text(ticketData.date || '----');
            $('#ticket-sala').text(ticketData.sala || '----');
            $('#ticket-hora').text(ticketData.horario || '----');
            $('#ticket-ciudad').text(ticketData.ciudad || '----');
            $('#ticket-cine').text(ticketData.cine || '----');
            $('#ticket-formato').text(ticketData.formato || '----');
            $('#ticket-butaca').text(ticketData.butaca || '----');
        }
    }

    container.on("click", ".seat:not(.sold):not(.invisible)", function() {
        $(this).toggleClass("selected");
        updateSelectedCount();
    });

    fetchOccupiedSeats();
    loadTicketDetails();
});
