// Función para obtener y mostrar la lista de datos usando jQuery
function mostrarDatos() {
    const sessionName = localStorage.getItem('sessionName'); 

    // Se muestra ventana de sweet alerta para que el usuario sepa que el proceso esta cargando
    Swal.fire({
        title: 'Cargando...',
        text: 'Por favor espera mientras se cargan los datos.',
        icon: 'info',
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading()
        }
    });

    // Peticion al controlador por medio de jQuery para obtener los datos de la api
    $.ajax({
        url: `../index.php?action=lisData&sessionName=${sessionName}`,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            setTimeout(function() {
                Swal.close();

                if (response.status === 'success') {
                    const data = response.data;
                    const dataTableBody = $('#dataTableBody');
                    dataTableBody.empty();

                    // Se recprren las posiciones de la respuesta y se crea la tabla dinamicamente dependiendo de los datos que reciba
                    data.forEach(function(item) {
                        const row = `
                            <tr>
                                <td>${item.id}</td>
                                <td>${item.contact_no}</td>
                                <td>${item.lastname}</td>
                                <td>${item.createdtime}</td>
                            </tr>
                        `;
                        dataTableBody.append(row);
                    });
                } else {
                    console.error('Error:', response.message);
                    Swal.fire('Error', response.message, 'error');
                }
            }, 3000); //setTimeout de 3 segundos para ver el sweet alert
        },
        error: function(error) {
            setTimeout(function() {
                console.error('Error:', error);
                Swal.fire('Error', 'No se pudo cargar los datos.', 'error');
            }, 3000);
        }
    });
}

// Se borran las variables del localstorage al cerrar la ventana del navegador
window.addEventListener('unload', function() {
    
    localStorage.removeItem('token');
    localStorage.removeItem('logged_in');
    localStorage.removeItem('sessionName');

});
