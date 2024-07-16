document.addEventListener('DOMContentLoaded', function() {
    const continueButton = document.getElementById('continue-button');
    const currentUrl = window.location.pathname;

    if (currentUrl.includes('/compra/pago')) {
        continueButton.href = '/';
    } else if (currentUrl.includes('/compra/tickets')) {
        continueButton.href = '/compra/pago';
    } else if (currentUrl.includes('/compra')) {
        continueButton.href = '/compra/tickets';
    }
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

 