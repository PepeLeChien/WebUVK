document.addEventListener('DOMContentLoaded', function() {
    const enCarteleraBtn = document.getElementById('en-cartelera-btn');
    const proximosEstrenosBtn = document.getElementById('proximos-estrenos-btn');
    const moviesList = document.getElementById('movies-list');

    if (enCarteleraBtn && proximosEstrenosBtn && moviesList) {
        let estadoEstreno = ['Pelicula', 'Estreno'];

        enCarteleraBtn.addEventListener('click', function() {
            estadoEstreno = ['Pelicula', 'Estreno'];
            setActiveButton(enCarteleraBtn);
            loadMovies();
        });

        proximosEstrenosBtn.addEventListener('click', function() {
            estadoEstreno = ['Pre-Venta'];
            setActiveButton(proximosEstrenosBtn);
            loadMovies();
        });

        function setActiveButton(activeButton) {
            enCarteleraBtn.classList.remove('active');
            proximosEstrenosBtn.classList.remove('active');
            activeButton.classList.add('active');
        }

        function loadMovies() {
            const url = `${window.location.origin}/load-more-movies`;
            const data = {
                estadoEstreno: estadoEstreno
            };

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => { throw new Error(text) });
                }
                return response.json();
            })
            .then(movies => {
                console.log('Movies:', movies); // Añadir este log para depuración
                if (!Array.isArray(movies)) {
                    throw new Error('Expected an array of movies');
                }
                moviesList.innerHTML = '';
                movies.forEach(movie => {
                    fetch(`${window.location.origin}/get-movie-html`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ movie: JSON.stringify(movie) })
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.text().then(text => { throw new Error(text) });
                        }
                        return response.text();
                    })
                    .then(html => {
                        const movieElement = document.createElement('div');
                        movieElement.classList.add('col-lg-4', 'col-6', 'p-lg-5', 'p-2');
                        movieElement.innerHTML = html;
                        moviesList.appendChild(movieElement);
                    })
                    .catch(error => console.error('Error fetching movie HTML:', error));
                });
            })
            .catch(error => console.error('Error loading movies:', error));
        }

        // Cargar películas por defecto
        loadMovies();
    } else {
        console.error('One or more elements not found.');
    }
});
