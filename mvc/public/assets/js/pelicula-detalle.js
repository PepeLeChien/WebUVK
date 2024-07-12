document.addEventListener('DOMContentLoaded', function() {

    peliculaDetalle();
    
});


function peliculaDetalle(){
    viewTrailer();
    selectDate();
}


function selectDate(){
    const buttons = document.querySelectorAll('.btn-date');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            buttons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
}
 
function onPlayerStateChange(event) {
    const detailMovieContainer = document.getElementById("detailMovieContainer");
    const videoContainer = document.getElementById("videoContainer");
    
    if (event.data == YT.PlayerState.ENDED) {
        videoContainer.classList.add("d-none");
        detailMovieContainer.classList.remove("d-none");
    }
}

function viewTrailer(){

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

        // Reproducir el video automáticamente
        player.playVideo();
    });
}