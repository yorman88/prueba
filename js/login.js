document.addEventListener('DOMContentLoaded', function() {
    // Obtener token al cargar la página
    fetch('../index.php?action=getToken', {
        method: 'GET'
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {

            const token = data.token;
            localStorage.setItem('token', token);
            console.log('Token almacenado en localStorage');

        } else {
            console.error('Error al obtener el token');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });

    // Manejar el envío del formulario de inicio de sesión
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

        // Obtener los valores del formulario
        const username = document.getElementById('username').value;

        // Obtener el token desde localStorage
        const token = localStorage.getItem('token');

        // Crear un objeto JSON con los datos del formulario
        const formData = {
            username: username,
            password: token
        };

        // Realizar la solicitud Fetch al servidor
        fetch('../index.php?action=login', {
            method: 'POST',
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            // Manejar la respuesta del servidor
            console.log(data);
           
            if (data.status === 'success') {
                localStorage.setItem('logged_in', 'true');
                localStorage.setItem('sessionName', data.sessionName);
                // Redirigir al usuario si el inicio de sesión fue exitoso
                window.location.href = 'api.php';
            } else {
                // Mostrar un mensaje de error al usuario
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Mostrar un mensaje de error al usuario
            alert('Error en la solicitud');
        });
    });
});


// Se borran las variables del localstorage al cerrar la ventana del navegador
window.addEventListener('beforeunload', function() {
    
    localStorage.removeItem('token');
    localStorage.removeItem('logged_in');
    localStorage.removeItem('sessionName');

});