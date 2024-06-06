<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div class="container mt-5" id="userListContainer">
    <h1 class="text-center mb-4">Lista de Datos</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <button class="btn btn-primary" onclick="mostrarDatos()">Mostrar Datos</button>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Contact_no</th>
                <th scope="col">Lastname</th>
                <th scope="col">Createdtime</th>
            </tr>
        </thead>
        <tbody id="dataTableBody">
            <!-- Aquí se mostrarán los datos -->
        </tbody>
    </table>
</div>


<script>
        // Verificar si el usuario está autenticado
        if (!localStorage.getItem('logged_in')) {
            // Si no está autenticado, redirigir al formulario de inicio de sesión
            window.location.href = 'login.php';
        }
</script>

<script type="text/javascript" src="../js/api.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
