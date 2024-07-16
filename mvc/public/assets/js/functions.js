$(document).ready(function() {
    fetchFunctions();

    function fetchFunctions() {
        $.ajax({
            url: '/admin/funciones/getFunctions',
            method: 'GET',
            dataType: 'json',
            success: function(functions) {
                renderFunctions(functions);
            },
            error: function(error) {
                console.error('Error fetching functions:', error);
            }
        });
    }

    function renderFunctions(functions) {
        const tableBody = $('#functionsTable tbody');
        tableBody.empty();

        functions.forEach(func => {
            const row = `
                <tr>
                    <td>${func.id}</td>
                    <td>${func.cine_sala}</td>
                    <td>${func.pelicula_formato}</td>
                    <td>${func.fecha}</td>
                    <td>${func.horario}</td>
                    <td>${func.estado}</td>
                    <td>
                        <a href="/admin/funciones/edit/${func.id}" class="btn btn-warning">Editar</a>
                        <form action="/admin/funciones/delete/${func.id}" method="POST" style="display:inline;">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            `;

            tableBody.append(row);
        });
    }
});
