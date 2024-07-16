$(document).ready(function() {
    fetchMovies();

    function fetchMovies() {
        $.ajax({
            url: '/admin/peliculas/getMovies',
            method: 'GET',
            dataType: 'json',
            success: function(movies) {
                renderMovies(movies);
            },
            error: function(error) {
                console.error('Error fetching movies:', error);
            }
        });
    }

    function renderMovies(movies) {
        const tableBody = $('#moviesTable tbody');
        tableBody.empty();

        movies.forEach(movie => {
            const row = `
                <tr>
                    <td>${movie.id}</td>
                    <td>${movie.nombre}</td>
                    <td>${movie.descripcion}</td>
                    <td>${movie.genero}</td>
                    <td>${movie.clasificacion}</td>
                    <td>${movie.fecha_inicio}</td>
                    <td>${movie.formatos ? movie.formatos : 'N/A'}</td>
                    <td>
                        <a href="/admin/peliculas/edit/${movie.id}" class="btn btn-warning">Editar</a>
                        <form action="/admin/peliculas/delete/${movie.id}" method="POST" style="display:inline;">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            `;

            tableBody.append(row);
        });
    }
});
