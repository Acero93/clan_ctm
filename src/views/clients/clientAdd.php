<?php


?>

<h1>Añadir Cliente</h1>

<form id="client-form">
    <div class="mb-3">
        <label for="first_name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="first_name" name="first_name" required>
        <div class="invalid-feedback">
            Por favor, ingrese el nombre.
        </div>
    </div>

    <div class="mb-3">
        <label for="last_name" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="last_name" name="last_name" required>
        <div class="invalid-feedback">
            Por favor, ingrese el apellido.
        </div>
    </div>

    <div class="mb-3">
        <label for="phone_number" class="form-label">Teléfono</label>
        <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
        <div class="invalid-feedback">
            Por favor, ingrese un número de teléfono válido.
        </div>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Dirección</label>
        <input type="text" class="form-control" id="address" name="address" required>
        <div class="invalid-feedback">
            Por favor, ingrese la dirección.
        </div>
    </div>

    <div class="mb-3">
        <label for="age" class="form-label">Edad</label>
        <input type="number" class="form-control" id="age" name="attributes[age]" value="" required min="18" max="100">
        <div class="invalid-feedback">
            Por favor, ingrese una edad válida (18-100).
        </div>
    </div>

    <div class="mb-3">
        <label for="gender" class="form-label">Género</label>
        <select class="form-select" id="gender" name="attributes[gender]" required>
            <option value="" disabled>Seleccione el género</option>
            <option value="male">Masculino</option>
            <option value="female">Femenino</option>
            <option value="other">Otro</option>
        </select>

        <div class="invalid-feedback">
            Por favor, seleccione el género.
        </div>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Estado</label>
        <select class="form-select" id="status" name="status" required>
            <option value="active">Activo</option>
            <option value="inactive">Inactivo</option>
        </select>
        <div class="invalid-feedback">
            Por favor, seleccione el estado.
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Agregar Cliente</button>
</form>




<?= loadScripts($scripts ?? []) ?>
<script>
    // Habilitar la validación en el formulario
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();


document.getElementById('client-form').addEventListener('submit', async function (event) {
    event.preventDefault(); // Evitar el envío estándar del formulario

    const form          = event.target;
    const formData      = new FormData(form);
    const attributes    = {};
    const jsonData      = {};

    // Convertir FormData a JSON
    formData.forEach((value, key) => {
        if (key.startsWith('attributes[')) {
            // Extraer el nombre del atributo (entre corchetes)
            const attrKey = key.match(/\[(.*?)\]/)[1];
            attributes[attrKey] = value;
        } else {
            jsonData[key] = value;
        }
    });

    // Añadir los atributos al JSON principal
    jsonData.attributes = attributes;

    try {
        // Enviar datos con fetchRequest
        const response = await fetchRequest('/client/save', 'POST', jsonData);

        console.log(response);

        if (response.success) {
            // Mostrar mensaje de éxito con SweetAlert2
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Cliente guardado exitosamente.',
                confirmButtonText: 'Aceptar',
            });

            setInterval(() => {
                window.location.href = "/clientes/ver/";
            }, 2000);
        } else {
            // Mostrar mensaje de error con SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al guardar el cliente: ' + response.message,
                confirmButtonText: 'Aceptar',
            });
        }
    } catch (error) {
        console.error('Error al enviar el formulario:', error);
        // Mostrar mensaje de error genérico con SweetAlert2
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error al procesar la solicitud.',
            confirmButtonText: 'Aceptar',
        });
    }
});

</script>

