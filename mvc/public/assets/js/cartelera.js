document.addEventListener('DOMContentLoaded', () => {
    const enCarteleraBtn = document.getElementById('en-cartelera-btn');
    const proximosEstrenosBtn = document.getElementById('proximos-estrenos-btn');
    const moviesList = document.getElementById('movies-list');
    const verMasBtn = document.getElementById('ver-mas-peliculas');
    const carteleraSection = document.getElementById('cartelera');

    let currentList = 'enCartelera';
    let currentIndex = 6;
    const moviesData = {
        enCartelera: JSON.parse(carteleraSection.getAttribute('data-en-cartelera')),
        proximosEstrenos: JSON.parse(carteleraSection.getAttribute('data-proximos-estrenos'))
    };

    function loadMoreMovies() {
        const movies = moviesData[currentList].slice(currentIndex, currentIndex + 6);
        movies.forEach(movie => {
            const movieElement = document.createElement('div');
            movieElement.classList.add('col-lg-4', 'col-6', 'p-lg-5', 'p-2');
            movieElement.innerHTML = `
                <div class="movie-card">
                    <img src="${movie.url_image}" alt="${movie.title}">
                    <h3>${movie.title}</h3>
                </div>
            `;
            moviesList.appendChild(movieElement);
        });
        currentIndex += 6;
        if (currentIndex >= moviesData[currentList].length) {
            verMasBtn.style.display = 'none';
        }
    }

    function switchList(newList) {
        currentList = newList;
        currentIndex = 6;
        moviesList.innerHTML = '';
        loadMoreMovies();
        verMasBtn.style.display = moviesData[currentList].length > 6 ? 'block' : 'none';
    }

    if (enCarteleraBtn && proximosEstrenosBtn && moviesList && verMasBtn) {
        enCarteleraBtn.addEventListener('click', () => {
            enCarteleraBtn.classList.add('active');
            proximosEstrenosBtn.classList.remove('active');
            switchList('enCartelera');
        });

        proximosEstrenosBtn.addEventListener('click', () => {
            proximosEstrenosBtn.classList.add('active');
            enCarteleraBtn.classList.remove('active');
            switchList('proximosEstrenos');
        });

        verMasBtn.addEventListener('click', loadMoreMovies);
    }

    // Load initial movies
    loadMoreMovies();
});
