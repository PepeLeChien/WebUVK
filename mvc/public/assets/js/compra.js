document.addEventListener('DOMContentLoaded', function() {
    loadTicketDetails();
});

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