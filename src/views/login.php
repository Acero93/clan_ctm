<?php include (dirname(__DIR__)) . "/utils/helpers.php";  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "components/baseHead.php"; ?>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow" style="width: 25rem;">
            <h2 class="text-center mb-4">Login CTM</h2>
            <form id="loginForm">
                <div class="mb-3">
                    <label for="email" class="form-label">Usuario</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Ingresa tu usuario" value="">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Ingresa tu contraseña">
                </div>
                <button type="submit" class="btn btn-primary w-100">Ingresar</button>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>



<script>
    document.getElementById('loginForm').addEventListener('submit', async function (event) {
        event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

        // Obtener los valores del formulario
        const email     = document.getElementById('email').value.trim();
        const password  = document.getElementById('password').value.trim();

        // Validar campos
        if (!email || !password) {
            alert('Los campos no pueden estar vacíos');
            return;
        }

        try {
            // Enviar datos al servidor
            const response = await fetch('/auth', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ email, password }),
            });

            // Manejar la respuesta del servidor

            if (response.ok) {
                const data = await response.json();

                // Guardar el token en localStorage
                localStorage.setItem('authToken', data.token);

                // Redirigir al usuario a la ruta proporcionada
                window.location.href = data.path;
            } else {
                const errorData = await response.json();
                alert(errorData.message); // Mostrar mensaje de error
                console.error('Error al iniciar sesión:', errorData);
            }

        } catch (error) {
            console.error('Error during login:', error);
            alert('Error durante el inicio de sesión');
        }
    });
</script>

</body>
</html>
