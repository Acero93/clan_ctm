

async function fetchRequest(url, method = 'GET', body = null, headers = {}) {
    const options = {
        method,
        headers: {
            'Content-Type': 'application/json',
            ...headers,
        },
        body: body ? JSON.stringify(body) : null,
    };
    const response = await fetch(url, options);
    return response.json();
}


(function () {
    'use strict';

    // Seleccionar el formulario
    const form = document.getElementById('strategyForm');

    // Validar y enviar el formulario
    form.addEventListener('submit', async function (event) {
        event.preventDefault(); // Evitar el envío tradicional

        // Validar el formulario
        if (!form.checkValidity()) {
            event.stopPropagation();
            form.classList.add('was-validated');
            return;
        }

        // Validar el número de archivos seleccionados
        const fileInput = document.getElementById('maps_img');
        if (fileInput.files.length > 5) {
            fileInput.setCustomValidity('Solo se permiten hasta 5 archivos.');
            fileInput.classList.add('is-invalid');
            event.stopPropagation();
            form.classList.add('was-validated');
            return;
        }

        // Recopilar datos del formulario
        const formData = new FormData(form);

        // Convertir FormData a un objeto JSON
        const data = {};
        formData.forEach((value, key) => {
            if (key === 'maps_img[]') {
                if (!data.maps_img) data.maps_img = [];
                data.maps_img.push(value);
            } else {
                data[key] = value;
            }
        });

        // Enviar los datos al endpoint
        try {
            const response = await fetchRequest('/savemap', 'POST', data);
            console.log('Respuesta del servidor:', response);
            alert('Datos enviados correctamente.');
        } catch (error) {
            console.error('Error al enviar los datos:', error);
            alert('Hubo un error al enviar los datos.');
        }
    }, false);
})();