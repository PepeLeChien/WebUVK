// document.addEventListener('DOMContentLoaded', function() {

//     peliculaDetalle();
    
// });


// function peliculaDetalle(){
//     viewTrailer();
//     selectDate();
// }


// function selectDate(){
//     const buttons = document.querySelectorAll('.btn-date');

//     buttons.forEach(button => {
//         button.addEventListener('click', function() {
//             buttons.forEach(btn => btn.classList.remove('active'));
//             this.classList.add('active');
//         });
//     });
// }
 
// function onPlayerStateChange(event) {
//     const detailMovieContainer = document.getElementById("detailMovieContainer");
//     const videoContainer = document.getElementById("videoContainer");
    
//     if (event.data == YT.PlayerState.ENDED) {
//         videoContainer.classList.add("d-none");
//         detailMovieContainer.classList.remove("d-none");
//     }
// }

// function viewTrailer(){

//     player = new YT.Player('trailerVideo', {
//         events: {
//             'onStateChange': onPlayerStateChange
//         }
//     });

//     const detailMovieContainer = document.getElementById("detailMovieContainer");
//     const viewTrailerButton = document.getElementById("viewTrailerButton");
//     const videoContainer = document.getElementById("videoContainer");

//     viewTrailerButton.addEventListener("click", function (event) {
//         event.preventDefault();
        
//         videoContainer.classList.remove("d-none");
//         detailMovieContainer.classList.add("d-none");

//         // Reproducir el video automáticamente
//         player.playVideo();
//     });
// }
document.addEventListener('DOMContentLoaded', function() {
    peliculaDetalle();
});

function peliculaDetalle() {
    
    selectDate();
    selectHorario();
    $('#ticket-movie').text($('#movie-name-title').text()); 
    initTicketDetails();
    loadTicketDetails();
    viewTrailer();
}

function selectDate() {
    const buttons = document.querySelectorAll('.btn-date');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            buttons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
}

function selectHorario() {
    $('input[name="horario"]').on('change', function() {
        $('input[name="horario"]').next().removeClass('active');
        $(this).next().addClass('active');

        const id = $(this).val();
        console.log(`Selected horario ID: ${id}`); // Mensaje de depuración

        $.ajax({
            url: `/api/funcion`,
            type: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(data) {
                console.log('API Response:', data); // Mensaje de depuración

                if (data.error) {
                    console.error('API Error:', data.error);
                } else {
                    updateTicketDetails(data);
                    saveToLocalStorage(data); 
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }
        });
    });
}

function updateTicketDetails(data) {
    $('#ticket-movie').text(data.movieName || '----');
    $('#ticket-date').text(data.fecha); 
    $('#ticket-sala').text(data.sala);
    $('#ticket-hora').text(data.horario);
    $('#ticket-ciudad').text(data.ciudad);
    $('#ticket-cine').text(data.cine);
    $('#ticket-formato').text(data.formato);
    $('#ticket-butaca').text(data.butaca || '----');
}

function initTicketDetails() { 
    $('#ticket-date').text('-'); 
    $('#ticket-sala').text('-');
    $('#ticket-hora').text('-');
    $('#ticket-ciudad').text('-');
    $('#ticket-cine').text('-');
    $('#ticket-formato').text('-');
    $('#ticket-butaca').text('-');
    const ticketData = {movieName: $('#movie-name-title').text()};
    localStorage.setItem('ticketData', JSON.stringify(ticketData));
}



function saveToLocalStorage(data) {
    const ticketData = {
        movieName: $('#movie-name-title').text(),
        date: $('#ticket-date').text(),
        sala: data.sala,
        horario: data.horario,
        ciudad: data.ciudad,
        cine: data.cine,
        formato: data.formato,
        butaca: data.butaca || '----'
    };
    localStorage.setItem('ticketData', JSON.stringify(ticketData));
}

function loadTicketDetails() {
    const ticketData = JSON.parse(localStorage.getItem('ticketData'));
    if (ticketData) {
        $('#ticket-movie-name').text(ticketData.movieName);
        $('#ticket-date').text(ticketData.date);
        $('#ticket-sala').text(ticketData.sala);
        $('#ticket-hora').text(ticketData.horario);
        $('#ticket-ciudad').text(ticketData.ciudad);
        $('#ticket-cine').text(ticketData.cine);
        $('#ticket-formato').text(ticketData.formato);
        $('#ticket-butaca').text(ticketData.butaca);
    }
}
 

function onPlayerStateChange(event) {
    const detailMovieContainer = document.getElementById("detailMovieContainer");
    const videoContainer = document.getElementById("videoContainer");
    
    if (event.data == YT.PlayerState.ENDED) {
        videoContainer.classList.add("d-none");
        detailMovieContainer.classList.remove("d-none");
    }
}

function viewTrailer() {
    player = new YT.Player('trailerVideo', {
        events: {
            'onStateChange': onPlayerStateChange
        }
    });

    const detailMovieContainer = document.getElementById("detailMovieContainer");
    const viewTrailerButton = document.getElementById("viewTrailerButton");
    const videoContainer = document.getElementById("videoContainer");

    viewTrailerButton.addEventListener("click", function (event) {
        event.preventDefault();
        
        videoContainer.classList.remove("d-none");
        detailMovieContainer.classList.add("d-none");

        player.playVideo();
    });
}
